<?php

namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
    protected function initialize()
    {
        if(!session('?admin.id')){
          $this->redirect('admin/login/login');
        }
    }
}
