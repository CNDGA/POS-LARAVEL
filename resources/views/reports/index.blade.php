@extends('layouts.main')
@section('title'.'Add New Categories')
@section('content')
<div class="container">
    <h2>Laporan Penjualan</h2>
    
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Harian</h5>
                    <form action="{{ route('reports.daily') }}" method="GET">
                        <div class="form-group">
                            <label for="date">Pilih Tanggal</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Lihat Laporan</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Mingguan</h5>
                    <form action="{{ route('reports.print.weekly') }}" method="GET">
                        <div class="form-group">
                            <label for="start_date">Minggu dari</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ Carbon\Carbon::now()->startOfWeek()->format('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label for="end_date">Sampai</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ Carbon\Carbon::now()->endOfWeek()->format('Y-m-d') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Lihat Laporan</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Bulanan</h5>
                    <form action="{{ route('reports.monthly') }}" method="GET">
                        <div class="form-group">
                            <label for="month">Bulan</label>
                            <select name="month" id="month" class="form-control">
                                @for($i=1; $i<=12; $i++)
                                    <option value="{{ $i }}" {{ $i == date('n') ? 'selected' : '' }}>{{ date('F', mktime(0,0,0,$i,1)) }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="year">Tahun</label>
                            <select name="year" id="year" class="form-control">
                                @for($i=date('Y'); $i>=date('Y')-5; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Lihat Laporan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection