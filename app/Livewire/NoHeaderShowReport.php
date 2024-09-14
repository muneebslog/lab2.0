<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PatientTest;

class NoHeaderShowReport extends Component
{
    public $data;
    public function mount($id){
        // dd($id);
        $data=PatientTest::with('patient','test','testResults')->find($id);
        // dd($data->id);
        // $results=TestResult::where('patient_test_id',$data->id)->get();
        // dd($data->test->code);
        $this->data=$data;
        // $this->hi();
        // dd($data);

    }
    public function hi(){
        PatientTest::find(24)->update([
            'isResultAdded'=>1
        ]);
    }
    public function render()
    {
        return view('livewire.no-header-show-report')->layout('invoices.noheader');
    }
}
