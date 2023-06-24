<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable =[
        'question',
        'level_id'
    ];
    public function answer(){
        return $this->hasMany(Answer::class,'question_id','id');
    }
    public function level(){
        return $this->hasMany(Level::class,'id','level_id');
    }
}
