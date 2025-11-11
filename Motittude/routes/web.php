<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\SubjectController;
use App\Http\Controllers\User\QuestionController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\User\QuizController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\AdvertController;


use App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use App\Models\Quiz;


//User route
//Route::get('/', function () {
//    return view('index');
//});
Route::get('/profile', function () {
    return view('user.profile');
});



//Route::get('/test-db', function () {
    //return Quiz::with(['questions.options', 'answers'])->get();
//});


Route::get('/test-db', function () {
    return Quiz::with([
        'participants'        // The question each answer was for
    ])->get();
});

Route::get('/', [\App\Http\Controllers\ParticipantController::class, 'index']);

//Auth route
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::get('/signup', [\App\Http\Controllers\AuthController::class, 'signup']);
Route::post('/signup', [\App\Http\Controllers\AuthController::class, 'signup'])->name('signup');

Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');



//User Auth
Route::prefix('user')->name('user.')->group(function () {
    //Route::match(['get', 'post'], '/login', [AuthController::class, 'login']);
    //Route::match(['get', 'post'], '/signup', [AuthController::class, 'signup']);

    Route::get('/questions/create/{quiz_id}', [\App\Http\Controllers\User\QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions/store', [\App\Http\Controllers\User\QuestionController::class, 'store'])->name('questions.store');
    Route::get('/quiz/{quiz_id}/questions', [\App\Http\Controllers\User\QuestionController::class, 'show'])->name('questions.show');
    Route::get('/quiz/{quiz_id}/question/{index?}', [\App\Http\Controllers\User\QuestionController::class, 'show_id'])->name('questions.show_id');
    Route::post('/question/{question}/update', [\App\Http\Controllers\User\QuestionController::class, 'update'])->name('questions.update');


    Route::get('/quiz/create', [\App\Http\Controllers\User\QuizController::class, 'create'])->name('quiz.create');
    Route::post('/quiz/store', [\App\Http\Controllers\User\QuizController::class, 'store'])->name('quiz.store');
    Route::get('/quiz/show', [\App\Http\Controllers\User\QuizController::class, 'show'])->name('quiz.show');
    Route::get('/quiz/{quiz}/enrolluser', [QuizController::class, 'enrollForm'])->name('enroll');
    Route::post('/quiz/{quiz}/enrolluser', [QuizController::class, 'storeParticipant'])->name('storeParticipant');

    Route::get('/advert/videoForm', [AdvertController::class, 'videoForm'])->name('videoForm');
    Route::post('/advert/storeVideo', [AdvertController::class, 'storeVideo'])->name('storeVideo');
    Route::get('/advert/show_video', [AdvertController::class, 'showVideo'])->name('showVideo');


    Route::get('/joinForm', [UserController::class, 'joinForm'])->name('joinForm');
    Route::post('/join_quiz', [UserController::class, 'join_quiz'])->name('join_quiz');
    
});
  

//Auth Route


//Quizzes route

//Route::get('/joinform', [ParticipantController::class, 'joinform'])->name('joinform');
//Route::post('/join_quiz', [ParticipantController::class, 'join_quiz'])->name('join_quiz');
Route::get('/quiz/{quiz_id}/question/{index?}', [ParticipantController::class, 'show_quiz'])->name('show_quiz');
Route::post('/quiz/{quiz_id}/submit', [ParticipantController::class, 'calResult'])->name('calResult');
Route::get('/quiz/result', [ParticipantController::class, 'result'])->name('result');
Route::post('/quiz/{quiz_id}/save', [ParticipantController::class, 'saveAnswer'])->name('saveAnswer');
Route::get('/quiz/{quiz_id}/leaderboard', [QuizController::class, 'leaderboard'])->name('leaderboard');
//Route::post('/quiz/{quiz_id}/addParticipants', [QuizController::class, 'addParticipants'])->name('addParticipants');
Route::get('/quiz/{quiz}/start_quiz', [ParticipantController::class, 'start'])->name('start_quiz');
Route::get('/quiz/{quiz}/startform', [ParticipantController::class, 'startform'])->name('startform');




Route::get('/search-users', [QuizController::class, 'searchUsers'])->name('search.users');
Route::post('/add-participant', [QuizController::class, 'addParticipant'])->name('add.participant');




