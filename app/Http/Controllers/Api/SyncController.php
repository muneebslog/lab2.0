<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SyncOrderRequest;
use App\Models\Patient;
use App\Models\PatientTest;
use App\Models\Test;
use Illuminate\Http\JsonResponse;

class SyncController extends Controller
{
    public function sync(SyncOrderRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $name = trim($validated['name']);
        $phone = $this->normalizePhone($validated['phone']);
        $receiptNo = $validated['receipt_no'];
        $testCodes = array_map('strval', $validated['test_codes']);

        if (empty($phone)) {
            return response()->json([
                'message' => 'Phone number is required and must be valid.',
            ], 422);
        }

        $tests = Test::whereIn('code', $testCodes)->get();
        $foundCodes = $tests->pluck('code')->map(fn ($c) => (string) $c)->values()->all();
        $invalidCodes = array_diff($testCodes, $foundCodes);

        if (! empty($invalidCodes)) {
            return response()->json([
                'message' => 'One or more test codes are invalid.',
                'invalid_codes' => array_values($invalidCodes),
            ], 422);
        }

        $patient = Patient::where('name', $name)
            ->where('phone', $phone)
            ->first();

        if (! $patient) {
            $patient = Patient::create([
                'name' => $name,
                'phone' => $phone,
                'receipt_no' => $receiptNo,
                'age' => $validated['age'] ?? null,
                'age_unit' => $validated['age_unit'] ?? 'Year',
                'gender' => $validated['gender'] ?? 'male',
                'doctor' => $validated['doctor'] ?? 'Self',
            ]);
        }

        $existingOrder = PatientTest::where('patient_id', $patient->id)
            ->where('receipt_no', $receiptNo)
            ->exists();

        if ($existingOrder) {
            $patientTests = PatientTest::where('patient_id', $patient->id)
                ->where('receipt_no', $receiptNo)
                ->with('test')
                ->get();

            return response()->json([
                'patient_id' => $patient->id,
                'receipt_no' => $receiptNo,
                'patient_tests' => $patientTests->map(fn ($pt) => [
                    'id' => $pt->id,
                    'test_id' => $pt->test_id,
                    'test_code' => $pt->test?->code,
                ]),
            ], 200);
        }

        $testIds = $tests->pluck('id')->all();
        $pivotData = array_fill_keys($testIds, ['receipt_no' => $receiptNo]);
        $patient->tests()->attach($pivotData);

        $patientTests = PatientTest::where('patient_id', $patient->id)
            ->where('receipt_no', $receiptNo)
            ->with('test')
            ->get();

        return response()->json([
            'patient_id' => $patient->id,
            'receipt_no' => $receiptNo,
            'patient_tests' => $patientTests->map(fn ($pt) => [
                'id' => $pt->id,
                'test_id' => $pt->test_id,
                'test_code' => $pt->test?->code,
            ]),
        ], 201);
    }

    private function normalizePhone(string $phone): string
    {
        return preg_replace('/\s+|-+/', '', trim($phone));
    }
}
