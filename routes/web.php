<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\FutureEventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Frontend\BlogsController;


use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Contracts\Permission;

use function Pest\Laravel\delete;

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
    return view('home');
});

Route::get('/blog', [BlogsController::class, 'index'])->name('site.blogs');
Route::get('/create-blog', [BlogsController::class, 'create'])->name('site.blogs.create');

Route::post('/store-blog', [BlogsController::class, 'store'])->name('site.blogs.store');


Route::prefix('admin')->middleware(['auth', 'verified', 'role:Admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard/index');
    })->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('users/pdf', [UserController::class, 'pdf'])->name('users.pdf');
    Route::get('users/roles/{id}', [UserController::class, 'userRoles'])->name('users.roles');
    Route::post('users/save-roles', [UserController::class, 'saveRole'])->name('userRoles.save');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.view');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings/update', [SettingController::class, 'update'])->name('settings.update');
    Route::get('/slides/sort', [SliderController::class, 'sort'])->name('slides.sort');
    Route::post('/slides/updateOrder', [SliderController::class, 'updateOrder'])->name('slides.updateOrder');
    Route::resource('slides', SliderController::class);
    Route::get('/testimonials/sort', [TestimonialController::class, 'sort'])->name('testimonials.sort');
    Route::post('/testimonials/updateOrder', [TestimonialController::class, 'updateOrder'])->name('testimonials.updateOrder');
    Route::resource('testimonials', TestimonialController::class);
    Route::get('/sponsors/sort', [SponsorController::class, 'sort'])->name('sponsors.sort');
    Route::post('/sponsors/updateOrder', [SponsorController::class, 'updateOrder'])->name('sponsors.updateOrder');
    Route::resource('sponsors', SponsorController::class);
    Route::resource('futureEvents', FutureEventController::class);
    Route::get('/emails', [ContactUsController::class, 'index'])->name('emails.index');
    Route::get('/emails/{id}', [ContactUsController::class, 'showEmail'])->name('emails.show');
    Route::put('/emails/{id}/mark-as-read', [ContactUsController::class, 'markAsRead'])->name('emails.markAsRead');
    Route::delete('/emails/{id}', [ContactUsController::class, 'destroy'])->name('emails.delete');
    Route::post('gallery/uploadImage', [GalleryController::class, 'uploadImage'])->name('gallery.uploadImage');
    Route::resource('gallery', GalleryController::class);
    Route::resource('blogs', BlogController::class);
    Route::post('/roles/{role}/assign', [RoleController::class, 'assignRole'])->name('roles.assign');
    Route::post('/roles/{role}/remove', [RoleController::class, 'removeRole'])->name('roles.remove');
    Route::resource('roles', RoleController::class);

    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::resource('permissions', PermissionController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
