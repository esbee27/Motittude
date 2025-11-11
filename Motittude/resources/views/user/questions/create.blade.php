@extends('layouts.navbar')


@section('title', 'Add Question')

@section('content')
    <div class="container">
    <h2>Add New Question</h2>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

<form action="{{ route('user.questions.store') }}" method="POST">
    @csrf

    <!-- Display Quiz Code (Read-Only) -->
    <div>
        <p>Your quiz ID is: {{ $quiz->id }}</p>
        <p>Your quiz code is: {{ $quiz->code }}</p>
        <p>Your quiz name is: {{ $quiz->name }}</p>
    </div>
    <!-- Hidden input for quiz ID -->
    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

    <!-- Question Text -->
    <div style="margin-top: 10px;">
        <label for="question_text">Question:</label><br>
        <textarea name="question_text" id="question_text" rows="4" cols="50" required>{{ old('question_text') }}</textarea>
    </div>

    <!-- Options -->
    <div style="margin-top: 10px;">
        <label>Options:</label><br>

        @for ($i = 1; $i <= 4; $i++)
            <div style="margin-bottom:5px;">
                <input type="text" name="options[{{ $i }}][option_text]" placeholder="Option {{ $i }}" required>
                <label>
                    <input type="radio" name="correct_answer" value="{{ $i }}" required> Correct Answer
                </label>
            </div>
        @endfor
    </div>

    <!-- Submit Button -->
    <div style="margin-top: 15px;">
        <button type="submit">Save Question</button>
    </div>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div style="color:red; margin-top:10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</form>

</div>

@endsection

