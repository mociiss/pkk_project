<!-- resources/views/partials/sidebar.blade.php -->
<style>
    .sidebar {
      width: 240px;
      background: #006d77;
      color: white;
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .sidebar h2 { margin-bottom: 30px; }
    .brand a{
        text-decoration: none;
        font-size: 30px;
        color: white;
        align-items: center;
    }
    .menu{
        margin-top: 20px;
    }
    .menu a {
        display: block;
        color: white;
        padding: 10px 15px;
        border-radius: 8px;
        text-decoration: none;
        margin-bottom: 10px;
    }
    .menu a.active, .menu a:hover { 
        background: #00b4d8; 
    }
</style>
<aside class="sidebar" id="sidebar">
  <div class="brand">
    <a href="{{ route('dashboard') }}">CatatYuk</a>
  </div>

  <nav class="menu">
    <a href="{{ route('dashboard') }}" class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('produk.index') }}" class="menu-item {{ request()->is('produk*') ? 'active' : '' }}">Produk</a>
    <a href="#" class="menu-item">Laporan</a>
  </nav>

  <div class="sidebar-footer">
    <small>Logged in as:</small>
    <div class="user-name">{{ Auth::user()->name }}</div>
  </div>
</aside>
