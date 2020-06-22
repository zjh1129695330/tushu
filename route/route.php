<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');


Route::group('admin',function(){
	Route::rule('/','admin/index/index','get');
    Route::rule('login','admin/login/login','get|post');
    Route::rule('zc','admin/login/zhuce','get|post');
    Route::rule('zhuce','admin/login/zc','post');
    Route::rule('logout','admin/login/logout','post');
    Route::rule('cate','admin/cate/index','get|post');
    Route::rule('catesort','admin/cate/sort','get|post');
    Route::rule('cateadd','admin/cate/add','get|post');
    Route::rule('cateedit/[:id]','admin/cate/edit','get|post');
    Route::rule('catedel','admin/cate/del','post');
    Route::rule('catehsz','admin/cate/hsz','get|post');
    Route::rule('catehhuifu','admin/cate/huifu','post');

    Route::rule('news','admin/news/index','get');
    Route::rule('newsadd','admin/news/add','get|post');
    Route::rule('newsedit/[:id]','admin/news/edit','get|post');
    Route::rule('newsdel','admin/news/del','post');
    Route::rule('newshsz','admin/news/hsz','get|post');
    Route::rule('newshhuifu','admin/news/huifu','post');
});
Route::rule('/','index/index/index','get');
Route::rule('/id/[:id]','index/index/index','get');
Route::rule('/show/[:id]','index/index/show','get|post');
Route::rule('index/index/admins/id/[:id]','index/index/admin','get|post');
return [

];
