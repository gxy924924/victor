<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;

// use Think;
//  extends controller
class Index extends Base
{   
    //视图部分----------------------------------------------------
    //主页跳转（防止出现url地址解析错误）
    public function index(){
        $this->redirect(URL_PATH."index/index/index_do");
    }

    //主页
    public function index_do(){
        $view=new View();
        //表中的信息
        $view->province=$this->city_get();
        $view->appointment_type=Db::table('mariah_appointment_type')->select();
        $view->appointment_style=Db::table('mariah_appointment_style')->select();
        //隐藏地址获取
        $view->city_get_url=URL_PATH."Index/Index/city_get";
        $view->add_new_url=URL_PATH."Index/Index/add_new";
        // $view->time=date("Y-m-d H:i");
        return $view->fetch('index');
    }



//功能部分----------------------------------------------------

 

    //ajax传递获取城市信息
    function city_get(){
        $id=empty($_GET['id'])?0:$_GET['id'];
        // return $_POST['id'];
        $city=Db::table('mariah_city')->where('parentid',$id)->select();
        if (empty($_GET['id'])) {
            return $city;
        }elseif($_GET['id']=="p0"){
            return json_encode($city,JSON_UNESCAPED_UNICODE);
        }else{

            return json_encode($city,JSON_UNESCAPED_UNICODE);
        }
    }

    function test(){
        echo "<pre>";
        var_dump($_SERVER);
        echo "</pre>";
    }



    

   

}
