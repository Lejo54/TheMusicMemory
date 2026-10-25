<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthenticateMyUser;
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

Route::view('/', 'signin');
Route::view('/signin','signin')->name('view_signin');
Route::view('/signup', 'signup')->name('view_signup');
Route::post('/authenticate', [UserController::class, 'connect'])->name('user_authenticate');
Route::post('/adduser', [UserController::class, 'create'])->name('user_adduser');

Route::prefix('user')->middleware(AuthenticateMyUser::class)->group(function () {
	Route::view('/account', 'account')->name('view_account');
	Route::view('/settings','settings')->name('view_settings');
	Route::view('/songs','songs')->name('view_songs');
	Route::view('/wishlist','wishlist')->name('view_wishlist');
	Route::view('/friends','friends')->name('view_friends');

	Route::post('/changepassword', [UserController::class, 'updatePassword'])->name('user_changepassword');
	Route::delete('/deleteuser', [UserController::class, 'delete'])->name('user_deleteuser');
	Route::post('/signout', [UserController::class, 'disconnect'])->name('user_signout');
});
