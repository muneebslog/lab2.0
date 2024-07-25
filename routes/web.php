<?php

use App\Livewire\Invoice;
use App\Livewire\NewCase;
use App\Livewire\LetterPad;
use App\Livewire\ListCases;
use App\Livewire\AddResults;
use App\Livewire\ShowReport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\TestViewController;
use App\Http\Controllers\LetterPadController;
use App\Http\Controllers\QRcodeGenerateController;
use App\Livewire\EditReport;

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
// Route::get('caselist',ListCases::class)->name('cases-list');
Route::get('caselist',ListCases::class)->name('cases-list');
// Route::get('test/add/results/{id}',AddResults::class)->name('addResults');
Route::get('test/addresults/{patientId}/{testId}',AddResults::class)->name('addResults');
Route::get('report/show/{id}',ShowReport::class)->name('showreport');
Route::get('report/edit/{id}',EditReport::class)->name('editreport');
Route::get('invoice/{invoiceId}/download',invoiceController::class)->name('invoiceDownload');
Route::get('letterpad',LetterPadController::class)->name('letterpad');
Route::get('report/view/{id}',TestViewController::class)->name('reportShow');
// Route::get('/qr', [QRcodeGenerateController::class,'qrcode']);

require __DIR__.'/auth.php';
