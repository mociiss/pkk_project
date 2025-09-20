<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title', 'Dashboard')</title>

  <!-- CSS manual dari public/css -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <div class="layout-wrapper">
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
      <div class="brand">
        <a href="{{ route('dashboard') }}">MyApp</a>
      </div>

      <nav class="menu">
        <a href="{{ route('dashboard') }}" class="menu-item active">Dashboard</a>
        <a href="#" class="menu-item">Data</a>
        <a href="#" class="menu-item">Laporan</a>
      </nav>

      <div class="sidebar-footer">
        <small>Logged as:</small>
        <div class="user-name">{{ Auth::user()->name }}</div>
      </div>
    </aside>

    <!-- Main content -->
    <div class="main">
      <header class="topbar">
        <button id="btnToggle" class="btn-toggle">☰</button>
        <h1 class="topbar-title">@yield('title', 'Dashboard')</h1>

        <div class="topbar-actions">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn-logout">Logout</button>
          </form>
        </div>
      </header>

      <main class="content">
        @yield('content')
      </main>

      <footer class="footer">
        © {{ date('Y') }} MyApp. All rights reserved.
      </footer>
    </div>
  </div>

  <script>
    // Sidebar toggle untuk layar kecil
    const btn = document.getElementById('btnToggle');
    const sidebar = document.getElementById('sidebar');
    btn.addEventListener('click', () => {
      sidebar.classList.toggle('open');
    });
  </script>
</body>
</html>
