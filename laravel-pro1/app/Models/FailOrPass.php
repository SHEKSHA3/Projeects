<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailOrPass extends Model
{
    use HasFactory;

    protected $fillable=[
        'candidate_id',
        'exam_id,',
        'marks',
    ];

    public function candidate(){
        return $this->belongsTo(User::class, 'candidate_id', 'id');
    }
    
    
    public function exam(){
        return $this->hasMany(Exam::class,'id','exam_id');
    }

    public static function getResultsByCandidateId($candidateId)
    {
        return FailOrPass::where('candidate_id', $candidateId)->with('candidate', 'exam')->get();
    }
    
}
 