<?php

namespace App\Http\Controllers;

use App\Models\FailOrPass;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\Answer;
use App\Models\Question;
use App\Models\TestPaper;
use App\Models\User;
use App\Models\TestAssign;
use App\Models\Result;
class adminController extends Controller


{

    public function allUsers()
    {
        $userModel = new User();
        $userlist = $userModel->returnAllUsers();
        return view('admin.alluser', ['userlist' => $userlist]);
    }

    public function deleteUser($userId)
    {
       
        
        $user = User::where('id', $userId)
            ->where('is_admin', 0)
            ->first();

        if ($user) {
            // User found, proceed with the deletion
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
            
        } else {
            // User not found or user is an admin
            return response()->json(['message' => 'User not found or is an admin'], 404);
    }

    }

    public function addSubject(Request $request)
    {
        try{
            Subject::insert([
                'subject'=>$request->subject,
            ]);
            return response()->json(['success'=>true,'msg'=>"added successfully"]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);

        }
    }
    public function editSubject(Request $request){
        try{
           $sub=Subject::find($request->id);
           $sub->subject=$request->subject;
           $sub->save();
            return response()->json(['success'=>true,'msg'=>"updated"]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);

        }
    }
    
    // deleting the question from question
    public function deleteQuestion($questionId)
    {  
        $question = Question::find($questionId);
        if ($question) {
            Answer::where('question_id', $questionId)->delete();
            $question->Delete();
            return back();
        } else {
            return response()->json(['error' => 'Question not found'], 404);
        }
    }

    public function testpaperdeleteSubject(Request $request)
    {
        try{
            Subject::where('id',$request->id)->delete();
             return response()->json(['success'=>true,'msg'=>"deleted"]);
        }catch(\Exception $e){
             return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
 
         }
    }

    public function answersheet($id, $examId) {
       
        $data=Result::where('candidate_id',$id)
        ->Where('exam_id',$examId)
        ->with('user','exam','question','answer')
        ->get();
        
        return response()->json(['success'=>true ,'data'=>$data]);
    }
    

    // exam board
    public function examDashboard(){
        $subjects=Subject::all();
        $exams=Exam::with('subject')->get();
        return view('admin.exam-dashboard',['subjects'=>$subjects,'exams'=>$exams]);
    }

    // add exams
    public function addExam(Request $request)
    {
        try{
            Exam::insert([
                'exam_name'=>$request->exam_name, 
                'subject_id'=>$request->subject_id,
                'date'=>$request->date,
                'time'=>$request->time,
                'question'=>$request->question,
                'easy'=>$request->easy,
                'medium'=>$request->medium,
                'hard'=>$request->hard,
                'passing_percentage'=>$request->passing_percentage,
            ]); 
            return response()->json(['success'=>true,'msg'=>"Exam added successfullly"]);
        }catch(\Exception $e){
             return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
 
         }

    }

    public function  getExamDetails($id){
        try{
            $exam=Exam::where('id',$id)->get();
            return response()->json(['success'=>true,'data'=>$exam]);
        }catch(\Exception $e){
             return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
 
         }
    }

    public function updateExam(Request $request ){
        try{
            $exam=Exam::find($request->exam_id);
            if (TestPaper::where('exam_id', $request->exam_id)->exists()) {
                TestPaper::where('exam_id', $request->exam_id)->delete();
            }
            $exam->exam_name=$request->exam_name;
            $exam->subject_id=$request->subject_id;
            $exam->date=$request->date;
            $exam->time=$request->time;
            $exam->question=$request->question;
            $exam->easy=$request->easy;
            $exam->medium=$request->medium;
            $exam->hard=$request->hard;
            $exam->passing_percentage=$request->passing_percentage;
            $exam->save();
            
            return response()->json(['success'=>true,'msg'=>"Exam updated successfullly"]);
        }catch(\Exception $e){
             return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
 
         }

    }

    // delete exam
    public function deleteExam(Request $request)
    {
        try{
            Exam::where('id',$request->exam_id)->delete();
            if (TestPaper::where('exam_id', $request->exam_id)->exists()) {
                TestPaper::where('exam_id', $request->exam_id)->delete();
            }
    
            return response()->json(['success'=>true,'msg'=>"Exam deleted successfullly"]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        }
    }

    public function questionDashBoard(){
        $questions=Question::with('answer','level')->get();
        return view('admin.qnaDashboard',compact('questions'));
    }
    
    // add q and a
    public function questionadition(Request $request){
        try{

            $questionId=Question::insertGetId([
                'question'=>$request->question,
                'level_id'=>$request->level_id,
            ]);
            
            foreach($request->answers as $ans){
                $is_correct=0;
                if($request->is_correct==$ans){
                    $is_correct=1;
                }
                Answer::insert([
                    'question_id'=>$questionId,
                    'answer'=>$ans,
                    'is_correct'=>$is_correct,
                ]);
            }
            return response()->json(['success'=>true,'message'=>"question added successfullly"]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }


    public function takeQuestion(Request $request){
        $qna=Question::where('id',$request->qid)->with('answer','level')->get();
        return response()->json(['data'=>$qna]);
    }


    public function deleteAns(Request $req){
      
        try{
            Answer::where('id',$req->id)->delete();
            return response()->json(['success'=>true,'msg'=>"deleted successfullu"]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        }

    }
// updating the values;
    public function updateQuestion(Request $req){

        try{
            
            Question::where('id',$req->question_id)->update([
                'question'=>$req->question,
            ]);
            return response()->json(['success'=>true,'data'=>"successull"]);
        }
        catch(\Exception $e){
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
            
        }
    }

    // inserting inside the test paper
    public function showExams($examId)
    {
        $test = TestPaper::where('exam_id', $examId)->get();
      
        if ($test->isEmpty()) {
            try {
                $exam_id = $examId;
                
                $exam = Exam::where('id', $exam_id)->first();

                $easyPercentage = $exam->easy;
                $mediumPercentage = $exam->medium;
                $hardPercentage = $exam->hard;
                $totalQuestionCount = $exam->question;
                
                // Calculate the count of questions for each difficulty level
                $easyCount = floor(($easyPercentage / 100) * $totalQuestionCount);
                $mediumCount = floor(($mediumPercentage / 100) * $totalQuestionCount);
                $hardCount = $totalQuestionCount - ($easyCount + $mediumCount);
                
                // Handle cases where the sum of counts is less than the totalQuestionCount
                if (($easyCount + $mediumCount + $hardCount) < $totalQuestionCount) {
                    $hardCount++; // Increase the count of hard questions to make up the difference
                }
                
                // Calculate the remaining count for adjustment
                $remainingCount = $totalQuestionCount - ($easyCount + $mediumCount + $hardCount);
                
                // Fetch questions based on the count for each difficulty level
                $easyQuestions = Question::where('level_id', 1)
                    ->inRandomOrder()
                    ->limit($easyCount)
                    ->with('answer', 'level')
                    ->get();
                
                $mediumQuestions = Question::where('level_id', 2)
                    ->inRandomOrder()
                    ->limit($mediumCount)
                    ->with('answer', 'level')
                    ->get();
    
                $hardQuestions = Question::where('level_id', 3)
                    ->inRandomOrder()
                    ->limit($hardCount)
                    ->with('answer', 'level')
                    ->get();
                
                // Fetch additional questions to adjust remaining count
                $remainingQuestions = Question::whereNotIn('id', $easyQuestions->pluck('id'))
                    ->whereNotIn('id', $mediumQuestions->pluck('id'))
                    ->whereNotIn('id', $hardQuestions->pluck('id'))
                    ->inRandomOrder()
                    ->limit($remainingCount)
                    ->with('answer', 'level')
                    ->get();
               
                // Combine the questions from each level into a single collection
                $questions = $easyQuestions->concat($mediumQuestions)->concat($hardQuestions)->concat($remainingQuestions);
                
                foreach ($questions as $question) {
                    TestPaper::insert([
                        'question_id' => $question->id,
                        'exam_id' => $exam_id,
                    ]);
                }
                
                return response()->json(['success' => true, 'msg' => 'Successfully generated the test paper.']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'msg' => $e->getMessage()]);
            }
        } else {
            return response()->json(['success' => false, 'msg' => 'Exam is already generated. Please visit the Test area.']);
        }
    }
    

public function testpaper()
    {
        $testPapers = TestPaper::distinct('exam_id')->with('exams', 'question')->get(['exam_id']);
        return view('admin.testpapers', compact('testPapers'));
    }
    public function getTest(Request $request){
       try{
        $exam_id=$request->id;
        $testquestion=TestPaper::where('id',$exam_id);
        return response()->json(['success'=>true,'data'=>$testquestion]);
       }
       catch(\Exception $e){
        return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
       }

    }

    
    public function testAssignment()
    {
        $exams = Exam::get();
        $candidates = User::where('is_admin', 0)->get();
        $testAssigned = TestAssign::with('exam', 'candidate')->get();
        $total = $exams->concat($candidates)->concat($testAssigned);
        return view('admin.testAssignment', compact('total', 'testAssigned'))->with('exam', 'candidate');
    }
    
    
    public function testAssignmentTocandidates(Request $request){

        TestAssign::insert([
            'student_id' => $request->candidate,
            'exam_id' => $request->exam,
        ]);
        return back();
    }
    
    public function allcandidateresult(){

        $results=FailOrPass::with('candidate','exam')->get();
        return view('admin.result')->with('results', $results);
    }
    // fetching the question i 
     public function fetchQuestions(Request $req)
     {
      try{
        $examId=$req->input('examId');
       
        $result=TestPaper::where('exam_id',$examId)->with('question','answer')->get();
        return response()->json(['data'=>$result,'success'=>true]);
      }
      catch(\Exception $e){
        return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
      }
 
    }

    // test Assign deleting
    public function deleteTestCandidate(Request $request)
    {
        $studentId = $request->query('studentId');
        $examId = $request->query('examId');
        $candidate = TestAssign::where('student_id', $studentId)
                           ->where('exam_id', $examId)
                           ->first();
        if($candidate){
            $candidate->delete();
            return back();
        }else{
            return back();
        }

        // Perform the necessary actions to delete the test candidate
        // Use the $studentId and $examId variables as needed

        return response()->json(['message' => 'Test candidate deleted successfully'], 200);
    }
}