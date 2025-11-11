
@extends('layouts.navbar')

@push('styles')
    @vite(['resources/css/quiz.css'])
@endpush

@section('title', 'Create Video')

@section('content')
<div class="quiz_container">
    <h2>Create Video</h2>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('user.storeVideo') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Create a video for advert</label>
        <input type="text" placeholder="Video name" name="name"/>
        <input type="file" placeholder="Video" name="video" accept="video/*"/>
        <button type="submit">Create video</button>
    </form>
@endsection

