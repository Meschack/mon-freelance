<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TwoFactorController;
use App\Models\Migration;
use App\Models\Role;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    /* Role::query()->insert([
        ["name" => "admin", "label" => "Administrator"],
        ["name" => "seller", "label" => "Seller"],
        ["name" => "customer", "label" => "Customer"]
    ]); */

    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::resource('sellers', SellerController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'twofactor'])->group(function () {
    Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
    Route::resource('verify', TwoFactorController::class)->only('index', 'store');
});

Route::get('/search', function (Request $request) {
    $keyword = $request->get('q');

    $services = Service::where('title', 'LIKE', "%$keyword%")->paginate(12);

    return view('search', [
        'q' => $keyword,
        'services' => $services,
    ]);
})->name('search');

Route::resource('service', ServiceController::class);

require __DIR__ . '/auth.php';
