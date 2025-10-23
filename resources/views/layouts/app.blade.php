<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard')</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
      font-family: Arial, sans-serif;
      height: 100vh;
      background: #f5f6fa;
    }
    .main {
      flex: 1;
      padding: 20px;
      padding-top: 70px;
    }
  </style>
</head>
<body>
  @include('components.topbar')

  {{-- Konten utama --}}
  <div class="main">
      @yield('content')
  </div>
</body>
</html>
