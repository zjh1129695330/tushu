<?php

namespace app\admin\controller;

use think\Controller;

class Login extends Controller
{
    public function login(){

        if(request()->isAjax()){
            $data=[
                'username'=>input('post.username'),
                'password'=>input('post.password'),
                'code'=>input('post.code'),
            ];
            $result=model('Admin') -> login($data);
            if($result==1) {
                $this->success('登陆成功！', 'admin/index/index');
            } else{

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
            return view();
            }

            public function zc()
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
            }
}

