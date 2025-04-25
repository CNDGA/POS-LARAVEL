<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orders;
use App\Models\Products;
use Carbon\Carbon;
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

        $pdf = PDF::loadView('reports.print.weekly', compact('orders', 'totalSales', 'startDate', 'endDate'));
        return $pdf->stream('laporan-mingguan-' . $startDate . '-' . $endDate . '.pdf');
    }

    public function printMonthly(Request $request)
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

        $monthName = Carbon::create()->month($month)->monthName;

        $pdf = PDF::loadView('reports.print.monthly', compact('orders', 'totalSales', 'month', 'year', 'monthName'));
        return $pdf->stream('laporan-bulanan-' . $monthName . '-' . $year . '.pdf');
    }

    public function popularProducts(Request $request)
    {
        $products = Products::with('category')
            ->withCount('orderDetails')
            ->orderBy('order_details_count', 'desc')
            ->paginate(10);

        return view('reports.popular-products', compact('products'));
    }
}
