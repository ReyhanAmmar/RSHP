<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="Login Admin RSHP Unair">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - RSHP Unair</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, rgb(2, 3, 129) 0%, rgb(0, 50, 150) 100%);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .login-container {
      background: white;
      border-radius: 16px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      max-width: 450px;
      width: 100%;
      animation: slideIn 0.5s ease;
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .login-header {
      background: rgb(2, 3, 129);
      color: white;
      padding: 40px 30px;
      text-align: center;
    }

    .login-header h1 {
      font-size: 28px;
      margin-bottom: 10px;
    }

    .login-header p {
      font-size: 14px;
      opacity: 0.9;
    }

    .logo {
      width: 80px;
      height: 80px;
      background: white;
      border-radius: 50%;
      margin: 0 auto 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 36px;
    }

    .login-body {
      padding: 40px 30px;
    }

    .alert {
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 14px;
    }

    .alert-success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    .alert-error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }

    .form-group {
      margin-bottom: 25px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      color: #333;
      font-weight: 500;
      font-size: 14px;
    }

    .input-group {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
      font-size: 18px;
    }

    .form-group input {
      width: 100%;
      padding: 14px 15px 14px 45px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 15px;
      transition: all 0.3s;
      font-family: Arial, sans-serif;
    }

    .form-group input:focus {
      outline: none;
      border-color: orange;
      box-shadow: 0 0 0 3px rgba(255, 165, 0, 0.1);
    }

    .form-group input.error {
      border-color: #dc3545;
    }

    .error-message {
      color: #dc3545;
      font-size: 13px;
      margin-top: 6px;
      display: block;
    }

    .remember-forgot {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      font-size: 14px;
    }

    .remember-me {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .remember-me input[type="checkbox"] {
      width: 18px;
      height: 18px;
      cursor: pointer;
    }

    .remember-me label {
      cursor: pointer;
      color: #555;
    }

    .forgot-password {
      color: rgb(2, 3, 129);
      text-decoration: none;
      font-weight: 500;
    }

    .forgot-password:hover {
      text-decoration: underline;
    }

    .btn-login {
      width: 100%;
      padding: 14px;
      background: orange;
      color: black;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s;
    }

    .btn-login:hover {
      background: #ff8c00;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(255, 165, 0, 0.4);
    }

    .btn-login:active {
      transform: translateY(0);
    }

    .back-home {
      text-align: center;
      margin-top: 25px;
      padding-top: 25px;
      border-top: 1px solid #e0e0e0;
    }

    .back-home a {
      color: rgb(2, 3, 129);
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    .back-home a:hover {
      text-decoration: underline;
    }

    @media (max-width: 480px) {
      .login-container {
        max-width: 100%;
      }

      .login-header {
        padding: 30px 20px;
      }

      .login-body {
        padding: 30px 20px;
      }

      .remember-forgot {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
      }
    }
  </style>
</head>
<body>

<div class="login-container">
  <div class="login-header">
    <div class="logo">🏥</div>
    <h1>Login</h1>
    <p>Rumah Sakit Hewan Pendidikan Unair</p>
  </div>

  <div class="login-body">
    <!-- Alert Success -->
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif

    <!-- Alert Error -->
    @if(session('error'))
    <div class="alert alert-error">
      {{ session('error') }}
    </div>
    @endif

    <!-- Error dari validasi -->
    @if($errors->has('email') && !$errors->has('password'))
    <div class="alert alert-error">
      {{ $errors->first('email') }}
    </div>
    @endif

    @if($errors->has('access'))
    <div class="alert alert-error">
      {{ $errors->first('access') }}
    </div>
    @endif

    <!-- Login Form -->
    <form action="{{ route('login.proses') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="email">Email</label>
        <div class="input-group">
          <span class="input-icon">📧</span>
          <input 
            type="email" 
            name="email" 
            placeholder="masukkan email Anda"
            class="{{ $errors->has('email') ? 'error' : '' }}"
            required
          >
        </div>
        @error('email')
        <span class="error-message">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <div class="input-group">
          <span class="input-icon">🔒</span>
          <input 
            type="password" 
            name="password" 
            placeholder="masukkan password Anda"
            class="{{ $errors->has('password') ? 'error' : '' }}"
            required
          >
        </div>
        @error('password')
        <span class="error-message">{{ $message }}</span>
        @enderror
      </div>

      <div class="remember-forgot">
        <div class="remember-me">
          <input type="checkbox" id="remember" name="remember">
          <label for="remember">Ingat Saya</label>
        </div>
        <a href="#" class="forgot-password">Lupa Password?</a>
      </div>

      <button type="submit" class="btn-login">Login</button>
    </form>

    <div class="back-home">
      <a href="/home">← Kembali ke Beranda</a>
    </div>
  </div>
</div>

</body>
</html>