<?php

use App\Http\Controllers\BitcoinPagesController;
use App\Http\Controllers\EthereumPagesController;
use App\Http\Controllers\StatisticsPageController;

Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/donate', 'donate')->name('donate');

Route::get('/statistics', StatisticsPageController::class)->name('stats');

Route::get('/bitcoin', [BitcoinPagesController::class, 'index'])->name('btcPages.index');
Route::get('/bitcoin/search', [BitcoinPagesController::class, 'showSearch'])->name('btcPages.search');
Route::post('/bitcoin/search', [BitcoinPagesController::class, 'search'])->name('btcPages.search');
Route::get('/bitcoin/random', [BitcoinPagesController::class, 'randomPage'])->name('btcPages.random');
Route::get('/bitcoin/statistics', [BitcoinPagesController::class, 'stats'])->name('btcPages.stats');
Route::get('/bitcoin/you-have-gone-too-far', [BitcoinPagesController::class, 'pageTooBig'])->name('btcPages.pageTooBig');
Route::get('/bitcoin/{pageNumber?}', [BitcoinPagesController::class, 'keysPage'])->name('btcPages');
Route::redirect('/btc', '/bitcoin');

Route::get('/ethereum', [EthereumPagesController::class, 'index'])->name('ethPages.index');
Route::get('/ethereum/search', [EthereumPagesController::class, 'showSearch'])->name('ethPages.search');
Route::post('/ethereum/search', [EthereumPagesController::class, 'search'])->name('ethPages.search');
Route::get('/ethereum/random', [EthereumPagesController::class, 'randomPage'])->name('ethPages.random');
Route::get('/ethereum/statistics', [EthereumPagesController::class, 'stats'])->name('ethPages.stats');
Route::get('/ethereum/you-have-gone-too-far', [EthereumPagesController::class, 'pageTooBig'])->name('ethPages.pageTooBig');
Route::get('/ethereum/{pageNumber?}', [EthereumPagesController::class, 'keysPage'])->name('ethPages');
Route::redirect('/eth', '/ethereum');
