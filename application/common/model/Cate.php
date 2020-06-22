<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;
use app\admin\validate\Cate as validateCate;
use app\admin\validate\Sort as validateSort;
class Cate extends Model
{   //软删除
    use SoftDelete;

    //栏目添加
    public function add($data)
    {
    	$validate= new validateCate();
    	if(!$validate->check($data)){
    	return $validate->getError();
    	}
    	$result = $this->allowField(true)->save($data);
    	if($result){
    		return 1;
    	}else{
    		return '栏目添加失败！';
    	}
    }
public function edit($data)
{
    $validate=new validateCate();
    if(!$validate->check($data)){
        return $validate->getError();
    }
    $cateInfo=$this->find($data['id']);
    $cateInfo->catename=$data['catename'];
    $result=$cateInfo->save();
    if ($result) {
        return 1;
    }else{
        return'栏目修改失败';
    }
}
   
   public function news()
   {
    return $this->hasMany('news','cate_id','id');
   }

   public function del($data)
   {
    // $NewsInfo=model('news')->where('cate_id',$data['id'])->find();
    $NewsInfo=model('news')->getByCateId($data['id']);
    if($NewsInfo){
            return'有新闻信息此栏目无法删除';
    }else{
    $cateInfo=$this->find($data);
    $result=$cateInfo->together('news')->delete();

    if($result){
    return 1;
    }else{
    return'栏目删除失败';
    }
    }
    
   }

    public function sort($data)
    {
    $validate=new validateSort();
    if(!$validate->check($data)){
        return $validate->getError();
    }
    $cateInfo=$this->find($data['id']);
    $cateInfo->sort=$data['sort'];
    $result=$cateInfo->save();
    if ($result) {
        return 1;
    }else{
        return'排序修改失败';
    }
    }
}
