<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;

// use Think;
//  extends controller
class Appointment extends Base
{   
    function __construct(){
        parent::__construct();
        $_COOKIE['left_collapse']='appointment';
    }
    //视图部分----------------------------------------------------
    ////新增登记
    function appointment_add(){
        $view=new View();
        //表中的信息
        $view->province=$this->city_get();
        $view->shop=Db::table('mariah_shopstore')->select();
        $view->appointment_type=Db::table('mariah_appointment_type')->select();
        $view->appointment_style=Db::table('mariah_appointment_style')->select();
        //隐藏地址获取
        $view->city_get_url=URL_PATH."Index/appointment/city_get";
        $view->item_get_url=URL_PATH."Index/appointment/item_get";
        $view->add_new_url=URL_PATH."Index/appointment/add_new";
        // $view->time=date("Y-m-d H:i");
        return $view->fetch();
    }
 

    //预约信息（查看预约与其他操作功能）
    function appointment_info(){
        $view=new View();
        $view->province=$this->city_get();
        $view->city_get_url=URL_PATH."Index/appointment/city_get";
        $view->appointment_style=Db::table('mariah_appointment_style')->select();
        //授权管理联系方式隐藏字段
        $view->tel_access=$this->info_access("tel_info");
        if(count($_POST)){
            $view->appo_info=$this->appointment_search_info();
        }else{
            // $view->appo_info=Db::table('mariah_appointment_info')->select();
            $view->appo_info=Db::table('mariah_appointment_info a')->join('mariah_admin_user b on a','a.adder_user_id=b.id','left')->field('a.*,b.username')->select();

        }
        // var_dump($view->appo_info);
        return $view->fetch();
    }

    //预约搜索信息
    function appointment_search_info(){
        // var_dump($_POST);
        // echo "</br>";
        // $attr="";
        $obj=Db::table('mariah_appointment_info a')->join('mariah_admin_user b on a','a.adder_user_id=b.id','left')->field('a.*,b.username');
        if(!empty($_POST['add_time_start'])){
            $obj=$obj->where("add_time","> time",$_POST['add_time_start']);
        }
        if(!empty($_POST['add_time_stop'])){
            $obj=$obj->where("add_time","< time",$_POST['add_time_stop']);
        }
        if(!empty($_POST['appointment_time_start'])){
            $obj=$obj->where("appointment_time","> time",$_POST['appointment_time_start']);
        }
        if(!empty($_POST['appointment_time_stop'])){
            $obj=$obj->where("appointment_time","< time",$_POST['appointment_time_stop']);
        }
        if($_POST['appointment_go']=="0"){
            $obj=$obj->where("appointment_go",$_POST['appointment_go']);
        }else if($_POST['appointment_go']=="1"){
            $obj=$obj->where("appointment_go",$_POST['appointment_go']);
        }
        if(!empty($_POST['appointment_style'])){
           $obj=$obj->where("appointment_style",$_POST['appointment_style']);
        }
        if(!empty($_POST['adder_name'])){
           $obj=$obj->where("username",$_POST['adder_name']);
        }
        if(!empty($_POST['province'])){
            $province=explode("-",$_POST['province']);
            // echo $province[1];
            $attr["position"]=["like","%".$province[1]."%"];
           $obj=$obj->where($attr);
        }
        if(!empty($_POST['city'])){
            $city=explode("-",$_POST['city']);
            // echo $city[1];
            $attr["position"]=["like","%".$city[1]."%"];
           $obj=$obj->where($attr);
        }
        if(!empty($_POST['county'])){
            $county=explode("-",$_POST['county']);
            // echo $province[1];
            $attr["position"]=["like","%".$county[1]."%"];
           $obj=$obj->where($attr);
        }
        
        $arr=$obj->select();
        return $arr;
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
        $view->city_get_url=URL_PATH."Index/appointment/city_get";
        $view->add_new_url=URL_PATH."Index/appointment/add_new";
        //回传给前端之前填好的信息
        $view->appo_info=Db::table('mariah_appointment_info')->where('id',$_GET['appo_id'])->select();
        return $view->fetch();
    }

//添加、修改预约详细内容
    function appoint_detail(){
        var_dump($_GET);
        $ap_id=$_GET['ap_id'];
        $info=Db::table('mariah_guest_detail')->where('appo_id',$ap_id)->select();
        $exist=count($info);

        if ($exist) {
             $this->redirect(url('index/appointment/update_detail')."?ap_id=".$ap_id);
        }else{
            $this->redirect(url('index/appointment/add_detail')."?ap_id=".$ap_id);
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
        $vi->tel_access=$this->info_access("tel_info");
        $vi->info=Db::table('mariah_appointment_info')->where('id',$ap_id)->select();
        $vi->detail=Db::table('mariah_guest_detail')->where('appo_id',$ap_id)->select();
        return $vi->fetch();
    }

    //到达信息
    function show_arrive(){
        $vi=new View();
        $vi->arrive=Db::table('mariah_guest_arrive')->select();
        return $vi->fetch();
    }


//功能部分----------------------------------------------------
//
    function item_get(){
        $item_classify=$_GET['classify'];
        // return $item_classify;
        $item=Db::table('mariah_production')->where('classify',$item_classify)->select();
        return json_encode($item,JSON_UNESCAPED_UNICODE);
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

    //添加顾客登记
    function add_new(){

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
        $arr['item']=$_POST['item1']."-".$_POST['item2'];
        $arr_exp2=explode("+",$_POST['shop_info']);
        $id=$arr_exp2[0];
        $arr['shop']=$arr_exp2[1];
        $position=Db::table("mariah_shopstore")->where("id",$id)->find();
        $arr['position']=$position['position'];
        // $arr['price']=$arr_exp1[0];
        $arr['adder_user_id']=$_SESSION['userid'];

        $info=Db::table("mariah_appointment_info")->insert($arr);
        $t_url=url('Index/appointment/appointment_info');
        $this->t_f_jump($info,"","删除失败",$t_url,$t_url);//base中方法
    }


    //删除预约
    function appoint_delete(){
        // return "aa";
        // var_dump($_GET);
        $info=Db::table('mariah_appointment_info')->delete($_GET['id']);
        $t_url=url('Index/appointment/appointment_info');
        $info2=Db::table('mariah_guest_detail')->where("appo_id",$_GET['id'])->delete();
        $this->t_f_jump($info,"","删除失败",$t_url,$t_url);
        
    }

    //添加详细内容（功能）
    function add_detail_do(){
        var_dump($_POST);
        $info=Db::table('mariah_guest_detail')->insert($_POST);
        $update_info=Db::table('mariah_appointment_info')->where('id',$_POST['appo_id'])->update(["detail_exist"=>1]);
        // $t_url=url('Index/Index/appointment_info');
         $this->redirect(url('index/appointment/show_detail')."?ap_id=".$_POST['appo_id']);
    }

    function update_detail_do(){
        // var_dump($_POST);
        $table="mariah_guest_detail";
        $attr="appo_id=".$_POST['appo_id'];
        $info=$this->sql_arr_update($table,$_POST,$attr);
        if ($info) {
            $this->redirect(url('index/appointment/show_detail')."?ap_id=".$_POST['appo_id']);
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
        $t_url=url('Index/appointment/appointment_info');
         $this->redirect(url('index/appointment/show_detail')."?ap_id=".$_POST['user_id']);
    }

    

    //预约到达
    function appoint_arrive(){
        // var_dump($_GET);
        $appo_id=$_GET['id'];
        $arr=Db::table('mariah_guest_arrive')->where('appo_id',$appo_id)->find();
        if(count($arr)){
           $this->success("已确认到达过了",url('index/appointment/show_arrive'));
        }else{
            $arr=Db::table('mariah_appointment_info')->where("id",$appo_id)->find();
            $info=Db::table('mariah_appointment_info')->where("id",$appo_id)->update(["appointment_go"=>1]);
            $info2=Db::table('mariah_guest_arrive')->insert(["appo_id"=>$appo_id,"name"=>$arr['name']]);
        }

        if($info&&$info2){
            $this->redirect(url('index/appointment/show_arrive'));
        }else{
            $f_url=url('index/appointment/show_arrive');
            $this->error("确认到达有误",$f_url);
        }
        echo "<pre>";
        var_dump($arr);
        echo "</pre>";
    }

}
