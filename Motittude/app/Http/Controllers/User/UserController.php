<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Result;
use App\Models\Question;
use App\Models\Participant;
use App\Models\User;
use App\Models\Option;



class UserController extends Controller
{
    public function joinForm() {
        return view('user.joinForm');
    }

    //Participants join
    public function joinQuiz(Request $request)
    {
        $request->validate([
            'code' => 'required|string'
        ]);
        
        $quiz = Quiz::where('code', strtoupper($request->code))->first();
        
        if (!$quiz) {
            return back()->withErrors(['code' => 'Invalid quiz code.']);
        }

        session([
            'user_id' => $user->id,
            'name' => $request->name,
            'quiz_id' => $quiz->id
        ]);
        
        return redirect()->route('show_quiz', $quiz->id);

    }


    public function showQuiz($quiz_id, $index = 0)
    {
        $quiz = Quiz::with('questions.options')->findOrFail($quiz_id);
        $questions = $quiz->questions;

        // If there is no current question, quiz is finished
        if ($index >= $questions->count()) {
            return redirect()->route('user.questions.show', $quiz_id); // Or route to results page 
        }

        $question = $questions[$index];

        $totalQuestions = $questions->count();
        $currentQuestionNumber = $index + 1;
        
        return view('show_quiz', compact('quiz', 'question', 'index', 'totalQuestions', 'currentQuestionNumber'));
    }

    public function join_quiz(Request $request)
    {
        // Validate that code exists in quizzes
        $request->validate([
            'code' => 'required|string|exists:quizzes,code',
        ]);

        $quiz = Quiz::where('code', $request->code)->firstOrFail();

        if (auth()->check()) {
            // Logged-in user joins with code only
            $user = auth()->user();

            $exists = $quiz->participants()->where('user_id', $user->id)->exists();
            if (!$exists) {
                $participant = $quiz->participants()->create([
                    'user_id' => $user->id,
                    'name'    => $user->username, // auto-use username
                    'code'    => $request->code,
                    'joined_via' => auth()->check() ? 'admin' : 'code',

                ]);
            }
        } else {
            // Guests must supply both name and code
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $participant = $quiz->participants()->create([
                'name' => $request->name,
                'code' => $request->code,
                'joined_via' => auth()->check() ? 'admin' : 'code',

            ]);
        }

        session(['participant_id' => $participant->id]);

        return view('startform', [
            'quiz' => $quiz,
            'duration' => $quiz->duration,
        ]);
    }



}
