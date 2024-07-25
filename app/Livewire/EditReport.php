<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PatientTest;

class EditReport extends Component
{

    public $data;
    public function mount($id){
        $data=PatientTest::with('patient','test','testResults')->find($id);
        // dd($data->id);
        // $results=TestResult::where('patient_test_id',$data->id)->get();
        // dd($results[0]);
        $this->data=$data;
        // $this->hi();
        // dd($data->testResults);

    }
    public function render()
    {
        return view('livewire.edit-report');
    }
}
