<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BetterController;
use App\Http\Controllers\HorseController;

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

Route::get('/', function () {
    return view('home');
})->name('home');


Route::group(['prefix'=>'better'], function () {
    Route::middleware(['auth:sanctum', 'verified'])->
    get('/', [BetterController::class, 'index'])->name('better.index'); 
    
    Route::middleware(['auth:sanctum', 'verified'])->
    get('/sort', [BetterController::class, 'sort'])->name('better.sort'); 

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/winner', [BetterController::class, 'winner'])->name('better.winner'); 

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/create', [BetterController::class, 'create'])->name('better.create');  

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/store', [BetterController::class, 'store'])->name('better.store');  

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/edit/{better}', [BetterController::class, 'edit'])->name('better.edit');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/update/{better}', [BetterController::class, 'update'])->name('better.update');

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/destroy/{better}', [BetterController::class, 'destroy'])->name('better.destroy');
});


Route::group(['prefix'=>'horse'], function () {
    Route::middleware(['auth:sanctum', 'verified'])->
    get('/', [HorseController::class, 'index'])->name('horse.index');  

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/create', [HorseController::class, 'create'])->name('horse.create');  

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/store', [HorseController::class, 'store'])->name('horse.store');  

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/edit/{horse}', [HorseController::class, 'edit'])->name('horse.edit');

    Route::middleware(['auth:sanctum', 'verified'])->
    post('/update/{horse}', [HorseController::class, 'update'])->name('horse.update');

    Route::middleware(['auth:sanctum', 'verified'])->
    get('/destroy/{horse}', [HorseController::class, 'destroy'])->name('horse.destroy');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
