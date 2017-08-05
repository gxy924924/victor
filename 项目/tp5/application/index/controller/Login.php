<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;
use think\Cookie;

// use Think;
//  extends controller
class Login extends Controller
{
      //登录页
    function login(){
        $view=new View();
        return $view->fetch();
    }

    function login_out(){
        session(null);
        session_destroy();
        return $this->success('退出成功','index/login/login');
    }
   
    //执行登录
    function login_do(){
        $userinfo=Db::table('mariah_admin_user')->where('username',$_POST['username'])->find();
        //登录成功
        if(md5($_POST['password'])==$userinfo['password']){
            $arr=['user_id'=>$userinfo['id'],'username'=>$userinfo['username'],'login_time'=>date('Y-m-d H:i:s')];
            $info=Db::table('mariah_admin_login')->insert($arr);
            $_SESSION['userid']=$userinfo['id'];
            $_SESSION['auth_level']=$userinfo['auth_level'];
            Cookie::set("username",$userinfo['username'],36000);
            Cookie::set("PHPSESSTM",time(),3600);
            // var_dump($_SESSION);
            // var_dump($_COOKIE);
            // exit;
            $this->redirect(URL_PATH.'Index/index/index_do');
        }else{
        //登录失败
            $this->error("账号或密码错误",URL_PATH.'Index/login/login');
        }


        // echo "<pre>";
        // var_dump($_POST);
        // var_dump($userinfo);
        // echo "</pre>";
    }

 

}
