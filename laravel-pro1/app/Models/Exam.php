<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'exam_name',
        'subject_id',
        'data',
        'time',
        'easy',
        'medium',
        'hard',
        'passing_percentage'

    ];
   
    public function subject()
    {
        return $this->hasMany(Subject::class,'id','subject_id'); 
    }
}

