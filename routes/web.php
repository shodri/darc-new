<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CurriculumContactController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/inicio', [FrontController::class, 'index'])->name('index');
Route::get('/empresa', [FrontController::class, 'empresa'])->name('empresa');
Route::get('/servicios', [FrontController::class, 'servicios'])->name('servicios');
Route::get('/recursos-humanos', [FrontController::class, 'rrhh'])->name('recursos-humanos');
Route::get('/sucursales', [FrontController::class, 'sucursales'])->name('sucursales');
Route::get('/blog', [FrontController::class, 'blog'])->name('blog');
Route::get('/post/{post}', [FrontController::class, 'post'])->name('post');

Route::get('/citroen', [FrontController::class, 'citroen'])->name('citroen');
Route::get('/ds', [FrontController::class, 'ds'])->name('ds');
Route::get('/peugeot', [FrontController::class, 'peugeot'])->name('peugeot');


Route::get('/author', [FrontController::class, 'author'])->name('author.show');
Route::get('/contacto', [FrontController::class, 'contacto'])->name('contacto');
Route::post('curriculum', [CurriculumContactController::class, 'store'])->name('curriculum.store');
Route::post('/contacto', [ContactController::class, 'store'])->name('contacto.store');


Route::get('/admin', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
    Route::get('posts/{post}/image', [PostController::class, 'removeImage'])->name('posts.removeImage');
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('/landings', LandingController::class);

    Route::resource('/banners', BannerController::class);
    Route::get('/banners/{banner}/photos', [BannerController::class, 'photos'])->name('banners.photos');
    Route::post('/banners/{banner}/crop-store', [BannerController::class, 'crop_store'])->name('banners.crop-store');
    Route::post('banners/{banner}/update-order', [BannerController::class, 'updateOrder'])->name('banners.update-order');
    Route::post('banners/{banner}/update-image-text', [BannerController::class, 'updateImageText'])->name('banners.update-image-text');
    Route::post('banners/{banner}/upload', [BannerController::class, 'upload'])->name('banners.upload');
    Route::get('/banners/{banner}/image/{image}', [BannerController::class, 'showImage'])->name('banner.image.show');
    Route::delete('/banners/{banner}/image/{image}', [BannerController::class, 'destroyImage'])->name('banner.image.destroy');
    
    Route::resource('/pages', PageController::class);

    Route::resource('/albums', AlbumController::class);
    Route::get('/albums/{album}/photos', [AlbumController::class, 'photos'])->name('albums.photos');
    Route::post('/albums/{album}/crop-store', [AlbumController::class, 'crop_store'])->name('albums.crop-store');
    Route::post('albums/{album}/update-order', [AlbumController::class, 'updateOrder'])->name('albums.update-order');
    Route::post('albums/{album}/update-image-text', [AlbumController::class, 'updateImageText'])->name('albums.update-image-text');
    Route::post('albums/{album}/upload', [AlbumController::class, 'upload'])->name('albums.upload');
    Route::get('/albums/{album}/image/{image}', [AlbumController::class, 'showImage'])->name('album.image.show');
    Route::delete('/albums/{album}/image/{image}', [AlbumController::class, 'destroyImage'])->name('album.image.destroy');

    Route::get('/contacts', [AdminContactController::class, 'contacts'])->name('contacts');
    Route::get('/curriculums', [AdminContactController::class, 'curriculums'])->name('curriculums');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/{url}', [LandingController::class, 'showLanding'])->name('landing.show');