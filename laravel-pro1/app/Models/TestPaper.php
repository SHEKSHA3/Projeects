<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestPaper extends Model
{
    use HasFactory;

    protected $fillable=[                                   
        'exam_id',
        'question_id'
    ];
    public function exams(){
        return $this->hasMany(Exam::class,'id','exam_id');
    }

    public function question(){
        return $this->hasMany(Question::class,'id','question_id');
    }
    public function answer(){
        return $this->hasMany(Answer::class,'question_id','question_id');
    }
}
