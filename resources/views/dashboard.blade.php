<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard</title>
  <style>
    * { 
      box-sizing: border-box; 
      margin: 0; 
      padding: 0; 
      font-family: Arial, sans-serif; }

    body { 
      display: flex; 
      min-height: 100vh; 
      background: #f5f7fa; 
    }

    /* Sidebar */
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

    .main { 
      flex: 1; 
      display: flex; 
      flex-direction: column; 
    }

    .topbar {
      background: white;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .content { 
      flex: 1; 
      display: flex; 
      padding: 20px; 
      gap: 20px; }

    .order-line {
      flex: 2;
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .order-line h3 { margin-bottom: 15px; }
    .tabs { display: flex; gap: 10px; margin-bottom: 20px; }
    .tab { padding: 8px 16px; border-radius: 8px; background: #eee; cursor: pointer; }
    .tab.active { background: #00b4d8; color: white; }

    /* Menu Items */
    .menu-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
      gap: 15px;
    }
    .menu-card {
      background: #f8f9fa;
      border-radius: 12px;
      padding: 10px;
      text-align: center;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      cursor: pointer;
    }
    .menu-card img {
      width: 100%;
      height: 80px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    .menu-card h4 { font-size: 14px; margin-bottom: 5px; }
    .menu-card p { font-size: 12px; color: gray; }

    /* Right Panel */
    .right-panel {
      flex: 1;
      background: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .summary { margin-top: 20px; }
    .summary h4 { margin-bottom: 10px; }
    .summary p { display: flex; justify-content: space-between; margin: 5px 0; }

    .btn {
      display: block;
      width: 100%;
      padding: 10px;
      margin-top: 20px;
      background: #00b4d8;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }
    .btn:hover { background: #0096c7; }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <!-- <aside class="sidebar">
    <div>
      <h1>CatatYuk</h1>
      <nav class="menu">
        <a href="#" class="active">Dashboard</a>
        <a href="{{ route('produk.index') }}" >Menu</a>
        <a href="#">Produk</a>
        <a href="#">Customers</a>
      </nav>
    </div>
    <div>
      <p><small>Logged in as</small></p>
      <strong>{{ Auth::user()->name ?? 'User' }}</strong>
    </div>
  </aside> 

  <-- Main -->
@include('components.sidebar')
  <div class="main">
    <header class="topbar">
      <h1>Dashboard</h1>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn">Logout</button>
      </form>
    </header>

    <!-- <div class="content"> -->
      <!-- Order Line -->
      <!-- <section class="order-line">
        <h3>Order Line</h3>
        <div class="tabs">
          <div class="tab active">All</div>
          <div class="tab">New</div>
          <div class="tab">Processing</div>
          <div class="tab">Done</div>
        </div> -->

        <!-- <h3>Menu</h3>
        <div class="menu-grid">
          <div class="menu-card">
            <img src="https://via.placeholder.com/100" alt="">
            <h4>Nasi Goreng</h4>
            <p>Rp 20.000</p>
          </div>
          <div class="menu-card">
            <img src="https://via.placeholder.com/100" alt="">
            <h4>Mie Ayam</h4>
            <p>Rp 15.000</p>
          </div>
          <div class="menu-card">
            <img src="https://via.placeholder.com/100" alt="">
            <h4>Ayam Bakar</h4>
            <p>Rp 25.000</p>
          </div>
        </div>
      </section>

      <-- Right Panel -->
      <!-- <aside class="right-panel">
        <h3>Table #04</h3>
        <p>2 People</p>

        <div class="summary">
          <h4>Ordered Items</h4>
          <p><span>Nasi Goreng</span> <span>Rp 20.000</span></p>
          <p><span>Mie Ayam</span> <span>Rp 15.000</span></p>
        </div>

        <div class="summary">
          <h4>Payment Summary</h4>
          <p><span>Subtotal</span> <span>Rp 35.000</span></p>
          <p><span>Discount</ --> 
