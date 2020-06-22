<?php

namespace app\admin\controller;
use think\Model;
class News extends Base
{
    public function add()
    {
        $cates=model('Cate')->select();
        $viewData=[
            'cates'=>$cates
        ];
        $this->assign($viewData);

    	if(request()->isAjax()){
    		$data=[
    			// 'admin_id'=>input('post.admin_id'),
    			'cate_id'=>input('post.cate_id'),
    			'title'=>input('post.title'),
    			'content'=>input('post.content'),
                'admin_id'=>session('admin.id'),
    		];
    		$result=model('News')->add($data);
    		if($result==1){
    			$this->success('新闻添加成功','admin/news/index');
    		}else{
    			$this->error($result);
    		}
    	}
    	return view();
    }
    public function index()
    {
        $news=model('News')->with('cate')->order('id','desc')->paginate(2);
        //return dump($news); //调试代码
        $viewData=[
            'news'=>$news
        ];
        $this->assign($viewData);
    	return view();
    }
    public function edit()
    {
        if(request()->isAjax()){
            $data=[
                'id'=>input('post.id'),
                'cate_id'=>input('post.cate_id'),
                'title'=>input('post.title'),
                'content'=>input('post.content'),
            ];
            $result=model('News')->edit($data);
            if($result==1){
                $this->success('新闻修改成功','admin/news/index');
            }else{
                $this->error($result);
            }
            }

        $newsInfo=model('News')->find(input('id'));
        $cates=model('Cate')->select();
        $viewData=[
            'cates'=>$cates,
            'newsInfo'=>$newsInfo
        ];
        $this->assign($viewData);
        return view();
        
    }

     public function del()
    {
        $newsInfo=model('News')->find(input('post.id'));
        $result=$newsInfo->delete();
        if($result){
            $this->success('新闻删除成功','admin/news/index');

        }else{
            $this->error('新闻删除失败');
        }
         return view();
    }

     public function hsz()
    {
        
        $news=model('news')->onlyTrashed()->order('id','desc')->paginate(2);
        
        $viewData=[
            'news'=>$news
        ];
        $this->assign($viewData);
        return view();
    }
    public function huifu()
    {   
       $huifu =model('news')->onlyTrashed()->find(input('post.id'));
       $lanmu=model('Cate')->find($huifu['cate_id']);
       $lanmu2=model('Cate')->onlyTrashed()->find($huifu['cate_id']);
       $catename=$lanmu2['catename'];
    if($lanmu){
         
        $result=$huifu->restore();
        if($result==1){
            $this->success('新闻恢复成功','admin/news/index');
        }else{
            $this->error('恢复失败');
        }
    
    }else{
        $this->error('请先恢复"'.$catename.'"栏目');
    }
       
    }
}
