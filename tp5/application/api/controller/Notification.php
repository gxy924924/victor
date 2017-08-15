<?php
namespace app\api\controller;

use think\Controller;
use think\Db;
use think\View;
use think\File;
use think\paginator;

//tp5.com/index.php/api/notification/notification_watch
// use Think;
//  extends controller
//通知和行业知识等等
class Notification{
    //显示热门产品
    function show_hot_production(){
        $hot=Db::table('mariah_hot_production')->order('id')->select();
        foreach ($hot as $key => $val) {
            $p_id=$val['p_id'];
            $arr=Db::table('mariah_production')->where('id',$p_id)->find();
            $hot[$key]["p_info"]=$arr;
        }
        $input_info=["empty"];
        $api_info=$hot;
        $this->log_helper($input_info,$api_info);
        $api_info=json_encode($api_info);
        return $api_info;
        // echo "<pre>";
        // var_dump($hot);
        // echo "<pre>";
    }

    //显示文章
    function show_article(){
        // $_POST['p_id']=2;
        $p_id=$_POST['p_id'];
        $at_content=Db::table('mariah_article_content')->where('p_id',$p_id)->order('add_time')->select();

        $api_info=$at_content;
        $this->log_helper(["p_id"=>$p_id],$api_info);
        $api_info=json_encode($api_info);
        return $api_info;
        // var_dump($at_content);
        
    }

    //显示文章标题
    function show_title(){
        // $_POST['sort_id']=1;
        $sort_id=$_POST['sort_id'];
        $at_title=Db::table('mariah_article_title')->where('sort_id',$sort_id)->select();

        $api_info=$at_title;
        $this->log_helper(["sort_id"=>$sort_id],$api_info);
        $api_info=json_encode($api_info);
        return $api_info;
    }


    //用户查看到通知图标时（返回未看通知数量）
    function user_watch(){
        // $_POST['user_id']=47;
        $user_id=$_POST['user_id'];
        $watched_info=Db::table('mariah_notification_user')->where('user_id',$user_id)->find();

        if(empty($watched_info)){
            $user_to_watch=$this->user_watch_init($user_id);
        }else{
            $user_to_watch=$watched_info['user_to_watch'];
            $ua=$this->user_watch_refresh($user_id,$watched_info['last_watch_time'],$watched_info['user_to_watch']);
            if(!empty($ua)){
                $user_to_watch=$ua;
            }
        }
        $num=$this->count_user_watch($user_to_watch);
        $api_info['num']=$num;
        $this->log_helper(['user_id'=>$_POST['user_id']],$api_info);
        $api_info=json_encode($api_info);
        return $api_info;
    }
        //计数
    function count_user_watch($u){

        $arr=explode(',', $u);
        // var_dump($arr);
        $num=count($arr);
        if(empty($arr[0])){
            $num=0;
        }
        return $num;
    }

    //查看通知
    function notification_watch(){
        // $_POST['user_id']=47;
        // $_POST['check']='true';
        $user_id=$_POST['user_id'];
        $check=$_POST['check'];
        $watched_info=Db::table('mariah_notification_user')->field('user_to_watch')->where('user_id',$user_id)->find();
        $notification=Db::table('mariah_notification')->order('note_time desc')->select();
        $arr=explode(',', $watched_info['user_to_watch']);
        foreach ($arr as $k => $v) {
            $arr1[$v]=1;
        }
        // var_dump($arr1);
        foreach ($notification as $key => $val) {
            $time=strtotime($val['note_time']);
            $notification[$key]['note_time']=date('Y年m月d日');
        }
        if($check=='true'){
            $watched_info['user_to_watch']="";
            $sql_info=Db::table('mariah_notification_user')->where('user_id',$user_id)->update($watched_info);
            // var_dump($watched_info);
        }
        foreach ($notification as $key => $val) {
            $arr=json_decode($val['notification'],1);
            $notification[$key]['notification']=$arr;
        }
        
        // var_dump($arr);
        $api_info=$notification;
        $this->log_helper(['user_id'=>$_POST['user_id']],$api_info);
        $api_info=json_encode($api_info);
        return $api_info;
        // echo "<pre>";
        // var_dump($notification);
        // echo "</pre>";

    }

    //阅读通知
    function notification_get_info(){
        // $_POST['user_id']=47;
        // $_POST['note_id']=2;
        // $_POST['check']='true';
        $user_id=$_POST['user_id'];
        $note_id=$_POST['note_id'];
        $check=$_POST['check'];
        $notification=Db::table('mariah_notification')->where('id',$note_id)->find();
        if($check=='true'){
            $watched_info=Db::table('mariah_notification_user')->field('user_to_watch')->where('user_id',$user_id)->find();
            $user_to_watch=$watched_info['user_to_watch'];
            $arr=explode(',', $user_to_watch);
            foreach ($arr as $key => $val) {
                if($val==$note_id){
                    unset($arr[$key]);
                }
            }
            $watched_info['user_to_watch']=implode(',',$arr);
            $sql_info=Db::table('mariah_notification_user')->where('user_id',$user_id)->update($watched_info);
            // var_dump($watched_info);
        }

        $input_info=['user_id'=>$_POST['user_id'],'note_id'=>$_POST['note_id'],'check'=>$_POST['check']];
        $api_info=$notification;
        $this->log_helper($input_info,$api_info);
        $api_info=json_encode($api_info);
        return $api_info;

    }



    //用户第一次看通知
    function user_watch_init($id){
        $notification=Db::table('mariah_notification')->field('id')->select();
        $user_to_watch="";
        foreach ($notification as $key => $val) {
            if($key>0){
                $user_to_watch.=",";
            }
            $user_to_watch.=$val['id'];
        }
        $last_watch_time=date("Y-m-d H-i-s");
        $user_watch_info['user_id']=$id;
        $user_watch_info['user_to_watch']=$user_to_watch;
        $user_watch_info['last_watch_time']=$last_watch_time;
        $sql_info=Db::table('mariah_notification_user')->insert($user_watch_info);
        // var_dump($user_watch_info);
        // var_dump($sql_info);
        return $user_to_watch;
    }

    //更新用户未看通知
    function user_watch_refresh($id,$date_time,$user_to_watch){
        $time=strtotime($date_time);
        $add_time=600;
        if(time()>$time+$add_time){

            $notification=Db::table('mariah_notification')->field('id')->where('note_time','>= time',$date_time)->select();
            if(!empty($notification[0]['id'])){
                foreach ($notification as $key => $val) {
                    if(!empty($user_to_watch)){
                        $user_to_watch.=",";
                    }
                    $user_to_watch.=$val['id'];
                }
                $input_sql['user_to_watch']=$user_to_watch;
            }
            $new_date_time=date("Y-m-d H-i-s");
            $input_sql['last_watch_time']=$new_date_time;
            
            $sql_info=Db::table('mariah_notification_user')->where('user_id',$id)->update($input_sql);
            return $user_to_watch;
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

        $vi->sort=Db::table('mariah_article_sort')->select();
        return $vi->fetch();
        
    }

}
