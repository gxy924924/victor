<?php
namespace  app\index\controller;
use think\Controller;
use think\Db;
use think\View;

class  Income  extends  controller{

   function    index(){
       $income=Db::table("mariah_income")->where('type','1')->select();
       for($i=0;$i<count($income);$i++){
           $income[$i]['username']=$income[$i]['username'];
       }
       $this->assign('income',$income);
     
       return view('index');
   }
   
   //同意提款
   function    agree(){
       $arr['type']=0;
       $arr['updatetime']=date("YmdHis");
       $list= Db::table('mariah_income')->where('id',$_GET['id'])->update($arr);
       if ($list) {
	 $this->redirect("index/income/index");
	}
   }
   
   //不同意提款
   function    disagree(){
       $arr['type']=2;
       $arr['updatetime']=date("YmdHis");
       $list= Db::table('mariah_income')->where('id',$_GET['id'])->update($arr);
       if ($list) {
	 $this->redirect("index/income/index");
	}
   }
   
   function    record(){
       $list= Db::table('mariah_income')->where('type','0')->select();
       for($i=0;$i<count($list);$i++){
           $list[$i]['username']= json_decode($list[$i]['username']);
       }
 
       $this->assign('list',$list);
     return  view('record');     
   }
   
}