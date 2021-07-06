<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ChangeProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MultiImageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\UserAuthController;
use App\Models\Contact;
use App\Models\MultiImage;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $about = DB::table('home_abouts')->latest()->get();
    $images = MultiImage::all();
    return view('home', compact('brands', 'about', 'images'));
});
Route::get('/home', [HelloController::class, 'home']);
Route::get('/about', [HelloController::class, 'about'])->middleware('age');
Route::get('/carrier', [RouteController::class, 'carrier']);
Route::get('/contact', [RouteController::class, 'contact'])->name('contact');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    // $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

// category Controller
Route::get('/all-category', [CategoryController::class, 'allCategory'])->name('all.category');
Route::post('/add-category', [CategoryController::class, 'addCategory'])->name('add.category');
Route::get('/edit-category/{id}', [CategoryController::class, 'editCategory'])->name('edit.category');
Route::post('/update-category/{id}', [CategoryController::class, 'updateCategory'])->name('update.category');
Route::get('/softDelete-category/{id}', [CategoryController::class, 'softDeleteCategory']);
Route::get('/restore-category/{id}', [CategoryController::class, 'restoreCategory']);
Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory']);

// Brand Controller
Route::get('/all-brand', [BrandController::class, 'allBrand'])->name('all.brand');
Route::post('/add-brand', [BrandController::class, 'addBrand'])->name('add.brand');
Route::get('/edit-brand/{id}', [BrandController::class, 'editBrand'])->name('edit.brand');
Route::post('/update-brand/{id}', [BrandController::class, 'updateBrand'])->name('update.brand');
Route::get('/delete-brand/{id}', [BrandController::class, 'deleteBrand'])->name('delete.brand');

// MultiImage Controller
Route::get('/all-images', [MultiImageController::class, 'allImages'])->name('all.images');
Route::post('/add-images', [MultiImageController::class, 'addImages'])->name('add.images');

// UserAuth Controller
Route::get('/user/logout', [UserAuthController::class, 'userLogout'])->name('user.logout');

// Home Slider
Route::get('/home/slider', [HomeController::class, 'allSlider'])->name('all.slider');
Route::get('/add/slider', [HomeController::class, 'addSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'storeSlider'])->name('store.slider');
Route::get('/edit/slider/{id}', [HomeController::class, 'editSlider'])->name('edit.slider');
Route::post('/update/slider/{id}', [HomeController::class, 'updateSlider'])->name('update.slider');
Route::get('/delete/slider/{id}', [HomeController::class, 'deleteSlider'])->name('delete.slider');

// Home About 
Route::get('/home/about', [AboutController::class, 'allAbout'])->name('all.about');
Route::get('/add/about', [AboutController::class, 'addAbout'])->name('add.about');
Route::post('/store/about', [AboutController::class, 'storeAbout'])->name('store.about');
Route::get('/edit/about/{id}', [AboutController::class, 'editAbout'])->name('edit.about');
Route::post('/update/about/{id}', [AboutController::class, 'updateAbout'])->name('update.about');
Route::get('/delete/about/{id}', [AboutController::class, 'deleteAbout'])->name('delete.about');

// Portfolio page
Route::get('/portfolio', [PortfolioController::class, 'portfolio'])->name('portfolio');

// Contact Page
Route::get('/admin/contact', [ContactController::class, 'allContact'])->name('all.contact');
Route::get('/add/contact', [ContactController::class, 'addContact'])->name('add.contact');
Route::post('/store/contact', [ContactController::class, 'storeContact'])->name('store.contact');
Route::get('/edit/contact/{id}', [ContactController::class, 'editContact'])->name('edit.contact');
Route::post('/update/contact/{id}', [ContactController::class, 'updateContact'])->name('update.contact');
Route::get('/delete/contact/{id}', [ContactController::class, 'deleteContact'])->name('delete.contact');

// Home Contact Page
Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'contactForm'])->name('contact.form');

// Contact Message page
Route::get('/admin/contactMessage', [ContactMessageController::class, 'allContactMessage'])->name('allContact.message');
Route::get('/delete/contactMessage/{id}', [ContactMessageController::class, 'deleteContactMessage'])->name('deleteContact.message');

// Change Password and Update password
Route::get('/user/password', [ChangePasswordController::class, 'changePassword'])->name('change.password');
Route::post('/update/password', [ChangePasswordController::class, 'updatePassword'])->name('update.password');

// Change Profile and Update Profile
Route::get('/edit/profile', [ChangeProfileController::class, 'editProfile'])->name('edit.profile');
Route::post('/update/profile', [ChangeProfileController::class, 'updateProfile'])->name('update.profile');