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
            <form method="POST" action="{{ route('signup') }}">
              @csrf
              <h1>Sign Up</h1>
              <hr />
              <p>Explore the World!</p>
              <label>Username</label>
              <input type="string" placeholder="Username" name="username"/>
              <label>First Name</label>
              <input type="text" placeholder="First name" name="first_name"/>
              <label>Last Name</label>
              <input type="text" placeholder="Lasr name" name="last_name"/>
              <label>Email</label>
              <input type="email" placeholder="Email" name="email"/>              
              <label>Phone number</label>
              <input type="number" placeholder="phone_no" name="phone_no"/>              
              <label for="gender">Gender</label>
                <select name="gender" id="">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              <label>Date of birth</label>
              <input type="date" placeholder="Date of birth" name="date_of_birth"/>
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
    </html></span>