<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Inventory Lab</title>

    <!-- Fonts - Menggunakan Font Google 'Inter' -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS - CDN Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom right, #5D3FD3 0%, #00BFFF 100%);
            /* Warna background seperti welcome page */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            overflow: hidden;
            color: #333;
            /* Warna teks default untuk form */
        }

        .auth-card {
            background-color: rgba(255, 255, 255, 0.98);
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
            padding: 40px;
            text-align: center;
            max-width: 450px;
            width: 90%;
            animation: fadeIn 1.5s ease-out;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #007bff;
            margin-bottom: 25px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }

        .btn-auth {
            padding: 12px 25px;
            font-size: 1.05rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-primary-auth {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        .btn-primary-auth:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.3);
        }

        .btn-link-custom {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .btn-link-custom:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .text-muted-custom {
            color: #6c757d !important;
        }

        .text-register {
            margin-top: 25px;
            font-size: 0.95rem;
        }

        .text-register a {
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="auth-card">
        <h2 class="auth-title">Login ke Inventory Lab</h2>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label text-start w-100 mb-1">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <div class="invalid-feedback text-start">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label text-start w-100 mb-1">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">
                @error('password')
                    <div class="invalid-feedback text-start">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                    <label class="form-check-label text-muted-custom" for="remember_me">
                        Ingat saya
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a class="btn-link-custom" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <div class="d-grid gap-2"> {{-- Tombol Login --}}
                <button type="submit" class="btn btn-primary btn-auth btn-primary-auth">
                    <i class="bi bi-box-arrow-in-right me-2"></i> Login
                </button>
            </div>
        </form>

        <!-- Link to Register -->
        @if (Route::has('register'))
            <div class="text-center text-register">
                <span class="text-muted-custom">Belum punya akun?</span>
                <a class="btn-link-custom" href="{{ route('register') }}">Daftar sekarang!</a>
            </div>
        @endif
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigF/00aJ/l2P/PNJ2L" crossorigin="anonymous">
    </script>
</body>

</html>
