<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Pacifico&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;600&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      font-family: "Karla", sans-serif;
      background-color: #f5f5f5;
    }

    .topbar {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background: #8C623B;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 40px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .brand a {
      text-decoration: none;
      color: white;
      font-family: "Poppins", sans-serif;
      font-weight: 600;
      font-size: 28px;
    }

    .brand a span {
      font-family: "Pacifico", cursive;
      color: #FFD166;
      font-size: 32px;
    }

    .menu {
      display: flex;
      gap: 5px;
      flex: 1;
      font-family: "Poppins", sans-serif;
      font-weight: 600;
      justify-content: center;
    }

    .menu a {
      color: white;
      text-decoration: none;
      font-size: 16px;
      padding: 15px 25px;
      border-radius: 50px;
      transition: background 0.3s;
    }

    .menu-item img {
      width: 24px;
      height: 24px;
      vertical-align: middle;
    }

    .menu a.menu-item.img-link {
      padding: 10px 18px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .menu a.active,
    .menu a:hover {
      background: #5d381cff;
      box-shadow: 0 2px 5px rgba(74, 54, 43, 0.34);
    }

    /* ==== Notifikasi ==== */
    .notif-section {
      display: flex;
      align-items: center;
      gap: 15px;
      position: relative;
    }

    .notification {
      position: relative;
      display: inline-block;
    }

    .notification img {
      width: 28px;
      height: 28px;
      cursor: pointer;
      transition: transform 0.2s;
    }

    .notification img:hover {
      transform: scale(1.1);
    }

    .badge {
      position: absolute;
      top: -5px;
      right: -10px;
      background: #dc3545;
      color: white;
      font-size: 11px;
      font-weight: bold;
      padding: 3px 6px;
      border-radius: 50%;
      line-height: 1;
      border: 2px solid #8C623B; /* biar kelihatan rapi di atas topbar */
    }

    .user-info {
      text-align: right;
      font-size: 14px;
      line-height: 1.2;
    }

    .user-name {
      font-weight: bolder;
      font-size: 15px;
    }

    .logout-btn {
      margin-left: 15px;
      display: inline-block;
      text-decoration: none;
      background: #c97b3e;
      color: white;
      font-size: 12px;
      font-weight: bolder;
      padding: 10px 20px;
      border-radius: 50px;
      border: 0;
      transition: 0.3s;
      cursor: pointer;
    }

    .logout-btn:hover {
      background: #5d381cff;
    }

    @media (max-width: 768px) {
      .topbar {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }

      .menu {
        flex-wrap: wrap;
        justify-content: flex-start;
      }

      .notif-section {
        align-self: flex-end;
      }
    }
  </style>
</head>

<body>
  <header class="topbar">
    <div class="brand">
      <a href="{{ route('dashboard') }}">Catat<span>Yuk</span></a>
    </div>

    @php
        use App\Models\Notification;
        $unread = Notification::where('is_read', false)->count();
    @endphp

    <nav class="menu">
      <a href="{{ route('dashboard') }}" class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
      <a href="{{ route('produk.index') }}" class="menu-item {{ request()->is('produk*') ? 'active' : '' }}">Produk</a>
      <a href="{{ route('karyawan.index') }}" class="menu-item {{ request()->is('karyawan*') ? 'active' : '' }}">Karyawan</a>
      <a href="{{ route('pelanggan.index') }}" class="menu-item {{ request()->is('pelanggan*') ? 'active' : '' }}">Pelanggan</a>
      <a href="{{ route('transaksi.index') }}" class="menu-item {{ request()->is('transaksi*') ? 'active' : '' }}">Transaksi</a>
    </nav>

    <div class="notif-section">
      <div class="notification">
        <a href="{{ route('notifikasi.index') }}">
          <img src="{{ asset('images/notification_48px.png') }}" alt="Notifikasi">
          @if($unread > 0)
              <span class="badge">{{ $unread }}</span>
          @endif
        </a>
      </div>

      <div class="user-info">
        <small>Logged in as:</small><br>
        <div class="user-name">{{ Auth::user()->name }}</div>
      </div>

      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
      </form>
    </div>
  </header>
</body>
