<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestField extends Model
{
    use HasFactory;
    protected $fillable = [
        'field_name',
        'unit',
        'min_value',
        'max_value',
        'created_at',
        'updated_at',
    ];

    public function tests()
    {
        return $this->belongsToMany(Test::class, 'test_test_field', 'test_field_id', 'test_id');
    }
}
