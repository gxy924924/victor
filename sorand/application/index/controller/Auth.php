<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;
/*
四级目录
auth_url 	:网站的【路径】，记录在这里才可以对相应的路径进行权限限制
auth_group 	:网站的【路径组】，给路径分组以方便管理
auth_sort 	:根据网站的分组设置【分组选项】，进行权限管理
auth_level 	:【权限组】，根据获得勾选的分组选项的权限进行权限验证。
 */
// use Think;
//  extends controller
class Auth extends Base{

	//------------------------视图部分-----------------------------------
	//显示权限目录
	function auth_url(){
		$vi=new View();
		$vi->group=Db::table('mariah_auth_group')->select();
		// foreach ($vi->group as $key => $v) {
		// 	$arr[$v["id"]]=$v["group_name"];
		// }
		// $vi->group_arr=$arr;
		$vi->auth=Db::table('mariah_auth_rule')->order("group_id")->select();

		return $vi->fetch();
	}

	//修改权限目录
	function update_url(){
		$vi=new View();
		$id=$_GET['id'];
		$vi->group=Db::table('mariah_auth_group')->select();
		$vi->auth=Db::table('mariah_auth_rule')->where("id",$id)->find();

		return $vi->fetch();
	}

	//权限级别管理（增删改查）
	function user_auth_level(){
		$vi=new View();
		$vi->auth=Db::table('mariah_auth_level')->select();
		return $vi->fetch();
	}

	//分类权限（权限等级中的选项）
	function auth_sort(){
		$vi=new View();
		if(empty($_GET['group_id'])||empty($_GET['sort_id'])){
			$arr=Db::table('mariah_auth_sort')->find();
			$_GET['group_id']=$arr['group_id'];
			$_GET['sort_id']=$arr['id'];
		}else{
			// $group_id=$_GET['group_id'];
			// $sort_id=$_GET['sort_id'];
		}
		
		$vi->group=Db::table('mariah_auth_group')->select();
		$vi->auth=Db::table('mariah_auth_sort')->order('sort_name')->select();
		$vi->url=Db::table('mariah_auth_rule')->where("group_id",$_GET['group_id'])->select();
		$vi->sort=Db::table('mariah_auth_sort')->where('id',$_GET['sort_id'])->find();
		$vi->rule=json_decode($vi->sort['rule'],1);
		// var_dump($vi->rule);
		return $vi->fetch();
	}

	//权限级别管理（权限赋予）
	function auth_level(){
		if(empty($_GET['id'])){
			$arr=Db::table('mariah_auth_level')->find();
		}else{
			$arr=Db::table('mariah_auth_level')->where('id',$_GET['id'])->find();
		}
		$vi=new View();
		$vi->now_level=$arr;
		$vi->level=Db::table('mariah_auth_level')->select();
		$vi->level_info=json_decode($vi->now_level['rule'],1);

		$vi->group=Db::table('mariah_auth_group')->select();
		$vi->sort=Db::table('mariah_auth_sort')->select();
		// var_dump($vi->level_info);
		return $vi->fetch();
	}

	//更新权限等级
	function user_level_update(){
		$vi=new View();
		$vi->level=Db::table('mariah_auth_level')->where('id',$_GET['id'])->find();
		return $vi->fetch();
	}

	//管理权限组
	function auth_group(){
		$vi=new View();
		$vi->group=Db::table('mariah_auth_group')->select();
		return $vi->fetch();
	}

	//修改目录权限组
	function update_group(){
		$vi=new View();
		$vi->group=Db::table('mariah_auth_group')->where('id',$_GET['id'])->find();
		return $vi->fetch();
	}

	//修改分类
	function update_sort(){
		$vi=new View();
		$vi->group=Db::table('mariah_auth_group')->select();
		$vi->sort=Db::table('mariah_auth_sort')->where('id',$_GET['id'])->find();
		return $vi->fetch();
	}

	function show_log(){
		$vi=new View();
		$vi->log=Db::table('mariah_log_action')->order('time desc')->paginate(20);
		return $vi->fetch();
	}

	//------------------------功能部分-----------------------------------

	//修改分类（执行）
	function update_sort_do(){
		$arr_exp=explode("-",$_POST['group']);
		$arr['sort_name']=$_POST['sort_name'];
		$arr['group_id']=$arr_exp[0];
		$arr['group_name']=$arr_exp[1];
		$info=Db::table("mariah_auth_sort")->where('id',$_GET['id'])->update($arr);
		$this->t_f_jump($info,"","更改失败",url('index/auth/auth_sort'));
	}

	//删除分类
	function delete_sort(){
		$info=Db::table("mariah_auth_sort")->delete($_GET['id']);
		$this->t_f_jump($info,"","删除失败",url('index/auth/auth_sort'));
	}

	//删除目录组
	function delete_group(){
		$info=Db::table("mariah_auth_group")->where('id',$_GET['id'])->delete($_GET['id']);
		$this->t_f_jump($info,"","删除失败",url('index/auth/auth_group'));
	}

	//更新目录组（执行）
	function update_group_do(){
		// var_dump($_POST);
		// var_dump($_GET);
		$info=Db::table("mariah_auth_group")->where('id',$_GET['id'])->update($_POST);
		$info2=Db::table("mariah_auth_rule")->where('group_id',$_GET['id'])->update($_POST);
		// echo $info=$info+$info2;
		$this->t_f_jump($info,"","更改失败",url('index/auth/auth_group'));
	}

	//权限组跟新（执行）
	function level_update_do(){
		// var_dump($_GET);
		// var_dump($_POST);
		$_POST['update_time']=date("Y-m-d H:i");
		$info=Db::table('mariah_auth_level')->where('id',$_GET['id'])->update($_POST);
		// echo $info;
		 $this->t_f_jump($info,"","更改失败",url('index/auth/user_auth_level'));
	}

	//删除权限等级
	function user_level_delete(){
		$info=Db::table('mariah_auth_level')->delete($_GET['id']);
		// echo $info;
		$this->t_f_jump($info,"","删除失败",url('index/auth/user_auth_level'));
	}

	function delete_url(){
		 // echo "<pre>";
   //      var_dump($_POST);
   //      var_dump($_GET);
   //      echo "</pre>";
        $info=Db::table("mariah_auth_rule")->delete($_GET['id']);
        // var_dump($info);
        $this->t_f_jump($info,"","删除失败",url('index/auth/auth_url'));
	}

	function update_url_do(){
		
		$id=$_POST['id'];
		$arr_exp=explode('-',$_POST['group']);
		$_POST['group_id']=$arr_exp[0];
		$_POST['group_name']=$arr_exp[1];
		$info=$this->sql_arr_update("mariah_auth_rule",$_POST,"id",$id);
		$this->t_f_jump($info,"","更新失败",url('index/auth/auth_url'));
		// echo $info;

		
	}

	function update_auth_rule(){
		// echo "<pre>";
  //       var_dump($_POST);
  //       var_dump($_GET);
  //       echo "</pre>";
        $json=json_encode($_POST);
        $info=Db::table("mariah_auth_level")->where("id",$_GET['id'])->update(["rule"=>$json]);
        $this->t_f_jump($info,"更新成功","更新失败",url('index/auth/auth_level')."?id=".$_GET['id']);
	}

	//更新权限分类
	function update_auth_sort(){
		$json=json_encode($_POST);
        $info=Db::table("mariah_auth_sort")->where("id",$_GET['sort_id'])->update(["rule"=>$json]);
        $this->t_f_jump($info,"更新成功","更新失败",url('index/auth/auth_sort')."?sort_id=".$_GET['sort_id']."&group_id=".$_GET['group_id']);
        //  echo "<pre>";
        // var_dump($info);
        // echo "</pre>";
	}

	function add_uri(){
		 // echo "<pre>";
   //      var_dump($_POST);
   //      echo "</pre>";
        $_POST['path']='0';
        $exist=Db::table("mariah_auth_rule")->where("request_uri",$_POST['request_uri'])->select();
        if (count($exist)) {
        	$info=1;
        }else{
        	$info=$this->sql_arr_insert("mariah_auth_rule",$_POST);
        }
        
        // var_dump($info);
        $t_url=url("index/auth/auth_url");
        $this->t_f_jump($info,"","添加失败",$t_url,$t_url);
	}

	function add_level(){
		// echo "<pre>";
  //       var_dump($_POST);
  //       echo "</pre>";
        $info=$this->sql_arr_insert("mariah_auth_level",$_POST);
        $url=url('index/auth/user_auth_level');
        $this->t_f_jump($info,"","添加失败",$url);
        // echo $info;
	}

	function add_sort(){
		$arr['sort_name']=$_POST['sort_name'];
		$arr_exp=explode("-",$_POST['group']);
		$arr['group_id']=$arr_exp[0];
		$arr['group_name']=$arr_exp[1];
		$info=Db::table("mariah_auth_sort")->insert($arr);
		$url=url("index/auth/auth_sort");
		$this->t_f_jump($info,"","添加失败",$url);

	}

	function add_group(){
		$arr=Db::table("mariah_auth_group")->where("group_name",$_POST['group_name'])->select();
		if(count($arr)){
			$info=0;
		}else{
			$info=$this->sql_arr_insert("mariah_auth_group",$_POST);
		}
		
		$url=url('index/auth/auth_group');
		$this->t_f_jump($info,"","名字重复了，添加失败",$url);
	}

	function test(){
		
		$path=$_SERVER['REQUEST_URI'];
		// $path="/index.php/Index/appointment/appointment_info";
		$info=explode("/",$path);
		echo "<pre>";
        var_dump($info);
        echo "</pre>";
	}
}
