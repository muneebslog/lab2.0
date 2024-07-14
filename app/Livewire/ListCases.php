<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Patient;
use Livewire\Component;

class ListCases extends Component
{
    public $patients;
    public $date;
    public function mount(){
        $this->date=Carbon::today();
        $this->getData();
    }

    public function getData(){
        $this->patients = Patient::whereDate('created_at', $this->date)
        ->orderBy('created_at', 'desc')
        ->with('tests')
        ->get();
        // dd($this->patients);
    }
    public function nextDay(){
        $carbonDate = Carbon::parse($this->date);

    // Check if $this->date is today
    if ($carbonDate->isToday()) {
        // If it's today, don't advance to the next day
        return;
    }
    else{
        $this->date = $carbonDate->addDay();
        $this->getData();
    }
    }

    public function prevDay(){
        $this->date = Carbon::parse($this->date)->subDay();
        $this->getData();

    }
    public function render()
    {
        return view('livewire.list-cases');
    }
}
