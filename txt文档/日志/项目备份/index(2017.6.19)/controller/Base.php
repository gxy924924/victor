<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;

// use Think;
//  extends controller
class Base extends Controller
{
    function __construct(){
        parent::__construct();  
        if (empty($_SESSION['userid'])||empty($_SESSION['auth_level'])){
            $this->redirect(URL_PATH.'Index/login/login');
        }
        $url=$_SERVER['PHP_SELF'];
        $url=str_replace(".html", "", $url);
        //检查权限是否通过
        $this->check_auth($url);
        // 帮助添加函数
        // $this->auth_url_auto_adder($url);
        // test
        // $this->info_access("tel_info");
        // 
        // $this->sort_access_get();
        
    }

    //检查权限
    function check_auth($url){
        $arr1=Db::table("mariah_auth_rule")->field('id')->where('request_uri',$url)->find();
        $id=$arr1['id'];
        if(!empty($id)){
            $access=$this->sort_access_get($id);
            if(!$access){
                $this->error("你权限不足",URL_PATH.'Index/index/index');
            }
        }
    }

    //从分类权限库中获取权限
    function sort_access_get($id){
        $json=Db::table("mariah_auth_level")->field("rule")->where('id',$_SESSION['auth_level'])->find();
        $arr_sort=json_decode($json['rule'],1);
        foreach($arr_sort as $key=>$v){
            $key_sort=explode("_",$key);
            if ($key_sort[0]=="sort") {
                $rule=Db::table("mariah_auth_sort")->field("rule")->where('id',$v)->find();
                $arr_part=json_decode($rule['rule'],1);
                // var_dump($arr_part);
                if(!empty($arr_part["id_".$id])){
                    return $arr_part["id_".$id];
                } 
            }
        }
        // var_dump($arr);
        return false;
    }

    //查看额外权限信息
    function info_access($info){
        $json=Db::table("mariah_auth_level")->field("rule")->where('id',$_SESSION['auth_level'])->find();
        $arr_sort=json_decode($json['rule'],1);
        $info_access=$arr_sort[$info];
        return $info_access;
        // var_dump($info_access);
    }

    //自动帮助权限功能获取路径
    function auth_url_auto_adder($url){
        $arr['path']='0';
        $arr['request_uri']=$url;
        $arr['title']="待命名";
        $exist=Db::table("mariah_auth_rule")->where("request_uri",$arr['request_uri'])->select();
        if (count($exist)) {
            $info="已存在";
        }else{
            $info=$this->sql_arr_insert("mariah_auth_rule",$arr);
            $info.="添加成功";
        }
        // echo $info;
    }



    //跳转助手
    function t_f_jump($info,$t="添加成功",$f="添加失败",$t_url,$f_url=""){
        if($f_url==""){
            $f_url=$t_url;
        }
    	if($info){
            if(empty($t)){
                $this->redirect($t_url);
            }else{
                 $this->success($t,$t_url);
                // return ;
            }
        }else{
            if(empty($f)){
                $this->redirect($t_url);
            }else{
                $this->error($f,$f_url);
            // return "添加失败".$info;;
            }
            
        } 
    }

    //数据库筛查
    function sql_arr_search($table,$f_arr){
        $sql_arr=Db::query("describe ".$table);
        foreach ($sql_arr as $value) {
            // $field=$value["Field"];
            if(!empty($f_arr[$value["Field"]])){
                $arr[$value["Field"]]=$f_arr[$value["Field"]];
            }
        }
        return $arr;
    }

    //简易式数据库写入
    function sql_arr_insert($table,$f_arr){
        $arr=$this->sql_arr_search($table,$f_arr);
        return $info=Db::table($table)->insert($arr);
    }

    //简易式数据库更新
    function sql_arr_update($table,$f_arr,$attr_info,$attr){
        $arr=$this->sql_arr_search($table,$f_arr);
        return $info=Db::table($table)->where($attr_info,$attr)->update($arr);
    }


}
