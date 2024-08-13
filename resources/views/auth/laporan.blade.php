<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan dan Stok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        h1, h2 {
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-title {
            color: #007bff;
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-5">Laporan Penjualan dan Stok</h1>

        <form action="{{ route('laporan') }}" method="GET" class="mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate->format('Y-m-d') }}">
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate->format('Y-m-d') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter me-2"></i>Filter</button>
                </div>
            </div>
        </form>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-chart-line me-2"></i>Total Penjualan</h5>
                        <p class="card-text fs-4">Rp {{ number_format($totalSales, 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-box me-2"></i>Total Produk Terjual</h5>
                        <p class="card-text fs-4">{{ $totalQuantity }}</p>
                    </div>
                </div>
            </div>
        </div>

        <h2><i class="fas fa-shopping-cart me-2"></i>Laporan Produk Terjual</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah Terjual</th>
                        <th>Total Penjualan</th>
                        <th>Sisa Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productSales as $sale)
                        <tr>
                            <td>{{ $sale['product']->name }}</td>
                            <td>{{ $sale['quantity'] }}</td>
                            <td>Rp {{ number_format($sale['total_price'], 2) }}</td>
                            <td>{{ $sale['product']->stock }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h2 class="mt-5"><i class="fas fa-warehouse me-2"></i>Laporan Produk Belum Terjual</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Stok Tersedia</th>
                        <th>Harga Satuan</th>
                        <th>Nilai Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($unsoldProducts as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>Rp {{ number_format($product->price, 2) }}</td>
                            <td>Rp {{ number_format($product->stock * $product->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h2 class="mt-5"><i class="fas fa-list-alt me-2"></i>Detail Penjualan</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                        <tr>
                            <td>{{ $sale->sale_date->format('d/m/Y') }}</td>
                            <td>{{ $sale->product->name }}</td>
                            <td>{{ $sale->quantity }}</td>
                            <td>Rp {{ number_format($sale->total_price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>