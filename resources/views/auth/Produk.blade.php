<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk</title>
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
        h1 {
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        .card-body {
            padding: 20px;
        }
        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .card-text {
            color: #6c757d;
        }
        .price {
            font-size: 1.3rem;
            font-weight: bold;
            color: #28a745;
        }
        .stock {
            font-size: 0.9rem;
            color: #6c757d;
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
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1 class="text-center mb-5">Katalog Produk</h1>
        
        <h2 class="mb-4">Produk Tersedia</h2>
        <div class="row">
            @forelse($produk as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($product->image)
                            <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        @else
                            <div class="card-img-top d-flex align-items-center justify-content-center bg-light">
                                <i class="fas fa-image fa-4x text-secondary"></i>
                            </div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text flex-grow-1">{{ Str::limit($product->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="stock"><i class="fas fa-box me-1"></i>Stok: {{ $product->stock }}</span>
                            </div>
                            <div class="mt-3 d-flex justify-content-between">
                                <form action="{{ route('kurangi.stok', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-warning btn-sm">
                                        <i class="fas fa-minus me-1"></i>Kurangi Stok
                                    </button>
                                </form>
                                <form action="{{ route('hapus.produk', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash me-1"></i>Hapus Produk
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">Tidak ada produk tersedia saat ini.</p>
                </div>
            @endforelse
        </div>

        @if($outOfStockProducts->isNotEmpty())
            <h2 class="mt-5 mb-4">Produk Habis</h2>
            <div class="row">
                @foreach($outOfStockProducts as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 bg-light">
                            @if($product->image)
                                <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-light">
                                    <i class="fas fa-image fa-4x text-secondary"></i>
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text flex-grow-1">{{ Str::limit($product->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="stock text-danger"><i class="fas fa-box me-1"></i>Stok Habis</span>
                                </div>
                                <div class="mt-3 d-flex justify-content-end">
                                    <form action="{{ route('hapus.produk', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash me-1"></i>Hapus Produk
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        
        <div class="text-center mt-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="fas fa-plus me-2"></i>Tambah Produk
            </button>
        </div>
    </div>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Tambah Produk Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Produk') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Produk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>