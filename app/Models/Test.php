<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'short_hand'];

    public function testFields()
    {
        return $this->belongsToMany(TestField::class, 'test_test_field', 'test_id', 'test_field_id');
    }
}
