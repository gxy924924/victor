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
        if (empty($_SESSION['userid'])) {
             $this->redirect(URL_PATH.'Index/login/login');
        }
    }

    function t_f_jump($info,$t="添加成功",$f="添加失败",$t_url,$f_url){
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
    function sql_arr_update($table,$f_arr,$attr){
        $arr=$this->sql_arr_search($table,$f_arr);
        return $info=Db::table($table)->where($attr)->update($arr);
    }


}
