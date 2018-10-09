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

Route::get('/', function () {
    return view('welcome');
});

//加载登录模板
Route::any('login','Admin\LoginController@login');

//执行登录
Route::any('loginDo','Admin\LoginController@loginDo');

//加载首页
Route::any('/','Admin\IndexController@index');

//管理员列表展示
Route::any('admins','Admin\AdminController@admin');

//管理员列表展示
Route::any('adminadd','Admin\AdminController@adminAdd');

//管理员添加
Route::any('admindo','Admin\AdminController@adminDo');

//展示管理员数据
Route::any('adminlist','Admin\AdminController@adminList');

//管理员数据删除
Route::any('admindel','Admin\AdminController@adminDel');

//管理员数据编辑
Route::any('adminupdata','Admin\AdminController@adminUpdata');

//管理员数据编辑
Route::any('adminup','Admin\AdminController@adminUp');

//展示权限节点
Route::any('right','Admin\RightController@right');

//展示权限节点列表
Route::any('rightlist','Admin\RightController@rightList');

//权限节点添加模板
Route::any('rightadd','Admin\RightController@rightAdd');


