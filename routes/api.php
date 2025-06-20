<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AufgabenController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('aufgaben', AufgabenController::class);
});
