<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\CompanyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
//    Route::apiResources([
//        'companies' => CompanyController::class,
//        'clients' => ClientController::class,
//    ]);

    Route::get('/companies', [CompanyController::class, 'index'])->name('api.companies.index');
    Route::get('/companies/{company}/clients', [CompanyController::class, 'clients'])->name('api.company.clients');
    Route::get('/clients/{client}/companies', [ClientController::class, 'companies'])->name('api.client.companies');

});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::fallback(function (){
    return response()->json(['message' => 'API resource not found'], 404);
});
