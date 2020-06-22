<?php

namespace app\admin\validate;

use think\Validate;

class Sort extends Validate
{

	protected $rule = [
        'sort|栏目排序'=>'require',//必填|检查重复
    ];

    // protected $message = [];
}
