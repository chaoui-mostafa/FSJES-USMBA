<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaboratoireController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\DoctorantController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\ProfController;


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
Route::get('/profes', [ProfController::class, 'index'])->name('profes.index');

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
// Route::prefix('api')->group(function () {
//     Route::get('laboratoires', [LaboratoireController::class, 'apiIndex']);
//     Route::get('profs/search', [ProfController::class, 'search']);
// });

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


Route::resource('users', UserController::class);
//     ->except(['create', 'edit', 'update', 'destroy']);
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
// Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('users/{user}/reset-password', [UserController::class, 'resetPassword'])
    ->name('users.reset-password');
// routes/web.php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\DocumentController;

// use App\Http\Controllers\StudentController;

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::post('/students/upload', [StudentController::class, 'upload'])->name('students.upload');

Route::get('/sql-query', function () {
    return view('sql-page');
});
// عرض الطلبة الحاليين
Route::get('/students/current', [StudentController::class, 'showCurrent'])->name('students.current');

// عرض السجل
Route::get('/students/history', [StudentController::class, 'showHistory'])->name('students.history');
// use App\Http\Controllers\StudentController;

Route::get('/students/import', [StudentController::class, 'showImportForm'])->name('students.import.form');
Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');
// use App\Http\Controllers\StudentController;

// Route::get('students/import', [StudentController::class, 'showImportForm'])->name('students.import');
// Route::post('students/upload', [StudentController::class, 'upload'])->name('students.upload');
Route::get('/doctorants/{doctorant}/details', [StudentController::class, 'showDetails'])
     ->name('doctorants.details');
Route::post('/professeurs/import', [ProfController::class, 'import'])->name('professeurs.import');
// routes/web.php

// use App\Http\Controllers\DocumentController;

// Route::get('/document/create', [DocumentController::class, 'create']);
// Route::post('/document', [DocumentController::class, 'store'])->name('documents.store');
// use App\Http\Controllers\DocumentController;

Route::get('/doctorants', function () {
    $doctorants = \App\Models\Doctorant::all();
    return view('doctorants.index', compact('doctorants'));
})->name('doctorants.index');

// Route::get('/documents/{id}/{type}', [DocumentController::class, 'generateDoctorantDocument'])
    // ->name('documents.generate')
    //  use App\Http\Controllers\DocumentController;

    //  Route::get('/documents/download/{id}', [DocumentController::class, 'download'])->name('documents.download');
    //  Route::get('/generate-word', [\App\Http\Controllers\WordExportController::class, 'export']);
    use App\Http\Controllers\DoctorantWordExportController;

    Route::get('/doctorant/{id}/export-word', [DoctorantWordExportController::class, 'export'])
    ->name('doctorants.export-word');


// routes/web.php
Route::get('/doctorants/{doctorant}', [DoctorantController::class, 'show'])->name('doctorants.show');
// route('documents.generate', [ 'type' => $documentType]);
Route::get('/doctorants/{doctorant}/generate/{type}', [DoctorantController::class, 'generateDocument'])
     ->name('doctorants.generate');
// For importing professors
// use App\Http\Controllers\DoctorantController;

Route::get('/doctorants/export-word', [DoctorantController::class, 'exportWord'])->name('doctorants.export-word');
// routes/web.php
// Route::get('/generate-docx/{id}', [DocumentController::class, 'generateDocx']);
// Route::get('/doctorants/{id}/export', [DoctorantWordExportController::class, 'export'])
//     ->name('doctorants.export');
// use App\Http\Controllers\DoctorantWordExportController;

Route::get('/doctorant/{id}/annonce', [DoctorantWordExportController::class, 'showForm'])->name('doctorant.annonce.form');
Route::post('/doctorant/annonce/generate', [DoctorantWordExportController::class, 'generate'])->name('doctorant.annonce.generate');
