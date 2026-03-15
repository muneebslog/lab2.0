<?php

namespace App\Livewire;

use App\Models\Patient;
use App\Models\PatientTest;
use Livewire\Component;

class TrackMyTests extends Component
{
    public ?string $receipt = null;

    public ?Patient $patient = null;

    public ?string $error = null;

    public function mount(): void
    {
        $this->receipt = request()->query('receipt');
        $this->receipt = $this->receipt ? trim($this->receipt) : null;

        if ($this->receipt) {
            $this->loadPatient();
        }
    }

    protected function loadPatient(): void
    {
        $this->error = null;
        $this->patient = Patient::where('receipt_no', $this->receipt)
            ->with(['tests' => fn ($q) => $q->withPivot('id', 'isResultAdded', 'isPrinted', 'receipt_no')])
            ->first();

        if (! $this->patient) {
            $patientTest = PatientTest::where('receipt_no', $this->receipt)->first();
            if ($patientTest) {
                $this->patient = $patientTest->patient;
                $this->patient->setRelation(
                    'tests',
                    $this->patient->tests()->wherePivot('receipt_no', $this->receipt)->withPivot('id', 'isResultAdded', 'isPrinted', 'receipt_no')->get()
                );
                $this->patient->receipt_no = $this->receipt; // for display in view
            }
        }

        if (! $this->patient) {
            $this->error = 'No tests found for this receipt number.';
        }
    }

    public function lookup(): void
    {
        $this->validate([
            'receipt' => ['required', 'string', 'max:100'],
        ]);

        $this->redirect(route('track-my-tests', ['receipt' => trim($this->receipt)]), navigate: true);
    }

    public function render()
    {
        return view('livewire.track-my-tests')
            ->layout('layouts.track');
    }
}
