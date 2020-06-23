<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;
use app\admin\validate\Cate as validateCate;

class Cate extends Model
{
	// 软删除
	use SoftDelete;

  // 关联新闻表
  public function book()
  {
    return $this->hasMany('book');
  }

  //栏目添加
  public function add($data)
  {
  	$validate = new validateCate();
  	if (!$validate->check($data)) {
  		return $validate->getError();
  	}
  	$result = $this->allowField(true)->save($data);
  	if ($result) {
  		return 1;
  	} else {
  		return '栏目添加失败! ';
  	}
  }

  // 栏目修改
  public function edit($data)
  {
    $validate = new validateCate();
    if (!$validate->check($data)) {
      return $validate->getError();
    }
    $cateInfo = $this->find($data['id']);
    $cateInfo->catename = $data['catename'];
    $result = $cateInfo->save();
    if ($result) {
      return 1;
    } else {
      return '栏目修改失败! ';
    }
  }

  // 栏目删除
  public function del($data)
  {
    $bookInfo = model('book')->where('cate_id', $data['id'])->find();
    if ($bookInfo) {
      return '此栏目还有书籍，不能删除! ';
    } else {
      $cateInfo = $this->find($data['id']);
      $result = $cateInfo->delete();
      if ($result) {
        return 1;
      } else {
        return '栏目删除失败! ';
      }
    }
  }
}
