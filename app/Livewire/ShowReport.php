<?php

namespace App\Livewire;

use App\Models\PatientTest;
use App\Models\TestResult;
use Livewire\Component;

class ShowReport extends Component
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
    public function hi(){
        PatientTest::find(24)->update([
            'isResultAdded'=>1
        ]);
    }
    public function render()
    {
        return view('livewire.show-report')->layout('invoices.letterpad');
    }
}
