<?php

use App\Http\Controllers\invoiceController;
use App\Livewire\Invoice;
use App\Livewire\LetterPad;
use App\Livewire\NewCase;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');

Route::redirect('/', 'admin/login');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::get('newcase',NewCase::class)->name('new-case');
Route::get('invoice/{id}',Invoice::class)->name('invoice');
Route::get('invoice/{invoiceId}/download',invoiceController::class)->name('invoiceDownload');

require __DIR__.'/auth.php';
