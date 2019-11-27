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
// =================   企业站 后台 ==========================
// 第三方登录
Route::any('/admin/user','admin\LoginController@user');// 微信登录
Route::any('/admin/code','admin\LoginController@code');// 微信登录
//  登陆
Route::any('/admin/login','admin\LoginController@login');// 后台登陆
Route::any('/admin/regist','admin\LoginController@regist');// 后台注册
Route::any('/login/quit','admin\LoginController@quit');// 退出登陆
Route::group(['middleware'=>['CheckLogin']],function(){
    Route::any('/admin/index','rbac\AdminController@index');// 后台首页

    // 管理员 管理
    Route::any('/admin/admin_add','rbac\AdminController@admin_add');// 管理员添加
    Route::any('/admin/admin_index','rbac\AdminController@admin_index');// 管理员展示
    Route::any('/admin/admin_del','rbac\AdminController@admin_del');// 管理员删除
    Route::any('/admin/admin_update','rbac\AdminController@admin_update');// 管理员修改
    Route::any('/admin/reset','rbac\AdminController@reset');// 管理员重置密码

    // 角色 管理
    Route::any('/admin/role_add','rbac\AdminController@role_add');// 角色 添加
    Route::any('/admin/role_index','rbac\AdminController@role_index');// 角色 展示
    // 权限 管理
    Route::any('/admin/right_add','rbac\AdminController@right_add');// 权限 添加
    Route::any('/admin/right_index','rbac\AdminController@right_index');// 权限 展示
    // admin 角色 管理
    Route::any('/admin/admin_role_add','rbac\AdminController@admin_role_add');// admin 角色 添加
    Route::any('/admin/admin_role_index','rbac\AdminController@admin_role_index');// admin 角色 展示
    // 角色权限 管理
    Route::any('/admin/role_right_add','rbac\AdminController@role_right_add');// 角色权限 添加
    Route::any('/admin/role_right_index','rbac\AdminController@role_right_index');// 角色权限 展示


    //导航 管理
    Route::any('/admin/nav_add','admin\NavController@nav_add');// 导航添加
    Route::any('/admin/nav_index','admin\NavController@nav_index');// 导航展示
    Route::any('/admin/nav_del','admin\NavController@nav_del');// 导航删除
    Route::any('/admin/nav_update','admin\NavController@nav_update');// 导航修改

    // 轮播图 管理
    Route::any('/admin/img_add','admin\ImgController@img_add');// 轮播图 添加
    Route::any('/admin/img_index','admin\ImgController@img_index');// 轮播图 展示
    Route::any('/admin/img_del','admin\ImgController@img_del');// 轮播图 删除
    Route::any('/admin/img_update','admin\ImgController@img_update');// 轮播图 修改

    // 分类 管理
    Route::any('/admin/cate_add','admin\CateController@cate_add');// 分类 添加
    Route::any('/admin/cate_index','admin\CateController@cate_index');// 分类 展示
    Route::any('/admin/cate_del','admin\CateController@cate_del');// 分类 删除
    Route::any('/admin/cate_update','admin\CateController@cate_update');// 分类 修改

    // 新闻 管理
    Route::any('/admin/new_add','admin\NewController@new_add');// 新闻 添加
    Route::any('/admin/new_index','admin\NewController@new_index');// 新闻 展示
    Route::any('/admin/new_del','admin\NewController@new_del');// 新闻 删除
    Route::any('/admin/new_update','admin\NewController@new_update');// 新闻 修改
    Route::any('/admin/details','admin\NewController@details');// 新闻 修改
    Route::any('/admin/is_hot','admin\NewController@is_hot');// 新闻 即点即改

    // 产品 管理
    Route::any('/admin/product_add','admin\ProductController@product_add');// 产品 添加
    Route::any('/admin/product_index','admin\ProductController@product_index');// 产品 展示
    Route::any('/admin/product_del','admin\ProductController@product_del');// 产品 删除
    Route::any('/admin/product_update','admin\ProductController@product_update');// 产品 修改

    // 友链 管理
    Route::any('/admin/link_add','admin\LinkController@link_add');// 友链 添加
    Route::any('/admin/link_index','admin\LinkController@link_index');// 友链 展示
    Route::any('/admin/link_del','admin\LinkController@link_del');// 友链 删除
    Route::any('/admin/link_update','admin\LinkController@link_update');// 友链 修改

    // voice 管理
    Route::any('/admin/voice_add','admin\VoiceController@voice_add');// voice 添加
    Route::any('/admin/voice_index','admin\VoiceController@voice_index');// voice 展示
    Route::any('/admin/voice_del','admin\VoiceController@voice_del');// voice 删除
    Route::any('/admin/voice_update','admin\VoiceController@voice_update');// voice 修改
});
// ==============    公司 企业站   =========================
Route::any('/index/index','index\IndexController@index');// 前台首页
Route::any('/index/about','index\AboutController@about');// 关于我们
Route::any('/index/news','index\NewController@new');// 新闻资讯
Route::any('/index/shownews','index\ShowController@show');// 新闻内容
Route::any('/index/jokes','index\JokesController@jokes');// 接口段子
Route::any('/index/video','index\VideoController@video');// 接口视频
Route::any('/index/del_cache','index\VideoController@del_cache');// 接口视频





// =================   api     ============================
Route::any('/user/info','api\UserController@info');// 返回数据
Route::any('/user/token','api\UserController@token');// api 数据
Route::any('/user/aa','api\UserController@aa');// api 数据



