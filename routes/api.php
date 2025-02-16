<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Time Entries
    Route::apiResource('time-entries', 'TimeEntriesApiController');
});

Route::middleware('api')->group(function () {
    Route::post('/login', 'Admin\ListingController@login');
    Route::get('/listing', 'Admin\ListingController@listing');
});
