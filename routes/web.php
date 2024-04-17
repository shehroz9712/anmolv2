<?php

use App\Http\Controllers\admin;
use App\Http\Controllers\AdminVenueController;
use App\Http\Controllers\AppleAuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomerVenueController;
use App\Http\Controllers\DishesController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\menu;
use App\Http\Controllers\OccasionController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\TwitterController;
use App\Http\Controllers\TypeController;
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


    //menu
    Route::get('/menu/items/{eventId?}', [menu::class, 'items'])->name('custom.menu');
    Route::post('/menu/submit', [menu::class, 'submit'])->name('menu.submit');
    Route::post('/getDishes', [menu::class, 'getDishes'])->name('menu.getDishes');

    Route::get('/menu/addon/{eventId?}', [menu::class, 'addon'])->name('menu.addon');
    Route::get('/menu/detail/{id}/{eventId?}', [menu::class, 'detail'])->name('menu.detail');

    Route::get('/equipment', [menu::class, 'equipment'])->name('equipment.index');
    Route::get('/menu/{id?}', [menu::class, 'index'])->name('menu.index');


    //Events
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events-create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');

    Route::get('/service/styling/{eventId?}', [ServiceController::class, 'create'])->name('service.styling');
    Route::post('/service/styling', [ServiceController::class, 'store'])->name('service.store');

    Route::get('/events/show/{id}', [EventController::class, 'show'])->name('events.show');

    Route::post('/events/edit', [EventController::class, 'edit'])->name('events.edit');

    Route::put('/events', [EventController::class, 'update'])->name('events.update');

    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    //customer venue

    Route::get('/customer-venues', [CustomerVenueController::class, 'index'])->name('customer-venues.index');
    Route::get('/customer-venues-create', [CustomerVenueController::class, 'create'])->name('customer-venues.create');
    Route::get('/customer-venues-create/{id?}', [CustomerVenueController::class, 'create'])->name('customer-venues.createWithId');
    Route::post('/customer-venues', [CustomerVenueController::class, 'store'])->name('customer-venues.store');
    Route::post('/customer-venues/edit', [CustomerVenueController::class, 'edit'])->name('customer-venues.edit');
    Route::put('/customer-venues', [CustomerVenueController::class, 'update'])->name('customer-venues.update');
    Route::delete('/customer-venues/{customerVenue}', [CustomerVenueController::class, 'destroy'])->name('customer-venues.destroy');


    //password
    Route::get('/change-password', [PasswordChangeController::class, 'showChangePasswordForm'])->name('passwordChange');
    Route::post('/changePassword', [PasswordChangeController::class, 'changePassword'])->name('password.change');

    // Route::group(['prefix' => 'items'], function () {
    //     Route::get('/', [ItemController::class, 'index'])->name('items.index');
    //     Route::get('/add', [ItemController::class, 'create'])->name('items.create');
    //     Route::post('/', [ItemController::class, 'store'])->name('items.store');
    //     Route::get('/{item}', [ItemController::class, 'edit'])->name('items.edit');
    //     Route::put('/{item}', [ItemController::class, 'update'])->name('items.update');
    //     Route::delete('/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
    // });
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


    Route::get('/admin-venues', [AdminVenueController::class, 'index'])->name('admin-venues.index');
    Route::get('/admin-venues/create', [AdminVenueController::class, 'create'])->name('admin-venues.create');
    Route::post('/admin-venues', [AdminVenueController::class, 'store'])->name('admin-venues.store');
    Route::get('/admin-venues/{adminVenue}', [AdminVenueController::class, 'show'])->name('admin-venues.show');
    Route::get('/admin-venues/{adminVenue}/edit', [AdminVenueController::class, 'edit'])->name('admin-venues.edit');
    Route::put('/admin-venues/{adminVenue}', [AdminVenueController::class, 'update'])->name('admin-venues.update');
    Route::delete('/admin-venues/{adminVenue}', [AdminVenueController::class, 'destroy'])->name('admin-venues.destroy');


    Route::resource('packages', PackagesController::class);
    Route::resource('items', DishesController::class)->names('dishes');
    Route::resource('categories', CategoriesController::class);
    Route::resource('subcategories', SubCategoriesController::class);
    Route::resource('equipments', EquipmentController::class);
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [admin::class, 'index'])->name('admin.login');
});

require __DIR__ . '/auth.php';
