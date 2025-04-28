<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orders;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// use Barryvdh\DomPDF\Facade\Pdf;
// use PDF;

class ReportController extends Controller
{
    // Method untuk halaman utama laporan
    public function index()
    {
        return view('reports.index');
    }

    // Method untuk laporan harian
    public function dailyReport(Request $request)
    {
        $date = $request->input('date', Carbon::today()->toDateString());

        $orders = Orders::with(['orderDetails.product'])
            ->whereDate('order_date', $date)
            ->where('order_status', 1)
            ->orderBy('order_date', 'desc')
            ->get();

        $totalSales = $orders->sum('order_amount');

        return view('reports.daily', compact('orders', 'totalSales', 'date'));
    }

    public function weeklyReport(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfWeek()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfWeek()->toDateString());

        $orders = Orders::with(['orderDetails.product'])
            ->whereBetween('order_date', [$startDate, $endDate])
            ->where('order_status', 1)
            ->orderBy('order_date', 'desc')
            ->get();

        $totalSales = $orders->sum('order_amount');

        return view('reports.weekly', compact('orders', 'totalSales', 'startDate', 'endDate'));
    }

    public function monthlyReport(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        $orders = Orders::with(['orderDetails.product'])
            ->whereMonth('order_date', $month)
            ->whereYear('order_date', $year)
            ->where('order_status', 1)
            ->orderBy('order_date', 'desc')
            ->get();

        $totalSales = $orders->sum('order_amount');

        return view('reports.monthly', compact('orders', 'totalSales', 'month', 'year'));
    }



    public function popularProducts(Request $request)
    {
        $products = Products::with('category')
            ->withCount('orderDetails')
            ->orderBy('order_details_count', 'desc')
            ->paginate(10);

        return view('reports.popular-products', compact('products'));
    }

    public function stokBarang(Request $request)
    {
        $stok = DB::table('products')->get();
        return view('reports.stok', compact('stok'));
    }

    public function printDaily(Request $request)
    {

        $date = $request->input('date', Carbon::today()->toDateString());

        $orders = Orders::with(['orderDetails.product'])
            ->whereDate('order_date', $date)
            ->where('order_status', 1)
            ->orderBy('order_date', 'desc')
            ->get();

        $totalSales = $orders->sum('order_amount');

        return view('reports.print.daily', compact('orders', 'totalSales', 'date'));
    }



    public function printWeekly(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfWeek()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfWeek()->toDateString());

        $orders = Orders::with(['orderDetails.product'])
            ->whereBetween('order_date', [$startDate, $endDate])
            ->where('order_status', 1)
            ->orderBy('order_date', 'desc')
            ->get();

        $totalSales = $orders->sum('order_amount');



        return view('reports.print.weekly', compact('orders', 'totalSales', 'startDate', 'endDate'));
    }

    public function monthly(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        // Validasi bulan dan tahun
        if ($month < 1 || $month > 12) {
            $month = Carbon::now()->month;
        }

        if ($year < 2000 || $year > 2100) {
            $year = Carbon::now()->year;
        }

        // Data utama
        $orders = Orders::with(['orderDetails.product', 'customer'])
            ->whereMonth('order_date', $month)
            ->whereYear('order_date', $year)
            ->where('order_status', 1)
            ->orderBy('order_date', 'desc')
            ->get();

        $totalSales = $orders->sum('order_amount');

        // Hitung jumlah hari dalam bulan
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;

        // Data untuk chart harian
        $dailySales = Orders::select(
            DB::raw('DATE(order_date) as date'),
            DB::raw('SUM(order_amount) as total'),
            DB::raw('COUNT(*) as count')
        )
            ->whereMonth('order_date', $month)
            ->whereYear('order_date', $year)
            ->where('order_status', 1)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Format data untuk chart
        $dailySalesData = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = Carbon::create($year, $month, $day)->format('Y-m-d');
            $sale = $dailySales->firstWhere('date', $date);

            $dailySalesData[] = [
                'date' => $day . ' ' . Carbon::create()->month($month)->locale('id')->isoFormat('MMM'),
                'total' => $sale ? $sale->total : 0,
                'count' => $sale ? $sale->count : 0
            ];
        }

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $monthName = Carbon::create()->month($month)->locale('id')->isoFormat('MMMM');

        return view('reports.monthly', [
            'orders' => $orders,
            'totalSales' => $totalSales,
            'startDate' => $startDate,
            'month' => $month,
            'year' => $year,
            'monthName' => $monthName,
            'daysInMonth' => $daysInMonth,
            'dailySales' => collect($dailySalesData)
        ]);
    }

    public function printMonthly(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        $orders = Orders::with(['orderDetails.product', 'customer'])
            ->whereMonth('order_date', $month)
            ->whereYear('order_date', $year)
            ->where('order_status', 1)
            ->orderBy('order_date', 'desc')
            ->get();

        $totalSales = $orders->sum('order_amount');
        $monthName = Carbon::create()->month($month)->locale('id')->isoFormat('MMMM');
        $year = $year;

        return view('reports.print.monthly', [
            'orders' => $orders,
            'totalSales' => $totalSales,
            'monthName' => $monthName,
            'year' => $year
        ]);
    }
}
