@extends('layouts.navbar')

@push('styles')
    @vite(['resources/css/quiz.css'])
@endpush

@section('title', 'Leaderboard')

@section('content')
    <div><p><strong>Leaderboard for {{ $quiz->name }}</strong></p></div>
    <table class="quiz-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Score</th>
                <th>Created_at</th>
                <th>Updated_at</th>
            </tr>
        </thead>
        <tbody>
        @foreach($quiz->participants as $participant)
            <tr>
                <td>{{ $participant->id }} </td>
                <td>{{ $participant->name }} </td>
                <td>{{ $participant->score }} </td>
                <td>{{ $participant->created_at->format('Y-m-d H:i') }} </td>
                <td>{{ $participant->updated_at->format('Y-m-d H:i') }} </td>
            </tr>           
        @endforeach
        </tbody>
    </table>    

@endsection