@extends('layouts.main')
@section('title', 'Laporan Mingguan')
@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Laporan Mingguan</h2>
            <h4>{{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}</h4>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('reports.index') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
            <a href="{{ route('reports.print.weekly', ['start_date' => $startDate, 'end_date' => $endDate]) }}" 
               class="btn btn-primary" target="_blank">
                <i class="fas fa-print me-1"></i> Cetak
            </a>
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
                    <!-- Table content same as before -->
                </table>
            </div>
        </div>
    </div>
</div>
@endsection