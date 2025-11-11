<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Start Quiz</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: #f4f4f9;
    }
    .quiz-container {
      background: white;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      text-align: center;
      width: 400px;
    }
    h1 {
      margin-bottom: 1rem;
      color: #333;
    }
    p {
      margin-bottom: 2rem;
      color: #666;
    }
    button {
      padding: 0.75rem 1.5rem;
      font-size: 1rem;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      background: #007bff;
      color: white;
      cursor: pointer;
      transition: background 0.3s;
    }
    button:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>

  <div class="quiz-container">
    <h1>Ready to Start?</h1>
    <p>This quiz has a time limit of <strong>30 minutes</strong>.  
       Once you start, the timer cannot be paused.</p>
       <h2>{{ $quiz->title }}</h2>
        <p>Duration: {{ $duration }} minutes</p>
        <form action="{{ route('show_quiz', ['quiz_id' => $quiz->id, 'index' => 0]) }}" method="GET">
            <button type="submit" class="btn btn-success mt-3">Start Quiz</button>
        </form>

  </div>

</body>
</html>
