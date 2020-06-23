<?php

namespace app\admin\controller;
use think\Model;
class Book extends Base
{
    public function add()
    {
        if(request()->isAjax()){
            $data=[
                'cate_id'=>input('post.cate_id'),
                'title'=>input('post.title'),
                'content'=>input('post.content'),
            ];
            $id=input('post.cate_id');
            $result=model('book')->add($data);
            if($result==1){
                $this->success('图书成功',"admin/book/$id");
            }else{
                $this->error($result);
            }
            }

        $cates=model('cate')->where('id',input('id'))->find();
         $viewData = [
      'cates' => $cates,
    ];
    $this->assign($viewData);
    	return view();
    }
    public function index()
    {
        $books=model('book')->with('cate')->order('id', 'desc')->where('cate_id',input('id'))->paginate(10);
        $viewData = [
      'books' => $books,
      'id'=>input('id'),
    ];
     $this->assign($viewData);
    	return view();
    }
    public function edit()
    {
        if(request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'title'=>input('post.title'),
                'content'=>input('post.content'),
            ];
            $result=model('book')->edit($data);
            $id=input('post.cate_id');
            if($result==1){
                $this->success('图书修改成功',"admin/book/$id");
            }else{
                $this->error($result);
            }
            }
            $books=model('book')->find(input('id'));
            $viewData = [
      'books' => $books,
      'id'=>input('id'),
    ];
     $this->assign($viewData);
        return view();
        
    }

     public function del()
    {
        $bookInfo=model('book')->find(input('post.id'));
        $id=$bookInfo['cate_id'];
        $result=$bookInfo->delete();

        if($result){
            $this->success('图书删除成功',"admin/book/$id");
        }else{
            $this->error('图书删除失败');
        }
         return view();
    }

     public function hsz()
    {
        
        $books=model('book')->onlyTrashed()->order('id','desc')->where('cate_id',input('id'))->paginate(2);
        $viewData=[
            'books'=>$books,
            'id'=>input('id'),
        ];
        $this->assign($viewData);
        return view();
    }
    public function huifu()
    {   
       $huifu =model('book')->onlyTrashed()->find(input('post.id'));
       $cateid=$huifu['cate_id'];
       $lanmu=model('Cate')->find($huifu['cate_id']);
       $lanmu2=model('Cate')->onlyTrashed()->find($huifu['cate_id']);
       $catename=$lanmu2['catename'];
    if($lanmu){
         
        $result=$huifu->restore();
        if($result==1){
            $this->success('图书恢复成功',"admin/book/$cateid");
        }else{
            $this->error('恢复失败');
        }
    
    }else{
        $this->error('请先恢复"'.$catename.'"类目');
    }
       
    }

    public function sousuo()
    {
        $text=input('post.text');
         $this->success('正在跳转页面请稍后...',"booksousuoxs/$text");
    }
    public function sousuoxs(){
        $text=input('text');
         $books=model('book')->with('cate')->where('title','like','%'.$text.'%')->order('id','desc')->paginate(3);
         $viewData=[
            'books'=>$books,
        ];
        $this->assign($viewData);
        return view();
    }
}
