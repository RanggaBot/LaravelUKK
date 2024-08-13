@extends('template_dashboard.template')
@section('main_body')
    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h4 class="mb-4">Detail Penjualan Barang</h4>
                    <form>
                        <div class="mb-3">
                            <label for="inputID" class="form-label">ID Produk</label>
                            <input type="number" class="form-control" id="inputID" readonly value="{{ $data['id'] ?? 'Tidak diketahui'}}">
                        </div>
                        <div class="mb-3">
                            <label for="inputJumlah" class="form-label">Jumlah Produk</label>
                            <input type="number" class="form-control" id="inputJumlah" readonly value="{{ $data['jumlah_produk'] ?? 'Tidak diketahui'}}">
                        </div>
                        <div class="mb-3">
                            <label for="inputHarga" class="form-label">Total Harga</label>
                            <input type="number" class="form-control" id="inputHarga" readonly value="{{ $data['total_harga'] ?? 'Tidak diketahui'}}">
                        </div>
                        <div class="mb-3">
                            <label for="inputSubtotal" class="form-label">Subtotal</label>
                            <input type="number" class="form-control" id="inputSubtotal" readonly value="{{ $data['subtotal'] ?? 'Tidak diketahui'}}">
                        </div>
                        <div class="mb-3">
                            <label for="inputTanggalPenjualan" class="form-label">Tanggal Penjualan</label>
                            <input type="date" class="form-control" id="inputTanggalPenjualan" readonly value="{{ $data['tanggal_penjualan'] ?? 'Tidak diketahui'}}">
                        </div>
                        <a href="{{ route('dashboard_penjualan.edit', $data->id) }}" class="btn btn-warning m-1">Edit</a>
                        <a href="{{ route('dashboard_penjualan.index') }}" class="btn btn-danger m-1">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@endsection