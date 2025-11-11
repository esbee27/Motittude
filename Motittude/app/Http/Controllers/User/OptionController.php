<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Option;

class OptionController extends Controller
{
    //
public function store(Request $request, $question_id)
{
    $request->validate([
        'option_text' => 'required|string',
        'correct_answer' => 'required|boolean', // use 'boolean' if needed
    ]);

    $question = Question::findOrFail($question_id);

    $question->options()->create([
        'option_text' => $request->option_text,
        'correct_answer' => $request->correct_answer,
    ]);

    return redirect()->route('questions.create', $question_id)->with('success', 'Option created successfully!');
}

}
