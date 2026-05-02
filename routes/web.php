<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Home\HomeController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LibraryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\User\UserLibraryController;
use App\Http\Controllers\User\ProfileController;

use App\Http\Controllers\Library\DashboardController;
use App\Http\Controllers\Library\LibraryBookController;
use App\Http\Controllers\Library\StockController;
use App\Http\Controllers\Library\WithdrawController;
use App\Http\Controllers\Library\LibraryShowController;
use App\Http\Controllers\Library\LibraryShowBooksController;
use App\Http\Controllers\Library\LibraryTransactionController;

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentController;

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/books/{book}', [HomeController::class, 'show'])->name('books.show');


Route::middleware(['auth', 'role:admin', 'ban'])->prefix('admin')->name('admin.')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Libraries
        Route::get('/libraries', [LibraryController::class, 'index'])->name('libraries.index');
        Route::get('/libraries/create', [LibraryController::class, 'create'])->name('libraries.create');
        Route::post('/libraries', [LibraryController::class, 'store'])->name('libraries.store');
        Route::post('/libraries/{library}/approve', [LibraryController::class, 'approve'])->name('libraries.approve');
        Route::post('/libraries/{library}/block', [LibraryController::class, 'block'])->name('libraries.block');
        Route::delete('/libraries/{library}', [LibraryController::class, 'destroy'])->name('libraries.destroy');

        // Books
        Route::get('/books', [BookController::class, 'index'])->name('books.index');
        Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/books', [BookController::class, 'store'])->name('books.store');
        Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

        // Users
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/users/{user}/ban', [UserController::class, 'ban'])->name('users.ban');
        Route::post('/users/{user}/unban', [UserController::class, 'unban'])->name('users.unban');

        // Tags
        Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
        Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
        Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
        Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
        Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
        Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

        // Categories
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});


Route::middleware(['auth', 'ban'])->group(function () {

    Route::get('/library/create', [UserLibraryController::class, 'create'])->name('library.create');
    Route::post('/library', [UserLibraryController::class, 'store'])->name('library.store');
    Route::get('/library', [UserLibraryController::class, 'index'])->name('libraries.index');

    Route::get('/recommendations', [HomeController::class, 'recommendations'])->name('recommendations');
    Route::get('/nearby', [HomeController::class, 'nearby'])->name('nearby');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});



Route::middleware(['auth', 'role:library', 'ban'])->prefix('library')->name('library.')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/books/create', [LibraryBookController::class, 'create'])->name('books.create');
        Route::post('/books', [LibraryBookController::class, 'store'])->name('books.store');
        Route::get('/books/{book}/edit', [LibraryBookController::class, 'edit'])->name('books.edit');
        Route::put('/books/{book}', [LibraryBookController::class, 'update'])->name('books.update');
        Route::delete('/books/{book}', [LibraryBookController::class, 'destroy'])->name('books.destroy');

        Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
        Route::post('/stock', [StockController::class, 'store'])->name('stock.store');
        Route::put('/stock/{stock}', [StockController::class, 'update'])->name('stock.update');
        Route::delete('/stock/{stock}', [StockController::class, 'destroy'])->name('stock.destroy');

        Route::get('/withdraw', [WithdrawController::class, 'index'])->name('withdraw.index');
        Route::post('/withdraw/search', [WithdrawController::class, 'search'])->name('withdraw.search');
        Route::post('/withdraw/confirm', [WithdrawController::class, 'confirm'])->name('withdraw.confirm');

        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/library/transactions', [LibraryTransactionController::class, 'index'])->name('library.transactions');
        Route::get('/edit', [UserLibraryController::class, 'edit'])->name('edit');
        Route::put('/edit', [UserLibraryController::class, 'update'])->name('update');
});

Route::middleware(['auth', 'ban'])->group(function () {

    Route::get('/payment/checkout/{payment}', [PaymentController::class, 'checkout'])->name('payment.checkout');

    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

    Route::post('/books/{book}/summary', [TransactionController::class, 'summary'])->name('books.summary');
    Route::post('/checkout', [TransactionController::class, 'checkout'])->name('transactions.checkout');

    Route::get('/libraries/{library}', [LibraryShowController::class, 'show'])->name('library.show');

    Route::get('/books/category/{category}', [LibraryShowBooksController::class, 'byCategory'])->name('books.category');
    Route::get('/books/author/{author}', [LibraryShowBooksController::class, 'byAuthor'])->name('books.author');
    Route::get('/books/tag/{tag}', [LibraryShowBooksController::class, 'byTag'])->name('books.tag');
});


Route::middleware(['auth', 'ban','role:user'])->prefix('user')->name('user.')->group(function () {

        Route::get('/dashboard', [ProfileController::class, 'index'])->name('dashboard');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

        Route::get('/orders', [ProfileController::class, 'orders'])->name('orders');
        Route::get('/orders/{transaction}', [ProfileController::class, 'showOrder'])->name('orders.show');
});

Route::post('/stripe/webhook', [PaymentController::class, 'webhook']);

Route::get('/libraries', [HomeController::class, 'libraries'])->name('libraries');
