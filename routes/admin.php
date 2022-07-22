<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;



Route::prefix("Dachbord")
->middleware(["auth","isAdmin"])
->group(function(){
    

  
    Route::get("/",[AdminController::class,"index"])
    ->name("Dachbord");

    Route::get("users",[AdminController::class,"showUser"])->name("users");
    
    Route::get("main-test",[AdminController::class,"mainTest"])->name("main-test");
    Route::post("creat-emain-question",[AdminController::class,"createNewTest"])
    ->name("creat-emain-question");
    Route::get("Courses",[AdminController::class,"showCoures"])->name("show-corses");
    Route::get("teacher",[AdminController::class,"showTecher"])->name("admin-teacher");

    Route::get("Profile",[AdminController::class,"profile"])->name("profile");
    Route::post("/",[AdminController::class,"membershep"])->name("teacher-membershep");
    Route::post("users",[AdminController::class,"deleteStudent"])->name("delete-student");
});
