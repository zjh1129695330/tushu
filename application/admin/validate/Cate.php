<?php

namespace app\admin\validate;

use think\Validate;

class Cate extends Validate
{
	protected $rule = [
    'catename|类目名称' => 'require|unique:cate',
  ];

  // protected $message = [];
}
