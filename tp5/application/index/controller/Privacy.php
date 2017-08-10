<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;
use think\Cookie;

// use Think;
//  extends controller
class Privacy
{
    function privacy(){
        $view=new View();
        return $view->fetch('index/privacy');
    }
}
