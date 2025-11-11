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
    <h2>Enroll User into Quiz</h2>

    {{-- Search box --}}
    <input type="text" id="search" placeholder="Type a name...">

    {{-- Form for adding participant --}}
    <form method="POST" action="{{ route('add.participant') }}">
        @csrf
        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
        
        <select name="user_id" id="userSelect" style="display:none;"></select>
        
        <button type="submit" style="display:none;" id="addBtn">
            Add Participant
        </button>
    </form>

</body>
</html>
