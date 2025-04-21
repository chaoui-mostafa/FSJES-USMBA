<!-- <?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LaboratoireApiController;
use App\Http\Controllers\Api\ProfApiController;
use App\Http\Controllers\Api\DoctorantApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public API endpoints
Route::get('laboratoires', [LaboratoireApiController::class, 'index']);
Route::get('laboratoires/{id}', [LaboratoireApiController::class, 'show']);

// Authenticated API endpoints
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('profs', ProfApiController::class);
    Route::apiResource('doctorants', DoctorantApiController::class);

    Route::post('doctorants/{doctorant}/upload-thesis', [DoctorantApiController::class, 'uploadThesis']);
    Route::get('stats', function() {
        return response()->json([
            'laboratoires' => \App\Models\Laboratoire::count(),
            'profs' => \App\Models\Prof::count(),
            'doctorants' => \App\Models\Doctorant::count()
        ]);
    });
}); -->
