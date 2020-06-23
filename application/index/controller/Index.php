<?php


namespace app\index\controller;
use think\Controller;
class Index extends Controller
{
public function index(){
  $cates=model('cate')->paginate(3);
  $viewData=[
            'cates'=>$cates,
        ];
         $this->assign($viewData);
    	return view();
}

public function book(){
  $books=model('book')->with('cate')->where('cate_id',input('id'))->paginate(3);
   $viewData=[
            'books'=>$books,
        ];
         $this->assign($viewData);
  return view();
}

public function show(){
  $books=model('book')->with('cate')->find(input('id'));
$viewData=[
            'books'=>$books,
        ];
         $this->assign($viewData);
  return view();
}
}
