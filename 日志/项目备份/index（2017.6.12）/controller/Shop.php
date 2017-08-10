<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\View;
class Shop extends Controller{
     /*
     * 商店显示
     *      */
	public function index(){
              $view=new View();
          $view->appo_info=Db::table('mariah_shopstore')->order("id asc")->select();
           return $view->fetch();
	}
         /*
     * 商店添加
     *      */
        public function add(){
            if (count($_POST)) {
           if (isset($_POST['city_provice'])&&isset($_POST['city_city'])){
         
            $position_province=explode('-',$_POST['city_provice']);
            $position_city=explode('-',$_POST['city_city']);
            $arr['position_num']=$position_province[0].'-'.$position_city[0];
            $arr['position']=$position_province[1].'-'.$position_city[1];
           
        }
        if (isset($_POST['city_county'])){
            if($_POST['city_county']){
                $position_county=explode('-',$_POST['city_county']);
                
                $arr['position_num'].='-'.$position_county[0];
                $arr['position'].='-'.$position_county[1];
            }
           
           }
             if (isset($_POST['addr'])){
            if($_POST['addr']){
                $position_addr=$_POST['addr'];
          
                $arr['position'].=$position_addr;
            }
           
           }
       $arr['shopname']=$_POST['shopname'];
     
       $arr['tel']=$_POST['tel'];
       $arr['qq']=$_POST['qq'];
        $arr['weixin']=$_POST['weixin'];
      
        $info=Db::table("mariah_shopstore")->insert($arr);
        if($info){
           $this->redirect("index/shop/add");
        }else{
            return "添加失败";
        }
        }
        $id=empty($_GET['id'])?0:$_GET['id'];
        $addr=Db::table('mariah_city')->where('parentid',$id)->select();
      
        $list=Db::table('mariah_production')->select();
	$url=URL_PATH."Index/shop/city_get";
        $this->assign("list",$list);
	$this->assign("city_get_url",$url);
        $this->assign("addr",$addr);
          return view('add');
         }
         
         
   //ajax传递获取城市信息      
         function city_get(){
        $id=empty($_GET['id'])?0:$_GET['id'];
        // return $_POST['id'];
        $city=Db::table('mariah_city')->where('parentid',$id)->select();
        if (empty($_GET['id'])) {
            return $city;
        }else{
            return json_encode($city,JSON_UNESCAPED_UNICODE);

        }
         }
         //商店删除
         
          function shopDelete(){
          $info=Db::table('mariah_shopstore')->delete($_GET['id']);
          if($info){
            $this->redirect("index/shop/index");
        }
    }
          function   shopEdit(){
           if (request()->isPost()) {
           if (isset($_POST['city_provice'])&&isset($_POST['city_city'])){
         
            $position_province=explode('-',$_POST['city_provice']);
            $position_city=explode('-',$_POST['city_city']);
            $arr['position_num']=$position_province[0].'-'.$position_city[0];
            $arr['position']=$position_province[1].'-'.$position_city[1];
           
        }
        if (isset($_POST['city_county'])){
            if($_POST['city_county']){
                $position_county=explode('-',$_POST['city_county']);
                
                $arr['position_num'].='-'.$position_county[0];
                $arr['position'].='-'.$position_county[1];
            }
           
           }
             if (isset($_POST['addr'])){
            if($_POST['addr']){
                $position_addr=$_POST['addr'];
          
                $arr['position'].=$position_addr;
            }
           
           }
       $arr['shopname']=$_POST['shopname'];
     
       $arr['tel']=$_POST['tel'];
       $arr['qq']=$_POST['qq'];
        $arr['weixin']=$_POST['weixin'];
      
        $info=Db::table("mariah_shopstore")->insert($arr);
        if($info){
           $this->redirect("index/shop/add");
        }else{
            return "添加失败";
        }
        }
        $id=empty($_GET['id'])?0:$_GET['id'];
        $addr=Db::table('mariah_city')->where('parentid',$id)->select();
      
        $list=Db::table('mariah_production')->select();
	$url=URL_PATH."Index/shop/city_get";
        $this->assign("list",$list);
	$this->assign("city_get_url",$url);
        $this->assign("addr",$addr);   
         return  view('edit');
           }
        
}