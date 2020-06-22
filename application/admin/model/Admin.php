<?php

namespace app\admin\model;

use think\Model;
use think\model\concern\SoftDelete;
use app\admin\validate\Admin as validateAdmin;
use app\admin\validate\Zhuce as validateZhuce;
class Admin extends Model
{
    //软删除
    use SoftDelete;
    //管理员登陆
    public function login($data)
    {
        $validate= new validateAdmin();
        if(!$validate->check($data)){
            return $validate->getError();
        }
        //验证通过使用提供的账号密码查询输入表中的数据
        //密码进行md5加密
        $data['password']=md5($data['password']);
        //数据表中没有code字段，去掉
        unset($data['code']);
        //查询数据 获得结果 $this指代当前模型
        $result=$this->where($data)->find();
        if($result) {
            $sessionData = [
                'id' => $result['id'],
            'username' => $result['username'],
                ];
            session('admin',$sessionData);
            return 1;
        }else {
            return '用户表或密码错误！';
        }
    }

    public function add($data)
    {
        $validate= new validateZhuce();
        if(!$validate->check($data)){
            return $validate->getError();
        }
        $data['password']=md5($data['password']);
        unset($data['code']);
        $result1 = $this->allowField(true)->save($data);
        if($result1) {
            $result=$this->where($data)->find();
        if($result) {
            $sessionData = [
                'id' => $result['id'],
            'username' => $result['username'],
                ];
            session('admin',$sessionData);
            return 1;
        }else {
            return '用户表或密码错误！';
        }
            return 1;
        }else{
            return '注册失败！';
        }
    }
}
