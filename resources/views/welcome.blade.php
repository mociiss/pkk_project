<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Selamat Datang — Laravel 12 Modern</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <!-- AOS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

  <!-- Custom Style -->
  <style>
    :root {
      --primary-color: #6c63ff;
      --secondary-color: #3f3da1;
      --accent-color: #2b2a82;
      --light-bg: #f9f9f9;
      --text-color: #333;
      --gradient: linear-gradient(135deg, #6c63ff 0%, #3f3da1 100%);
    }
    body {
      font-family: 'Poppins', 'Nunito', sans-serif;
      background: var(--light-bg);
      color: var(--text-color);
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }
    .hero {
      min-height: 100vh;
      background: var(--gradient);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 0 20px;
      color: #fff;
      position: relative;
      overflow: hidden;
    }
    .hero::before, .hero::after {
      content: '';
      position: absolute;
      border-radius: 50%;
      opacity: 0.15;
      z-index: 0;
    }
    .hero::before {
      width: 600px;
      height: 600px;
      background: #fff;
      top: -200px;
      left: -200px;
      animation: float1 8s ease-in-out infinite alternate;
    }
    .hero::after {
      width: 400px;
      height: 400px;
      background: #fff;
      bottom: -150px;
      right: -150px;
      animation: float2 10s ease-in-out infinite alternate;
    }
    @keyframes float1 {
      0% { transform: translateY(0);}
      100% { transform: translateY(40px);}
    }
    @keyframes float2 {
      0% { transform: translateY(0);}
      100% { transform: translateY(-30px);}
    }
    .hero-content {
      position: relative;
      z-index: 1;
    }
    .hero h1 {
      font-size: 3.5rem;
      font-weight: 800;
      margin-bottom: 20px;
      letter-spacing: 2px;
      text-shadow: 0 4px 24px rgba(44,44,84,0.2);
    }
    .hero p {
      font-size: 1.3rem;
      margin-bottom: 35px;
      max-width: 650px;
      margin-left: auto;
      margin-right: auto;
      color: #e0e0ff;
    }
    .btn-cta {
      background: var(--accent-color);
      color: #fff;
      padding: 14px 48px;
      border: none;
      border-radius: 50px;
      font-weight: 700;
      font-size: 1.1rem;
      box-shadow: 0 6px 24px rgba(44,44,84,0.15);
      transition: all 0.3s cubic-bezier(.4,2,.6,1);
      position: relative;
      z-index: 1;
    }
    .btn-cta:hover {
      background: #fff;
      color: var(--accent-color);
      transform: scale(1.07) translateY(-2px);
      box-shadow: 0 12px 32px rgba(44,44,84,0.18);
    }
    .wave {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      z-index: 1;
    }
    .section {
      padding: 90px 20px 70px 20px;
      background: #fff;
      position: relative;
      z-index: 2;
    }
    .section-title {
      font-size: 2.7rem;
      font-weight: 700;
      margin-bottom: 50px;
      color: var(--primary-color);
      letter-spacing: 1px;
    }
    .feature-card {
      border: none;
      border-radius: 18px;
      box-shadow: 0 8px 32px rgba(44,44,84,0.08);
      transition: transform 0.3s cubic-bezier(.4,2,.6,1), box-shadow 0.3s;
      background: linear-gradient(120deg, #f8f8ff 60%, #e6e6ff 100%);
      position: relative;
      overflow: hidden;
    }
    .feature-card:hover {
      transform: translateY(-12px) scale(1.03);
      box-shadow: 0 16px 40px rgba(44,44,84,0.13);
    }
    .feature-card i {
      font-size: 3.2rem;
      color: var(--primary-color);
      margin-bottom: 18px;
      background: #fff;
      border-radius: 50%;
      padding: 18px;
      box-shadow: 0 2px 12px rgba(44,44,84,0.07);
      transition: background 0.3s;
    }
    .feature-card:hover i {
      background: var(--primary-color);
      color: #fff;
    }
    .feature-card .card-title {
      font-weight: 700;
      color: var(--secondary-color);
      font-size: 1.3rem;
    }
    .feature-card .card-text {
      color: #555;
      font-size: 1.05rem;
    }
    footer {
      background: var(--secondary-color);
      color: #fff;
      text-align: center;
      padding: 38px 20px 28px 20px;
      font-size: 1.05rem;
      letter-spacing: 0.5px;
      position: relative;
      z-index: 2;
    }
    footer a {
      color: #fff;
      text-decoration: underline;
      transition: color 0.2s;
    }
    footer a:hover {
      color: #ffd700;
    }
    @media (max-width: 768px) {
      .hero h1 {
        font-size: 2.2rem;
      }
      .section-title {
        font-size: 2rem;
      }
      .feature-card {
        margin-bottom: 30px;
      }
    }
  </style>
</head>
<body>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-content animate__animated animate__fadeIn">
      <h1 class="animate__animated animate__fadeInDown">Selamat Datang di <span style="color:#ffd700;">Laravel 12</span></h1>
      <p class="animate__animated animate__fadeInUp">
        Nikmati framework Laravel terbaru dengan tampilan modern, elegan, dan fitur canggih yang dirancang untuk para developer masa kini.
      </p>
      <a href="{{ route('login') }}" class="btn btn-cta animate__animated animate__zoomIn">Mulai Sekarang</a>
    </div>
    <svg class="wave" viewBox="0 0 1440 180" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill="#fff" d="M0,64L60,80C120,96,240,128,360,133.3C480,139,600,117,720,117.3C840,117,960,139,1080,154.7C1200,171,1320,181,1380,186.7L1440,192L1440,320L0,320Z"></path>
    </svg>
  </section>

  <!-- FITUR -->
  <section class="section" id="features">
    <div class="container">
      <h2 class="section-title text-center" data-aos="fade-up">Fitur Unggulan</h2>
      <div class="row g-4 justify-content-center">
        <div class="col-md-4" data-aos="zoom-in-up">
          <div class="card feature-card p-4 text-center">
            <i class="fas fa-rocket"></i>
            <h5 class="card-title mt-3">Laravel 12</h5>
            <p class="card-text">
              Temukan fitur terbaru dan peningkatan performa dalam Laravel 12 yang dirancang lebih cepat, ringan, dan efisien.
            </p>
          </div>
        </div>
        <div class="col-md-4" data-aos="zoom-in-up" data-aos-delay="100">
          <div class="card feature-card p-4 text-center">
            <i class="fas fa-layer-group"></i>
            <h5 class="card-title mt-3">Template Modern</h5>
            <p class="card-text">
              Template responsif dan dapat disesuaikan dengan tampilan elegan berbasis Bootstrap 5 untuk antarmuka pengguna yang menarik.
            </p>
          </div>
        </div>
        <div class="col-md-4" data-aos="zoom-in-up" data-aos-delay="200">
          <div class="card feature-card p-4 text-center">
            <i class="fas fa-user-shield"></i>
            <h5 class="card-title mt-3">Laravel Breeze</h5>
            <p class="card-text">
              Proses otentikasi yang aman dan cepat menggunakan Laravel Breeze untuk sistem login yang mudah dan efisien.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="container">
      <p class="mb-1">&copy; {{ date('Y') }} Laravel 12 Modern. Hak Cipta Dilindungi.</p>
      <p class="mb-0">Kontributor: <a href="#" target="_blank">Taufik Hidayat</a></p>
    </div>
  </footer>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true,
      duration: 900,
      offset: 120,
    });
  </script>
</body>
</html>
