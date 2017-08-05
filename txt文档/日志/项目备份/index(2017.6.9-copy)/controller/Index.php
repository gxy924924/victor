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

    //预约信息（查看预约与其他操作功能）
    function appointment_info(){
        $view=new View();
        $view->appo_info=Db::table('mariah_appointment_info')->select();
        return $view->fetch();
    }

    //更新预约
    function appointment_update(){
        // var_dump($_GET);
        $view=new View();

        //表中的信息
        $view->province=$this->city_get();
        $view->appointment_type=Db::table('mariah_appointment_type')->select();
        $view->appointment_style=Db::table('mariah_appointment_style')->select();
        //隐藏地址获取
        $view->city_get_url=URL_PATH."Index/Index/city_get";
        $view->add_new_url=URL_PATH."Index/Index/add_new";
        //回传给前端之前填好的信息
        $view->appo_info=Db::table('mariah_appointment_info')->where('id',$_GET['appo_id'])->select();
        return $view->fetch();
    }

//预约详细内容
    function appoint_detail(){
        var_dump($_GET);
        $ap_id=$_GET['ap_id'];
        $info=Db::table('mariah_guest_detail')->where('appo_id',$ap_id)->select();
        $exist=count($info);

        if ($exist) {
             $this->redirect(url('index/index/update_detail')."?ap_id=".$ap_id);
        }else{
            $this->redirect(url('index/index/add_detail')."?ap_id=".$ap_id);
        }
    }


    //添加详细内容
    function add_detail(){
        $vi=new View();
        $ap_id=$_GET['ap_id'];
        $vi->info=Db::table('mariah_appointment_info')->where('id',$ap_id)->select();
        // var_dump($vi->info);
        return $vi->fetch();
    }

    //修改详细内容
    function update_detail(){
        $vi=new View();
        $ap_id=$_GET['ap_id'];
        $vi->info=Db::table('mariah_appointment_info')->where('id',$ap_id)->select();
        $vi->detail=Db::table('mariah_guest_detail')->where('appo_id',$ap_id)->select();
        // var_dump($vi->info);
        return $vi->fetch();
    }
    //显示详细内容
    function show_detail(){
        $vi=new View();
        $ap_id=$_GET['ap_id'];
        $vi->info=Db::table('mariah_appointment_info')->where('id',$ap_id)->select();
        $vi->detail=Db::table('mariah_guest_detail')->where('appo_id',$ap_id)->select();
        return $vi->fetch();
    }


//功能部分----------------------------------------------------

    //添加顾客登记
    function add_new(){

//字段组合
        if (!empty($_POST['city_provice'])&&!empty($_POST['city_city'])){

            $position_province=explode('-',$_POST['city_provice']);
            $position_city=explode('-',$_POST['city_city']);
            $arr['position_num']=$position_province[0].'-'.$position_city[0];
            $arr['position']=$position_province[1].'-'.$position_city[1];
        }
        if (!empty($_POST['city_county'])){
                $position_county=explode('-',$_POST['city_county']);
                
                $arr['position_num'].='-'.$position_county[0];
                $arr['position'].='-'.$position_county[1];  
        }

        if(!empty($_POST['time_date'])&&!empty($_POST['time_time'])){
            $arr['appointment_time']=$_POST['time_date']." ".$_POST['time_time'];
        }
        
//数据库筛查
        $sql_arr=Db::query("describe mariah_appointment_info");
        foreach ($sql_arr as $value) {
            $field=$value["Field"];
            if(!empty($_POST[$value["Field"]])){
                $arr[$value["Field"]]=$_POST[$value["Field"]];
            }
        }
        // echo "<pre>";
        // var_dump($arr);
        // echo "</pre>";
        $info=Db::table("mariah_appointment_info")->insert($arr);
        $t_url=url('Index/Index/appointment_info');
        $this->t_f_jump($info,"","删除失败",$t_url,$t_url);//base中方法
    }

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


    //删除预约
    function appoint_delete(){
        // return "aa";
        // var_dump($_GET);
        $info=Db::table('mariah_appointment_info')->delete($_GET['id']);
        $t_url=url('Index/Index/appointment_info');
        $info2=Db::table('mariah_guest_detail')->where("appo_id",$_GET['id'])->delete();
        $this->t_f_jump($info,"","删除失败",$t_url,$t_url);
        
    }

    //添加详细内容（功能）
    function add_detail_do(){
        var_dump($_POST);
        $info=Db::table('mariah_guest_detail')->insert($_POST);
        $update_info=Db::table('mariah_appointment_info')->where('id',$_POST['appo_id'])->update(["detail_exist"=>1]);
        // $t_url=url('Index/Index/appointment_info');
         $this->redirect(url('index/index/show_detail')."?ap_id=".$_POST['appo_id']);
    }

    function update_detail_do(){
        // var_dump($_POST);
        $table="mariah_guest_detail";
        $attr="appo_id=".$_POST['appo_id'];
        $info=$this->sql_arr_update($table,$_POST,$attr);
        if ($info) {
            $this->redirect(url('index/index/show_detail')."?ap_id=".$_POST['appo_id']);
        }
    }

    function appoint_update_do(){
        $arr=$this->sql_arr_search("mariah_appointment_info",$_POST);

        if (!empty($_POST['city_provice'])&&!empty($_POST['city_city'])){

            $position_province=explode('-',$_POST['city_provice']);
            $position_city=explode('-',$_POST['city_city']);
            $arr['position_num']=$position_province[0].'-'.$position_city[0];
            $arr['position']=$position_province[1].'-'.$position_city[1];
        }
        if (!empty($_POST['city_county'])){
                $position_county=explode('-',$_POST['city_county']);
                
                $arr['position_num'].='-'.$position_county[0];
                $arr['position'].='-'.$position_county[1];  
        }

        if(!empty($_POST['time_date'])&&!empty($_POST['time_time'])){
            $arr['appointment_time']=$_POST['time_date']." ".$_POST['time_time'];
        }

        $update_info=Db::table('mariah_appointment_info')->where('id',$_POST['user_id'])->update($arr);
        // var_dump($arr);
        $t_url=url('Index/Index/appointment_info');
         $this->redirect(url('index/index/show_detail')."?ap_id=".$_POST['user_id']);
    }

    

    //预约到达
    function appoint_go(){
        return "bb";
    }

}
