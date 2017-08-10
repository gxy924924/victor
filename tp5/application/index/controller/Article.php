<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;
use think\paginator;
use think\File;

// use Think;
//  extends controller
class Article extends Base{
    //显示热点项目
    function show_hot_production(){
        $vi=new View();
        $vi->hot=Db::table('mariah_hot_production')->select();
        return $vi->fetch();
    }
    function show_update_hot_production(){
        $vi=new View();
        $vi->hot=Db::table('mariah_hot_production')->select();
        $vi->hot_pro=Db::table('mariah_hot_production')->where('id',$_GET['id'])->find();
        $vi->production=Db::table('mariah_production')->select();
        return $vi->fetch();
    }
    // function add_hot_production(){
    //     $imgp=$this->img_upload();
    //     $res=Db::table('mariah_hot_production')->insert(['title'=>$_POST['title'],'img_url'=>$imgp,'p_id'=>$_POST['p_id']]);
    //     var_dump($res);
    // }
    function update_hot_production(){
        $imgp=$this->img_upload();
        $up_arr=['title'=>$_POST['title'],'p_id'=>$_POST['p_id']];
        if(!empty($imgp)){
            $at_title=Db::table('mariah_hot_production')->where('id',$_GET['id'])->find();
            // var_dump($at_title);
            // echo "<br/>";
            $this->del_file($at_title['img_url']);
            $up_arr['img_url']=$imgp;
        }
        
        var_dump($up_arr);
        $res=Db::table('mariah_hot_production')->where('id',$_GET['id'])->update($up_arr);
        var_dump($res);
    }

    //显示通知
    function show_notification(){
        $vi=new View();
        $vi->notification=Db::table('mariah_notification')->select();
        return $vi->fetch();
    }
    //显示修改通知
    function show_update_notification(){
        $vi=new View();
        $vi->notification=Db::table('mariah_notification')->where('id',$_GET['id'])->find();
        return $vi->fetch();
    }

    //添加通知
    function add_notification(){
        $_POST['notification']=json_encode($_POST['notification']);
        $res=Db::table('mariah_notification')->insert($_POST);
        $this->redirect(url('index/article/show_notification'));
    }

    //删除通知
    function del_notification(){
        $res=Db::table('mariah_notification')->where($_GET)->delete();
        $this->redirect(url('index/article/show_notification'));
    }

    //修改通知
    function update_notification(){
        $_POST['notification']=json_encode($_POST['notification']);
        $res=Db::table('mariah_notification')->where('id',$_GET['id'])->update($_POST);
        $this->redirect(url('index/article/show_notification'));
    }

    //显示文章
    function show_article(){
        $vi=new View();
        $vi->sort=Db::table('mariah_article_sort')->select();
        $obj=Db::table('mariah_article_title');
        if(!empty($_GET['sort_id'])){
            $obj=$obj->where('sort_id',$_GET['sort_id']);
        }
        $vi->at_title=$obj->select();
        return $vi->fetch();
    }

    //添加文章内容
    function show_content(){
        $vi=new View();
        $vi->at_title=Db::table('mariah_article_title')->where('id',$_GET['p_id'])->find();
        $vi->at_content=Db::table('mariah_article_content')->order('add_time')->where('p_id',$_GET['p_id'])->select();
        return $vi->fetch();
    }

    //添加文章
    function add_article(){
 
        $imgp=$this->img_upload();
        $sql_info=Db::table('mariah_article_title')->insert(['img_url'=>$imgp,'title'=>$_POST['title'],'sort_id'=>$_POST['sort_id']]);
        $this->redirect(url('index/article/show_article'));
    }

    //添加文章内容
    function add_content(){
        $imgp=$this->img_upload();
        $sql_info=Db::table('mariah_article_content')->insert(['img_url'=>$imgp,'p_id'=>$_POST['p_id'],'content'=>$_POST['content']]);
        $this->redirect(url('index/article/show_content')."?p_id=".$_POST['p_id']);
    }

    //删除整篇文章
    function del_artical(){
        $at_title=Db::table('mariah_article_title')->where('id',$_GET['p_id'])->find();
        $at_content=Db::table('mariah_article_content')->where('p_id',$_GET['p_id'])->select();
        //删除图片
        $this->del_file($at_title['img_url']);
        foreach ($at_content as $key => $val) {
            $this->del_file($val['img_url']);
        }
        //删除数据库
        Db::table('mariah_article_title')->where('id',$_GET['p_id'])->delete();
        Db::table('mariah_article_content')->where('p_id',$_GET['p_id'])->delete();
        $this->redirect(url('index/article/show_article'));
    }

    //删除段落内容
    function del_content(){
        $cont_info=Db::table('mariah_article_content')->where('p_id',$_GET['p_id'])->where('add_time',$_GET['add_time'])->find();
        $res=$this->del_file($cont_info['img_url']);
        $res2=Db::table('mariah_article_content')->where('p_id',$_GET['p_id'])->where('add_time',$_GET['add_time'])->delete();

        var_dump($res."||".$res2);
        $this->redirect(url('index/article/show_content')."?p_id=".$_GET['p_id']);
    }

    //删除文件工具
    function del_file($file,$add_path="./public/uploads/"){
        $file_path=$add_path.$file;
        if(is_file($file_path)){
            unlink($file_path);
            return 1;
        }else{
            return 0;
        }
    }

    //图片上传工具
    function img_upload(){
        $file = request()->file('img');
        if (isset($file)) {
            // 获取表单上传文件 例如上传了001.jpg
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->validate(['ext'=>'jpg,jpeg,png,gif'])->move(ROOT_PATH . 'public/uploads');

            if ($info) {
                // 成功上传后 获取上传信息
                $a = $info->getSaveName();
                $imgp = str_replace("\\", "/", $a);
                
            } else {
                // 上传失败获取错误信息
                $err=$file->getError();
                $this->error('上传文件错误：'.$err);
            }
        }else{
            $imgp=false;
        }
        return $imgp;
    }

    //设置标题更改信息
    function show_update_title(){
        $vi=new View();
        $vi->sort=Db::table('mariah_article_sort')->select();
        $vi->at_title=Db::table('mariah_article_title')->where('id',$_GET['p_id'])->find();
        return $vi->fetch();
    }

    //设置段落更改信息
    function show_update_content(){
        
        $vi=new View();
        $vi->at_content=Db::table('mariah_article_content')->where('p_id',$_GET['p_id'])->where('add_time',$_GET['add_time'])->find();
        return $vi->fetch();
    }

    //更改文章标题
    function update_title(){
        $file=$this->img_upload();
        if(!empty($file)){
            $at_title=Db::table('mariah_article_title')->where('id',$_GET['p_id'])->find();
            $this->del_file($at_title['img_url']);
            $up_arr['img_url']=$file;
        }
        $up_arr['title']=$_POST['title'];
        $up_arr['sort_id']=$_POST['sort_id'];
        $res=Db::table('mariah_article_title')->where('id',$_GET['p_id'])->update($up_arr);
        $this->redirect(url('index/article/show_article'));
    }

    //更改文章段落
    function update_content(){
        $file=$this->img_upload();
        if(!empty($file)){
            $at_title=Db::table('mariah_article_title')->where('id',$_GET['p_id'])->find();
            $this->del_file($at_title['img_url']);
            $up_arr['img_url']=$file;
        }
        $up_arr['content']=$_POST['content'];
        
        $res=Db::table('mariah_article_content')->where('p_id',$_GET['p_id'])->where('add_time',$_GET['add_time'])->update($up_arr);
        $this->redirect(url('index/article/show_content')."?p_id=".$_GET['p_id']);

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


}
