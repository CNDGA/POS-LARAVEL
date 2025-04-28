<body onload="window.print()">
<div class="report-container">
    <div class="report-header">
        <h1>Laporan Harian Penjualan</h1>
        <h3>{{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }}</h3>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y H:i') }}</p>
    </div>

    <div class="report-summary">
        <h2>Ringkasan Penjualan</h2>
        <div class="summary-grid">
            <div class="summary-item">
                <span class="label">Total Transaksi</span>
                <span class="value">{{ $orders->count() }}</span>
            </div>
            <div class="summary-item highlight">
                <span class="label">Total Penjualan</span>
                <span class="value">Rp {{ number_format($totalSales, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="report-details">
        <h2>Detail Transaksi</h2>
        <table class="report-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>No. Order</th>
                    <th>Waktu</th>
                    <th>Produk</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Harga</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($orders as $order)
                    @foreach($order->orderDetails as $detail)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $order->order_code }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->created_at)->format('H:i') }}</td>
                        <td>{{ $detail->product->product_name }}</td>
                        <td class="text-right">{{ $detail->qty }}</td>
                        <td class="text-right">Rp {{ number_format($detail->order_price, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($detail->order_subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="6" class="text-right"><strong>Total Penjualan</strong></td>
                    <td class="text-right"><strong>Rp {{ number_format($totalSales, 0, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="report-footer">
        <div class="signature">
            <div class="signature-line"></div>
            <p>(Nama Penanggung Jawab)</p>
            <p>Admin/Pemilik Toko</p>
        </div>
        <div class="report-notes">
            <p><strong>Catatan:</strong></p>
            <ul>
                <li>Laporan ini mencakup seluruh transaksi pada tanggal {{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }}</li>
                <li>Data diambil secara otomatis dari sistem</li>
            </ul>
        </div>
    </div>
</div>
</body>

<style>
    .report-container {
        font-family: Arial, sans-serif;
        max-width: 100%;
        margin: 0 auto;
        padding: 20px;
    }
    
    .report-header {
        text-align: center;
        margin-bottom: 30px;
        border-bottom: 2px solid #333;
        padding-bottom: 20px;
    }
    
    .report-header h1 {
        margin: 0;
        font-size: 24px;
    }
    
    .report-header h3 {
        margin: 5px 0 0;
        font-size: 18px;
        font-weight: normal;
    }
    
    .report-summary {
        margin-bottom: 30px;
    }
    
    .report-summary h2 {
        font-size: 18px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 5px;
    }
    
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 15px;
    }
    
    .summary-item {
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 5px;
    }
    
    .summary-item.highlight {
        background-color: #f8f9fa;
        border-color: #6c757d;
    }
    
    .label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    .value {
        font-size: 18px;
    }
    
    .report-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    
    .report-table th, .report-table td {
        border: 1px solid #ddd;
        padding: 8px 12px;
        text-align: left;
    }
    
    .report-table th {
        background-color: #343a40;
        color: white;
    }
    
    .report-table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }
    
    .total-row {
        font-weight: bold;
        background-color: #e9ecef !important;
    }
    
    .text-right {
        text-align: right;
    }
    
    .report-footer {
        margin-top: 40px;
        display: flex;
        justify-content: space-between;
    }
    
    .signature {
        width: 200px;
        text-align: center;
    }
    
    .signature-line {
        border-top: 1px solid #333;
        margin: 40px 0 10px;
    }
    
    .report-notes {
        width: calc(100% - 220px);
    }
</style>