<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Answer;
use App\Models\Question;
use App\Models\TestPaper;
use App\Models\TestAssign;
use App\Models\Result;
use App\Models\FailOrPass;
use Illuminate\Support\Facades\DB;


class CandidateController extends Controller
{
    public function testAssignedToMe()
    {
        $id = session()->get('candidate_id');
        $testshow = TestAssign::where('student_id', $id)->with('candidate','exam')->get(); // Add get() to retrieve the test assignments
        return view('candidate.exam', compact('testshow'));
    }
    

    // when start button pressed in candiadate dash
    public function startExam(Request $request){
        
       
       
        $values=TestPaper::where('exam_id',$request->id)->get();
        
        $values=TestPaper::where('exam_id',$request->id)->with('exams')->pluck('question_id');

        $exam=Exam::where('id',$request->id)->get();
        
       
        $values = Question::whereIn('id', $values)->get();


        return view('candidate.startExam',compact('values','exam',))->with(['candidate_id'=>session()->get('candidate_id'),'exam_id'=>$request->id]);
    }

    // to store the exam result

    
  public function examresult(Request $request)
{   
    $answers = $request->input('answer');
    $candidateId = $request->input('candidate_id');
    $examId = $request->input('exam_id');
    $totalMarks = 0;

    foreach ($answers as $questionId => $answerId) {
        $result = Result::insert([
            'candidate_id' => $candidateId,
            'exam_id' => $examId,
            'question_id' => $questionId,
            'answer_id' => $answerId
        ]);

        // Retrieve the is_correct value for the selected answer
        $isCorrect = Answer::where('id', $answerId)->value('is_correct');

        if ($isCorrect) {
            // Increment the totalMarks if the answer is correct
            $totalMarks++;
        }
    }
// dd($totalMarks);
    // Store the marks in the pass_or_fails table
    FailOrPass::insert([
        'candidate_id' => $candidateId,
        'exam_id' => $examId,
        'marks' => $totalMarks
    ]);
    // dd(FailOrPass::get())

    return view('candidate.thankyou');
}

}

