<?php 
namespace app\admin\validate;

use think\Validate;

class Zhuce extends Validate
{
	protected $rule = [
	    'username|账号'=>'require|unique:Admin',
        'password|密码'=>'require',
        'code|验证码'=>'require|captcha',
    ];
    

//    protected $message = [];
}
