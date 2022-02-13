<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', static function () {
    return view('welcome');
});

Route::get('/payment/verify', static function (Request $request) {
    $response = Http::post('http://shoppingbyapi.mytest/api/payment/verify', [
        "token" => $request->get('token'),
    ]);
    dd($response->json(), $request->all());
});
