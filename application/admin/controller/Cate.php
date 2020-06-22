<?php

namespace app\admin\controller;
class Cate extends Base
{
    public function add()
    {
    	if(request()->isAjax()){
    		$data=[
    			'catename'=>input('post.catename')
    		];
    		$result=model('Cate')->add($data);
    		if($result==1){
    			$this->success('栏目添加成功','admin/cate/index');
    		}else{
    			$this->error($result);
    		}
    	}
    	return view();
    }
    public function index()
    {   
        $cates=model('Cate')->order('sort','asc')->paginate(6);
        $viewData=[
            'cates'=>$cates,
        ];
        $this->assign($viewData);
        return view();
    }
    public function edit()
    {
        if(request()->isAjax()){
            $data=[
            'id'=>input('post.id'),
            'catename'=>input('post.catename'),
        ];
        $result=model('Cate')->edit($data);
        if($result==1){
            $this->success('栏目修改成功','admin/cate/index');

        }else{
            $this->error($result);
        }
        }
        $cateInfo=model('Cate')->find(input('id'));
        $viewData=[
            'cateInfo'=>$cateInfo
        ];
        $this->assign($viewData);
        return view();
    }
     public function del()
    {
        if(config('del_mode')){
        //连接删除
        $cateInfo=model('Cate')->with('news')->find(input('post.id'));
        $result=$cateInfo->together('news')->delete();
        if($result){
            $this->success('栏目删除成功','admin/cate/index');
        }else{
            $this->error('栏目删除失败');
        }
        }else{
        //阻止删除
        $data=[
            'id'=>input('post.id'),
        ];
        $result=model('cate')->del($data);
        if($result==1){
            $this->success('栏目删除成功','admin/cate/index');
        }else{
            $this->error($result);
        }
        }
    }

    public function hsz()
    {
        
        $cates=model('Cate')->onlyTrashed()->order('delete_time','desc')->paginate(2);
        $viewData=[
            'cates'=>$cates
        ];
        $this->assign($viewData);
        return view();
    }
    public function huifu()
    {
        $huifu =model('Cate')->onlyTrashed()->find(input('post.id'));
        $result=$huifu->restore();
        if($result==1){
            $this->success('栏目恢复成功','admin/cate/index');
        }else{
            $this->error($result);
        }
    }

    public function sort()
    {
        if(request()->isAjax()){
            $data=[
            'id'=>input('post.id'),
            'sort'=>input('post.sort'),
        ];
         $result=model('Cate')->sort($data);
        if($result==1){
            $this->success('修改栏目排序成功','admin/cate/index');

        }else{
            $this->error($result);
        }
        }
    }
}
