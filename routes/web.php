
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaboratoireController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\DoctorantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DoctorantWordExportController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\ProfileController;

/*
|------------------------------------------------------------------
| Public Routes (No Authentication Required)
|------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware('guest')->group(function () {
    // Password reset routes
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});
/*
|------------------------------------------------------------------
| Protected Routes (Require Authentication)
|------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    /*
    |------------------------------------------------------------------
    | Laboratoire Routes
    |------------------------------------------------------------------
    */
    Route::resource('laboratoires', LaboratoireController::class);
    Route::get('laboratoires/{laboratoire}/members', [LaboratoireController::class, 'members'])->name('laboratoires.members');

    /*
    |------------------------------------------------------------------
    | Professor Routes
    |------------------------------------------------------------------
    */
    Route::resource('profs', ProfController::class);
    Route::get('profs/{prof}/supervisions', [ProfController::class, 'supervisions'])->name('profs.supervisions');
    Route::post('profs/{prof}/assign-lab', [ProfController::class, 'assignLab'])->name('profs.assign-lab');
    Route::post('/professeurs/import', [ProfController::class, 'import'])->name('professeurs.import');
    Route::get('/profes', [ProfController::class, 'index'])->name('profes.index');


    /*
    |------------------------------------------------------------------
    | Doctorant Routes
    |------------------------------------------------------------------
    */
    Route::resource('doctorants', DoctorantController::class);
    Route::get('doctorants/{doctorant}/thesis', [DoctorantController::class, 'thesisProgress'])->name('doctorants.thesis');
    Route::post('doctorants/{doctorant}/change-supervisor', [DoctorantController::class, 'changeSupervisor'])->name('doctorants.change-supervisor');
    Route::get('doctorants/{doctorant}/documents', [DoctorantController::class, 'documents'])->name('doctorants.documents');
    Route::get('/doctorants/export', [DoctorantController::class, 'export'])->name('doctorants.export');
    Route::post('/doctorants/import', [DoctorantController::class, 'import'])->name('doctorants.import');
    Route::get('/doctorants/template', [DoctorantController::class, 'template'])->name('doctorants.template');

    /*
    |------------------------------------------------------------------
    | User Routes
    |------------------------------------------------------------------
    */
    Route::resource('users', UserController::class);
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
// Blocage manuel
Route::post('/users/{user}/block', [UserController::class, 'block'])->name('users.block');

// Déblocage manuel
Route::post('/users/{user}/unlock', [UserController::class, 'unlock'])->name('users.unlock');
// web.php

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');



    /*
    |------------------------------------------------------------------
    | Student Routes
    |------------------------------------------------------------------
    */
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::post('/students/upload', [StudentController::class, 'upload'])->name('students.upload');
    Route::get('/students/current', [StudentController::class, 'showCurrent'])->name('students.current');
    Route::get('/students/history', [StudentController::class, 'showHistory'])->name('students.history');
    Route::get('/students/import', [StudentController::class, 'showImportForm'])->name('students.import.form');
    Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');

    /*
    |------------------------------------------------------------------
    | Document Routes
    |------------------------------------------------------------------
    */
    Route::get('/doctorants/{doctorant}/generate/{type}', [DoctorantController::class, 'generateDocument'])->name('doctorants.generate');
    Route::get('/doctorant/{id}/export-word', [DoctorantWordExportController::class, 'export'])->name('doctorants.export-word');
    Route::get('/doctorant/{id}/annonce', [DoctorantWordExportController::class, 'showForm'])->name('doctorant.annonce.form');
    Route::post('/doctorant/annonce/generate', [DoctorantWordExportController::class, 'generate'])->name('doctorant.annonce.generate');
});

// routes/web.php

use App\Http\Controllers\ProfileSettingsController;

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/settings', [ProfileSettingsController::class, 'index'])->name('profile.settings');
    Route::post('/profile/settings', [ProfileSettingsController::class, 'update'])->name('profile.settings.update');
    Route::post('/profile/settings/delete', [ProfileSettingsController::class, 'deleteAccount'])->name('profile.settings.delete');
    Route::post('/profile/settings/change-password', [ProfileSettingsController::class, 'changePassword'])->name('profile.settings.change-password');
});
