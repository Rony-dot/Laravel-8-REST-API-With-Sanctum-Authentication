<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserAuthController;
use App\Models\Product;
use Illuminate\Http\Request;
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

//Route::resource('/products',ProductController::class);

//Route::post('/tokens/create', function (Request $request) {
//    $token = $request->user()->createToken($request->token_name);
//
//    return ['token' => $token->plainTextToken];
//});

Route::post('/register',[UserAuthController::class,'register']);
Route::get('/products',[ProductController::class,'index']);
Route::get('/products/{id}',[ProductController::class,'show']);
Route::post('/login',[UserAuthController::class,'loginUser']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/products',[ProductController::class,'store']);
    Route::put('/products/{id}',[ProductController::class,'update']);
    Route::delete('/products/{id}',[ProductController::class,'destroy']);
    Route::post('/logout',[UserAuthController::class,'logout']);

});


Route::post('/products/add', function (){
    return Product::create([
       'name'=>'this is a phone',
       'slug'=>'this-is-a-phone',
       'description'=>'this is a nice phone',
       'price'=>10
    ]);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
