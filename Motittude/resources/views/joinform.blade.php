
@extends('layouts.navbar')

@push('styles')
    @vite(['resources/css/quiz.css'])
@endpush

@section('title', 'Join Form')

@section('content')
<div class="quiz_container">
    <h2>Join Quiz</h2>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('join') }}">
        @csrf
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="text" name="code" placeholder="Quiz Code" required>
        <button type="submit">Join Quiz</button>
    </form>
</div>
@endsection
