<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Author\AuthorController;
use App\Http\Controllers\Admin\Book\BookController;
use App\Http\Controllers\Admin\ContactMessage\ContactMessageController;
use App\Http\Controllers\Admin\Content\ContentController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Translator\TranslatorController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Site (الواجهة العامة)
|--------------------------------------------------------------------------
*/
Route::get('/', [SiteController::class, 'home'])->name('site.home');
Route::get('/books', [SiteController::class, 'books'])->name('site.books');
Route::get('/books/{book}', [SiteController::class, 'show'])->name('site.books.show');

Route::get('/authors', [SiteController::class, 'authors'])->name('site.authors');
Route::get('/authors/{author}', [SiteController::class, 'authorShow'])->name('site.authors.show');

Route::get('/translators', [SiteController::class, 'translators'])->name('site.translators');
Route::get('/translators/{translator}', [SiteController::class, 'translatorShow'])->name('site.translators.show');

Route::get('/about', [SiteController::class, 'about'])->name('site.about');
Route::get('/contact', [SiteController::class, 'contact'])->name('site.contact');
Route::post('/contact', [SiteController::class, 'contactSubmit'])->name('site.contact.submit');

/*
|--------------------------------------------------------------------------
| Admin Auth (زوار غير مسجلين)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login.index');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

/*
|--------------------------------------------------------------------------
| Admin Dashboard (مسجلون فقط)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // ===== Routes للكتب =====
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::get('/books/filter', [BookController::class, 'filter'])->name('books.filter');
    Route::get('/books/stats', [BookController::class, 'stats'])->name('books.stats');

    // ===== Routes للمؤلفين =====
    Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::post('/authors', [AuthorController::class, 'store'])->name('authors.store');
    Route::put('/authors/{author}', [AuthorController::class, 'update'])->name('authors.update');
    Route::delete('/authors/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');
    Route::get('/authors/filter', [AuthorController::class, 'filter'])->name('authors.filter');
    Route::get('/authors/stats', [AuthorController::class, 'stats'])->name('authors.stats');

    // ===== Routes للمترجمين =====
    Route::get('/translators', [TranslatorController::class, 'index'])->name('translators.index');
    Route::post('/translators', [TranslatorController::class, 'store'])->name('translators.store');
    Route::put('/translators/{translator}', [TranslatorController::class, 'update'])->name('translators.update');
    Route::delete('/translators/{translator}', [TranslatorController::class, 'destroy'])->name('translators.destroy');
    Route::get('/translators/filter', [TranslatorController::class, 'filter'])->name('translators.filter');
    Route::get('/translators/stats', [TranslatorController::class, 'stats'])->name('translators.stats');

    // ===== Routes للمستخدمين =====
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/filter', [UserController::class, 'filter'])->name('users.filter');
    Route::get('/users/stats', [UserController::class, 'stats'])->name('users.stats');

    // ===== إدارة المحتوى (من نحن / تواصل معنا) =====
    Route::get('/content', [ContentController::class, 'index'])->name('content.index');
    Route::put('/content/{page}', [ContentController::class, 'update'])->name('content.update');

    // ===== رسائل التواصل الواردة من الموقع =====
    Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
    Route::get('/contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])->name('contact-messages.show');
    Route::delete('/contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');
    Route::post('/contact-messages/{contactMessage}/read', [ContactMessageController::class, 'markRead'])->name('contact-messages.read');
});
