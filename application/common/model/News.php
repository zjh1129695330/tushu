<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;
use app\admin\validate\News as validateNews;
class News extends Model
{
    //
    use SoftDelete;
     public function add($data)
    {
    	$validate= new validateNews();
    	if(!$validate->check($data)){
    	return $validate->getError();
    	}
    	$result = $this->allowField(true)->save($data);
    	if($result){
    		return 1;
    	}else{
    		return '新闻添加失败！';
    	}
    }

   public function cate()
   {
    return $this->belongsTo('cate','cate_id','id');
   }
   // public function admin()
   // {
   //  return $this->belongsTo('app\admin\model\Admin','admin_id','id');
   // }
   public function admin()
   {
    return $this->belongsTo('admin','admin_id','id');
   }
   public function edit($data)
   {
    $validate= new validateNews();
        if(!$validate->check($data)){
        return $validate->getError();
        }//验证器正确继续执行错误返回错误
        $newsInfo=$this->find($data['id']);//查找对应的id

    $newsInfo->cate_id=$data['cate_id'];//修改
    $newsInfo->title=$data['title'];//修改
    $newsInfo->content=$data['content'];//修改

    $result=$newsInfo->save();//执行
    if ($result) {
        return 1;//如果执行成功返回1
    }else{
        return'新闻修改失败';//否则返回栏目修改失败
    }
   }
}
