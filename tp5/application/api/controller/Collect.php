<?php
namespace  app\api\controller;
use think\Controller;
use think\Db;
use think\View;

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
        $uid=$_POST['uid'];
        $list=DB::table('mariah_collect')->where('uid',$uid)->field('pid')->select();
       // $list=DB::table('mariah_collect')->where('uid',$uid)->field('id')->select();
        foreach($list as  $k=>$v){
           $arr=$v;
           $info2=DB::table('mariah_production')->where('id',$arr['pid'])->select();
           $info[]=$info2[0];

        }
           if($info){

            $info=json_encode($info);
            $this->log_helper($_POST['uid'],$info);
            echo $info;
            // echo "<pre>";
            // var_dump(json_decode($info,1));
            // echo "</pre>";
        }
    }     


}

   function   del(){
       $arr['success']='收藏取消';
       if(request()->isPost()){ 
          $info = Db::table('mariah_collect')->where(array('uid'=>$_POST['uid'],'pid'=>$_POST['pid']))->delete();
          if($info){
             echo json_encode($arr); 
          }
       }
   }

    function log_helper($input="",$output=""){
        $file='my_test_log.txt';
        if(!empty($input)){
            $arr['input']=$input;
            $arr['output']=$output;
            $str=json_encode($arr);
            file_put_contents($file, $str);
        }else{
            if(is_file($file)){
                $info=file_get_contents($file);
                $info=json_decode($info,1);
                echo "<pre>";
                var_dump($info);
                echo "</pre>";
            }
        }
    }

    function test(){
        $this->log_helper();
        $vi=new View();
        return $vi->fetch('/coupons/test');
        
    }
    
}
