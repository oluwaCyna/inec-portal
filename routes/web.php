<?php

use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [VoteController::class, 'unitResult'])->name('unit');

Route::get('/total-result', [VoteController::class, 'totalResult'])->name('total');

Route::get('/add-result', [VoteController::class, 'addResult'])->name('add');

Route::post('/store', [VoteController::class, 'storeVote'])->name('vote.store');

Route::post('/request/lga', [VoteController::class, 'lgaRequest'])->name('lga-request');
Route::post('/request/ward', [VoteController::class, 'wardRequest'])->name('ward-request');
Route::post('/request/pu', [VoteController::class, 'pollingUnitRequest'])->name('pu-request');
Route::post('/request/result', [VoteController::class, 'resultRequest'])->name('result-request');
Route::post('/request/total', [VoteController::class, 'totalRequest'])->name('total-result-request');

