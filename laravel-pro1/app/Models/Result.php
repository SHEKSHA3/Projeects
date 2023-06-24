<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'exam_id',
        'question_id',
        'answer_id'
    ];

    public function user(){
        return $this->hasMany(User::class,'id','candidate_id');
    }

    public function exam(){
        return $this->hasMany(Exam::class,'id','exam_id');
    }

    public function question(){
        return $this->hasMany(Question::class,'id','question_id');

    }
    public function answer(){
        return $this->hasMany(Answer::class,'id','answer_id');
    }
}
