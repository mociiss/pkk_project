<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,500;1,500&family=Licorice&family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
<style>
  .sidebar-container{
    display: fixed;
  }
    .sidebar {
      width: 240px;
      height: 100vh;
      background: #8C623B;
      color: white;
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .sidebar h2 { margin-bottom: 30px; }
    .brand a{
        text-decoration: none;
        font-size: 38px;
        color: white;
        align-items: center;
        font-family: "Karla", sans-serif;
        font-optical-sizing: auto;
        font-weight: 600;
      font-style: normal;
    }
    .menu{
        margin-top: 20px;
    }
    .menu a {
        display: block;
        color: white;
        padding: 15px 15px;
        font-family: "Karla", sans-serif;
        border-radius: 15px;
        font-size: large;
        text-decoration: none;
        margin-bottom: 10px;
    }
    .menu a.active, .menu a:hover { 
      transition: 0.3s;
      background: #45240B; 
    }
</style>
  </head>
  <div class="sidebar-container">
<aside class="sidebar" id="sidebar">
  <div class="brand">
    <a href="{{ route('dashboard') }}">CatatYuk</a>
  </div>


  <nav class="menu">
    <a href="{{ route('dashboard') }}" class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('produk.index') }}" class="menu-item {{ request()->is('produk*') ? 'active' : '' }}">Produk</a>
    <a href="{{ route('karyawan.index') }}" class="menu-item {{ request()->is('karyawan*') ? 'active' : '' }}">Pegawai</a>
    <a href="{{ route('pelanggan.index') }}" class="menu-item {{ request()->is('pelanggan*') ? 'active' : '' }}">Pelanggan</a>
    <a href="{{ route('transaksi.index') }}" class="menu-item {{ request()->is('pelanggan*') ? 'active' : '' }}">Transaksi</a>
  </nav>

  <div class="sidebar-footer">
    <small>Logged in as:</small>
    <div class="user-name">{{ Auth::user()->name }}</div>
  </div>
</aside>
  </div>
