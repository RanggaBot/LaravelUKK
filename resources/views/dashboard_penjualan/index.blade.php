@extends('template_dashboard.template')
@section('main_body')
    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Table Penjualan</h6>
                    <a href="{{ route('dashboard_penjualan.create') }}" class="btn btn-success m-1">Tambah</a>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal Penjualan</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Pelanggan ID</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penjualans as $penjualan)
                                    <tr>
                                        <th scope="row">{{ $penjualan['id'] }}</th>
                                        <td>{{ $penjualan['tanggal_penjualan'] }}</td>
                                        <td>{{ $penjualan['total_harga'] }}</td>
                                        <td>{{ $penjualan['pelanggan_id'] }}</td>
                                        <td>
                                            <a href="{{ route('dashboard_penjualan.show', $penjualan->id) }}" class="btn btn-primary m-1">Detail</a>
                                            <a href="{{ route('dashboard_penjualan.edit', $penjualan->id) }}" class="btn btn-warning m-1">Edit</a>
                                            <form action="{{ route('dashboard_penjualan.destroy', $penjualan->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger m-1">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@endsection