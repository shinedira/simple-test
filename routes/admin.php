<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HrdController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('hrd', [HrdController::class, 'index'])->name('hrd');
Route::resource('skill', SkillController::class)->except('show');
Route::resource('candidate', CandidateController::class)->except('show');