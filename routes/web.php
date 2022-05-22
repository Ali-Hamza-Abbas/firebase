<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\firebase\ContactController;

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

// Contact routes Start
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::get('/add-contacts', [ContactController::class, 'create'])->name('contact-create');
Route::post('/add-contacts', [ContactController::class, 'store'])->name('contact-store');
Route::get('/edit-contact/{id}', [ContactController::class, 'edit'])->name('contact-edit');
Route::put('/update-contacts/{id}', [ContactController::class, 'update'])->name('contact-update');
Route::get('/delete-contact/{id}', [ContactController::class, 'destroy'])->name('contact-delete');
// Contact routes End

Route::get('/', function () {
    return view('index');
});
