<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create </title>
</head>
<body>
    <div class="container">
    <h2>Add New Question</h2>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    <form action="{{ route('questions.store') }}" method="POST">
        @csrf
        <div>
            <label>Subject</label>
            <select name="subject_id" required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Question Text</label>
            <textarea name="question_text" required></textarea>
        </div>

        <div>
            <label>Solution (optional)</label>
            <textarea name="solution"></textarea>
        </div>

        <div>
            <label>Options</label>
            @for ($i = 0; $i < 4; $i++)
                <div>
                    <input type="text" name="$question->option" required placeholder="Option {{ $i + 1 }}">
                    <label>
                        <input type="radio" name="$question->is_correct" value="{{ $i }}" {{ $i == 0 ? 'checked' : '' }}>
                        Correct
                    </label>
                </div>
            @endfor
        </div>

        <button type="submit">Save Question</button>
    </form>
</div>

</body>
</html>
