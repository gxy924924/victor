<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;

// use Think;
//  extends controller
class Index extends Controller{   
    function __construct(){
        parent::__construct();
    }
    //视图部分----------------------------------------------------
    //主页跳转（防止出现url地址解析错误）
    public function index(){
        $view=new View();
        return $view->fetch();
    }


}
