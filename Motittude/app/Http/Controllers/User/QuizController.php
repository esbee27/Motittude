<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Participant;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class QuizController extends Controller
{
    //
    public function create () 
    {
        return view('user.quiz.create'); 
    }

    public function store (Request $request) 
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $quiz = Quiz::create([
            'name' => $request->name,
            'duration' => $request->duration,
            'user_id' => $request->user_id,
            'code' => strtoupper(Str::random(6)),
        ]);
        
        return redirect()->route('user.questions.create', $quiz->id);
    }


    public function show()
    {
        $user = auth()->user();

        // fetch only quizzes where user is a participant
        $quizzes = Quiz::whereHas('participants', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return view('user.quiz.show', compact('quizzes'));
    }


/*    public function show() 
    {
        $quizzes = Quiz::with('questions')->orderBy('created_at', 'desc')->get();
        return view('user.quiz.show', compact('quizzes'));
    }
*/
    public function leaderboard($quiz_id) 
    {
        $quiz = Quiz::findOrFail($quiz_id);

        $participants = Participant::where('quiz_id', $quiz_id)
                        ->whereNotNull('score')
                        ->orderByDesc('score')
                        ->orderBy('name')
                        ->get();

        return view('leaderboard', [
            'quiz' => $quiz,
            'participants' => $participants
        ]);
    }


    public function search(Request $request)
    {
        $search = $request->query('search');

        if ($search) {
            // Fetch users whose names match the search term
            $users = User::where('username', 'like', '%' . $search . '%')
                         ->select('id', 'username') // only return id & name
                         ->get();

            return response()->json($users);
        }

        return response()->json([]);
    }

    
        // Show the enrollment form for a quiz
    public function enrollForm(Quiz $quiz)
    {
        $users = User::all(); // Or filter only students
        return view('user.enrolluser', compact('quiz', 'users'));
    }

    public function storeParticipant(Request $request, Quiz $quiz)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);

        // Prevent duplicates
        $exists = $quiz->participants()->where('user_id', $user->id)->exists();
        if (!$exists) {
            $quiz->participants()->create([
                'user_id' => $user->id,
                'name' => $user->username,
                'joined_via' => 'admin',

            ]);
        }

        return redirect()->route('user.enroll', $quiz->id)
                        ->with('success', 'User enrolled successfully into ' . $quiz->name);
    }



    
}
