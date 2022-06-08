<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CompanyController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::resources([
        'companies' => CompanyController::class,
        'clients' => ClientController::class,
    ]);

    Route::get('/typeahead/clients', [\App\Http\Controllers\Admin\TypeaheadController::class, 'clients'])
        ->name('typeahead.clients');
    Route::get('/typeahead/companies', [\App\Http\Controllers\Admin\TypeaheadController::class, 'companies'])
        ->name('typeahead.companies');
});
