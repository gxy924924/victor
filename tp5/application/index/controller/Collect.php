<?php
namespace  app\index\controller;
use think\Controller;
use think\Db;
use think\View;
use think\Log;
class  Collect  extends  controller{
  //收藏  
    function    index(){
        if(request()->isPost()){
            $data['success']='收藏成功';
            $key['erro']='已收藏';
            $arr['uid']=$_POST['uid'];
            $arr['pid']=$_POST['pid'];
            $list=DB::table('mariah_collect')->where(array('uid'=>$arr['uid'],'pid'=>$arr['pid']))->select();
            if($list){
                echo json_encode($key);
            }else{
                  $info=DB::table('mariah_collect')->insert($arr);
            if($info){
                echo json_encode($data);
            }
            }
          
        }
    }
 //我的收藏，收藏查询   
    function   collect(){
      
        if(request()->isPost()){
            $uid['uid']=$_POST['uid'];
             // echo json_encode($uid);
            $list=DB::table('mariah_collect')->where('uid',$uid['uid'])->field('pid')->select();
         for($i=0;$i<count($list);$i++){
             $key[$i]=$list[$i]['pid']; 
        
         }  
        for($j=0;$j<count($key);$j++){
            $value=$key[$j];
            $info[]=DB::table('mariah_production')->where('id',$value)->select();
            
        }
        echo json_encode($info);
        }
     return view('collect');
    }
    
}
