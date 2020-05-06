<?php

Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
Route::post('login', ['as' => 'postLogin', 'uses' => 'Auth\LoginController@postLogin']);
Route::get('logout', ['as' => 'getLogout', 'uses' => 'Auth\LoginController@logout']);


Route::post('reset-password', 'Auth\ResetPasswordController@sendMail');
Route::put('reset-password/{token}', 'Auth\ResetPasswordController@reset');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('list-users',['as'=>'GET_ALL_USERS', 'uses'=>'UserController@getAllUser']);
    Route::post('add-user',['as'=>'POST_ADD_USER', 'uses'=>'UserController@addNewUser']);
    Route::get('my-profile', ['as' => 'GET_MY_PROFILE', 'uses' => 'UserController@getMyProfile']);
    Route::post('my-profile', ['as' => 'POST_MY_PROFILE', 'uses' => 'UserController@updateMyProfile']);
    Route::get('options-general', ['as' => 'GET_OPTION_GENERAL', 'uses' => 'OptionController@getOptionGeneral']);
    Route::post('options-general', ['as' => 'POST_OPTION_GENERAL', 'uses' => 'OptionController@postUpdateOptionGeneral']);
    Route::post('add-options-general', ['as' => 'ADD_OPTION_GENERAL', 'uses' => 'OptionController@postAddOptionGeneral']);
    Route::get('permissions-settings', ['as' => 'GET_PERMISSION_SETTINGS', 'uses' => 'PermissionController@getPermission']);
    Route::post('add-permissions-settings', ['as' => 'ADD_PERMISSION_SETTINGS', 'uses' => 'PermissionController@addPermission']);

    Route::get('ajax-permission-by-id/{id}', ['as' => 'GET_PERMISSION_BY_ID', 'uses' => 'PermissionController@getPermissionByID']);
    Route::post('update-permissions-settings', ['as' => 'UPDATE_PERMISSION_SETTINGS', 'uses' => 'PermissionController@updatePermissionByID']);

//    Route::post('update-permission-for-role/{role-id}', ['as' => 'UPDATE_PERMISSION_FOR_ROLE', 'uses' => 'PermissionController@updatePermissionForRole'])->where('id', '[0-9]+');
    Route::post('update-permission-for-role', ['as' => 'UPDATE_PERMISSION_FOR_ROLE', 'uses' => 'PermissionController@updatePermissionForRole']);
    Route::get('ajax-permission-by-role/{role_id}', ['as' => 'GET_PERMISSION_BY_ROLE', 'uses' => 'PermissionController@getPermissionByRole'])->where('id', '[0-9]+');
    Route::get('ajax-permission-by-user/{user_id}', ['as' => 'GET_PERMISSION_BY_USER', 'uses' => 'PermissionController@getPermissionByUser'])->where('id', '[0-9]+');
    Route::get('ajax-update-permission-by-user/{user_id}', ['as' => 'UPDATE_PERMISSION_BY_USER', 'uses' => 'PermissionController@updatePermissionForUser'])->where('id', '[0-9]+');

    Route::post('update-permission-for-user', ['as' => 'UPDATE_PERMISSION_FOR_USER', 'uses'=>'PermissionController@updatePermissionForUserByIDUser']);
    Route::post('add-group-user', ['as' => 'ADD_GROUP_USER', 'uses'=>'PermissionController@addNewGroup']);
    Route::get('ajax-get-user-by-id/{id}', ['as' => 'GET_USER_BY_ID', 'uses'=>'UserController@getUserByID']);
    Route::post('update-user-by-list', ['as' => 'UPDATE_USER_BY_LIST', 'uses'=>'UserController@updateUserByList']);

    Route::get('nav-menu', ['as' => 'GET_NAV_MENU', 'uses'=>'NavMenuController@getViewNavMenu']);
    Route::post('add-postion-nav-menu', ['as' => 'POST_ADD_NEW_MENU_POSITION', 'uses'=>'NavMenuController@addPositionMenu']);

    Route::POST('ajax-update-menu', ['as' => 'UPDATE_MENU_ITEM' , 'uses'=> 'NavMenuController@updateMenuItem']);
    Route::POST('ajax-add-menu', ['as' => 'ADD_MENU_ITEM' , 'uses'=> 'NavMenuController@addMenuItem']);

});





