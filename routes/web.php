<?php

use App\Http\Controllers\admin;
use App\Http\Controllers\VenueInfoController;
use App\Http\Controllers\AppleAuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\DishesController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LabourController;
use App\Http\Controllers\menu;
use App\Http\Controllers\OccasionController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VanueCustomerController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Two\GoogleProvider;


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
    // return view('auth.login');
    return Redirect::route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('index');
});

Route::get('/guest-home', [GuestController::class, 'index'])->name('guest-home');


Route::get('/GuestLogout', [GuestController::class, 'GuestLogout'])->name('GuestLogout');
Route::post('/Convert2User', [GuestController::class, 'Convert2User'])->name('Convert2User');

Route::middleware(['auth', 'admin.auth'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('adminHome');
});
Route::middleware(['auth', 'kitchen.auth'])->group(function () {
    Route::get('/kitchen/home', [HomeController::class, 'kitchenHome'])->name('kitchenHome');
});
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');


Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);


Route::get('/auth/apple', [AppleAuthController::class, 'redirectToApple']);


Route::middleware('auth')->group(function () {

    Route::post('/continueJourney', [EventController::class, 'continueJourney'])->name('continueJourney');

    Route::get('/Contract/index', [HomeController::class, 'ContractIndex'])->name('ContractIndex');
    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/notification/read', [ProfileController::class, 'markNotificationAsRead'])->name('user.mark.notification.read');
    Route::get('/notification/list', [ProfileController::class, 'notificationlist'])->name('user.notification.list');


    //menu
    Route::get('/menu/items/{eventId?}', [menu::class, 'items'])->name('custom.menu');
    Route::post('/menu/submit', [menu::class, 'submit'])->name('menu.submit');
    Route::get('/getNewDishes', [menu::class, 'getNewDishes'])->name('menu.getNewDishes');
    Route::post('/getDishes', [menu::class, 'getDishes'])->name('menu.getDishes');
    Route::get('/menu/edit/request/{eventId?}', [menu::class, 'menu_edit_request'])->name('events.menu.edit.request');
    Route::get('/menu/edit/{eventId?}', [menu::class, 'menu_edit'])->name('events.menu.edit');
    Route::post('/menu/query', [menu::class, 'menu_query'])->name('submit.menu.query');
    Route::post('/menu/acceptDishChange', [menu::class, 'acceptDishChange'])->name('menu.acceptDishChange');



    Route::get('/menu/addon/{eventId?}', [menu::class, 'addon'])->name('menu.addon');
    Route::get('/menu/detail/{id}/{eventId?}', [menu::class, 'detail'])->name('menu.detail');

    Route::get('/equipment/{eventId?}', [menu::class, 'equipment'])->name('equipment.index');
    Route::get('/menu/{id?}', [menu::class, 'index'])->name('menu.index');


    //Events
    Route::get('/calender/{type?}', [EventController::class, 'calender'])->name('calender.index');

    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events-create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/invoice/show/{id}', [EventController::class, 'invoice'])->name('events.invoice.show');
    Route::get('/events/invoice/print/{id}', [EventController::class, 'print_invoice'])->name('event.print.invoice');

    Route::get('/service/styling/{eventId?}', [ServiceController::class, 'create'])->name('service.styling');
    Route::get('/edit/service/{serviceid}', [ServiceController::class, 'edit'])->name('service.styling.edit');
    Route::post('/service/styling', [ServiceController::class, 'store'])->name('service.store');
    Route::post('/update/service', [ServiceController::class, 'update'])->name('service.update');

    Route::get('/events/show/{id}', [EventController::class, 'show'])->name('events.show');

    Route::get('/events/edit/{id}', [EventController::class, 'edit'])->name('events.edit');

    Route::put('/events', [EventController::class, 'update'])->name('events.update');

    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');



    //password
    Route::get('/change-password', [PasswordChangeController::class, 'showChangePasswordForm'])->name('passwordChange');
    Route::post('/changePassword', [PasswordChangeController::class, 'changePassword'])->name('password.change');
});

Route::get('auth/twitter', [TwitterController::class, 'loginwithTwitter']);
Route::get('auth/callback/twitter', [TwitterController::class, 'cbTwitter']);


Route::middleware(['auth', 'admin.auth'])->group(function () {
    Route::get('/occasions', [OccasionController::class, 'index'])->name('occasions.index');
    Route::get('/occasions/create', [OccasionController::class, 'create'])->name('occasions.create');
    Route::post('/occasions', [OccasionController::class, 'store'])->name('occasions.store');
    Route::get('/occasions/{id}/edit', [OccasionController::class, 'edit'])->name('occasions.edit');
    Route::put('/occasions/{id}', [OccasionController::class, 'update'])->name('occasions.update');
    Route::delete('/occasions/{id}', [OccasionController::class, 'destroy'])->name('occasions.destroy');
    //types
    Route::get('/types', [TypeController::class, 'index'])->name('types.index');
    Route::get('/types/create', [TypeController::class, 'create'])->name('types.create');
    Route::post('/types', [TypeController::class, 'store'])->name('types.store');
    Route::get('/types/{id}/edit', [TypeController::class, 'edit'])->name('types.edit');
    Route::put('/types/{id}', [TypeController::class, 'update'])->name('types.update');
    Route::delete('/types/{id}', [TypeController::class, 'destroy'])->name('types.destroy');

    //admin vanue
    Route::get('/menus', [PackagesController::class, 'menuLinks'])->name('menu.link.index');


    
    Route::resource('contact', UserController::class)->names('contact');

    Route::resource('packages', PackagesController::class);
    Route::resource('items', DishesController::class)->names('dishes');
    Route::resource('categories', CategoriesController::class);
    Route::resource('subcategories', SubCategoriesController::class);
    Route::resource('equipments', EquipmentController::class);
    Route::resource('labours', LabourController::class);
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [admin::class, 'index'])->name('admin.login');
});

require __DIR__ . '/auth.php';




///////////////////////////////////////////// clean code /////////////////////////////////////////////


Route::middleware('auth')->group(function () {

    //customer venue

    Route::get('/venue-info', [VenueInfoController::class, 'index'])->name('venue-info.index');
    Route::get('/venue-info/create', [VenueInfoController::class, 'create'])->name('venue-info.create');
    Route::post('/venue-info', [VenueInfoController::class, 'store'])->name('venue-info.store');
    Route::get('/venue-info/{venueInfo}', [VenueInfoController::class, 'show'])->name('venue-info.show');
    Route::get('/venue-info/{venueInfo}/edit', [VenueInfoController::class, 'edit'])->name('venue-info.edit');
    Route::put('/venue-info/{venueInfo}', [VenueInfoController::class, 'update'])->name('venue-info.update');
    Route::delete('/venue-info/{venueInfo}', [VenueInfoController::class, 'destroy'])->name('venue-info.destroy');

    Route::get('/venues', [VenueController::class, 'index'])->name('Venues.index');
    Route::get('/venues-create', [VenueController::class, 'create'])->name('Venues.create');
    Route::get('/venues-create/{id?}', [VenueController::class, 'create'])->name('Venues.createWithId');
    Route::post('/venues', [VenueController::class, 'store'])->name('Venues.store');
    Route::get('/event/venues/edit/{id}', [VenueController::class, 'edit'])->name('Venues.edit');
    Route::put('/venues', [VenueController::class, 'update'])->name('Venues.update');
    Route::delete('/venues/{Venue}', [VenueController::class, 'destroy'])->name('Venues.destroy');
    Route::post('/venues/contact-details', [VenueController::class, 'getContactDetails'])->name('get.contact.details');
});
