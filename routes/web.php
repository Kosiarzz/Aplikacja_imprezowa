<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReservationController; 
use App\Http\Controllers\EventController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\PdfController;

use Illuminate\Support\Facades\Auth;
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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Frontend
Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('frontend.index');


Route::get('/rejestracja/użytkownik', function () {  return view('auth.registerUser');  })->name('role.user');
Route::get('/rejestracja/firma', function () {  return view('auth.registerBusiness');  })->name('role.bussines');

// id w pasku, zabezpieczenia, komentarze i ocena usera

Route::get('/searchCities', [App\Http\Controllers\FrontendController::class, 'searchCities']);
Route::post('/businessSearch', [App\Http\Controllers\FrontendController::class, 'businessSearch'])->name('businessSearch');
Route::get('/wyszukaj', [App\Http\Controllers\FrontendController::class, 'businessIndex'])->name('frontend.search');
Route::get('/wfirma/{id}', [App\Http\Controllers\FrontendController::class, 'businessDetails'])->name('businessDetails');
Route::get('/firmaa/sala/{id}', [App\Http\Controllers\FrontendController::class, 'serviceDetails'])->name('serviceDetails');

//
Route::get('/like/{likeable_id}/{type}', [App\Http\Controllers\LikeController::class, 'like'])->name('like');
Route::get('/unlike/{likeable_id}/{type}', [App\Http\Controllers\LikeController::class, 'unlike'])->name('unlike');

//
Route::post('/addComment/{commentable_id}/{type}', [App\Http\Controllers\CommentController::class, 'addComment'])->name('addComment');

//
Route::get('/ajaxGetServiceReservations/{id}', [App\Http\Controllers\ReservationController::class, 'ajaxGetServiceReservations']);
Route::post('/addReservation/{service_id}/{city_id}/{service_name}', [App\Http\Controllers\ReservationController::class, 'addReservation'])->name('reservation.addReservation');
Route::get('/confirmReservation/{id}', [App\Http\Controllers\ReservationController::class, 'confirmReservation'])->name('reservation.confirmReservation');
Route::get('/deleteReservation/{id}', [App\Http\Controllers\ReservationController::class, 'deleteReservation'])->name('reservation.deleteReservation');
Route::get('/cancelReservation/{id}', [App\Http\Controllers\ReservationController::class, 'cancelReservation'])->name('reservation.cancelReservation');

Route::get('/wyszukiwanie/uzytkownik/profil/{id}', [App\Http\Controllers\UserController::class, 'findUserProfile'])->name('findUserProfile');

Route::get('/full-calender', [FullCalenderController::class, 'index']);

Route::post('/full-calender/action', [FullCalenderController::class, 'action']);


//Strony wymagające zalogowania
Route::middleware(['auth','verified'])->group(function()
{
    Route::post('/uzytkownik/profil/update', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('user.updateProfile');

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
        Route::get('/firma/xx/{id}', [App\Http\Controllers\BusinessController::class, 'businessDetails'])->name('business.id');
        Route::get('/firma/profil', [App\Http\Controllers\BusinessController::class, 'profile'])->name('business.profile');
        Route::get('/firma/rejestracja/{category}', [App\Http\Controllers\BusinessController::class, 'register'])->name('business.register');
        Route::get('/firma/panel/kategorie', function () {  return view('business.categoryBusiness');  })->name('business.category');

        Route::post('/firma/dodawanie', [App\Http\Controllers\BusinessController::class, 'addBusiness'])->name('addBusiness');
        Route::get('/firma/panel/powiadomienia', [App\Http\Controllers\BusinessController::class, 'notifications'])->name('business.notifications');

        //Usługi
        Route::get('/firma/usługa/panel/{id}', [App\Http\Controllers\ServiceController::class, 'index'])->name('service.index');
        Route::get('/firma/usługa/panel', [App\Http\Controllers\ServiceController::class, 'dashboard'])->name('service.dashboard');
        Route::get('/firma/usługa/kalendarz', [App\Http\Controllers\ServiceController::class, 'calendar'])->name('service.calendar');
        Route::get('/firma/usługa/daty/kalendarz', [App\Http\Controllers\FullCalenderController::class, 'dateService']);
        Route::post('/firma/usługa/daty/kalendarz/akcja', [App\Http\Controllers\FullCalenderController::class, 'actionService']);
        Route::get('/firma/usługa/rezerwacje', [App\Http\Controllers\ServiceController::class, 'reservations'])->name('service.reservations');
        Route::get('/firma/usługa/rezerwacje/{id}/{title}', [App\Http\Controllers\ServiceController::class, 'reservationsDetails'])->name('service.reservationsDetails');
        Route::get('/firma/usługa/rezerwacje/filtry', [App\Http\Controllers\ServiceController::class, 'reservationDetailsFilters'])->name('service.reservationDetailsFilters');
        Route::get('/firma/usługa/powiadomienia', [App\Http\Controllers\ServiceController::class, 'notifications'])->name('service.notifications');
        Route::get('/firma/usługa/statystyki', [App\Http\Controllers\ServiceController::class, 'stats'])->name('service.stats');
        Route::get('/firma/usługa/podgląd', [App\Http\Controllers\ServiceController::class, 'preview'])->name('service.preview');
        Route::get('/firma/usługa/podgląd-usługi', [App\Http\Controllers\ServiceController::class, 'previewService'])->name('service.previewService');

        Route::get('/firma/usługa/usuwanie/{id}', [App\Http\Controllers\ServiceController::class, 'businessDelete'])->name('service.businessDelete');
        Route::get('/firma/usługa/edycja/{id}', [App\Http\Controllers\ServiceController::class, 'businessEdit'])->name('service.businessEdit');
        Route::post('/firma/usługa/edycja/zapisz', [App\Http\Controllers\ServiceController::class, 'businessEditSave'])->name('service.businessEditSave');

        Route::get('/firma/usługa/oferta/edycja/{id}', [App\Http\Controllers\ServiceController::class, 'serviceEdit'])->name('service.serviceEdit');
        Route::get('/firma/usługa/usuń/{id}', [App\Http\Controllers\ServiceController::class, 'serviceDelete'])->name('service.serviceDelete');
        Route::get('/firma/usługa/nowa', [App\Http\Controllers\ServiceController::class, 'serviceAdd'])->name('service.serviceAdd');
        Route::get('/firma/usługa/podgląd-usługi/{id}', [App\Http\Controllers\ServiceController::class, 'serviceDetails'])->name('service.serviceDetails');

        Route::post('/firma/usługa/nowa/dodawanie', [App\Http\Controllers\ServiceController::class, 'addService'])->name('addService');
        Route::post('/firma/usługa/nowa/edycja', [App\Http\Controllers\ServiceController::class, 'editService'])->name('editService');
    });

    Route::middleware(['can:isUser'])->group(function()
    {
        Route::get('/uzytkownik', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
        Route::get('/uzytkownik/profil', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
        Route::get('/uzytkownik/polubione', [App\Http\Controllers\UserController::class, 'like'])->name('user.like');
        Route::get('/uzytkownik/wydarzenia', [App\Http\Controllers\UserController::class, 'events'])->name('user.events');
        Route::get('/uzytkownik/rezerwacje', [App\Http\Controllers\UserController::class, 'reservation'])->name('user.reservation');
        Route::get('/uzytkownik/powiadomienia', [App\Http\Controllers\UserController::class, 'notifications'])->name('user.notification');

        Route::get('/uzytkownik/wydarzenie/główna/{id}', [App\Http\Controllers\EventController::class, 'index'])->name('event.index');
        Route::get('/uzytkownik/nowe/wydarzenie', [App\Http\Controllers\EventController::class, 'createEventView'])->name('event.createEvent');
        

        Route::get('/uzytkownik/wydarzenie/główna', [App\Http\Controllers\EventController::class, 'dashboardView'])->name('event.dashboardView');
        Route::get('/uzytkownik/wydarzenie/daty', [App\Http\Controllers\EventController::class, 'dateView'])->name('event.date');
        Route::get('/uzytkownik/wydarzenie/daty/kalendarz', [App\Http\Controllers\FullCalenderController::class, 'dateEvent']);
        Route::get('/uzytkownik/wydarzenie/finanse', [App\Http\Controllers\EventController::class, 'financesView'])->name('event.finances');
        Route::get('/uzytkownik/wydarzenie/goście', [App\Http\Controllers\EventController::class, 'guestView'])->name('event.guest');
        Route::get('/uzytkownik/wydarzenie/usługi', [App\Http\Controllers\EventController::class, 'serviceView'])->name('event.services');
        Route::get('/uzytkownik/wydarzenie/usługi/{idCategory}', [App\Http\Controllers\EventController::class, 'serviceDetails'])->name('event.servicesDetails');
        Route::get('/uzytkownik/wydarzenie/powiadomienia', [App\Http\Controllers\EventController::class, 'notificationsView'])->name('event.notifications');
        Route::get('/uzytkownik/wydarzenie/zadania', [App\Http\Controllers\EventController::class, 'tasksView'])->name('event.tasks');
        Route::get('/uzytkownik/wydarzenie/rezerwacje', [App\Http\Controllers\EventController::class, 'reservationsView'])->name('event.reservations');

        Route::post('/uzytkownik/wydarzenie/edycja', [App\Http\Controllers\EventController::class, 'editEventName'])->name('editEventName');

        Route::get('/uzytkownik/wydarzenie/usunięcie', [App\Http\Controllers\EventController::class, 'deleteEvent'])->name('event.delete');

        Route::post('/uzytkownik/wydarzenie/zadania/pdf', [App\Http\Controllers\PdfController::class, 'createTaskPDF'])->name('event.pdfTasks');
        Route::post('/uzytkownik/wydarzenie/goście/pdf', [App\Http\Controllers\PdfController::class, 'createGuestPDF'])->name('event.pdfGuests');
        Route::post('/uzytkownik/wydarzenie/finanse/pdf', [App\Http\Controllers\PdfController::class, 'createFinancePDF'])->name('event.pdfFinances');

        Route::post('/uzytkownik/nowe/wydarzenie/dodawanie', [App\Http\Controllers\EventController::class, 'addEvent'])->name('addEvent');

        Route::post('/uzytkownik/nowe/wydarzenie/grupa', [App\Http\Controllers\EventController::class, 'addGroup'])->name('addGroup');
        Route::post('/uzytkownik/edycja/wydarzenie/grupa', [App\Http\Controllers\EventController::class, 'editGroup'])->name('editGroup');
        Route::post('/uzytkownik/usuwanie/wydarzenie/grupa', [App\Http\Controllers\EventController::class, 'deleteGroup'])->name('deleteGroup');

        Route::get('/uzytkownik/wydarzenie/rezerwacje/filtry', [App\Http\Controllers\EventController::class, 'reservationFilter'])->name('event.reservation.filter');

        Route::post('/uzytkownik/nowe/wydarzenie/finanse', [App\Http\Controllers\EventController::class, 'addFinance'])->name('addFinance');

        Route::post('/uzytkownik/nowe/wydarzenie/zadanie', [App\Http\Controllers\EventController::class, 'addTask'])->name('addTask');
        Route::post('/uzytkownik/edycja/wydarzenie/zadanie', [App\Http\Controllers\EventController::class, 'editTask'])->name('editTask');
        Route::post('/uzytkownik/usuwanie/wydarzenie/zadanie', [App\Http\Controllers\EventController::class, 'deleteTask'])->name('deleteTask');
        Route::post('/uzytkownik/status/wydarzenie/zadanie', [App\Http\Controllers\EventController::class, 'statusTask'])->name('statusTask');

        Route::post('/uzytkownik/status/wydarzenie/finanse', [App\Http\Controllers\EventController::class, 'statusFinance'])->name('statusFinance');
        Route::post('/uzytkownik/edycja/wydarzenie/finanse', [App\Http\Controllers\EventController::class, 'editFinance'])->name('editFinance');
        Route::post('/uzytkownik/usuwanie/wydarzenie/finanse', [App\Http\Controllers\EventController::class, 'deleteFinance'])->name('deleteFinance');
        Route::post('/uzytkownik/edycja/wydarzenie/budżet', [App\Http\Controllers\EventController::class, 'editBudgetFinances'])->name('editBudgetFinances');

        Route::post('/uzytkownik/status/wydarzenie/gość', [App\Http\Controllers\EventController::class, 'statusGuest'])->name('statusGuest');
        Route::post('/uzytkownik/nowe/wydarzenie/gość', [App\Http\Controllers\EventController::class, 'addGuest'])->name('addGuest');
        Route::post('/uzytkownik/edycja/wydarzenie/goście', [App\Http\Controllers\EventController::class, 'editGuest'])->name('editGuest');
        Route::post('/uzytkownik/usuwanie/wydarzenie/goście', [App\Http\Controllers\EventController::class, 'deleteGuest'])->name('deleteGuest');

        Route::post('/uzytkownik/nowe/usługa/grupa', [App\Http\Controllers\EventController::class, 'addMainCategoryGroup'])->name('addMainCategoryGroup');

        Route::get('/setReadNotification', [App\Http\Controllers\UserController::class, 'setReadNotification']);
        Route::get('/getNotShownNotify', [App\Http\Controllers\UserController::class, 'getNotShownNotify']);
    });
    
});

Auth::routes(['verify' => true]);

//middleware(['auth','verified'])