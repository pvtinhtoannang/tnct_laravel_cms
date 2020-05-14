<?php
require_once 'tp-web.php';
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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', ['as' => 'GET_ADMIN_DASHBOARD_ROUTE', 'uses' => 'AdminController@getAdminDashboard']);

    //post
    Route::get('/posts/{status?}', ['as' => 'GET_POSTS_ROUTE', 'uses' => 'PostController@index']);

    //create new post
    Route::get('/post/create', ['as' => 'GET_CREATE_POST_ROUTE', 'uses' => 'PostController@getPostEditor']);
    Route::post('/post/create', ['as' => 'POST_CREATE_POST_ROUTE', 'uses' => 'PostController@createPost']);

    //edit post
    Route::get('/post/edit/{id}', ['as' => 'GET_EDIT_POST_ROUTE', 'uses' => 'PostController@getEditPost']);
    Route::post('/post/edit/{id}', ['as' => 'POST_EDIT_POST_ROUTE', 'uses' => 'PostController@updatePost']);

    //trash post
    Route::get('/post/trash/{id}', ['as' => 'GET_ACTION_TRASH_POST_ROUTE', 'uses' => 'PostController@getActionTrashPost']);

    //restore post
    Route::get('/post/restore/{id}', ['as' => 'GET_ACTION_RESTORE_POST_ROUTE', 'uses' => 'PostController@getActionRestorePost']);

    //delete post
    Route::get('/post/delete/{id}', ['as' => 'GET_ACTION_DELETE_POST_ROUTE', 'uses' => 'PostController@getActionDeletePost']);

    //page
    Route::get('/pages/{status?}', ['as' => 'GET_PAGES_ROUTE', 'uses' => 'PageController@index']);

    Route::get('/page/create', ['as' => 'GET_CREATE_PAGE_ROUTE', 'uses' => 'PageController@getPageEditor']);
    Route::post('/page/create', ['as' => 'POST_CREATE_PAGE_ROUTE', 'uses' => 'PageController@createPage']);

    //edit page
    Route::get('/page/edit/{id}', ['as' => 'GET_EDIT_PAGE_ROUTE', 'uses' => 'PageController@getEditPage']);
    Route::post('/page/edit/{id}', ['as' => 'POST_EDIT_PAGE_ROUTE', 'uses' => 'PageController@updatePage']);

    //trash page
    Route::get('/page/trash/{id}', ['as' => 'GET_ACTION_TRASH_PAGE_ROUTE', 'uses' => 'PageController@getActionTrashPage']);

    //restore page
    Route::get('/page/restore/{id}', ['as' => 'GET_ACTION_RESTORE_PAGE_ROUTE', 'uses' => 'PageController@getActionRestorePage']);

    //delete page
    Route::get('/page/delete/{id}', ['as' => 'GET_ACTION_DELETE_PAGE_ROUTE', 'uses' => 'PageController@getActionDeletePage']);

    //upload
    Route::get('/upload', ['as' => 'GET_UPLOAD_ROUTE', 'uses' => 'UploadController@getUpload']);
    Route::get('/upload/new', ['as' => 'GET_UPLOAD_NEW_ROUTE', 'uses' => 'UploadController@getUploadNew']);
    Route::post('/upload/new', ['as' => 'POST_UPLOAD_NEW_ROUTE', 'uses' => 'UploadController@postUploadNew']);

    //category
    Route::get('/category', ['as' => 'GET_CATEGORY_ROUTE', 'uses' => 'CategoryController@getCategory']);
    Route::post('/category', ['as' => 'POST_CATEGORY_ROUTE', 'uses' => 'CategoryController@addCategory']);

    Route::get('/category/edit/{id}', ['as' => 'GET_CATEGORY_EDIT_ROUTE', 'uses' => 'CategoryController@getEditCategory']);
    Route::post('/category/edit/{id}', ['as' => 'POST_CATEGORY_EDIT_ROUTE', 'uses' => 'CategoryController@updateCategory']);


    Route::get('/category/delete/{id}', ['as' => 'CATEGORY_DELETE_ROUTE', 'uses' => 'CategoryController@deleteCategory']);

    //tag
    Route::get('/post_tag', ['as' => 'GET_TAG_ROUTE', 'uses' => 'TagController@getTag']);
    Route::post('/post_tag', ['as' => 'POST_TAG_ROUTE', 'uses' => 'TagController@addTag']);

    //course
    Route::get('/courses/{status?}', ['as' => 'GET_COURSE_ROUTE', 'uses' => 'CourseController@index']);
    Route::get('/course/create', ['as' => 'GET_CREATE_COURSE_ROUTE', 'uses' => 'CourseController@getCourseEditor']);
    Route::post('/course/create', ['as' => 'POST_CREATE_COURSE_ROUTE', 'uses' => 'CourseController@createCourse']);

    //trash course
    Route::get('/course/trash/{id}', ['as' => 'GET_ACTION_TRASH_COURSE_ROUTE', 'uses' => 'CourseController@getActionTrashCourse']);

    //delete course
    Route::get('/course/delete/{id}', ['as' => 'GET_ACTION_DELETE_COURSE_ROUTE', 'uses' => 'CourseController@getActionDeleteCourse']);

    //restore course
    Route::get('/course/restore/{id}', ['as' => 'GET_ACTION_RESTORE_COURSE_ROUTE', 'uses' => 'CourseController@getActionRestoreCourse']);

    //edit course
    Route::get('/course/edit/{id}', ['as' => 'GET_EDIT_COURSE_ROUTE', 'uses' => 'CourseController@getEditCourse']);
    Route::post('/course/edit/{id}', ['as' => 'POST_EDIT_COURSE_ROUTE', 'uses' => 'CourseController@updateCourse']);

    //course cat
    Route::get('/course-cat', ['as' => 'GET_COURSE_CATEGORY_ROUTE', 'uses' => 'CourseCategoryController@getCourseCategory']);
    Route::post('/course-cat', ['as' => 'POST_COURSE_CATEGORY_ROUTE', 'uses' => 'CourseCategoryController@addCourseCategory']);

    //lesson
    Route::get('/lessons/{status?}', ['as' => 'GET_LESSON_ROUTE', 'uses' => 'LessonController@index']);
    Route::get('/lesson/create', ['as' => 'GET_CREATE_LESSON_ROUTE', 'uses' => 'LessonController@getLessonEditor']);
    Route::post('/lesson/create', ['as' => 'POST_CREATE_LESSON_ROUTE', 'uses' => 'LessonController@createLesson']);

    //edit lesson
    Route::get('/lesson/edit/{id}', ['as' => 'GET_EDIT_LESSON_ROUTE', 'uses' => 'LessonController@getEditLesson']);
    Route::post('/lesson/edit/{id}', ['as' => 'POST_EDIT_LESSON_ROUTE', 'uses' => 'LessonController@updateLesson']);

    //ajax
    Route::get('/slug-generator/{slug}', 'AdminAjaxController@slugGenerator');
    Route::get('/post-name-generator/{post_name}', 'AdminAjaxController@postNameGenerator');
    Route::get('/get-attached-file/{id}', 'AdminAjaxController@getAttachedFile');
    Route::get('/get-attachment', 'AdminAjaxController@getAttachment');
});

Route::get('/', 'ThemeController@index');
Route::get('/{slug}', 'ThemeController@type');
