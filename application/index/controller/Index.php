<?php


namespace app\index\controller;
use think\Controller;
class Index extends Controller
{
    //前台首页(新闻列表)
public function index(){
	//自己做的
     //    $news=model('News')->with('cate')->order('id','desc')->paginate(3);
     //    $cates=model('Cate')->select();
     //    $catesid=model('Cate')->find(input('id'));
     //    $newsid=model('News')->with('cate')->order('id','desc')->where('cate_id',input('id'))->paginate();
     //    $id=input('id',0);
     //    $viewData=[
     //        'news'=>$news,
     //        'cates'=>$cates,
     //        'id'=>$id,
     //        'catesid'=>$catesid,
     //        'newsid'=>$newsid
     //    ];
     //    $this->assign($viewData);
    	// return view();


      //老师的
      $where=[];
      if(input('?id')){
      	$where=[
      		'cate_id'=>input('id')
      	];
      	// $where[]=['cate_id','=',input('id')];
      	// $where['cate_id']=input('id');
      }
      $news=model('News')->with('cate')->where($where)->order('id','desc')->paginate(3);
        $cates=model('Cate')->select();
        $viewData=[
            'news'=>$news,
            'cates'=>$cates,
            'cateid'=>input('id',0),
        ];
        $this->assign($viewData);
    	return view();
}
//新闻内容页
public function show(){
      	$where=[
      		'cate_id'=>input('id')
      	];
	$news=model('News')->with(['cate','admin'])->find($where);
        $cates=model('Cate')->select();
        $viewData=[
            'news'=>$news,
            'cates'=>$cates,
            'cateid'=>input('id',0),
        ];
        $this->assign($viewData);
return view();
}
public function admin(){
      	$where=[
          'id'=>input('id')
        ];
        $admin=model('Admin')->find($where);
  $news=model('news')->with(['admin','Cate'])->where('admin_id',input('id'))->order('id','desc')->paginate(3);
        $viewData=[
            'adminid'=>input('id',0),
            'news'=>$news,
            'admin'=>$admin,
        ];
        $this->assign($viewData);
return view();
	}
}
