@extends('layouts.main')
@section('title'.'Cetak Laporan mingguan')
@section('content')
<body onload="window.print()">
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Laporan mingguan</h2>
            {{-- <h4>{{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }}</h4> --}}
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print me-1"></i> Cetak
            </button>
        </div>
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
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>No. Order</th>
                            <th>Waktu</th>
                            <th>Produk</th>
                            <th class="text-end">Qty</th>
                            <th class="text-end">Harga</th>
                            <th class="text-end">Subtotal</th>
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
                                <td class="text-end">{{ $detail->qty }}</td>
                                <td class="text-end">Rp {{ number_format($detail->order_price, 0, ',', '.') }}</td>
                                <td class="text-end">Rp {{ number_format($detail->order_subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-active">
                            <th colspan="6" class="text-end">Total Penjualan:</th>
                            <th class="text-end">Rp {{ number_format($totalSales, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
@endsection