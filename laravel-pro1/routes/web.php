<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\RegistereController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SearchController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('/login');
});

Route::get('/register', [RegistereController::class, 'loadRegister']);
Route::post('/register', [RegistereController::class, 'candidateRegister'])->name('candidateRegister');

Route::get('/login', [RegistereController::class, 'loadlogin']);
Route::post('/login', [RegistereController::class, 'userLogin'])->name('userLogin');

Route::group(['middleware' => ['web', 'checkAdmin']], function () {

    // all users
    Route::get('/alluser',[adminController::class,'allUsers']);
    Route::get('/deleteuser/{userId}',[adminController::class,'deleteuser'])->name('admin.deleteUser');
    Route::get('/admin/dashboard', [RegistereController::class,'adminDashboard']);

    // question delete
    Route::get('/deleteQuestion/{id}', [adminController::class, 'deleteQuestion'])->name('delete.question');





    // subject
    Route::post('/addSubject',[adminController::class,'addSubject'])->name('addSubject');

    Route::post('/editSubject',[adminController::class,'editSubject'])->name('editSubject');
    Route::post('/deleteSubject',[adminController::class,'deleteSubject'])->name('deleteSubject');

    // /admin/exam
    Route::get('/admin/exam',[adminController::class,'examDashboard']);
    Route::post('/add-exam',[adminController::class,'addExam'])->name('addExam');
    Route::get('/get-exam-detail/{id}',[adminController::class,'getExamDetails'])->name('getExamDetails');
    Route::post('/update-exam',[adminController::class,'updateExam'])->name('updateExam');
    Route::post('/delete-exam',[adminController::class,'deleteExam'])->name('deleteExam');


    
    Route::get('/admin/question',[adminController::class,'questionDashBoard'])->name('qaDashboard');
    Route::post('/add-qna-ans',[adminController::class,'questionadition'])->name('addQna');
    Route::get('get-qna-details',[adminController::class,'takeQuestion'])->name('getQnaDetail');
    Route::get('delete-ans',[adminController::class,'deleteAns'])->name('deleteAns');
    Route::post('/update-qna-ans',[adminController::class,'updateQuestion'])->name('updateQna');



    // testpaers and view:
    Route::get('/testpaper',[adminController::class,'testpaper'])->name('testpaper');
    Route::get('/get-exam-details/{id}',[adminController::class,'getTest'])->name('getTest');

    //test assigned     
    Route::get('/testAssignment',[adminController::class,'testAssignment'])->name('testAssignment');
    Route::post('/testAssignmentTocandidates',[adminController::class,'testAssignmentTocandidates'])->name('testAssignmentTocandidates');
    Route::get('/fetchQuestions', [adminController::class, 'fetchQuestions'])->name('fetchQuestions');
    Route::get('/deleteTestCandidate', [adminController::class, 'deleteTestCandidate'])->name('deleteTestCandidate');

    // all candidate results sheet
    Route::get('/allcandidateresult',[adminController::class,'allcandidateresult']);
    Route::get('/answersheet/{id}/{exam_id}', [adminController::class, 'answersheet'])->name('answersheet');

});


Route::group(['middleware' => ['web', 'checkCandidate']], function () {
    Route::get('/dashboard', [RegistereController::class, 'loadDashboard']);
    Route::get('/exams',[CandidateController::class,'testAssignedToMe'])->name('testAssignedToMe');
    Route::get('/start-exam/{id}', [CandidateController::class, 'startExam'])->name('startExam');
    Route::post('/examresult',[CandidateController::class,'examresult'])->name('examresult');

});

// Route for Result 
Route::get('/showExam/{examId}', [AdminController::class, 'showExams'])->name('showExam');
Route::get('/results',[ResultController::class,'resultsCandidate'])->name('results');
Route::get('/forgotPassword',[RegistereController::class,'forgotPassword']);
Route::post('/forgotPassword',[RegistereController::class,'updatedPassword'])->name('forgotPassword');



Route::get('/logout', [RegistereController::class, 'logout']);


