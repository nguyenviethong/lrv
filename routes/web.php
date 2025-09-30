<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Middleware\RedirectIfNotAdmin;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CKEditorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ServiceController ;
use App\Http\Controllers\Admin\SettingSectionsController ;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    // Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    // Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
});


Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(RedirectIfNotAdmin::class)->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

        Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('admin.products.show');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

        Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
        Route::get('/contacts/create', [ContactController::class, 'create'])->name('admin.contacts.create');
        Route::post('/contacts', [ContactController::class, 'store'])->name('admin.contacts.store');
        Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('admin.contacts.edit');
        Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('admin.contacts.update');
        Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');

        Route::get('/hero', [HeroSectionController::class, 'index'])->name('admin.hero.index');
        Route::get('/hero/create', [HeroSectionController::class, 'create'])->name('admin.hero.create');
        Route::post('/hero', [HeroSectionController::class, 'store'])->name('admin.hero.store');
        Route::get('/hero/{hero}/edit', [HeroSectionController::class, 'edit'])->name('admin.hero.edit');
        Route::put('/hero/{hero}', [HeroSectionController::class, 'update'])->name('admin.hero.update');
        Route::delete('/hero/{hero}', [HeroSectionController::class, 'destroy'])->name('admin.hero.destroy');

        Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');

        Route::get('/about', [AboutController::class, 'index'])->name('admin.about.index');
        Route::get('/about/{about}/edit', [AboutController::class, 'edit'])->name('admin.about.edit');
        Route::put('/about/{about}', [AboutController::class, 'update'])->name('admin.about.update');
        Route::get('/about/create', [AboutController::class, 'create'])->name('admin.about.create');
        Route::post('/about', [AboutController::class, 'store'])->name('admin.about.store');

        Route::get('/services', [ServiceController ::class, 'index'])->name('admin.services.index');
        Route::get('/services/{service}/edit', [ServiceController ::class, 'edit'])->name('admin.services.edit');
        Route::put('/services/{service}', [ServiceController ::class, 'update'])->name('admin.services.update');
        Route::get('/services/create', [ServiceController ::class, 'create'])->name('admin.services.create');
        Route::post('/services', [ServiceController ::class, 'store'])->name('admin.services.store');
        Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');

        Route::get('/settingSections', [SettingSectionsController ::class, 'index'])->name('admin.settingSections.index');
        Route::get('/settingSections/{settingSection}/edit', [SettingSectionsController ::class, 'edit'])->name('admin.settingSections.edit');
        Route::put('/settingSections/{settingSection}', [SettingSectionsController ::class, 'update'])->name('admin.settingSections.update');
        Route::get('/settingSections/create', [SettingSectionsController ::class, 'create'])->name('admin.settingSections.create');
        Route::post('/settingSections', [SettingSectionsController ::class, 'store'])->name('admin.settingSections.store');
        Route::delete('/settingSections/{settingSection}', [SettingSectionsController::class, 'destroy'])->name('admin.settingSections.destroy');

    });
});

Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('ckeditor.upload');

Route::get('/', function () {
    return view('index');
});
Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/category/{slug}', [FrontendController::class, 'category'])->name('category.show');

Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/products/{product}', [ProductController::class, 'showFE'])
    ->name('products.show');

// Route::get('/contact', [ContactController::class, 'showContactPage'])->name('contact.page');


// Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
//     Route::resource('categories', CategoryController::class);
// });

// Route::get('/dashboard', function () {
//     return 'Admin Dashboard';
// })->middleware(CheckAdmin::class);

