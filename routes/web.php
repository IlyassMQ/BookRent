<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\LibraryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Library\DashboardController;
use App\Http\Controllers\Library\StockController;
use App\Http\Controllers\User\UserLibraryController;
use App\Http\Controllers\Library\LibraryBookController;

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware('auth');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    //Library 
    Route::get('/libraries', [LibraryController::class, 'index'])->name('libraries.index');
    Route::get('/libraries/create', [LibraryController::class, 'create'])->name('libraries.create');
    Route::post('/libraries', [LibraryController::class, 'store'])->name('libraries.store');
    Route::post('/libraries/{library}/approve', [LibraryController::class, 'approve'])->name('libraries.approve');
    Route::post('/libraries/{library}/block', [LibraryController::class, 'block'])->name('libraries.block');
    Route::delete('/libraries/{library}', [LibraryController::class, 'destroy'])->name('libraries.destroy');
    //BOOOKS
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    //User
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/ban', [UserController::class, 'ban'])->name('users.ban');
    Route::post('/users/{user}/unban', [UserController::class, 'unban'])->name('users.unban');

    //Tags
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');

    Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');

    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/library/create', [UserLibraryController::class, 'create'])->name('library.create');
    Route::post('/library', [UserLibraryController::class, 'store'])->name('library.store');
    Route::get('/library', [UserLibraryController::class, 'index'])->name('libraries.index');
});

Route::middleware(['auth','role:library'])->prefix('library')->name('library.')->group(function () {

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
        

});

