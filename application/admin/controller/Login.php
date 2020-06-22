<?php

namespace app\admin\controller;

use think\Controller;

class Login extends Controller
{
    public function login()
  {
    if (request()->isAjax()) { //如果是ajax请求
        // 使用$data保存所有提交的数据
        $data = [
            'username' => input('post.username'), //字段名 -> 接收的数据
            'password' => input('post.password'),
            'code' => input('post.code'),
        ];
        // 调用模型进行具体操作，将数据传给模型，并获取处理结果
        $result = model('Admin')->login($data);
        if ($result == 1) {
            // 结果为1，登录成功，返回成功信息
            $this->success('登录成功!', 'admin/index/index');
        } else {
            // 登录失败，返回错误信息，直接使用$result中传递回来的错误信息
            $this->error($result);
        }
    }
    return view();
  }


        public function logout()
        {
            session(null);
            if(session('?admin.id')){
                $this->error('注销失败');
            }else{

                $this->success('注销成功！','admin/login/login');
            }
        }
         public function zhuce()
        {
             if(request()->isAjax()){
                    if(input('post.password')==input('post.password1')){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'code'=>input('post.code'),
            ];
            $result=model('Admin')->add($data);
            if($result==1){
                $this->success('注册成功','admin/index/index');
            }else{
                $this->error($result);
            }
            }else{
                $this->error('两次输入的密码不一样或者再次输入密码为空');
            }
        }
            return view();
            }
}

