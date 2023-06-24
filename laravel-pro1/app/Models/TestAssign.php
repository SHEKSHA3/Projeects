<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAssign extends Model
{
    use HasFactory;

    protected $fillable=[
        'stundent_id',
        'exam_id'
    ];

    public function exam(){
        return $this->hasMany(Exam::class,'id','exam_id');
    }

    public function candidate(){
        return $this->hasMany(User::class,'id','student_id');
    }
}
