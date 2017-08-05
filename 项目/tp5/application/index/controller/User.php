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

    function user_detail(){
        $vi=new view();
        $vi->userinfo=Db::table('mariah_admin_user')->where('id',$_GET['id'])->find();
        $vi->shop=Db::table('mariah_shopstore')->select();
        $vi->info=Db::table('mariah_admin_detail')->where('id',$_GET['id'])->find();
        $vi->shop_num=explode(',',$vi->info['shop_id']);
        if(count($vi->info)){
            $access=$this->info_access(['sort_10']);
            // var_dump($access);
            if(empty($access['sort_10'])){
                $this->redirect(url('index/index/index_do'));
            }else{
                $vi->url=URL_PATH."index/user/update_user_detail";
                $vi->title="修改";
            }
            
        }else{
            $vi->url=URL_PATH."index/user/add_user_detail";
            $vi->title="添加";
        }

        return $vi->fetch();
    }

    // -------------------------功能部分----------------------------------

    function add_user_detail(){
        $arr['id']=$_POST['id'];
        $arr['username']=$_POST['username'];
        $arr['nickname']=$_POST['nickname'];
        $arr['shop_id']=$_POST['shop_id1'];
        $arr['shop_id'].=empty($_POST['shop_id2'])?"":",".$_POST['shop_id2'];
        $arr['shop_id'].=empty($_POST['shop_id3'])?"":",".$_POST['shop_id3'];
        // var_dump($arr);
        // exit;
        $info=Db::table('mariah_admin_detail')->insert($arr);
        $access=$this->info_access(['sort_11']);
        if(empty($access['sort_11'])){
            $this->t_f_jump($info,'添加成功','添加失败',url('index/index/index_do'));
        }
        $this->t_f_jump($info,'','添加失败',url('index/user/select_user'));
        
    }

    function update_user_detail(){
        
        $arr['nickname']=$_POST['nickname'];
        $arr['shop_id']=$_POST['shop_id1'];
        $arr['shop_id'].=empty($_POST['shop_id2'])?"":",".$_POST['shop_id2'];
        $arr['shop_id'].=empty($_POST['shop_id3'])?"":",".$_POST['shop_id3'];
        // var_dump($_POST);
        // var_dump($arr);

        $info=Db::table('mariah_admin_detail')->where('id',$_POST['id'])->update($arr);
        $this->t_f_jump($info,'修改成功','修改失败',url('index/user/select_user'));
    }

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
        $info2=Db::table('mariah_admin_detail')->delete($_GET['id']);
        $url=url('index/user/select_user');
         $this->t_f_jump($info&&$info2,"","删除失败",$url,$url);
    }

    function update_user_do(){
        // var_dump($_POST);
        $pass=$_POST['password'];
        $arr['password']=md5($pass);
        $info=Db::table('mariah_admin_user')->where('id',$_GET['id'])->update($arr);
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