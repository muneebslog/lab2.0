<?php

namespace App\Livewire;

use App\Models\Test;
use App\Models\Patient;
use Livewire\Component;
use App\Models\TestResult;
use App\Models\PatientTest;

class AddResults extends Component
{
    public $patient;
    public $patient_id="";
    public $test_id="";
    public $results = [];

    public function mount($patientId, $testId)
    {
        $this->patient = Patient::with(['tests' => function ($query) use ($testId) {
            $query->wherePivot('isResultAdded', 0)->where('test_id', $testId);
        }])->findOrFail($patientId);
        $this->test_id = $testId;
        $this->patient_id= $patientId;
        // dd($this->patient);
    }

    public function save()
    {
        // dd($this->results);
        foreach ($this->results as $testCode => $array) {
            # code...
            $data = PatientTest::where('patient_id', $this->patient->id)
                ->where('test_id', $testCode)->get();
            $data=$data[0];
            $patient_test_id=($data->id);
            foreach ($array as $test_field_id => $result) {
                TestResult::create([
                    'patient_test_id' => $patient_test_id,
                    'test_field_id'=> $test_field_id,
                    'result'=> $result
                ]);
            }
            $data->update([
                'isResultAdded' => 1,
                // You can update other fields as needed here
            ]);
        }
        return redirect()->route('invoice', ['id' => $this->patient_id]);
        // dd($data[0]->id);
    }
    public function render()
    {
        return view('livewire.add-results');
    }
}
