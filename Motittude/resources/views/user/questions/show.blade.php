@extends('layouts.navbar')

@push('styles')
    @vite(['resources/css/quiz.css'])
@endpush

@section('title', 'Show Questions')

@section('content')
    <table class="quiz-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>QUESTION</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        @foreach($questions as $question)
            <tr>
                <td>{{ $question->id }} </td>
                <td>{{ $question->question_text }} </td>
                <td>{{ $question->created_at->format('Y-m-d H:i') }} </td>
                <td>{{ $question->updated_at->format('Y-m-d H:i') }} </td>
                <td><a href="{{ route('user.questions.show_id', ['quiz_id' => $quiz->id, 'index' => $loop->index]) }}" class="btn">Edit</a></td>
            </tr>           
        @endforeach
        </tbody>
    </table>    
    <button><a href="{{ route('user.questions.create', $quiz->id) }}" class="btn">Add Question</a></button>
    <button><a href="{{ route('user.enroll', $quiz->id) }}" class="btn">Enroll Users</a></button>


@endsection