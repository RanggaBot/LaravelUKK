<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }
        .login-title {
            color: #333;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-login {
            background-color: #4e73df;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            padding: 0.75rem;
        }
        .btn-login:hover {
            background-color: #2e59d9;
        }
        .alert {
            font-size: 0.875rem;
            padding: 0.5rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2 class="login-title">Login</h2>
        <form action="{{ route('login-proses') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ Session::get('email') }}" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>
            <button type="submit" class="btn btn-primary btn-login w-100">Login</button>
        </form>
        <div class="mt-3 text-center">
            <a href="{{ route('gantipassword') }}" class="text-decoration-none">Lupa Password?</a>
        </div>
        <div class="mt-2 text-center">
            <a href="{{ route('register') }}" class="text-decoration-none">Buat Akun Baru</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($message = Session::get('failed'))
        <script>
            Swal.fire({
                title: "Error",
                text: "{{ $message }}",
                icon: "error",
            });
        </script>
    @endif

    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ $message }}",
                icon: "success",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
</body>
</html>