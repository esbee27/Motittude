@extends('layouts.navbar')

@section('title', 'Quiz Result')

@section('content')
<div class="result-container">
    <h1>Result for: {{ $quiz->name }}</h1>
    
    <p><strong>Total Questions:</strong> {{ $totalQuestions }}</p>
    <p><strong>Correct Answers:</strong> {{ $score }}</p>
    <p><strong>Percentage Score:</strong> {{ $percentage }}%</p>

</div>

<div><a href="{{ route('leaderboard', ['quiz_id' => $quiz->id]) }}">View Leaderboard</a>
</div>


@endsection
