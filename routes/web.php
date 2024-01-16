<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    // return view('admin.files.layouts');
    return redirect()->route('login');
});

//('/login' to '/admin/login')
Route::get('/login', function () {
    return redirect()->route('login');
});

//('/register' to '/admin/register')
Route::get('/register', function () {
    return redirect()->route('register');
});

//('/admin' to '/admin/login')
Route::get('/admin', function () {
    return redirect('/admin/login');
});

//('/admin')
Route::group(['prefix' => 'admin', 'middleware' => 'disable-back'], function () {

    //dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // auth route
    Route::middleware('auth')->group(function () {
        //profile setting
        Route::get('/setting', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('ModuleAccessor:profile.edit');
        Route::patch('/setting', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/setting', [ProfileController::class, 'destroy'])->name('profile.destroy');

        //web setting
        Route::post('/setting', [SettingsController::class, 'store'])->name('setting.store');

        //role
        Route::get('/role', [RoleController::class, 'index'])->name('role.index')->middleware('ModuleAccessor:role.index');
        Route::get('/role/create', [RoleController::class, 'create'])->name('role.create')->middleware('ModuleAccessor:role.create');
        Route::post('/role/create', [RoleController::class, 'store']);
        Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit')->middleware('ModuleAccessor:role.edit');
        Route::post('/role/edit/{id}', [RoleController::class, 'update']);
        Route::get('/role/show/{id}', [RoleController::class, 'show'])->name('role.show')->middleware('ModuleAccessor:role.show');
        Route::get('/role/delete', [RoleController::class, 'destroy'])->name('role.destroy')->middleware('ModuleAccessor:role.destroy');
        Route::get('/role/status', [RoleController::class, 'status'])->name('role.status')->middleware('ModuleAccessor:role.status');

        //user
        Route::get('/user', [UserController::class, 'index'])->name('user.index')->middleware('ModuleAccessor:user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware('ModuleAccessor:user.create');
        Route::post('/user/create', [UserController::class, 'store']);
        Route::post('/user/permission', [UserController::class, 'permission'])->name('user.permission');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware('ModuleAccessor:user.edit');
        Route::post('/user/edit/{id}', [UserController::class, 'update']);
        Route::get('/user/show/{id}', [UserController::class, 'show'])->name('user.show')->middleware('ModuleAccessor:user.show');
        Route::get('/user/delete', [UserController::class, 'destroy'])->name('user.destroy')->middleware('ModuleAccessor:user.destroy');
        Route::get('/user/status', [UserController::class, 'status'])->name('user.status')->middleware('ModuleAccessor:user.status');
    });
});

require __DIR__ . '/auth.php';
