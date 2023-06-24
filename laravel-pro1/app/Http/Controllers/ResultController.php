<?php

namespace App\Http\Controllers;

use App\Models\FailOrPass;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Answer;
use App\Models\Question;
use App\Models\TestPaper;
use App\Models\TestAssign;
use App\Models\Result;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    //
    public function resultsCandidate(){

        $id=session()->get('candidate_id');
        
       $res=FailOrPass::where('candidate_id',$id)->with('candidate','exam')->get();
     
       return view('candidate.results',compact('res'))->with('candidate');

       
        


    }
}
