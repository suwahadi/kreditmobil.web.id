<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\LeadController;
use App\Livewire\News\NewsArchive;
use App\Livewire\News\NewsShow;
use App\Livewire\Promo\PromoArchive;
use App\Livewire\Promo\PromoShow;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Car
Route::get('/mobil/{slug}', [CarController::class, 'detail'])->name('car.detail');

// Leads
Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');
Route::post('/test-drive', [LeadController::class, 'testDrive'])->name('test-drive.store');

// News
Route::get('/news', NewsArchive::class)->name('news.index');
Route::get('/news/{slug}', NewsShow::class)->name('news.show');

// Promo
Route::get('/promo', PromoArchive::class)->name('promo.index');
Route::get('/promo/{slug}', PromoShow::class)->name('promo.show');

// Legacy route for compatibility
Route::get('/welcome', function () {
    return redirect()->route('home');
});

// Thank you page
Route::get('/thank-you', function () {
    return view('thank-you');
})->name('thank-you');
