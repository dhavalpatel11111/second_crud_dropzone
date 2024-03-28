<?php

use App\Http\Controllers\CrudDropzoneController;
use App\Http\Controllers\ImgtableController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/addimg', [CrudDropzoneController::class, 'addimg'])->name('addimg');
Route::post('/add', [CrudDropzoneController::class, 'add']);
Route::post('/del', [CrudDropzoneController::class, 'del']);
Route::post('/imgdel', [CrudDropzoneController::class, 'imgdel']);
Route::post('/edit', [CrudDropzoneController::class, 'edit']);
Route::get('/list', [CrudDropzoneController::class, 'list']);
