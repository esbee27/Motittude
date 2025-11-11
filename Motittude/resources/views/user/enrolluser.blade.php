<!DOCTYPE html>
<html>
<head>
    <title>Enroll User</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css','resources/js/enrolluser.js'])
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        #results { margin-top: 10px; }
        select { padding: 5px; margin-top: 5px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Enroll User into Quiz: {{ $quiz->name }}</h2>

    <form method="POST" action="{{ route('user.storeParticipant', $quiz->id) }}">
        @csrf

        <label for="user">Select User:</label>
        <select name="user_id" id="user" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
            @endforeach
        </select>

        <button type="submit">Enroll</button>
    </form>
</div>

</body>
</html>
