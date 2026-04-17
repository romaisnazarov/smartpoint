<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::prefix('blog')->group(function () {
   Route::post('/create', [BlogController::class, 'create']);
});
