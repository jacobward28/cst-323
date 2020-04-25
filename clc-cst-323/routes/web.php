<?php

use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */



//Default Laravel home page
Route::get('/', function () {
    return view('home');
});
    
    //Login form page
    Route::get('/Login', function () {
        return view('login');
    });
        
        //Submits form data from login form to login controller
        Route::post('/loginHandler', 'LoginController@index');
        
        //Registration form page
        Route::get('/Register', function () {
            return view('register');
        });
            
            //Form for creating a new Product posting
            Route::get('/createProduct', function() {
                return view('createProduct');
            })->middleware('admin');
            
                        //Gets Product data from the database and sends it to the Product view
            Route::get('/Products', 'ProductController@index');

            //Submits form data to Product controller to create new Product entry
            Route::post('/newProductHandler', 'ProductAdminController@createProduct');
            
            //Gets Product data from the database and sends it to the Product view
            Route::get('/ProductAdmin', 'ProductAdminController@index');
            
            //Submits form data from edit form to the controller
            Route::post('/ProductEditHandler', 'ProductAdminController@editProduct');
            
            //Submits the id of the Product to be removed to the controller
            Route::post('/ProductRemoveHandler', 'ProductAdminController@removeProduct');
            
            // Submits form data from registration form to registration controller
            Route::post('/registrationHandler', 'RegistrationController@index');
            
            //Loads the user admin page after going through the admin controller and getting all user data
            Route::get('/userAdmin', 'UserAdminController@index');
            
            //Submits form data from editing a user to the controller
            Route::post('/userEditHandler', 'UserAdminController@editUser');
            
            //Submits form data from the user admin page to the controller so that a user can be deleted
            Route::post('/userRemoveHandler', 'UserAdminController@removeUser');
            
            //Goes to the signout controller method to flush the current session data so that the user is signed out
            Route::get('/SignOut', 'SignOutController@index');
            
           