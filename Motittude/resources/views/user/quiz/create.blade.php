
@extends('layouts.navbar')

@push('styles')
    @vite(['resources/css/quiz.css'])
@endpush

@section('title', 'Create Quiz')

@section('content')
<div class="quiz_container">
    <h2>Create Quiz</h2>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('user.quiz.store') }}" method="POST">
        @csrf
        <label>Create quiz</label>
        <input type="text" placeholder="Quiz" name="name"/>
        <button type="submit">Create quiz</button>
    </form>
@endsection




