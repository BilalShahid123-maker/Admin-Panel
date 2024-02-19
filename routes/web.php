<?php

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

use App\Http\Controllers\BarberController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\HomeController; 



Route::get('/', function () {
    return view('login2');
});

//delete


Route::get('/login2', function () {
    return view('login2');
})->name('login2');

Route::post('/login2', [AuthController::class, 'login2'])->name('login2.submit');
// routes/web.php




Route::group(['middleware' => 'checkLogin'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::delete('/barber/{id}', [BarberController::class, 'delete'])->name('barber.delete');
Route::delete('/service/{id}', [ServiceController::class, 'delete'])->name('service.delete');
Route::delete('/client/{id}', [ClientController::class, 'delete'])->name('client.delete');
//edits
Route::post('/barber/approve/{userId}', [BarberController::class, 'approve'])->name('barber.approve');
Route::post('/barber/block/{userId}', [BarberController::class, 'block'])->name('barber.block');

Route::post('/logout2', 'AuthController@logout2')->name('logout2');

//add
Route::get('/admin/add', [ServiceController::class, 'showAddPage'])->name('admin.add');
Route::post('/admin/add', [ServiceController::class, 'create'])->name('service.create'); 

Route::get('/admin/edit', [AuthController::class, 'adminedit'])->name('admin.edit');
Route::post('/admin/edit', [AuthController::class, 'editUserProfile'])->name('edituserprofile.submit');


});


