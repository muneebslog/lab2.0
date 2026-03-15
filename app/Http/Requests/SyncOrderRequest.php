<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SyncOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'receipt_no' => ['required', 'string', 'max:100'],
            'test_codes' => ['required', 'array', 'min:1'],
            'test_codes.*' => ['required', 'string'],
            'age' => ['nullable', 'numeric'],
            'age_unit' => ['nullable', 'string', 'in:Month,Year'],
            'gender' => ['nullable', 'string', 'in:male,female'],
            'doctor' => ['nullable', 'string', 'max:255'],
        ];
    }
}
