<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'age', 'phone'];

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'patient_test', 'patient_id', 'test_id')->withTimestamps();
    }
}
