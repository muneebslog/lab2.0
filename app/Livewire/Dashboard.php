<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Patient;
use App\Models\PatientTest;
use Livewire\Component;

class Dashboard extends Component
{
    public $stats = [];

    public function mount()
    {
        $today = Carbon::today();

        // Today's patients with their tests
        $todayPatients = Patient::whereDate('created_at', $today)
            ->with('tests')
            ->get();

        $todayTestsLeft = 0;
        $todayCasesPending = 0;
        $todayCasesDone = 0;

        foreach ($todayPatients as $patient) {
            $pendingCount = $patient->tests->filter(fn($t) => (int) $t->pivot->isResultAdded === 0)->count();
            $totalTests = $patient->tests->count();

            if ($pendingCount > 0) {
                $todayCasesPending++;
                $todayTestsLeft += $pendingCount;
            } elseif ($totalTests > 0) {
                $todayCasesDone++;
            }
        }

        // Overall stats (all pending tests, not just today)
        $totalTestsLeft = PatientTest::where('isResultAdded', 0)->count();
        $totalCasesAwaiting = Patient::whereHas('tests', function ($q) {
            $q->where('patient_test.isResultAdded', 0);
        })->count();

        $this->stats = [
            'today_cases' => $todayPatients->count(),
            'today_tests_left' => $todayTestsLeft,
            'today_cases_pending' => $todayCasesPending,
            'today_cases_done' => $todayCasesDone,
            'total_tests_left' => $totalTestsLeft,
            'total_cases_awaiting' => $totalCasesAwaiting,
        ];
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'stats' => $this->stats,
        ])->layout('layouts.app', [
            'header' => view('livewire.partials.dashboard-header'),
        ]);
    }
}
