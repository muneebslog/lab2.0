<?php

use App\Http\Controllers\invoiceController;
use App\Http\Controllers\LetterPadController;
use App\Livewire\AddResults;
use App\Livewire\Invoice;
use App\Livewire\LetterPad;
use App\Livewire\ListCases;
use App\Livewire\NewCase;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');

Route::redirect('/', 'dashboard');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::get('newcase',NewCase::class)->name('new-case');
Route::get('invoice/{id}',Invoice::class)->name('invoice');
Route::get('caselist',ListCases::class)->name('cases-list');
// Route::get('test/add/results/{id}',AddResults::class)->name('addResults');
Route::get('test/addresults/{patientId}/{testId}',AddResults::class)->name('addResults');
Route::get('invoice/{invoiceId}/download',invoiceController::class)->name('invoiceDownload');
Route::get('letterpad',LetterPadController::class)->name('letterpad');

require __DIR__.'/auth.php';
