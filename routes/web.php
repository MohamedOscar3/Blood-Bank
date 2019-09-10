<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Permission;
use Illuminate\Http\Request;

Route::get('/',function() {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);


Route::middleware('auth')->group(function () {
    Route::get('dashboard',function () {
         return view('index');
    })->name('dashboard');


    Route::resource('user', 'UserController')->except('show','edit','create');
    Route::get('profile','UserController@show')->name('profile');
    Route::post('update_image','UserController@update_image')->name('profile_update');
    Route::resource('role', 'RoleController')->except('show','edit','create');

    Route::middleware('role:admin')->name('permission')->post('permission',function (Request $request) {
        
        
        $validate = $request->validate([
            
            'name' => 'required|max:255|unique:permissions',
            'display_name' => 'required|max:255',
            'description' => 'max:255',
        ]);

        if ($validate) {
            Permission::create($validate);
            return back()->with('msg','permission have been created successfuly');
        } else {
            return back()->with('errors');
        }
    });

    Route::resource('post', 'PostController');
    Route::post('post/image','PostController@storeImage')->name('post/image');
    
    Route::resource('config', 'ConfigController')->only('edit','update');

    Route::resource('governorate', 'GovernorateController')->only('index','store','update','destroy')->middleware('role:admin');
    Route::resource('city', 'CityController')->only('index','store','update','destroy')->middleware('role:admin');
    
});