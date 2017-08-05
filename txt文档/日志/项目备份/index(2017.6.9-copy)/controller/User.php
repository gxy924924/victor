<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;

// use Think;
//  extends controller
class User extends Base{
	function index(){
		return "index";
	}

    function select_user(){
        $vi=new view();
        $vi->userinfo=Db::table('mariah_user_info')->select();
        return $vi->fetch();
    }
    
    function add_user(){
        $vi=new view();
        
        return $vi->fetch();
    }

    function add_user_do(){
        // var_dump($_POST);
        $arr['username']=$_POST['username'];
        $arr['password']=md5($_POST['password']);
        $has_arr=Db::table('mariah_user_info')->where('username',$arr['username'])->select();
        if(count($has_arr)){
            $info=0;
        }else{
            $info=Db::table('mariah_user_info')->insert($arr);
        }
        $t_url=url('index/user/select_user');
        $f_url=url('index/user/add_user');
        $this->t_f_jump($info,"","已有用户名添加失败",$t_url,$f_url);
    }

    function delete_user(){
        // var_dump($_GET);
        $info=Db::table('mariah_user_info')->delete($_GET['id']);
        $url=url('index/user/select_user');
         $this->t_f_jump($info,"","删除失败",$url,$url);
    }


}
