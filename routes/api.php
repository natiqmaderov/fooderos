<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\BranchScheduleController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LangugeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\UtulitiesController;
use App\Http\Controllers\VisitorController;
use App\Models\UserDetails;
use App\Models\Visitor;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('phone',[\App\Http\Controllers\VertificationController::class , 'check']);
Route::post('phone/verfy', [\App\Http\Controllers\VertificationController::class , 'vertification']);
//for autentiocation
Route::group(['middleware'=>'api'] , function ($routes){

    Route::post('user/create',[\App\Http\Controllers\UserController::class,'register']);
    Route::post('user',[\App\Http\Controllers\UserController::class ,'get_user']);
    Route::post('refresh',[\App\Http\Controllers\UserController::class, 'refreshToken']);
    Route::post('logout',[\App\Http\Controllers\UserController::class, 'logout']);
    Route::post('active',[\App\Http\Controllers\UserController::class,'active']);
    Route::post('social/verify', [\App\Http\Controllers\SocialVerify::class , 'verify']);
    Route::post('visitor', [VisitorController::class , 'visitor']);
//for profile
    Route::prefix('profile')->group(function($routes){

        Route::get('/main' , [UserDetailsController::class , 'details']);
        Route::put('/update' , [UserDetailsController::class, 'update']);
        Route::post('/photo' , [UserDetailsController::class , 'photo']);
    });
//for tags
    Route::prefix('tag')->group(function($routes){
        //tags
        Route::get('/list/{lang}/{rest}' , [TagController::class , 'show']);
        Route::get('/list/{rest}' , [TagController::class , 'showAll']);

        Route::post('/create',[TagController::class , 'create']);
        Route::put('/status' ,[TagController::class , 'status']);
        Route::post('/edit',[TagController::class , 'edit']);
        Route::delete('/delete',[TagController::class , 'delete']);
        Route::get('/show/{id}',[TagController::class , 'showID']);
        //tag_types        
        Route::post('/type',[TagController::class , 'store']);
        Route::get('/type',[TagController::class , 'showTypes']);
        Route::put('/typestatus' , [TagController::class , 'TypeStatus']);

       
    });

    Route::prefix('lang')->group(function($routes){
      
        Route::post('/',[LangugeController::class , 'store']);
        Route::delete('/',[LangugeController::class , 'delete']);
        Route::get('/' , [LangugeController::class ,'show']);
    });

    
    
    Route::prefix('store')->group(function($routes){
        Route::get('/list/{lang}/{type}',[StoreController::class , 'show']);
        Route::post('/', [StoreController::class , 'store']);
        Route::get('/show/{id}',[StoreController::class , 'showID']);
        Route::post('/edit' , [StoreController::class , 'edit']);
        Route::post('/status',[StoreController::class,'status']);
        Route::delete('/',[StoreController::class , 'delete']);
        Route::get('/manager',[StoreController::class , 'manager']);

    });


    Route::prefix('branch')->group(function($routes){
        Route::get('/stores' , [BranchController::class , 'stores']);
        Route::get('/list/{id}',[BranchController::class , 'show']);
        Route::post('/',[BranchController::class , 'store']);
        Route::get('/show/{id}',[BranchController::class , 'showID']);
        Route::post('/edit',[BranchController::class , 'edit']);
        Route::post('/status',[BranchController::class , 'status']);
        Route::delete('/' , [BranchController::class , 'delete']);
        
    });

    
    Route::prefix('settings')->group(function($routes){
        Route::get('/paymnetoptions' , [UtulitiesController::class , 'paymentOptions']);
        Route::post('/currecny' , [UtulitiesController::class , 'addCurrency']);
        Route::post('/payment' ,[UtulitiesController::class , 'addOptions']);
        Route::delete('/curreny' , [UtulitiesController::class , 'destroyCurenncy' ]);
        Route::delete('/paymnet' , [UtulitiesController::class , 'destroyOptions' ]);


    });
    // Route::prefix('roles')->group(function($routes){
    //     Route::get('/',[RoleController::class , 'show']);
    //     Route::post('/',[RoleController::class , 'create']);
    //     Route::post('/edit',[RoleController::class , 'edit']);
    //     Route::delete('/',[RoleController::class , 'destroy']);

    // });
    
});
Route::get('country',[CountryController::class ,'show']);
Route::get('city/{name}' , [CountryController::class , 'cities']);

// //public test APIs
// Route::post('/lang' , [LangugeController::class , 'store']);

// Route::post('/create',[TagController::class , 'create']);
// Route::post('/edit',[TagController::class , 'edit']);
// Route::get('/show/{id}',[TagController::class , 'showID']);

// //for testing #Cavansir//
// Route::get('/list/{lang}/{rest}' , [TagController::class , 'show']);
// Route::post('/cava' , [TagController::class , 'store']); 
// Route::post('/a', [StoreController::class , 'store']);
// Route::get('a/{lang}/{type}',[StoreController::class , 'show']);
Route::get('/list' , [TagController::class , 'showAll']);
Route::get('/show/{id}',[StoreController::class , 'showID']);
Route::post('sch' , [BranchScheduleController::class , 'store']);