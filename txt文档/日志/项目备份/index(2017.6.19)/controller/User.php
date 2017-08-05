<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;

// use Think;
//  extends controller
class User extends Base{
    // -----------------------------视图部分---------------------------------
	function index(){
		return "index";
	}

    function select_user(){
        $vi=new view();
        $vi->level=Db::table('mariah_auth_level')->select();
        $vi->userinfo=Db::table('mariah_admin_user')->select();
        return $vi->fetch();
    }
    
    function add_user(){
        $vi=new view();
        $vi->level=Db::table('mariah_auth_level')->select();
        return $vi->fetch();
    }

    function update_user(){
        $vi=new view();
        $vi->user=Db::table("mariah_admin_user")->where('id',$_GET['id'])->find();
        return $vi->fetch();
    }

    // -------------------------功能部分----------------------------------

    function add_user_do(){
        // var_dump($_POST);
        $arr['username']=$_POST['username'];
        $arr['password']=md5($_POST['password']);
        $arr['auth_level']=$_POST['auth_level'];
        $has_arr=Db::table('mariah_admin_user')->where('username',$arr['username'])->select();
        if(count($has_arr)){
            $info=0;
        }else{
            $info=Db::table('mariah_admin_user')->insert($arr);
        }
        $t_url=url('index/user/select_user');
        $f_url=url('index/user/add_user');
        $this->t_f_jump($info,"","用户名重复添加失败",$t_url,$f_url);
    }

    function delete_user(){
        // var_dump($_GET);
        $info=Db::table('mariah_admin_user')->delete($_GET['id']);
        $url=url('index/user/select_user');
         $this->t_f_jump($info,"","删除失败",$url,$url);
    }

    function update_user_do(){
        // var_dump($_POST);
        $info=Db::table('mariah_admin_user')->where('id',$_GET['id'])->update($_POST);
        $this->t_f_jump($info,"","修改失败",url("index/user/select_user"));
    }

    function update_level(){
        // var_dump($_GET);
        $info=Db::table("mariah_admin_user")->where("id",$_GET['id'])->update(['auth_level'=>$_GET['lv']]);
        echo $info;
        $t_url=url("index/user/select_user");
        $this->t_f_jump($info,"","修改失败",$t_url,$t_url);
    }

    //检查用户名是否重复
    function check_username(){
        $arr=Db::table("mariah_admin_user")->where("username",$_POST['username'])->select();
        $exist=count($arr);

        echo $exist;
    }


}