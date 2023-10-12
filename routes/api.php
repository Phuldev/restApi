<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsPostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/student', StudentController::class);
Route::apiResource('/category', CategoryController::class);

// news


Route::get('/news', [NewsPostController::class, 'index']);

// View a particular news headline based on given id
Route::get('/news/{id}', [NewsPostController::class, 'show']);

// Search for news headline
Route::get('/news/search/{title}', [NewsPostController::class, 'search']);


// Register a new User
Route::post('/register', [AuthController::class, 'register']);
// Login a registered user
Route::post('/login', [AuthController::class, 'login']);
// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Create a new news headline
    Route::post('/news', [NewsPostController::class, 'store']);

    // Update a particular news headline
    Route::put('/news/{id}', [NewsPostController::class, 'update']);

    // Delete a news headline based on given id
    Route::delete('/news/{id}', [NewsPostController::class, 'destroy']);
    // Logout a User
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});