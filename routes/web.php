<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacultyController;

Route::get("/", [FacultyController::class, "index"]);
Route::post('/fetch-departments', [FacultyController::class, 'fetchDepartments']);