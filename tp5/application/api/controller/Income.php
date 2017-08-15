<?php
namespace  app\api\controller;
use think\Controller;
use think\Db;
use think\View;

class  Income  extends  controller{

   function    index(){
    if(request()->isPost()){
       $arr['uid']=$_POST['uid'];
      $sum['yongjin']=0;
      $list = Db::table("mariah_income")->where('uid',$arr['uid'])->select();
      if(!$list){
          $arr['income']=0;
          $arr['type']=0;
          $arr['creattime']=date("YmdHis");
        $info=Db::table("mariah_income")->insert($arr);
      }
      $income=Db::table("mariah_income")->where('uid',$arr['uid'])->select();
      for($i=0;$i<count($income);$i++){
          $sum['type']=$income[$i]['type'];
          $sum['yongjin']=$sum['yongjin']+$income[$i]['income'];
      }
      echo json_encode($sum);
    } 
   } 
   
   function  income(){
       $ary['success']='正在提交';
      if(request()->isPost()){
          $arr['uid']=$_POST['uid'];
          $arr['type']='1';
          $arr['income']=$_POST['income'];
          $arr['creattime']=date("YmdHis");
          $arr['money']=$_POST['money'];
          $arr['yongjin']=$_POST['yongjin'];
          $arr['tel']=$_POST['tel'];
          $arr['username']=  json_encode($_POST['username']);
 
          $info=Db::table("mariah_income")->insert($arr);
          
          if($info){
              echo json_encode($ary);
          }
      } 
   }
   
      function    record(){
       if(request()->isPost()){
       $uid=$_POST['uid'];
       $list= Db::table('mariah_income')->where(array('type'=>'0','uid'=>$uid))->field('creattime,income')->select();
       
       echo json_encode($list);
       }     
   }
}