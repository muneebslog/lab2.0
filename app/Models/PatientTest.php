<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTest extends Model
{
    protected $table="patient_tests";
    use HasFactory;
    protected $fillable=[
        'isResultAdded','isPrinted'
    ];

    public function testResults()
    {
        return $this->belongsToMany(TestResult::class);
    }
}
