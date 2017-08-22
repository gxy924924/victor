<?php
namespace app\api\controller;

use think\Controller;
use think\Db;
use think\View;
use think\File;
use think\paginator;

//tp5.com/index.php/api/notification/notification_watch
// use Think;
//  extends controller
//通知和行业知识等等
class Notification extends Controller{

    //ajax传递获取城市信息
    function city_get() {
        $id = empty($_GET['id']) ? 0 : $_GET['id'];
        header('content-type:application:json;charset=utf8');  
        header('Access-Control-Allow-Origin:*');  
        header('Access-Control-Allow-Methods:POST');  
        header('Access-Control-Allow-Headers:x-requested-with,content-type');  
        
        // return $_POST['id'];
        $city = Db::table('mariah_city')->where('parentid', $id)->select();

        return json_encode($city, JSON_UNESCAPED_UNICODE);
        // return "aaa";
    }

    //活动查看添加客户界面（废弃）
    function activity_guest_info_adder(){
        $vi=new View();
        $vi->base_url="http://".$_SERVER['HTTP_HOST'];
        $vi->addr = Db::table('mariah_city')->where('parentid', 0)->select();
        $vi->city_get_url=URL_PATH . "api/notification/city_get";
        return $vi->fetch();
        // echo "<pre>";
        // var_dump($_SERVER);
    }


    //活动添加客户信息
    function activity_guest_info_add(){
        $arr['name']=$_POST['name'];
        $arr['phone']=$_POST['phone'];
        $arr['weixin']=$_POST['weixin'];
        $arr['remark']=$_POST['remark'];
        if(!empty($_POST['city_provice'])){
            $arr['position']=$_POST['city_provice'];
        }
        if(!empty($_POST['city_city'])){
            $arr['position'].="-".$_POST['city_city'];
        }
        if(!empty($_POST['city_county'])){
            $arr['position'].="-".$_POST['city_county'];
        }
        $res=Db::table('activity_guest_info')->insert($arr);
        $url=$_POST['url'];
        if($res==1){
            echo "提交成功".$url;
        }

        

        // echo "<pre>";
        // var_dump($url);
        // echo "</pre>";
        if(!empty($url)){
            $this->redirect($url);
        }

        
    }
   

}
