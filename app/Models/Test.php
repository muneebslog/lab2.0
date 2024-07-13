<?php

namespace App\Models;

use App\Models\TestField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'short_hand'];

  public function testFields()  {
    return $this->BelongsToMany(TestField::class);
  }

 public function Patients(){
    return $this->BelongsToMany(Patient::class);
 }
}
