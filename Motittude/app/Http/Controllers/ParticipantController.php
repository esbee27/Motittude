<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Result;
use App\Models\Question;
use App\Models\Participant;
use App\Models\Option;
use App\Models\Video;




class ParticipantController extends Controller
{
    public function joinform() {
        return view('joinform');
    }

    //Participants join
    public function join_quiz(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string'
        ]);
        
        $quiz = Quiz::where('code', strtoupper($request->code))->first();
        
        if (!$quiz) {
            return back()->withErrors(['code' => 'Invalid quiz code.']);
        }

        $participant = Participant::create([
            'name' => $request->name,
            'quiz_id' => $quiz->id,
            'code' => strtoupper($request->code),
        ]);

        session([
            'participant_id' => $participant->id,
            'name' => $request->name,
            'quiz_id' => $quiz->id,
        ]);
        
        return view('startform', [
            'quiz' => $quiz,
            'duration' => $quiz->duration,
        ]);
    }


    public function start(Request $request, $quiz_id)
    {
        $participantId = session('participant_id');

        // Ensure the participant exists
        $participant = Participant::find($participantId);

        // Check if participant belongs to this quiz
        /*if (!$participant || $participant->quiz_id !== $quiz->id) {
            return redirect()->route('user.joinForm')
                            ->with('error', 'Participant not found or does not belong to this quiz.');
        }
        */

        if (!$participant->start_time) {
            $participant->start_time = now();
            $participant->save();
        }

        // Quiz duration set by teacher
        $duration = $quiz->duration;

        return redirect()->route('startform', compact('quiz', 'duration')); // Or route to results page 

    }



    public function startform(Quiz $quiz)
    {
        // Pass the quiz object to the view
        return view('startform', [
            'quiz' => $quiz,
            'duration' => $quiz->duration,
        ]);
    }


    public function show_quiz($quiz_id, $index = 0)
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
        $duration = $quiz->duration;
        return view('show_quiz', compact('quiz', 'question', 'index', 'totalQuestions', 'duration', 'currentQuestionNumber'));
    }


    public function calResult(Request $request, $quiz_id)
    {
        $participantId = session('participant_id'); // or use auth()->id() if authentication is implemented

        $quiz = Quiz::with('questions.options')->findOrFail($quiz_id);
        $answers = Answer::where('quiz_id', $quiz_id)
                        ->where('participant_id', $participantId)
                        ->get()
                        ->keyBy('question_id');

        $score = 0;
        $totalQuestions = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            $selectedAnswer = $answers->get($question->id);

            if ($selectedAnswer) {
                $selectedOption = $question->options->where('id', $selectedAnswer->option_id)->first();

                if ($selectedOption && $selectedOption->correct_answer) {
                    $score++;
                }
            }
        }

        $percentage = ($score / $totalQuestions) * 100;


        // Create or update participant
        Participant::where('id', $participantId)->update([
            'score' => $score,
        ]);


        return redirect()->route('result', [
            'quiz' => $quiz->id,
            'score' => $score,
            'totalQuestions' => $totalQuestions,
            'percentage' => $percentage,
        ]);
    }



    public function saveAnswer(Request $request, $quiz_id)
    {
        $answers = $request->input('answers'); // [question_id => option_id]
        $index = $request->input('index');
        $direction = $request->input('direction');
        $participantId = session('participant_id');


        if ($answers) {
            foreach ($answers as $questionId => $optionId) {
                Answer::updateOrCreate(
                    [
                        'participant_id' => $participantId,
                        'quiz_id' => $quiz_id,
                        'question_id' => $questionId,
                    ],
                    [
                        'option_id' => $optionId,
                    ]
                );
            }
        }

        if ($direction === 'submit') {
            return $this->calResult($request, $quiz_id);
        }

        // Go forward or backward
        $newIndex = $direction === 'previous' ? $index - 1 : $index + 1;

        return redirect()->route('show_quiz', [
            'quiz_id' => $quiz_id,
            'index' => $newIndex,
        ]);
    }

    public function result(Request $request)
    {
        $quiz_id = $request->get('quiz');
        $score = $request->get('score');
        $totalQuestions = $request->get('totalQuestions');
        $percentage = $request->get('percentage');

        $quiz = Quiz::findOrFail($quiz_id); // now it's a Quiz object
        
        return view('result', compact('quiz', 'score', 'totalQuestions', 'percentage'));
    }

    public function submitQuiz(Request $request, $quiz_id)
    {
        $participantId = session('participant_id');

        // ✅ Save the last answers before calculating result
        $answers = $request->input('answers'); // [question_id => option_id]

        if ($answers) {
            foreach ($answers as $questionId => $optionId) {
                Answer::updateOrCreate(
                    [
                        'participant_id' => $participantId,
                        'quiz_id' => $quiz_id,
                        'question_id' => $questionId,
                    ],
                    [
                        'option_id' => $optionId,
                    ]
                );
            }
        }

        //calculate result
        return $this->calResult($request, $quiz_id);
    }


    public function index() 
    {
        $videos = Video::all();
        $advert = Video::latest()->first();

        return view('index', compact('videos'));
    }

}
