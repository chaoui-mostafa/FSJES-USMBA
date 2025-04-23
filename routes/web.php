<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaboratoireController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\DoctorantController;


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Protected Routes (Require Authentication)
|--------------------------------------------------------------------------
*/
// Dashboard Route
// routes/web.php
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Laboratoire Routes
|--------------------------------------------------------------------------
*/
Route::resource('laboratoires', LaboratoireController::class);
Route::get('laboratoires/{laboratoire}/members', [LaboratoireController::class, 'members'])->name('laboratoires.members');


// Additional custom routes for laboratoires
// Route::get('laboratoires/{laboratoire}/members', [LaboratoireController::class, 'members'])
//     ->name('laboratoires.members');
// Route::get('laboratoires/export', [LaboratoireController::class, 'export'])
//     ->name('laboratoires.export');

/*
|--------------------------------------------------------------------------
| Professor Routes
|--------------------------------------------------------------------------
*/
Route::resource('profs', ProfController::class);

// Professor-specific routes
Route::get('profs/{prof}/supervisions', [ProfController::class, 'supervisions'])
    ->name('profs.supervisions');
Route::post('profs/{prof}/assign-lab', [ProfController::class, 'assignLab'])
    ->name('profs.assign-lab');

/*
|--------------------------------------------------------------------------
| Doctorant Routes
|--------------------------------------------------------------------------
*/
Route::resource('doctorants', DoctorantController::class);

// Doctorant-specific routes
Route::get('doctorants/{doctorant}/thesis', [DoctorantController::class, 'thesisProgress'])
    ->name('doctorants.thesis');
Route::post('doctorants/{doctorant}/change-supervisor', [DoctorantController::class, 'changeSupervisor'])
    ->name('doctorants.change-supervisor');
Route::get('doctorants/{doctorant}/documents', [DoctorantController::class, 'documents'])
    ->name('doctorants.documents');
/*
|--------------------------------------------------------------------------
| API Routes (Optional)
|--------------------------------------------------------------------------
*/
Route::prefix('api')->group(function () {
    Route::get('laboratoires', [LaboratoireController::class, 'apiIndex']);
    Route::get('profs/search', [ProfController::class, 'search']);
});

// Import and Export routes for Doctorants
Route::get('/doctorants/export', [DoctorantController::class, 'export'])->name('doctorants.export');
Route::post('/doctorants/import', [DoctorantController::class, 'import'])->name('doctorants.import');
Route::get('/doctorants/template', [DoctorantController::class, 'template'])->name('doctorants.template');

// use App\Http\Controllers\DoctorantController;

Route::resource('doctorants', DoctorantController::class);

// مسار الاستيراد
Route::post('doctorants/import', [DoctorantController::class, 'import'])->name('doctorants.import');


use App\Exports\ExampleExport;
use Maatwebsite\Excel\Facades\Excel;

// Route::get('/download-excel', function () {
//     return Excel::download(new ExampleExport, 'example.xlsx');
// });

