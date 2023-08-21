<?php

namespace App\Models;

use App\Models\Institute;
use App\Models\StudentClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function examCenter(): BelongsToMany
    {
        return $this->belongsToMany(ExamCenter::class);
    }
    public function exam(): BelongsToMany
    {
        return $this->belongsToMany(Exam::class);
    }

    // public function class(): HasOne
    // {
    //     return $this->hasOne(StudentClass::class);
    // }

    // public function institute(): HasOne
    // {
    //     return $this->hasOne(Institute::class);
    // }

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function student_class()
    {
        return $this->belongsTo(StudentClass::class);
    }
}
