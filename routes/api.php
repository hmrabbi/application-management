<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MasterDivisionController;
use App\Http\Controllers\MasterDistrictController;
use App\Http\Controllers\MasterUpzillaController;
use App\Http\Controllers\MasterGenderController;
use App\Http\Controllers\ApplicationController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[RegisterController::class,'register']);
Route::post('login',[RegisterController::class,'login']);

Route::middleware('auth:api')->group( function() {
    Route::post('mdcreate',[MasterDivisionController::class,'createDivision']);
    Route::get('mdlist',[MasterDivisionController::class,'listDivision']);
    Route::put('mdupdate/{id}',[MasterDivisionController::class,'updateDivision']);
    Route::delete('mddelete/{id}',[MasterDivisionController::class,'deleteDivision']);

    Route::post('distcreate',[MasterDistrictController::class,'createDistrict']);
    Route::get('distlist',[MasterDistrictController::class,'listDistrict']);
    Route::put('distupdate/{id}',[MasterDistrictController::class,'updateDistrict']);
    Route::delete('distdelete/{id}',[MasterDistrictController::class,'deleteDistrict']);

    Route::post('upcreate',[MasterUpzillaController::class,'createUpzilla']);
    Route::get('uplist',[MasterUpzillaController::class,'listUpzilla']);
    Route::put('upupdate/{id}',[MasterUpzillaController::class,'updateUpzilla']);
    Route::delete('updelete/{id}',[MasterUpzillaController::class,'deleteUpzilla']);

    Route::post('gcreate',[MasterGenderController::class,'createGender']);
    Route::get('glist',[MasterGenderController::class,'listGender']);
    Route::put('gupdate/{id}',[MasterGenderController::class,'putGender']);
    Route::delete('gdelete/{id}',[MasterGenderController::class,'deleteGender']);

    Route::post('application-create',[ApplicationController::class,'create']);
    Route::put('final_save/{id}',[ApplicationController::class,'finalSave']);
    Route::put('approval_save/{id}',[ApplicationController::class,'approvalSave']);
    Route::put('agreement_save/{id}',[ApplicationController::class,'agreementSave']);

    Route::get('list_application',[ApplicationController::class,'applicationList']);
    Route::get('list_save_status',[ApplicationController::class,'saveStatus']);
    Route::get('save_status_draf',[ApplicationController::class,'saveStatusDraf']);
   // Route::get('list_draf',[ApplicationController::class,'saveList']);

   Route::put('application-update/{id}',[ApplicationController::class,'applicationUpdate']);


});

