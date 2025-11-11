<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
        @vite(['resources/css/dashboard.css', 'resources/js/app.js'])        
</head>
<body>
    <div class="container">
    <div class="dp">

    </div>
    <div class="info" onclick="window.location.href='{{ route('questions.create') }}'">
            <p>Questions</p>
        </div>
    <div class="info">
        <p>Videos</p>
    </div>
    <div class="info">
        <p>Schools</p>
    </div>
    <div class="info"><p>Candidates</p>
    </div>
    <div class="info"><p>Notes</p>
    </div>
    <div class="info"><p></p>
    </div>
   </div> 
</body>
</html>