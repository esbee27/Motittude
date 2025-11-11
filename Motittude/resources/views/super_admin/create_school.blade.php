<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Schools</title>
</head>
<body>
    <form action="{{ route('schools.store') }}" method="POST">
        @csrf
        <label>Add School</label>
        <input type="text" placeholder="School" name="school"/>
        <button type="submit">Register school</button>
    </form>
</body>
</html>