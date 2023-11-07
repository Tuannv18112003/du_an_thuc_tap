<?php

use App\Livewire\Home;
use App\Livewire\Details;
use App\Models\Categories;
use App\Livewire\CartBooks;
use App\Livewire\ShopBooks;
use App\Livewire\Books\ListBooks;
use App\Livewire\Books\CreateBook;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Livewire\CheckOut;

// use Illuminate\Routing\Route;

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



// Route::get('book/create', CreateBook::class);
// Route::get('book', ListBooks::class);

Route::get('/', Home::class)->name('home');

Route::get('/chi-tiet-san-pham/{slug}', Details::class)->name('details');

Route::get('/danh-muc', function() {
    DB::enableQueryLog();

    $cate = Categories::find(3)->books;

    dd($cate);
    dd(DB::getQueryLog());
});

Route::get('cua-hang/{slug?}', ShopBooks::class);

// Route::get('cart', [CartController::class, 'index']);
Route::get('gio-hang', CartBooks::class);
Route::get('thanh-toan', CheckOut::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
