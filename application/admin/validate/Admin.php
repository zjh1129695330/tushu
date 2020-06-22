<?php 
namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
	protected $rule = [
	    'username|账号'=>'require',
        'password|密码'=>'require',
        'code|验证码'=>'require|captcha',
    ];
    

//    protected $message = [];
}
