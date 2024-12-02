<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hamza', function (Request $request) {
     
    $data =  [
        'id' => 1,
        'name' => 'Hmza elkheray li mataydirhax bida',
        'description' => 'This is just an example.',
    ];

    return response()->json($data, 200);
});

Route::post('/user', [UserController::class, 'store'] ) ;


