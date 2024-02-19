<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TwoFactorController;
use App\Models\Category;
use App\Models\Migration;
use App\Models\Role;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

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

    // Schema::dropIfExists('notifications');

    $categories = Category::all();

    return view('welcome', compact('categories'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('customers', CustomerController::class);
});
Route::resource('sellers', SellerController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'twofactor'])->group(function () {
    Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
    Route::resource('verify', TwoFactorController::class)->only('index', 'store');
});

Route::get('/search', [ServiceController::class, 'search'])->name('search');

Route::resource('service', ServiceController::class);


Route::middleware(['auth'])->group(function () {
    Route::resource('order', OrderController::class);
    Route::patch('order/{order}/review', [OrderController::class, 'review'])->name('order.review');
    Route::post('message', [MessageController::class, 'store'])->name('message.create');
    Route::get('inbox', [MessageController::class, 'index'])->name('inbox');
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications');
});


require __DIR__ . '/auth.php';
