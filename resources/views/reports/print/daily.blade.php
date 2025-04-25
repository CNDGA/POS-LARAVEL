<!DOCTYPE html>
<html>
<head>
    <title>Laporan Harian - {{ $date }}</title>
    <style>
        body { 
            font-family: 'Arial', sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            padding: 0;
            font-size: 16px;
        }
        .header p {
            margin: 0;
            padding: 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .summary {
            margin-top: 20px;
            float: right;
            width: 300px;
        }
        .footer {
            margin-top: 50px;
        }
        .signature {
            float: right;
            text-align: center;
            width: 200px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>TOKO MAKMUR JAYA</h2>
        <p>Jl. Raya Contoh No. 123, Kota Contoh</p>
        <p>Telp: (021) 12345678</p>
        <hr>
        <h3>LAPORAN PENJUALAN HARIAN</h3>
        <p>Tanggal: {{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Order</th>
                <th>Produk</th>
                <th>Qty</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; $grandTotal = 0; @endphp
            @foreach($orders as $order)
                @foreach($order->orderDetails as $detail)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td>{{ $order->order_code }}</td>
                    <td>{{ $detail->product->product_name }}</td>
                    <td class="text-center">{{ $detail->qty }}</td>
                    <td class="text-right">Rp {{ number_format($detail->order_price, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($detail->order_subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">TOTAL PENJUALAN</th>
                <th class="text-right">Rp {{ number_format($totalSales, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <div class="signature">
            <p>Kota Contoh, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <br><br><br>
            <p>(___________________)</p>
            <p>Manager</p>
        </div>
    </div>
</body>
</html>