<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');
Route::post('logout', 'LoginController@logout');

Route::get('/', 'IndexController@index');

 
Route::get('index', ['as' => 'admin.index', 'uses' => function () {
    return redirect('/admin/log-viewer');
}]);
 

Route::group(['middleware' => ['auth:admin', 'menu', 'authAdmin']], function () {

    //权限管理路由
    Route::get('permission/{cid}/create', ['as' => 'admin.permission.create', 'uses' => 'PermissionController@create']);
    Route::get('permission/manage', ['as' => 'admin.permission.manage', 'uses' => 'PermissionController@index']);
    Route::get('permission/{cid?}', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']);
    Route::post('permission/index', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']); //查询
    Route::resource('permission', 'PermissionController', ['names' => ['update' => 'admin.permission.edit', 'store' => 'admin.permission.create']]);


    //角色管理路由
    Route::get('role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::post('role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::resource('role', 'RoleController', ['names' => ['update' => 'admin.role.edit', 'store' => 'admin.role.create']]);


    //用户管理路由
    Route::get('user/index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);  //用户管理
    Route::post('user/index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);
    Route::resource('user', 'UserController', ['names' => ['update' => 'admin.role.edit', 'store' => 'admin.role.create']]);

    //任务理路由
    Route::get('task/index', ['as' => 'admin.task.index', 'uses' => 'TaskController@index']);
    Route::post('task/index', ['as' => 'admin.task.index', 'uses' => 'TaskController@index']);
    Route::resource('task', 'TaskController', ['names' => ['update' => 'admin.task.edit', 'store' => 'admin.task.create']]);
    //消息管理路由
    Route::get('information/index', ['as' => 'admin.information.index', 'uses' => 'InformationController@index']);
    Route::post('information/index', ['as' => 'admin.information.index', 'uses' => 'InformationController@index']);
    Route::resource('information', 'InformationController', ['names' => ['update' => 'admin.information.edit', 'store' => 'admin.information.create']]);

    //曝光管理路由
    Route::get('exposure/index', ['as' => 'admin.exposure.index', 'uses' => 'ExposureController@index']);
    Route::post('exposure/index', ['as' => 'admin.exposure.index', 'uses' => 'ExposureController@index']);
    Route::resource('exposure', 'ExposureController', ['names' => ['update' => 'admin.exposure.edit', 'store' => 'admin.exposure.create']]);


    //角色管理路由
    Route::get('target/index', ['as' => 'admin.target.index', 'uses' => 'TargetController@index']);
    Route::post('target/index', ['as' => 'admin.target.index', 'uses' => 'TargetController@index']);
    Route::resource('target', 'TargetController', ['names' => ['update' => 'admin.target.edit', 'store' => 'admin.target.create']]);
    //检查管理路由
    Route::any('check/{id}/feedbacksave', ['as' => 'admin.check.index', 'uses' => 'CheckController@feedbacksave']);
    Route::get('check/{id}/feedback', ['as' => 'admin.check.feedback', 'uses' => 'CheckController@feedback']);

 Route::get('keshihua', [  'uses' => 'CheckController@keshihua']);

    Route::any('check/maptypeajax', ['as' => 'admin.check.map', 'uses' => 'CheckController@maptypeajax']);
    Route::any('check/maptype', ['as' => 'admin.check.map', 'uses' => 'CheckController@maptype']);
    
    



    Route::any('check/map', ['as' => 'admin.check.map', 'uses' => 'CheckController@checkmap']);
    Route::get('check/index', ['as' => 'admin.check.index', 'uses' => 'CheckController@index']);
    Route::post('check/index', ['as' => 'admin.check.index', 'uses' => 'CheckController@index']);
    Route::resource('check', 'CheckController', ['names' => ['update' => 'admin.check.edit', 'store' => 'admin.check.create', 'feedbacksave' => 'admin.check.feedback']]);
    Route::any('check1/index', ['as' => 'admin.check1.index', 'uses' => 'CheckController@index1']);
    Route::any('check2/index', ['as' => 'admin.check2.index', 'uses' => 'CheckController@index2']);
    Route::any('check3/index', ['as' => 'admin.check3.index', 'uses' => 'CheckController@index3']);
    Route::any('check4/index', ['as' => 'admin.check4.index', 'uses' => 'CheckController@index4']);

    Route::any('feedback/index', ['as' => 'admin.feedback.index', 'uses' => 'CheckController@feedbackindex']);
    Route::any('expired/index', ['as' => 'admin.expired.index', 'uses' => 'CheckController@expiredindex']);
 
//subitems 'admin.feedback.index', '整改进度
//打分项目管理路由
    Route::get('subitem/index', ['as' => 'admin.subitem.index', 'uses' => 'SubitemController@index']);
    Route::post('subitem/index', ['as' => 'admin.subitem.index', 'uses' => 'SubitemController@index']);
    Route::resource('subitem', 'SubitemController', ['names' => ['update' => 'admin.subitem.edit', 'store' => 'admin.subitem.create']]);



});

Route::get('/', function () {
    return redirect('/admin/index');
});

