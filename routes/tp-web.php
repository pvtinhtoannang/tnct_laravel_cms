<?php

Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
Route::post('login', ['as' => 'postLogin', 'uses' => 'Auth\LoginController@postLogin']);
Route::get('logout', ['as' => 'getLogout', 'uses' => 'Auth\LoginController@logout']);


Route::post('reset-password', 'Auth\ResetPasswordController@postForgotPassword');
Route::get('reset-password/{token}', 'Auth\ResetPasswordController@getForgotPassword');
Route::post('new-reset-password', ['as' => 'postNewPassWordReset', 'uses' => 'Auth\ResetPasswordController@newPassword']);

Route::group(['prefix' => 'admin', 'middleware' => 'user-role'], function () {


    Route::get('list-users', ['as' => 'GET_ALL_USERS', 'uses' => 'UserController@getAllUser']);
    Route::post('add-user', ['as' => 'POST_ADD_USER', 'uses' => 'UserController@addNewUser']);
    Route::get('my-profile', ['as' => 'GET_MY_PROFILE', 'uses' => 'UserController@getMyProfile']);
    Route::post('my-profile', ['as' => 'POST_MY_PROFILE', 'uses' => 'UserController@updateMyProfile']);
    Route::get('login-social-guide', ['as' => 'GET_LOGIN_SOCIAL_GUIDE', 'uses' => 'UserController@getLoginSocialGuide']);


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

    Route::post('update-permission-for-user', ['as' => 'UPDATE_PERMISSION_FOR_USER', 'uses' => 'PermissionController@updatePermissionForUserByIDUser']);
    Route::post('add-group-user', ['as' => 'ADD_GROUP_USER', 'uses' => 'PermissionController@addNewGroup']);
    Route::get('ajax-get-user-by-id/{id}', ['as' => 'GET_USER_BY_ID', 'uses' => 'UserController@getUserByID']);
    Route::post('update-user-by-list', ['as' => 'UPDATE_USER_BY_LIST', 'uses' => 'UserController@updateUserByList']);


    Route::get('nav-menu', ['as' => 'GET_NAV_MENU', 'uses' => 'NavMenuController@getViewNavMenu']);
    Route::get('nav-menu/{id}', ['as' => 'GET_NAV_MENU_BY_ID', 'uses' => 'NavMenuController@getViewNavMenuByID']);
    Route::post('add-postion-nav-menu', ['as' => 'POST_ADD_NEW_MENU_POSITION', 'uses' => 'NavMenuController@addPositionMenu']);

    Route::POST('ajax-update-menu', ['as' => 'UPDATE_MENU_ITEM', 'uses' => 'NavMenuController@updateMenuItem']);
    Route::POST('ajax-add-menu', ['as' => 'ADD_MENU_ITEM', 'uses' => 'NavMenuController@addMenuItem']);

    Route::POST('ajax-save-menu', ['as' => 'POST_SAVE_MENU', 'uses' => 'NavMenuController@saveMenu']);
    Route::POST('ajax-delete-menu-item', ['as' => 'DELETE_MENU_ITEM', 'uses' => 'NavMenuController@deleteMenuItem']);

    Route::get('ajax-get-menu-position/{id}', ['as' => 'GET_MENU_POSITION', 'uses' => 'NavMenuController@getMenuPosition'])->where('id', '[0-9]+');
    Route::POST('ajax-update-postion-menu', ['as' => 'UPDATE_MENU_POSITION_BY_LIST', 'uses' => 'NavMenuController@updateMenuPosition']);

    Route::get('nav-menu', ['as' => 'GET_NAV_MENU', 'uses' => 'NavMenuController@getViewNavMenu']);
    Route::get('nav-menu/{id}', ['as' => 'GET_NAV_MENU_BY_ID', 'uses' => 'NavMenuController@getViewNavMenuByID']);
    Route::post('add-postion-nav-menu', ['as' => 'POST_ADD_NEW_MENU_POSITION', 'uses' => 'NavMenuController@addPositionMenu']);

    Route::POST('ajax-update-menu', ['as' => 'UPDATE_MENU_ITEM', 'uses' => 'NavMenuController@updateMenuItem']);
    Route::POST('ajax-add-menu', ['as' => 'ADD_MENU_ITEM', 'uses' => 'NavMenuController@addMenuItem']);

    Route::POST('ajax-save-menu', ['as' => 'POST_SAVE_MENU', 'uses' => 'NavMenuController@saveMenu']);
    Route::POST('ajax-delete-menu-item', ['as' => 'DELETE_MENU_ITEM', 'uses' => 'NavMenuController@deleteMenuItem']);

    Route::get('ajax-get-menu-position/{id}', ['as' => 'GET_MENU_POSITION', 'uses' => 'NavMenuController@getMenuPosition'])->where('id', '[0-9]+');
    Route::POST('ajax-update-postion-menu', ['as' => 'UPDATE_MENU_POSITION_BY_LIST', 'uses' => 'NavMenuController@updateMenuPosition']);


    Route::get('form/{id}', ['as' => 'GET_FORM_DATA', 'uses' => 'FormController@getFormData'])->where('id', '[0-9]+');
});
Route::post('add-data-form/{id}', ['as' => 'ADD_FORM_DATA', 'uses' => 'FormController@addDataForm'])->where('id', '[0-9]+');
Route::POST('dang-ky', ['as' => 'register', 'uses' => 'Auth\RegisterController@registerForUser']);
Route::get('/auth/{provider}', 'UserController@redirectToProvider');
Route::get('/auth/{provide}/callback', 'UserController@handleProviderCallback');


Route::group(['prefix' => 'tai-khoan'], function () {
    Route::get('/', ['as' => 'GET_MY_ACCOUNT', 'uses' => 'UserController@getMyAccountPage']);
    Route::post('update-password', ['as' => 'UPDATE_PASSWORD', 'uses' => 'UserController@updatePasswordForFrontEnd']);
});

Route::post('ajax-update-permission-post-activity', ['as'=>'UPDATE_ACTIVITY', 'uses'=>'LearningController@updateActivity']);
