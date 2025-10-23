<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>

  <!-- Font manis dan elegan -->
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;600&family=Licorice&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Karla", sans-serif;
      background: linear-gradient(135deg, #f7d6b1 0%, #e7b787 100%);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-box {
      background-color: #fffaf5;
      padding: 40px 35px;
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
      width: 350px;
      text-align: center;
      border: 2px solid #e0b28a;
      animation: float 3s ease-in-out infinite;
    }

    /* @keyframes float {
      0% { transform: translateY(0px); }
      50% { transform: translateY(-5px); }
      100% { transform: translateY(0px); }
    } */

    .login-box h2 {
      font-family: "Licorice", cursive;
      font-size: 48px;
      color: #8b5e34;
      margin-bottom: 25px;
    }

    .login-box form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .login-box input {
      padding: 12px;
      border-radius: 10px;
      border: 1.5px solid #d2a679;
      outline: none;
      font-size: 15px;
      transition: 0.3s;
    }

    .login-box input:focus {
      border-color: #b27b48;
      box-shadow: 0 0 6px #e0b28a;
    }

    .login-box button {
      padding: 12px;
      border: none;
      border-radius: 10px;
      background-color: #8b5e34;
      color: white;
      font-weight: 600;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .login-box button:hover {
      background-color: #a26b3f;
    }

    .error {
      background: #ffd5d5;
      color: #9b1c1c;
      border: 1px solid #f5a5a5;
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 15px;
      font-size: 14px;
    }
  </style>
</head>

<body>
  <div class="login-box">
    <h2>Login</h2>

    @if(session('error'))
      <p class="error">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ url('/login') }}">
      @csrf
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
