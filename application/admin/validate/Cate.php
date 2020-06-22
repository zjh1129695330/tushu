<?php

namespace app\admin\validate;

use think\Validate;

class Cate extends Validate
{

	protected $rule = [
        'catename|栏目名称'=>'require|unique:cate',//必填|检查重复
    ];

    // protected $message = [];
}
