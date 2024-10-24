<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Message;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/contact', 'App\Http\Controllers\Contactcontroller@submit');
Route::post('/reservation', 'App\Http\Controllers\Contactcontroller@reserver');
Route::post('/delete_my_account', 'App\Http\Controllers\Contactcontroller@delete_account');
Route::post('/update_profile/password', 'App\Http\Controllers\Contactcontroller@updateprofile_password');
Route::post('/update_profile/username', 'App\Http\Controllers\Contactcontroller@updateprofile_username');
Route::post('/admin/addrespo', 'App\Http\Controllers\Contactcontroller@addrespo');
Route::post('/admin/delete_user', 'App\Http\Controllers\Contactcontroller@delete_account');
Route::post('/admin/update_user', 'App\Http\Controllers\Contactcontroller@update_user');
Route::post('/admin/delete_message', 'App\Http\Controllers\Contactcontroller@delete_message');
Route::post('/admin/delete_allmessages', 'App\Http\Controllers\Contactcontroller@delete_allmessages');
Route::post('/forgotPassword', 'App\Http\Controllers\Contactcontroller@Reset_Password');
Route::get('/reservation-facteur/{id_reservation}', 'App\Http\Controllers\Contactcontroller@generateFacteur');
