<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age','age_unit', 'phone', 'gender','doctor','receipt_no'];

    public function tests()
    {
        return $this->BelongsToMany(Test::class)
        ->withPivot('isResultAdded','isPrinted','id');
    }
}
