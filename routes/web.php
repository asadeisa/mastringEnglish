<?php

use App\Http\Controllers\UserTolles;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\QuestionController;

Route::get('/', function () {
    return view('welcome');
    
});
Route::get('/',function(){
    return view('welcome');

})->name('welcome');


// student route 
Route::prefix("home")
    ->middleware(["auth"])
    ->group(function(){

        Route::get("/",[UserController::class,"index"])->name("home");
        Route::get("cours/content/{id}",[UserController::class,"showCours"])
        ->name("cours/content/");
        Route::post('my-path',[UserController::class,'gototest'])->name('gototest');
        Route::get("my-path",[UserController::class,'mypath'])->name('my-path');
        Route::get("teacher-path/{id}",[UserController::class,'mypathFromHeader'])->name('teacher-path');
        Route::get("1",[UserController::class,"goHome"])->name("go-home");
        Route::get('ask-question',[UserTolles::class,'askQuestion'])->name('ask-question');
        Route::get('catch-strem',[UserTolles::class,'catchAudio'])->name("catch-strem");
    
        Route::get('analyze',[UserTolles::class,'analyze'])->name('analyze');
        Route::get('community',[UserTolles::class,"communityPage" ])->name('community') ; 
        Route::get("u-profile",[UserTolles::class,"profilePge"])->name("u-profile");
       Route::get('practice',[UserTolles::class,"practicePage"])->name("practice");
       Route::get('practice/text-question',[UserTolles::class,"LocalQuestion"])->name("local-question");
       Route::get('practice/new-phrases',[UserTolles::class,"newPhrases"])->name("new-phrases");

    });

// admin and teacher
Route::get("profile",[LoginController::class,"index"]);


Route::prefix("teacher")
->middleware(["auth","isTacher"])
->group(function(){
    

    Route::get("/",[TeacherController::class,"index"])
    ->name("teacher");

    Route::get("students",[TeacherController::class,"student"])
    ->name("students");
    
    Route::get("my-courses",[TeacherController::class,"showCourses"])->name("my-courses");

    Route::post("new-cours",[TeacherController::class,"newCours"])->name("new-cours");

    Route::post("my-courses",[TeacherController::class,"newContent"])->name("create-content");
    Route::post("edit-content",[TeacherController::class,"EditContent"])
    ->name("edit-content");
    Route::get("my-courses/cours-content/{id}",[TeacherController::class,"showContent"])
    ->name("cours-content");
    Route::post("create-question",[TeacherController::class,"CreateQuestion"])->name("create-question");
    Route::post("delete-question",[QuestionController::class,"distroy"])->name("delete-question");
    Route::get("profile",[TeacherController::class,"profile"])->name("teacher.profile");
    Route::get("students/{email}",[TeacherController::class,"showMyStudent"])->name("go-to-student");
});

Route::get("test",[QuestionController::class,"howTestPage"])->name("level-test");

Route::post('test',[UserController::class,'startBeginener'])->name('start-beginner');