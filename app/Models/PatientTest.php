<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTest extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'test_id',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    /**
     * The test that this patient_test belongs to.
     */
    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id');
    }
}
