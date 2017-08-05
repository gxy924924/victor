<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;

// use Think;
//  extends controller
class Index extends Base{   
    function __construct(){
        parent::__construct();
    }
    //视图部分----------------------------------------------------
    //主页跳转（防止出现url地址解析错误）
    public function index(){
        $this->redirect(URL_PATH."index/index/index_do");
    }

    //主页
    public function index_do(){
        // echo "aa";
        $view=new View();
        //表中的信息
        $date=date('Y-m-d');
        $timestamp_start=strtotime($date);
        $timestamp_stop=$timestamp_start+86400;
        // var_dump($timestamp_start);
        // $obj=$obj->where("appointment_time",">= time",$_POST['appointment_time_start']);
        $guest_num=Db::table('mariah_appointment_info')->where("add_time",">= time",$timestamp_start)->where("add_time","<= time",$timestamp_stop)->count();
        $arrive_num=Db::table('mariah_guest_arrive')->where("arrive_time",">= time",$timestamp_start)->where("arrive_time","<= time",$timestamp_stop)->count();
        $not_arrive_num=Db::table('mariah_appointment_info')->where("appointment_time",">= time",$timestamp_start)->where("appointment_time","<= time",$timestamp_stop)->where('appointment_go',0)->count();
        // var_dump($timestamp_start);
        var_dump($guest_num);

        $view->today_total=$guest_num;
        $view->today_arrive=$arrive_num;
        $view->today_not=$not_arrive_num;
        // $view->time=date("Y-m-d H:i");
        return $view->fetch('index');
    }



//功能部分----------------------------------------------------

 

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

    function test(){

        $date=date('Y-m-d H:i');
        $time=strtotime($date);
        $date2=date('Y-m-d H:i:s',$time);
        $shop_id='255';
        $item_id='6526';
        $spread_code=$this->createCode($shop_id,'4000',3,60);
        $spread_code.=$this->createCode($item_id,'3500',3,60);
        $time_code=$this->createCode($time,'0',3,55);
        $rand_num=rand(0,55*55*27);
        $random_code=$this->createCode($rand_num,'0',3,55);
        $random_code2=$this->createCode($rand_num*2,'10',3,55);
        $discount_code=$spread_code. $random_code.$time_code.$random_code2;

        $test_code=$this->createCode($time,'200',3,55);
        $arr=str_split($test_code);
        $num=$this->get_decode($test_code,'200',55);
        echo "<pre>";
        // var_dump($date);
        var_dump($time);
        var_dump($num);
        var_dump($test_code);
        // var_dump($num);
        // var_dump($date2);
        // var_dump($random_code);
        // var_dump($spread_code);
        // var_dump($time_code);
        // var_dump($discount_code);
        
        // var_dump($arr);
        
        // var_dump($_SERVER);
        echo "</pre>";
        // $dispatch=$this->request->dispatch();
        // echo "<pre>";
        // var_dump($dispatch);
        // echo "</pre>";
    }



    

   

}
