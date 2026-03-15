<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Patient;
use Livewire\Component;

class ListCases extends Component
{
    public $patients;
    public $search = '';
    public $dateFrom;
    public $dateTo;

    public function mount()
    {
        $this->dateFrom = Carbon::today()->format('Y-m-d');
        $this->dateTo = Carbon::today()->format('Y-m-d');
        $this->getData();
    }

    public function getData()
    {
        $query = Patient::query();

        if (!empty(trim($this->search))) {
            $term = '%' . trim($this->search) . '%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                    ->orWhere('phone', 'like', $term);
            });
        }

        if (!empty($this->dateFrom)) {
            $query->whereDate('created_at', '>=', $this->dateFrom);
        }

        if (!empty($this->dateTo)) {
            $query->whereDate('created_at', '<=', $this->dateTo);
        }

        $this->patients = $query->orderBy('created_at', 'desc')
            ->with('tests')
            ->get();
    }

    public function updatedSearch()
    {
        $this->getData();
    }

    public function updatedDateFrom()
    {
        $this->getData();
    }

    public function updatedDateTo()
    {
        $this->getData();
    }

    public function clearDates()
    {
        $this->dateFrom = null;
        $this->dateTo = null;
        $this->getData();
    }

    public function render()
    {
        return view('livewire.list-cases');
    }
}
