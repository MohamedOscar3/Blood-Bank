<?php

use App\BloodType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Route;

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
Route::prefix('v1')->namespace('api\v1')->name('api.v1.')->group(function () {
    //get the governote for cities

    Route::get('governorate','GovernorateController@index')->name('governorate');

    //get the cities
    Route::get('city/{id}','CityController@index')->name('city');


    //get bloodTypes
    Route::Get('blood_types',function () {
        return responseJson('1','all blood types',BloodType::select('type_name')->get());
    });

    
    //register
    Route::post('register','ClientController@store')->name('register');

    //login
    Route::Post('login','ClientController@login')->name('login');

    // make the routes for all the things that reqire login 

    Route::middleware('auth:api')->group(function () {
        // get cataigory 
        Route::get('category','CategoryController@index');
        


        //show the posts
        Route::apiResource('post','PostController')->only('index','show');
        
        //Show the favorite Post
        Route::get('favorite','PostController@favoritePosts');
        
        

        
        //toggle fav
        Route::post('togglefavorite/{post_id}','FavoriteController@toggle');
     

        //donation routees
        Route::apiResource('donation','DonationController')->except('destroy','update');
        
        //open notification 
        Route::apiResource('notification','NotificationController')->only('index','show');
        

            //get the target fav
            Route::Get('/target','NotificationController@getTarget');

        // get the cities and the blood_types  
          Route::post('/target','NotificationController@target');
               
    


          //send all unreading notification 
          Route::get('unreading','NotificationController@count_unreading');
        
        
            
            
        
        
        Route::fallback(function () {
            return new Resource(['not found']);
        });
        
        
    });
});

    



    
    




