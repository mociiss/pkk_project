<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <!-- Navbar -->
  <div class="navbar">
    <h1 class="logo">MyApp</h1>
    <ul class="menu">
      <li><a href="/dashboard">Dashboard</a></li>
      <li><a href="#">Data</a></li>
      <li><a href="#">Profile</a></li>
      <li><a href="{{ url('/logout') }}">Logout</a></li>
    </ul>
  </div>

  <!-- Konten -->
  <div class="content">
    <h2>Selamat Datang, {{ Auth::user()->name }} 👋</h2>
    <p>Ini adalah halaman dashboard.</p>
  </div>
</body>
</html>
