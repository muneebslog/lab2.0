<?php

namespace App\Livewire;

use App\Models\Patient;
use Livewire\Component;

class Invoice extends Component
{
    public $qr;
    public $total=0;

    public $patient;
    public function mount($id)
    {

       $data=Patient::with('tests')->find($id);
    //    dd($data);
       $this->patient = $data;
        foreach ($data->tests as $test) {
            # code...
            $this->total+=($test->price);
        }

    }
    public function render()
    {
        return view('livewire.invoice');
    }
}
