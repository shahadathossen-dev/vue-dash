<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', 'HomeController@index')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');



Auth::routes(['verify' => true]);


// Routes for Admin Panel...
Route::prefix('admin')->namespace('Backend')->group(function(){
    // Login/Logout Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login.panel');
    Route::post('login', 'Auth\LoginController@login')->name('admin.login');

    // Verification Routes...
    Route::get('verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('admin.verify');
    Route::get('password/create', 'Auth\ResetPasswordController@showPasswordForm')->name('admin.show.password-panel');
    Route::post('password/create', 'Auth\ResetPasswordController@createPassword')->name('admin.create.password');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.resetForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('admin.password.reset');

    Route::middleware('auth:admin')->group(function(){
        Route::get('/', 'HomeController@index')->name('dashboard');
        Route::get('dashboard', 'HomeController@index')->name('admin.home');
        Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');

        //User Section
        Route::prefix('users')->group(function(){
            // Registration Routes...
            Route::get('/', 'UserController@index')->name('admin.users.index');
            Route::get('add', 'UserController@create')->name('admin.users.add');
            Route::post('store', 'UserController@store')->name('admin.users.store');
            Route::get('all', 'UserController@getUsers')->name('admin.users');
            Route::get('datatable', "UserController@dataTable")->name('admin.users.datatable');
            Route::post('get', "UserController@get_user")->name('admin.users.get');
            Route::get('{user}/details', "UserController@view_user")->name('admin.users.details');
            Route::get('{user}/edit', "UserController@edit")->name('admin.users.edit');
            Route::post('update', 'UserController@update')->name('admin.users.update');

            // Password Reset Routes...
            Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
            Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
            Route::get('password/change', 'UserController@showPasswordForm')->name('admin.password.change');
            Route::post('password/change', 'UserController@changePassword')->name('admin.password.update');
        });

        Route::prefix('profile')->group(function(){
            Route::get('/', 'UserController@profile')->name('admin.profile');
            Route::get('edit', 'UserController@editProfile')->name('admin.profile.edit');
            Route::post('update', 'UserController@updateProfile')->name('admin.profile.update');
        });

        // ACL Routes
        Route::group(['middleware' => ['role:Super Admin|Admin']], function () {

            // Users Routes
            Route::get('/users/{user}/remove', "UserController@destroy")->name('admin.users.remove');
            Route::get('/users/{user}/approve', "UserController@approveUser")->name('admin.users.approve');

            Route::namespace('User')->name('admin.')->group(function(){
                 // Roles Routes
                Route::resource('roles', "RolesController")->middleware('permission:manage roles');
                Route::get('/roles/get/all', 'RolesController@roles')->name('roles');
                Route::post('/assignRole', "RolesController@assignRole")->name('roles.assignRole')->middleware('permission:assign roles');
                Route::get('/roles/get/datatable', "RolesController@dataTable")->name('roles.datatable')->middleware('permission:manage roles');

                // Roles Routes
                Route::resource('statuses', "StatusController")->middleware('permission:manage status');
                Route::get('/statuses/get/datatable', "StatusController@dataTable")->name('statuses.datatable')->middleware('permission:manage status');
                Route::get('/statuses/get/all', 'StatusController@statuses')->name('statuses');
                Route::post('/assignStatus', "StatusController@assignStatus")->name('statuses.updateStatus')->middleware('permission:assign status');

                // Permissions Routes
                Route::resource('permissions', "PermissionsController")->middleware('permission:manage permissions');
                Route::get('/permissions/get/all', "PermissionsController@permissions")->name('permissions');
                Route::post('/assignPermissions', "PermissionsController@assignPermissions")->name('assignPermissions')->middleware('permission:assign permissions');
                Route::post('/getUserPermissions', "PermissionsController@getUserPermissions")->name('getUserPermissions')->middleware('permission:manage user-permissions');
                Route::post('/getRolePermissions', "PermissionsController@getRolePermissions")->name('getRolePermissions')->middleware('permission:manage role-permissions');
            });

        });

        Route::prefix('notifications')->name('notifications.')->group(function(){
            Route::get('/', 'NotificationsController@index')->name('panel');
            Route::get('all', 'NotificationsController@getAllNotifications')->name('all');
            Route::get('unread', 'NotificationsController@getUnreadNotifications')->name('unread');
            Route::get('{notification}/delete', 'NotificationsController@delete')->name('delete');
            Route::get('clear', 'NotificationsController@clear')->name('clear');
            Route::get('{notification}/read', 'NotificationsController@markAsRead')->name('mark.read');
            Route::get('read/all', 'NotificationsController@markAllAsRead')->name('read.all');
            Route::get('{notification}/unread', 'NotificationsController@markAsUnread')->name('mark.unread');
            Route::get('unread/all', 'NotificationsController@markAllAsUnread')->name('unread.all');

        });

    });


});

Route::middleware('auth:admin')->group(function(){

    Route::prefix('company')->middleware('permission:manage company-settings')->name('company.')
                            ->namespace('Backend\System')->group(function () {
        // Company Routes
        Route::get('settings', "CompanyController@index")->name('settings');
        Route::get('/', "CompanyController@getSettings")->name('getSettings');
        Route::post('settings', "CompanyController@update")->name('settings.update');
        Route::get('terms&conditions', "CompanyController@termsConditions")->name('terms-conditions');
        Route::get('parivacy-policy', "CompanyController@privacyPolicy")->name('privacy-policy');
    });


});



