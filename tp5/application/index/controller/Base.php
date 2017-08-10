<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;
use think\Cookie;

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
        $this->add_cookie_time();
        // 帮助添加函数
        // $this->auth_url_auto_adder($url);

        
        // test
        // $this->info_access("tel_info");
        // 
        // $this->sort_access_get();
        
    }

    //cookie延长时间
    function add_cookie_time(){
        if(empty($_COOKIE['PHPSESSTM'])){
            // $this->redirect(URL_PATH.'Index/login/login');
            $this->error("长时间未操作",URL_PATH.'Index/login/login');
        }
        if($_COOKIE['PHPSESSTM']+300<time()){
            Cookie::set("username",$_COOKIE['username'],3600);
            Cookie::set("PHPSESSID",$_COOKIE['PHPSESSID'],3600);
            Cookie::set("PHPSESSTM",time(),3600);
        }
    }

    //检查权限
    function check_auth($url){
        $arr1=Db::table("mariah_auth_rule")->where('request_uri',$url)->find();
        
        $id=$arr1['id'];
        if(!empty($id)){
            $access=$this->sort_access_get($id);
            if(!$access){
                $this->error("你权限不足",URL_PATH.'Index/index/index');
            }
        }
        //储存日志
        $this->log_save($arr1);
    }

    //储存日志
    function log_save($arr){
        
        $arr_log=['username'=>$_COOKIE['username'],'remote_addr'=>$_SERVER['REMOTE_ADDR'],'request_uri'=>$arr['request_uri'],'title'=>$arr['title'],'act_group'=>$arr['group_name'],'time'=>date('Y-m-d H:i:s')];
        $flag=$this->log_check($arr_log);
        if(!empty($flag)){
            $this->log_sql_put($arr_log);
        }
        // echo "<pre>";
        // var_dump($arr_log);
        // echo "</pre>";
    }

    function log_sql_put($arr){
        $info=Db::table('mariah_log_action')->insert($arr);
        // var_dump($info);
    }

    //检测是否应该储存
    function log_check($arr){
        $arr_check1=['add','update','delete','insert','put','set'];
        $arr_check2=['添加','修改','删除'];
        $flag1=$this->check_word($arr['request_uri'],$arr_check1);
        $flag2=$this->check_word($arr['title'],$arr_check2);
        $flag=$flag1+$flag2;
        return $flag;
        // var_dump($flag);
    }

    //字符串匹配工具
    function check_word($str,$arr_check){
        $flag=0;
        foreach ($arr_check as $v) {
            $res=strpos($str,$v);
            if(!empty($res)){
                $flag=1;
            }
        }
        return $flag;
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
        if(is_array($info)){
            foreach ($info as $v) {
                $info_access[$v]=!empty($arr_sort[$v])?$arr_sort[$v]:0;
            }
        }else{
            $info_access[$info]=!empty($arr_sort[$info])?$arr_sort[$info]:0;
        }

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

    //创建加密码
    function createCode($userId,$add_num=50000,$length=5,$sep_num=35)  
    {  
        static $sourceString = [  
        0,1,2,3,4,5,6,7,8,9,  
        'a','b','c','d','e','f',  
        'g','h','i','j','k','l',  
        'm','n','p','q','r',  
        's','t','u','v','w','x',  
        'y','z',  
        'A','B','C','D','E','F',  
        'G','H','I','J','K','L',  
        'M','N','P','Q','R',  
        'S','T','U','V','W','X',  
        'Y','Z'
        ];  

        $num = $userId+$add_num;  
        $code = '';  
        while($num)  
        {  
            $mod = $num % $sep_num;  
            $num = (int)($num / $sep_num);  
            $code = "{$sourceString[$mod]}{$code}";  
        }  

    //判断code的长度  
        if( empty($code[$length-1])){
            $code=str_pad($code,$length,'0',STR_PAD_LEFT);  
        }
            

        return $code;  
    } 

    //反向解密加密码
    function get_decode($str,$add_num=50000,$sep_num=35){
        $arr=str_split($str);
        
        static $sourceString = [  
        '0','1','2','3','4','5','6','7','8','9',  
        'a','b','c','d','e','f',  
        'g','h','i','j','k','l',  
        'm','n','p','q','r',  
        's','t','u','v','w','x',  
        'y','z',  
        'A','B','C','D','E','F',  
        'G','H','I','J','K','L',  
        'M','N','P','Q','R',  
        'S','T','U','V','W','X',  
        'Y','Z'
        ];
        foreach (array_reverse($arr) as $key=>$val) {
            $key_num=$this->my_array_search($val, $sourceString);
            $arr[$key]=$key_num;
        }
        $total_value=0-$add_num;
        foreach ($arr as $key => $val) {
            $pow=pow($sep_num,$key);
            $total_value+=$val*$pow;
        }
        return $total_value;
    }

    //匹配字符串
    function my_array_search($val,$arr){
        foreach ($arr as $k => $v) {
            if($v==$val){
                return $k;
            }
        }
    }


}
