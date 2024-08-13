<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ganti Password</title>
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
        .password-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }
        .password-title {
            color: #333;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-change-password {
            background-color: #4e73df;
            border: none;
            border-radius: 5px;
            font-weight: 500;
            padding: 0.75rem;
        }
        .btn-change-password:hover {
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
    <div class="password-card">
        <h2 class="password-title">Ganti Password</h2>
        <form action="{{ route('gantipassword') }}" method="POST">
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
                <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Gmail" required>
            </div>
            <div class="mb-3">
                <input type="password" name="new_password" class="form-control" id="new_password" placeholder="Password Baru" required>
            </div>
            <div class="mb-3">
                <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" placeholder="Konfirmasi Password Baru" required>
            </div>
            <button type="submit" class="btn btn-primary btn-change-password w-100">Ganti Password</button>
        </form>
        <div class="mt-3 text-center">
            <a href="{{ route('login') }}" class="text-decoration-none">Kembali ke login</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "{{ $message }}",
                icon: "success",
            });
        </script>
    @endif

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