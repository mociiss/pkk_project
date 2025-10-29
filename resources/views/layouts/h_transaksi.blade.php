<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Point of Sale')</title>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f6f7fb;
            font-family: 'Karla', sans-serif;
            margin: 0;
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex-direction: row;
            justify-content: space-between;
            padding: 100px 25px 30px;
            gap: 20px;
        }

        .main-area {
            flex: 1;
            overflow-y: auto;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
        }

        .product-card {
            background: #fff;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            transition: all 0.2s ease;
            padding: 10px;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 14px rgba(0,0,0,0.1);
        }

        .product-card img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 10px;
        }

        .product-card h6 {
            margin-top: 10px;
            font-size: 15px;
            font-weight: bolder;
        }

        .product-card p {
            font-size: 13px;
            color: #666;
            margin-bottom: 6px;
        }

        .product-card button {
            background: #ff7a00;
            border: none;
            color: #fff;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
        }

        .cart {
            position: sticky;
            top: 90px;
            width: 380px;
            min-width: 100px;
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            height: fit-content;
            max-height: calc(100vh - 120px);
            overflow-y: auto;
        }

        .cart h6 {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .cart-item img {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 10px;
        }

        .cart-item .info {
            flex-grow: 1;
        }

        .cart-item small {
            color: #666;
        }

        .btn-minus, .btn-plus {
            background: #ff7a00;
            border: none;
            color: #fff;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            line-height: 1;
        }

        .actor-form {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 20px;
            margin-bottom: 20px;
        }

        label {
            font-weight: 600;
            color: #333;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

        @media (max-width: 400px) {
            .content {
                flex-direction: column;
            }
            .cart {
                width: 100%;
                position: relative;
                top: 0;
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        @include('components.topbar')

        <div class="content">
            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
