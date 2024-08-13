<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Transaksi</h1>

        <div class="row mb-4">
            <div class="col-md-6">
                <h2>Tambah Transaksi Baru</h2>
                <form id="transactionForm">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="quantity" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
                </form>
            </div>
        </div>

        <h2>Riwayat Transaksi</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody id="transactionList">
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->product_name }}</td>
                        <td>Rp {{ number_format($transaction->price, 2) }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>Rp {{ number_format($transaction->total, 2) }}</td>
                        <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const transactionForm = document.getElementById('transactionForm');
            const transactionList = document.getElementById('transactionList');

            transactionForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const productName = document.getElementById('productName').value;
                const price = parseFloat(document.getElementById('price').value);
                const quantity = parseInt(document.getElementById('quantity').value);
                const total = price * quantity;

                fetch('{{ route('transactions.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        product_name: productName,
                        price: price,
                        quantity: quantity,
                        total: total
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${data.transaction.id}</td>
                            <td>${data.transaction.product_name}</td>
                            <td>Rp ${parseFloat(data.transaction.price).toFixed(2)}</td>
                            <td>${data.transaction.quantity}</td>
                            <td>Rp ${parseFloat(data.transaction.total).toFixed(2)}</td>
                            <td>${new Date(data.transaction.created_at).toLocaleString()}</td>
                        `;
                        transactionList.prepend(row);
                        transactionForm.reset();
                    } else {
                        alert('Gagal menambahkan transaksi');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
</body>
</html>