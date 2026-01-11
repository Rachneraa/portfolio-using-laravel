<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/projects/{project}', [HomeController::class, 'projectDetail'])->name('projects.show');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.store');
Route::get('/download-cv', [HomeController::class, 'downloadCV'])->name('download.cv');
Route::get('/api/timeline', [HomeController::class, 'timelineData'])->name('timeline.data');
