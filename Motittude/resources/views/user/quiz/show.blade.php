@extends('layouts.navbar')

@push('styles')
    @vite(['resources/css/quiz.css'])
@endpush

@section('title', 'Show Quizzes')

@section('content')
    <table class="quiz-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>CODE</th>
                <th>Total questions</th>
                <th>Created_at</th>
                <th>Updated_at</th>
            </tr>
        </thead>
        <tbody>
        @foreach($quizzes as $quiz)
            <tr>
                <td>{{ $quiz->id }} </td>
                <td>{{ $quiz->name }} </td>
                <td>{{ $quiz->code }} </td>
                <td>{{ $quiz->questions->count() }} </td>
                <td>{{ $quiz->created_at->format('Y-m-d H:i') }} </td>
                <td>{{ $quiz->updated_at->format('Y-m-d H:i') }} </td>
                <td><a href="{{ route('user.questions.show', $quiz->id) }}" class="btn">View</a></td>
                <td><a href="{{ route('leaderboard', ['quiz_id' => $quiz->id]) }}" class="btn">Leaderboard</a></td>


            </tr>           
        @endforeach
        </tbody>
    </table>    
<button><a href="{{ route('user.quiz.create', $quiz->id) }}" class="btn">Add Quiz</a></button>

@endsection