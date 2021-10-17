<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontednController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\UserController;

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

//Strony bez logowania
Route::get('/dsad', function () {
    return view('businessProfile.industry');
});

Route::get('/registerUser', function () {  return view('auth.registerUser');  })->name('role.user');
Route::get('/registerBussiness', function () {  return view('auth.registerBusiness');  })->name('role.bussines');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\FrontendController::class, 'businessIndex']);
Route::get('/firma/sala/{id}', [App\Http\Controllers\FrontendController::class, 'roomDetails'])->name('roomDetails');
Route::get('/searchCities', [App\Http\Controllers\FrontendController::class, 'searchCities']);
Route::get('/ajaxGetRoomReservations/{id}', [App\Http\Controllers\FrontendController::class, 'ajaxGetRoomReservations']);
Route::post('/businessSearch', [App\Http\Controllers\FrontendController::class, 'businessSearch'])->name('businessSearch');
Route::get('/uzytkownikss/{id}', [App\Http\Controllers\FrontendController::class, 'user'])->name('user');

Route::get('/like/{likeable_id}/{type}', [App\Http\Controllers\FrontendController::class, 'like'])->name('like');
Route::get('/unlike/{likeable_id}/{type}', [App\Http\Controllers\FrontendController::class, 'unlike'])->name('unlike');

Route::post('/addComment/{commentable_id}/{type}', [App\Http\Controllers\FrontendController::class, 'addComment'])->name('addComment');

Route::post('/addReservation/{room_id}/{city_id}', [App\Http\Controllers\FrontendController::class, 'addReservation'])->name('addReservation');
Route::get('/firmaaa/{id}', [App\Http\Controllers\FrontendController::class, 'businessDetails'])->name('businessDetails');

//Strony wymagające zalogowania
Route::middleware(['auth','verified'])->group(function()
{
    Route::middleware(['can:isAdmin'])->group(function()
    {
        Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);
    });

    Route::middleware(['can:isModerator'])->group(function()
    {
        Route::get('/moderator', [App\Http\Controllers\ModeratorController::class, 'index']);
    });

    Route::middleware(['can:isBusiness'])->group(function()
    {
        Route::get('/firma', [App\Http\Controllers\BusinessController::class, 'index'])->name('business.index');
        Route::get('/firmaa/{id}', [App\Http\Controllers\BusinessController::class, 'businessDetails'])->name('business.id');
        Route::get('/firma/rezerwacje', [App\Http\Controllers\BusinessController::class, 'reservations'])->name('business.reservations');
        Route::get('/firma/profil', [App\Http\Controllers\BusinessController::class, 'category'])->name('businessProfile.profile');
        Route::get('/firma/kategorie', function () {  return view('business.categoryBusiness');  })->name('business.category');

        Route::post('/firma/dodawanie', [App\Http\Controllers\BusinessController::class, 'addBusiness'])->name('addBusiness');
        Route::get('/firma/powiadomienia', [App\Http\Controllers\BusinessController::class, 'notifications'])->name('business.notifications');

        Route::get('/confirmReservation/{id}', [App\Http\Controllers\BusinessController::class, 'confirmReservation'])->name('business.confirmReservation');
        Route::get('/deleteReservation/{id}', [App\Http\Controllers\BusinessController::class, 'deleteReservation'])->name('business.deleteReservation');
    });

    Route::middleware(['can:isUser'])->group(function()
    {
        Route::get('/uzytkownik', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
        Route::get('/uzytkownik/profil', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
        Route::get('/uzytkownik/polubione', [App\Http\Controllers\UserController::class, 'like'])->name('user.like');
        Route::get('/uzytkownik/wydarzenia', [App\Http\Controllers\UserController::class, 'events'])->name('user.events');
        Route::get('/uzytkownik/rezerwacje', [App\Http\Controllers\UserController::class, 'reservation'])->name('user.reservation');
        Route::get('/uzytkownik/powiadomienia', [App\Http\Controllers\UserController::class, 'notifications'])->name('user.notification');

        Route::get('/deleteeReservation/{id}', [App\Http\Controllers\UserController::class, 'deleteReservation'])->name('user.deleteReservation');
        Route::get('/setReadNotification', [App\Http\Controllers\UserController::class, 'setReadNotification']);
        Route::get('/getNotShownNotify', [App\Http\Controllers\UserController::class, 'getNotShownNotify']);
    });
    
});

Auth::routes();
