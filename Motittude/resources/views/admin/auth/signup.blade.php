<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Sign Up Form</title>
        @vite(['resources/css/auth.css', 'resources/js/app.js'])        
      </head>
      <body>
        <div class="container">
          <div class="login">
            <form method="POST" action="/signup">
              @csrf
              <h1>Sign Up</h1>
              <hr />
              <p>Explore the World!</p>
              <label>School</label>
              <select name="school" id="school_id required">
                @foreach($schools as $school)
                  <option value="{{school->id}}">{{school->name}}</option>
                @endforeach
              </select>
              <label>Username</label>
              <input type="text" placeholder="Username" name="username"/>
              <label>Password</label>
              <input type="password" placeholder="Password" name="password"/>
              <label>Confirm password</label>
              <input type="password" placeholder="Confirm password" name="password_confirmation"/>
              <button type="submit"><span>Sign Up</span></button>
              <p>Already have an account? <a href="/login"> Login </a></p>
            </form>
          </div>
        </div>
      </body>
    </html>
