<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
        @vite(['resources/css/dashboard.css', 'resources/js/app.js'])        
</head>
<body>
   <div class="container">
    <div class="dp">

    </div>
    <div class="info">
            <p>{{ Auth::user()->first_name }}</p>
        </div>
    <div class="info"><p>{{ Auth::user()->last_name }}</p>
    </div>
    <div class="info"><p>{{ Auth::user()->email }}</p>
    </div>
    <div class="info"><p>{{ Auth::user()->phone_no }}</p>
    </div>
    <div class="info"><p>{{ Auth::user()->date_of_birth }}</p>
    </div>
    <div class="info"><p>{{ Auth::user()->gender }}</p>
    </div>
   </div> 
</body>
</html>