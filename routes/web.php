<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

// Route::get('/', function () {
//     return view('/index');
// });

// Route::get('/', [DataController::class, 'getData'])->name('getData');

// Route::resource('/data',DataController::class);
// Route::delete('/data/{id}', [DataController::class, 'destroy'])->name('data.destroy');


///////////////////////////////////////////////////////



Route::get('/index', function () {
    return view('/index');
});

// Route untuk halaman login (GET)
Route::get('/', [AuthController::class, 'index'])->name('login');
// Route untuk proses login (POST)
Route::post('/', [AuthController::class, 'login']);

// Route untuk halaman register
Route::get('/register', [AuthController::class, 'create'])->name('register');
Route::post('/register', [AuthController::class, 'store']);

Route::get('/index', [DataController::class, 'getData'])->name('getData');
Route::post('/store-data', [DataController::class, 'storeData'])->name('storeData');
Route::get('/get-marker', [DataController::class, 'getMarker'])->name('getMarker');

Route::delete('/delete-data/{id_rs}', [DataController::class, 'destroy'])->name('data.destroy');

Route::get('/data/{id_rs}/edit', [DataController::class, 'edit'])->name('data.edit');
Route::put('/data/{id_rs}', [DataController::class, 'update'])->name('data.update');




/////////////////////////////////////////////////////////////////////////////

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/', [DataController::class, 'getData'])->name('getData');
// Route::post('/store-data', [DataController::class, 'storeData'])->name('storeData');


// Route::get('/getMarker', [DataController::class, 'getMarker'])->name('getMarker');

// Route::get('/', [AuthController::class, 'index'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);

// Route::get('/register', [AuthController::class, 'create'])->name('register');
// Route::post('/register', [AuthController::class, 'store']);


// Route::get('/getData', [DataController::class, 'getData']);
// Route::post('/storeData', [DataController::class, 'storeData']);