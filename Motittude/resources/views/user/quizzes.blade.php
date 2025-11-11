<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizzes</title>
        @vite(['resources/css/dashboard.css', 'resources/js/app.js'])        

</head>
<body>
    <div class="container">
        @foreach($subjects as $subject)
        <div class="info" onclick="window.location.href='{{ route('user.questions', $subject->id) }}'">
            <p>{{ $subject->name }}</p>
        </div>
        @endforeach
</div>
</body>
</html>