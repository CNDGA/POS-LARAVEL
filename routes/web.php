<?php

use App\Http\Controllers\BelajarController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LevelsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UsersController;
use App\Models\Levels;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

//belajar untuk slide ulrnya, BelajarControllernya adalah controllernya & index adalah methodnya
Route::get('belajar', [BelajarController::class, 'index']);
Route::get('tambah', [BelajarController::class, 'tambah']);
Route::get('kurang', [BelajarController::class, 'kurang']);
Route::get('bagi', [BelajarController::class, 'bagi']);
Route::get('kali', [BelajarController::class, 'kali']);
Route::get('login', [LoginController::class, 'login']);
Route::post('actionLogin', [LoginController::class, 'actionLogin']);
Route::get('logout', [LoginController::class, 'logout']);



Route::post('action-tambah', [BelajarController::class, 'actionTambah']);

//get, post,put, delete dengan syaratt Dashboardcontrollernya harus ada create, show,store,update,delete,destroyer
Route::resource('dashboard', DashboardController::class);

Route::resource('categories', CategoriesController::class);



Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoriesController::class);
    Route::resource('product', ProductController::class);
    Route::resource('users', UsersController::class);
    Route::resource('pos', TransactionController::class);
    Route::resource('levels', LevelsController::class);


    //mengambil parameter id untuk print
    //jika nama routenya sama (print:contoh) dan class nya jg (print:contoh) maka harus menambahkan ->name ('print');
    Route::get('print/{id}', [TransactionController::class, 'print'])->name('print');




    Route::get('get-product/{id}', [TransactionController::class, 'getProduct']);

    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        // Laporan harian
        Route::get('/daily', [ReportController::class, 'dailyReport'])->name('daily');
        Route::get('/daily/print', [ReportController::class, 'printDaily'])->name('daily.print');

        // Laporan mingguan
        Route::get('/weekly', [ReportController::class, 'weeklyReport'])->name('weekly');

        // Route laporan bulanan
        Route::get('/monthly', [ReportController::class, 'monthlyReport'])->name('monthly');

        Route::get('/popular-products', [ReportController::class, 'popularProducts'])->name('popular-products');
    });
});
