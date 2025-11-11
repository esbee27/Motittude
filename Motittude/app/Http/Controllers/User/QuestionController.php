<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Option;
use App\Models\Question;



class QuestionController extends Controller
{
    //
    public function create ($quiz_id) 
    {
        $quiz = Quiz::findOrFail($quiz_id);
        return view('user.questions.create', compact('quiz'));
    }

    public function store(Request $request) 
    {
        $validatedData = $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'question_text' => 'required|string',
            'options' => 'required|array|size:4',
            'options.*.option_text' => 'required|string',
            'correct_answer' => 'required|in:1,2,3,4',

        ]);

        $quiz = Quiz::findOrFail($request->quiz_id);

        // Create the question
        $question = Question::create([
            'quiz_id' => $validatedData['quiz_id'],
            'question_text' => $validatedData['question_text'],
        ]);

        // Save the options
        foreach ($validatedData['options'] as $key => $data) {
            $question->options()->create([
                'option_text' => $data['option_text'],
                'correct_answer' => ($key == $validatedData['correct_answer']) ? 1 : 0,
            ]);
        }


        return redirect('/user/questions/create/' . $quiz->id)->with('success', 'Question created successfully!');
    }


    public function show($quiz_id) 
    {
        $quiz = Quiz::with('questions.options')->findOrFail($quiz_id);
        $questions = $quiz->questions;

        return view('user.questions.show', compact('quiz', 'questions'));
    }

    public function show_id ($quiz_id, $number = 1)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($quiz_id);
        $questions = $quiz->questions;

        $index = $number - 1; // convert to 0-based index for array


        if ($index < 0 || $index >= $questions->count()) {
            return redirect()->route('user.questions.show', $quiz_id);
        }
        $question = $questions[$index];
        $index = $number;


        return view('user.questions.show_id', compact('quiz', 'question', 'index'));

    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question_text' => 'required|string|max:255',
            'options' => 'required|array',
            'options.*.id' => 'required|exists:options,id',
            'options.*.option_text' => 'required|string|max:255',
            'correct_answer' => 'required|integer',
        ]);

        // Update question text
        $question->update([
            'question_text' => $request->question_text,
        ]);

        // Reset all options to not correct
        foreach ($question->options as $option) {
            $option->update(['correct_answer' => 0]);
        }

        // Update each option text
        foreach ($request->options as $optionData) {
            $option = Option::findOrFail($optionData['id']);
            $option->option_text = $optionData['option_text'];

            // Mark only the chosen one as correct
            if ((int)$request->correct_answer === $option->id) {
                $option->correct_answer = 1;
            }

            $option->save();
        }

        return redirect()->back()->with('success', 'Question updated successfully!');
    }

                

}
