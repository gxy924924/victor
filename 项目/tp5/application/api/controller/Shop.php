<?php
namespace app\api\controller;
use think\Controller;
use think\Db;
use think\View;
class Shop extends controller {
    //显示店铺
    public   function   shopname(){
        $appo_info = Db::table('mariah_shopstore')->order("id asc")->select();
        echo json_encode($appo_info);
    }

    //显示单个店铺的所有项目
    public function index() {
            if(request()->isPost()){
	      	$appo_info = Db::table('mariah_shopstore')->order("id asc")->select();
                $pid=  Db::table('mariah_shopping')->where('shopid',$_POST['id'])->field("pid")->select();
               // dump($pid);exit;
                for($i=0;$i<count($pid);$i++){
                  $p[$i]=unserialize($pid[$i]['pid']);
              
                  for($j=0;$j<count($p[$i]);$j++){
                     $cc[$j]=$p[$i][$j];
                     $production[]=  Db::table('mariah_production')->where('id', $cc[$j])->select();
                  }
                }
                echo json_encode($production); 
            }
                            
	}
       
        //查询单个店铺的详情
        public function shop() {  
             $help['error']='失败';
              if(request()->isPost()){
                $arr['id']=$_POST['id'];
                $appo_info = Db::table('mariah_shopstore')->where('id',$arr['id'])->find();
                if($appo_info){
                  
               echo json_encode($appo_info);
                }  else {
                   echo json_encode($help); 
                }
              }
	                 
	}
   
    }
        
        
  
	