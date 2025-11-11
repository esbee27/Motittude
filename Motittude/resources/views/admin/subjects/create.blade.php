<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Subject</title>
</head>
<body>
    <form action="{{ route('subjects.store') }}" method="POST">
        @csrf
        <label>Add subject</label>
        <input type="text" placeholder="Subject" name="name"/>
        <button type="submit">Add subject</button>
    </form>
</body>
</html>