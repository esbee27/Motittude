<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Protitude')</title>
    @vite(['resources/css/index.css', 'resources/js/app.js'])
    @stack('styles')
    @stack('scripts')

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
  <header>
    <nav class="navbar">
      <div class="logo">Protitude</div>
      <ul class="nav-links">
        <li><a href="/">Home</a></li>

        @guest
        <li><a href="/signup">Sign Up</a></li>
        <li><a href="/login">Login</a></li>

        @endguest

        @auth
        <li><a href="{{ route('logout') }}">Logout</a></li>
        <li><a href="{{ route('user.quiz.create') }}">Create Quiz</a></li>
        <li><a href="{{ route('user.quiz.show') }}">Show Quizzes</a></li>

        @endauth

        <li><a href="{{ route('user.joinForm') }}">Join Quiz</a></li>

      </ul>
    </nav>
  </header>

  <main class="hero">
    @yield('content')
  </main>

</body>
</html>
