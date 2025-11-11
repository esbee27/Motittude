<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login Form</title>
        @vite(['resources/css/auth.css', 'resources/js/app.js'])        
      </head>
      <body>
        <div class="container">
          <div class="login">
            <form method="POST" action="{{ route('login') }}">
              @csrf
              <h1>Login</h1>
              <hr />
              <p>Explore the World!</p>
              <label>Username</label>
              <input type="text" placeholder="Username" name="username"/>
              <label>Password</label>
              <input type="password" placeholder="Password" name="password"/>
              <button type="submit"><span>Login</span></button>
              <p>Don't have an account? <a href="/signup"> Sign Up</a></p>
            </form>
          </div>
        </div>
      </body>
    </html></span>