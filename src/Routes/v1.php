<?php

Route::post('/auth', 'AuthController@index');

Route::middleware('dawnstarApiAuth:apiAdmin')->group(function () {
    Route::apiResource('containers', ContainerController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('pages', PageController::class);
    Route::apiResource('menus', MenuController::class);
});
