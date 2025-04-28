@extends('layouts.main')

@section('content')
<div class="container">
    <div class="text-center mb-4">
        <h2>Laporan Bulanan</h2>
        {{-- <h4>{{ $monthName }} {{ $year }}</h4> --}}
        <p class="text-muted">Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</p>
    </div>

    <div class="card mb-4">
        <div class="card-body bg-light">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Ringkasan Penjualan</h5>
                    <p class="card-text">Total Transaksi: {{ $orders->count() }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <h3 class="text-success">Total Penjualan: Rp {{ number_format($totalSales, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>No. Transaksi</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d F Y H:i') }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->customer->name ?? 'Pelanggan Umum' }}</td>
                            <td>Rp {{ number_format($order->order_amount, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 'warning' }}">
                                    {{ $order->status == 'completed' ? 'Selesai' : 'Proses' }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto print ketika dokumen siap
    document.addEventListener('DOMContentLoaded', function() {
        window.print();
        
        // Optional: Kembali ke halaman sebelumnya setelah cetak
        window.onafterprint = function() {
            window.history.back();
        };
    });
</script>
@endsection