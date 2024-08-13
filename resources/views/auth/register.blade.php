<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar</title>
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
        .register-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }
        .register-title {
            color: #333;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-register {
            background-color: #4e73df;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            padding: 0.75rem;
        }
        .btn-register:hover {
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
    <div class="register-card">
        <h2 class="register-title">Buat Akun</h2>
        <form action="{{ route('register-proses') }}" method="POST">
            @csrf
            @if($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="mb-3">
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" value="{{ old('nama') }}" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" id="email" placeholder="Alamat email" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-register w-100">Buat Akun</button>
        </form>
        <div class="mt-3 text-center">
            <a href="/lupa-password" class="text-decoration-none">Lupa Password?</a>
        </div>
        <div class="mt-2 text-center">
            <a href="{{ route('login') }}" class="text-decoration-none">Sudah punya akun? Login!</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($message = Session::get('error'))
        <script>
            Swal.fire({
                title: "Error",
                text: "{{ $message }}",
                icon: "error",
            });
        </script>
    @endif
</body>
</html>