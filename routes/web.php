<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');



// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');


Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('permissions_managments', 'Admin\PermissionsManagmentsController');
    Route::post('permissions_managments_mass_destroy', ['uses' => 'Admin\PermissionsManagmentsController@massDestroy', 'as' => 'permissions_managments.mass_destroy']);
    Route::post('permissions_managments_restore/{id}', ['uses' => 'Admin\PermissionsManagmentsController@restore', 'as' => 'permissions_managments.restore']);
    Route::delete('permissions_managments_perma_del/{id}', ['uses' => 'Admin\PermissionsManagmentsController@perma_del', 'as' => 'permissions_managments.perma_del']);
    Route::resource('leaves', 'Admin\LeavesController');
    Route::post('leaves_mass_destroy', ['uses' => 'Admin\LeavesController@massDestroy', 'as' => 'leaves.mass_destroy']);
    Route::post('leaves_restore/{id}', ['uses' => 'Admin\LeavesController@restore', 'as' => 'leaves.restore']);
    Route::delete('leaves_perma_del/{id}', ['uses' => 'Admin\LeavesController@perma_del', 'as' => 'leaves.perma_del']);

    Route::resource('presence', 'Admin\PresenceController');
    Route::post('presence_mass_destroy', ['uses' => 'Admin\PresenceController@massDestroy', 'as' => 'presence.mass_destroy']);
    Route::post('presence_restore/{id}', ['uses' => 'Admin\PresenceController@restore', 'as' => 'presence.restore']);
    Route::delete('presence_perma_del/{id}', ['uses' => 'Admin\PresenceController@perma_del', 'as' => 'presence.perma_del']);




 
});

Route::group(['middleware' => ['auth'], 'prefix' => 'employee', 'as' => 'employee.'], function () {

    Route::resource('leaves', 'LeaveController');
    Route::resource('permissions', 'PermissionController');

});