<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Point of Sale')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background:#f5f6fa; }
        .wrapper { display: flex; height: 100vh; }
        .sidebar {
            width: 220px; background:#fff; border-right:1px solid #ddd;
            padding:20px;
        }
        .sidebar h4 { font-weight:bold; }
        .content { flex:1; display:flex; }
        .products { flex:1; padding:20px; overflow-y:auto; }
        .cart { width:300px; background:#fff; border-left:1px solid #ddd; padding:20px; }
        .product-card {
            border:1px solid #ddd; border-radius:12px; overflow:hidden;
            background:#fff; transition:.2s;
        }
        .product-card:hover { box-shadow:0 4px 12px rgba(0,0,0,.1); }
        .product-card img { width:100%; height:150px; object-fit:cover; }
        .btn-plus, .btn-minus {
            width:28px; height:28px; border:none; border-radius:50%;
            background:#ff6600; color:#fff; font-weight:bold;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <h4>Template Laravel</h4>
            <hr>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="/transaksi" class="nav-link">Transaksi</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
