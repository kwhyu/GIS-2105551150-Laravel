<?php

use App\Http\Controllers\DataController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|z
*/


Route::get('/', function () {
    return view('index');
});

Route::get('/', [DataController::class, 'getData'])->name('getData');
Route::post('/store-data', [DataController::class, 'storeData'])->name('storeData');
Route::get('/getMarker', [DataController::class, 'getMarker'])->name('getMarker');

// Route::get('/getData', [DataController::class, 'getData']);
// Route::post('/storeData', [DataController::class, 'storeData']);
