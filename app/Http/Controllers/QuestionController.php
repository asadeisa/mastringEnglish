<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //
    public function distroy(Request $request)
    {
        Question::where("id","=",$request->id)->delete();
        return redirect()->back()->with("delete","question deleted successflly");

    }
    public function howTestPage()
    {
        return view("main-test");
    }
}
