<?php

use App\Http\Controllers\CoinsController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\Admin\CoinsController as AdminCoinsController;
use App\Http\Controllers\Admin\PartialsController;
use App\Http\Controllers\Auth\LoginController;
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

Route::middleware(['language'])->group(function () {
    Route::get('/coin/{coinId}/{lang?}', [CoinsController::class, "show"])->name("show");

    Route::get('/login/{lang?}', [LoginController::class, 'create'])->middleware('guest')->name('login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('guest')->name('login.store');
    Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('login.destroy');

    Route::middleware(['auth'])->group(function () {
        Route::get("download/db", [DownloadController::class, 'downloadDatabase'])->name('download.database');
        Route::get("download/pictures/{type}", [DownloadController::class, 'downloadPictures'])->name('download.pictures');
        Route::get("download/document/{type}/{coin?}", [DownloadController::class, 'downloadDocument'])->name('download.document');
        Route::prefix("admin")->name("admin.")->group(function () {
            Route::resources(["coins" => AdminCoinsController::class]);
            Route::post("coins/preset", [AdminCoinsController::class, 'savePreset'])->name('coins.preset');
            Route::prefix("partials")->name("partials.")->group(function () {
                Route::post("upload-picture", [PartialsController::class, 'uploadPicture'])->name('upload_picture');
            });
            Route::get("/", [AdminCoinsController::class, 'index'])->name('index');
        });
    });

    Route::get('/{lang?}', [CoinsController::class, "index"])->name("index");
});

Route::post("/log", LogController::class)->name("log");
