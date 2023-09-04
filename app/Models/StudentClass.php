<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentClass extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
