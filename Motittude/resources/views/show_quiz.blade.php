@extends('layouts.navbar')

@push('styles')
    @vite(['resources/css/show-quiz.css'])
@endpush

@section('title', 'Quiz Question')



@section('content')
<div class="quiz-container" id="timer">
    <h2 class="quiz-title">{{ $quiz->name }}</h2>
    <p><strong>Question {{ $currentQuestionNumber }} of {{ $totalQuestions }}</strong></p>

    <form id="quiz_fom" action="{{ route('saveAnswer', [$quiz->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="index" value="{{ $index }}">

        <div class="question-card">
            <p>{{ $question->question_text }}</p>
        </div>

        <div class="options">
            @foreach ($question->options as $option)
                <div class="option">
                    <label>
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}"
                            {{ old("answers.$question->id") == $option->id ? 'checked' : '' }}>
                        {{ $option->option_text }}
                    </label>
                </div>
            @endforeach
        </div>

        <div class="navigation">
            @if ($index > 0)
                <button class="submit-btn" type="submit" name="direction" value="previous">Previous</button>
            @endif

            @if ($index + 1 < $totalQuestions)
                <button class="submit-btn" type="submit" name="direction" value="next">Next</button>
            @else
                <button class="submit-btn" type="submit" name="direction" value="submit">Submit</button>
            @endif

        </div>


    </form>


    

</div>
@endsection

@push('scripts')
    @vite(['resources/js/quiztimer.js'])
    <script>
        window.quizDuration = @json($duration);
    </script>
@endpush
