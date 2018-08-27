<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('roles', 'RolesController', ['except' => ['create', 'edit']]);

        Route::resource('users', 'UsersController', ['except' => ['create', 'edit']]);

        Route::resource('permissions_managments', 'PermissionsManagmentsController', ['except' => ['create', 'edit']]);

        Route::resource('leaves', 'LeavesController', ['except' => ['create', 'edit']]);

});
