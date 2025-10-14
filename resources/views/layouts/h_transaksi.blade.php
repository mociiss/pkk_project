<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Point of Sale')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f5f7;
            font-family: "Segoe UI", sans-serif;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 230px;
            background: #fff;
            border-right: 1px solid #ddd;
            padding: 20px;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
        }

        .sidebar h4 {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 30px;
            color: #333;
        }

        .sidebar a {
            display: block;
            color: #333;
            text-decoration: none;
            margin: 10px 0;
            padding: 8px 12px;
            border-radius: 6px;
            transition: 0.2s;
        }

        .sidebar a:hover, .sidebar a.active {
            background: #ff8800;
            color: white;
        }

        /* Konten utama */
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        /* Bagian produk dan keranjang sejajar */
        .main-area {
            display: flex;
            gap: 20px;
            flex: 1;
            margin-top: 10px;
        }

        /* Daftar produk (kiri) */
        .products {
            flex: 1;
            overflow-y: auto;
            padding-right: 10px;
        }

        /* Kartu produk */
        .product-card {
            border: 1px solid #ddd;
            border-radius: 12px;
            background: #fff;
            overflow: hidden;
            transition: .2s;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .product-card h6 {
            font-weight: 600;
            margin-top: 10px;
        }

        .product-card p {
            color: #555;
            font-size: 14px;
        }

        .btn-plus, .btn-minus {
            width: 28px;
            height: 28px;
            border: none;
            border-radius: 50%;
            background: #ff6600;
            color: #fff;
            font-weight: bold;
            line-height: 1;
        }

        /* Keranjang di kanan */
        .cart {
            width: 320px;
            background: #fff;
            border-left: 1px solid #ddd;
            padding: 20px;
            border-radius: 12px;
            box-shadow: -2px 0 8px rgba(0,0,0,0.05);
            position: sticky;
            top: 20px;
            height: fit-content;
            max-height: calc(100vh - 100px);
            overflow-y: auto;
        }

        .cart h6 {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .cart hr {
            margin: 10px 0;
        }

        .cart button {
            border-radius: 8px;
            font-weight: 500;
        }

        /* Form kasir dan pelanggan */
        .actor-form {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .actor-form label {
            font-weight: 600;
            color: #333;
        }

        /* Scroll halus */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

        /* Responsif */
        @media (max-width: 992px) {
            .main-area {
                flex-direction: column;
            }
            .cart {
                width: 100%;
                margin-top: 20px;
                position: relative;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        {{-- Sidebar kiri --}}
        @include('components.sidebar')

        {{-- Konten utama --}}
        <div class="content">
            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
