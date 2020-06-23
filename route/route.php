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
    Route::rule('logout','admin/login/logout','post');
    
    Route::rule('cate', 'admin/cate/index', 'get');
    Route::rule('cateadd', 'admin/cate/add', 'get|post');
    Route::rule('cateedit/[:id]', 'admin/cate/edit', 'get|post');
    Route::rule('catedel', 'admin/cate/del', 'post');
    Route::rule('caterecycle', 'admin/cate/recycle', 'get');
    Route::rule('caterestore', 'admin/cate/restore', 'post');


    Route::rule('book/[:id]','admin/book/index','get|post');
    Route::rule('bookadd/id/[:id]','admin/book/add','get|post');
    Route::rule('bookedit/[:id]','admin/book/edit','get|post');
    Route::rule('bookdel','admin/book/del','post');
    Route::rule('bookhsz/[:id]','admin/book/hsz','get|post');
    Route::rule('bookhhuifu','admin/book/huifu','post');
    Route::rule('booksousuo','admin/book/sousuo','get|post');
    Route::rule('booksousuoxs/[:text]','admin/book/sousuoxs','get|post');
});
Route::rule('/','index/index/index','get');
Route::rule('book/id/[:id]','index/index/book','get');
Route::rule('/show/[:id]','index/index/show','get|post');
return [

];
