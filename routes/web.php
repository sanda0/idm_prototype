<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[DashboardController::class,"index"] )->middleware(['auth',])->name('dashboard');

Route::get('/elective-module-selection', [DashboardController::class, 'electiveModuleSelection'])
    ->middleware(['auth',])->name('elective-module-selection');

Route::post('/elective-module-selection', [DashboardController::class, 'storeElectiveModuleSelection'])
    ->middleware(['auth',])->name('elective-module-selection.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'roles:Academic Head,Admin'])->group(function () {
    Route::resource('courses', CourseController::class);
    Route::resource('modules', ModuleController::class);
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::post('batchs', [CourseController::class, 'storeBatch'])->name('batch.store');
    Route::delete('batchs', [CourseController::class, 'destroyBatch'])->name('batch.destroy');
    Route::post('batchs_add_module', [CourseController::class, 'addModule'])->name('batch.add_module');
    Route::delete('batchs_remove_module', [CourseController::class, 'removeModule'])->name('batch.remove_module');
    Route::post('rules', [CourseController::class, 'storeRule'])->name('rules.store');
    Route::delete('rules', [CourseController::class, 'destroyRule'])->name('rules.destroy');




});

require __DIR__ . '/auth.php';
