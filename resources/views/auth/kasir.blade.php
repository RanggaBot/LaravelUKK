<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .table th, .table td {
            vertical-align: middle;
        }
        #cartTotal {
            font-weight: bold;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Dashboard Kasir</h1>
        
        <div class="row">
            <div class="col-md-6">
                <h2>Input Produk</h2>
                <form id="productForm">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="productPrice" required>
                    </div>
                    <div class="mb-3">
                        <label for="productQuantity" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="productQuantity" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah ke Keranjang</button>
                </form>
            </div>
            
            <div class="col-md-6">
                <h2>Keranjang Belanja</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="cartItems">
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->product_name }}</td>
                                    <td>Rp {{ number_format($transaction->price, 2) }}</td>
                                    <td>{{ $transaction->quantity }}</td>
                                    <td>Rp {{ number_format($transaction->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-end">
                    <h4>Total: Rp <span id="cartTotal">0</span></h4>
                    <button class="btn btn-success" id="processPayment">Proses Pembayaran</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productForm = document.getElementById('productForm');
            const cartItems = document.getElementById('cartItems');
            const cartTotal = document.getElementById('cartTotal');
            const processPayment = document.getElementById('processPayment');
            let total = 0;

            productForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const name = document.getElementById('productName').value;
                const price = parseFloat(document.getElementById('productPrice').value);
                const quantity = parseInt(document.getElementById('productQuantity').value);
                const itemTotal = price * quantity;

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${name}</td>
                    <td>Rp ${price.toFixed(2)}</td>
                    <td>${quantity}</td>
                    <td>Rp ${itemTotal.toFixed(2)}</td>
                `;

                cartItems.appendChild(row);

                total += itemTotal;
                cartTotal.textContent = total.toFixed(2);

                // Kirim data ke server
                fetch('{{ route('transactions.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        product_name: name,
                        price: price,
                        quantity: quantity,
                        total: itemTotal
                    })
                })
                .then(response => response.json())
                .then(data => console.log(data))
                .catch(error => console.error('Error:', error));

                // Reset form
                productForm.reset();
            });

            processPayment.addEventListener('click', function() {
                alert(`Total pembayaran: Rp ${total.toFixed(2)}`);
                // Di sini Anda bisa menambahkan logika untuk memproses pembayaran
                // Misalnya, mengirim data ke server
            });
        });
    </script>
</body>
</html>