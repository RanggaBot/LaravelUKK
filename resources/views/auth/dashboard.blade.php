<!DOCTYPE HTML>
<html lang="id">
<head>
    <title>Dashboard KasirKu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css2/style.css') }}" rel="stylesheet" type="text/css" media="all"/>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }
        #sidebar {
            background-color: #343a40;
            min-height: 100vh;
        }
        #sidebar .nav-link {
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        #sidebar .nav-link:hover, #sidebar .nav-link.active {
            background-color: #007bff;
        }
        .main-content {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .profile-section {
            text-align: center;
            padding: 20px 0;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>	
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="position-sticky">
                <div class="profile-section">
                    <img src="{{ asset(Auth::user()->profile_picture ?? 'images/default-profile.jpg') }}" alt="Profile Picture" class="profile-pic">
                    <h5 class="text-white">{{ Auth::user()->name }}</h5>
                    <button type="button" class="btn btn-sm btn-light mt-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="fas fa-edit"></i> Edit Profil
                    </button>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kasir') }}">
                            <i class="fas fa-shopping-cart"></i> Transaksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('Produk') }}">
                            <i class="fas fa-box"></i> Produk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users"></i> Pelanggan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('laporan') }}">
                            <i class="fas fa-chart-bar"></i> Laporan
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                    </div>
                </div>

                <!-- Statistik Ringkas -->
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <h5 class="card-title">Total Penjualan</h5>
                                <p class="card-text display-4">Rp 5.000.000</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <h5 class="card-title">Transaksi Hari Ini</h5>
                                <p class="card-text display-4">50</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-info">
                            <div class="card-body">
                                <h5 class="card-title">Total Produk</h5>
                                <p class="card-text display-4">{{ $totalProduk }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <h5 class="card-title">Produk Tersedia</h5>
                                <p class="card-text display-4">{{ $produkTersedia }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <h5 class="card-title">Produk Habis</h5>
                                <p class="card-text display-4">{{ $outOfStockProducts ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grafik Penjualan -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header">
                                Grafik Penjualan Mingguan
                            </div>
                            <div class="card-body">
                                <canvas id="salesChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                Ringkasan Produk
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Total Produk
                                        <span class="badge bg-primary rounded-pill">{{ $totalProduk }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Produk Tersedia
                                        <span class="badge bg-success rounded-pill">{{ $produkTersedia }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Produk Habis
                                        <span class="badge bg-warning rounded-pill">{{ $outOfStockProducts ?? 0 }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Transaksi -->
<div class="modal fade" id="transaksiModal" tabindex="-1" aria-labelledby="transaksiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transaksiModalLabel">Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Isi dengan form transaksi atau komponen transaksi lainnya -->
                <form>
                    <div class="mb-3">
                        <label for="produk" class="form-label">Pilih Produk</label>
                        <select class="form-select" id="produk" required>
                            <option value="">Pilih produk...</option>
                            @foreach(\App\Models\Product::all() as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                </form>
                
                <hr>
                
                <h6>Keranjang Belanja</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Isi dengan data keranjang belanja -->
                    </tbody>
                </table>
                
                <div class="text-end">
                    <strong>Total: Rp 0</strong>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Proses Transaksi</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Kode untuk membuat grafik penjualan
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [{
                label: 'Penjualan',
                data: [1200000, 1900000, 1500000, 2000000, 2200000, 2800000, 2100000],
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</body>
</html>