<?php

namespace app\admin\controller;

class Cate extends Base
{
  //类目列表
  public function index()
  {
    $cates = model('Cate')->order('id', 'desc')->paginate(10);
    $viewData = [
      'cates' => $cates
    ];
    $this->assign($viewData);
    return view();
  }

  //类目添加
  public function add()
    {
        if (request()->isAjax()) {
            $data = [
                'catename' => input('post.catename')
            ];
            $result = model('Cate')->add($data);
            if ($result == 1) {
                $this->success('类目添加成功！', 'admin/cate/index');
            } else {
                $this->error($result);
            }
        }
        return view();
    }

  // 类目修改
  public function edit()
  {
    if (request()->isAjax()) {
      $data = [
        'id' => input('post.id'),
        'catename' => input('post.catename'),
      ];
      $result = model('Cate')->edit($data);
      if ($result == 1) {
        $this->success('类目修改成功! ', 'admin/cate/index');
      } else {
        $this->error($result);
      }
    }
    $cateInfo = model('Cate')->find(input('id'));
    $viewData = [
      'cateInfo' => $cateInfo
    ];
    $this->assign($viewData);
    return view();
  }

  // 类目删除
  public function del()
  {
      $data = [
        'id' => input('post.id')
      ];
      $result = model('Cate')->del($data);
      if ($result == 1) {
        $this->success('类目删除成功! ', 'admin\cate');
      } else {
        $this->error($result);
      }
  }

  // 类目回收站
  public function recycle()
  {
    $cates = model('Cate')->onlyTrashed()->order('delete_time', 'desc')->paginate(10);
    $viewData = [
      'cates' => $cates
    ];
    $this->assign($viewData);
    return view();
  }

  // 类目恢复
  public function restore()
  {
    $cateInfo = model('Cate')->onlyTrashed()->find(input('post.id'));
    $result = $cateInfo->restore();
    if ($result) {
      $this->success('类目恢复成功! ', 'admin/cate/recycle');
    } else {
      $this->error('类目恢复失败! ');
    }
  }
}
