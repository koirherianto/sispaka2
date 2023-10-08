<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BC\TryBcController;
use App\Http\Controllers\BC\BcSettingController;
use App\Http\Controllers\LandingController;


Auth::routes();

Route::get('/', [LandingController::class, 'index'])->name('landing');

// Route::get('/landing', function () {
//     return view('landing.index2');
// });

// storage link
// Route::get('/storage-link', function () {
//     $targetFolder = storage_path('app/public');
//     $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
//     symlink($targetFolder, $linkFolder);
// });

Route::get('/inner-page', function () {
    return view('landing.inner-page');
});
Route::get('/portfolio-details', function () {
    return view('landing.portfolio-details');
});
Route::get('/expert-system/{slug}', [LandingController::class, 'blog'])->name('expert-system.blog');
Route::post('/expert-system/{slug}/backward-chaining', [LandingController::class, 'backwardChaining'])->name('expert-system.backward-chaining');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //middle ware role untuk admin
    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('permissions', App\Http\Controllers\PermissionController::class);
        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::resource('roles', App\Http\Controllers\RoleController::class);
    });

    Route::post('/changeProject/{id}', [ProjectController::class, 'changeProject'])->name('changeProject');
    Route::resource('projects', ProjectController::class);
    Route::resource('methods', App\Http\Controllers\MethodController::class);
    
    Route::group(['middleware' => ['ProjectSessionExist']], function () {
        Route::resource('backwardChainings', App\Http\Controllers\BC\BackwardChainingController::class);
        Route::resource('bcFacts', App\Http\Controllers\BC\BcFactController::class);
        Route::resource('bcResults', App\Http\Controllers\BC\BcResultController::class);
        Route::resource('bcQuestions', App\Http\Controllers\BC\BcQuestionController::class);
        Route::get('/tryBc/selectResult', [TryBcController::class, 'selectResults'])->name('trybc.selectResult');
        Route::post('/tryBc/selectQuestion', [TryBcController::class, 'selectQuestion'])->name('trybc.selectQuestion');
        Route::post('/tryBc/results', [TryBcController::class, 'results'])->name('trybc.results');
        Route::get('/bcSetting', [BcSettingController::class, 'index'])->name('bcSetting');
        Route::post('/bcSetting', [BcSettingController::class, 'store'])->name('bcSetting.store');
    });

});


// Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')
//    ->name('io_generator_builder');
// Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')
//    ->name('io_field_template');
// Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')
//    ->name('io_relation_field_template');
// Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')
//    ->name('io_generator_builder_generate');
// Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')
//    ->name('io_generator_builder_rollback');
// Route::post('generator_builder/generate-from-file','\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile')
//    ->name('io_generator_builder_generate_from_file');



