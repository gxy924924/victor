<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use think\View;

class Comment extends controller {

    //评论 
    function index() {
        if (request()->isPost()) {
            $data['success'] = '评论成功';
            $arr['uid'] = $_POST['uid'];
            $arr['body'] = $_POST['body'];
            $arr['world'] = $_POST['world'];
            $arr['scomment'] = $_POST['scomment'];
            $arr['pcomment'] = $_POST['pcomment'];
            $arr['before_img'] = $_POST['before_img'];
            $arr['after_img'] = $_POST['after_img'];
            $arr['username'] = $_POST['username'];
            $arr['headimgurl'] = $_POST['headimgurl'];
            $arr['creattime'] = date("Ymd");
            $arr['shopname'] = $_POST['shopname'];
//           import('upload.UploadFile',EXTEND_PATH);
//            $upload = new \UploadFile();// 实例化上传类
//            $upload->maxSize = 3145728 ;// 设置附件上传大小
//            $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
//            $upload->savePath = './public/comment/';// 设置附件上传目录
//            if(!$upload->upload()){
//            $this->error($upload->getErrorMsg());die;//输出错误提示
//            }else{
//           $info = $upload->getUploadFileInfo(); //取得成功上传的文件信息
//            //echo json_encode($info);
//                foreach($info as $key => $value){
//                    $array[$key]['path'] = './public/comment/'.$value['savename'];//这里以获取在本地的保存路径为例
//               }
//             }
//             if(!empty($array['image'][0])){
//                 $arr['before_img1']=$array['image'][0];
//             }
//              if(!empty($array['image'][1])){
//                 $arr['before_img2']=$array['image'][1];
//             }
//              if(!empty($array['image'][2])){
//                 $arr['before_img3']=$array['image'][2];
//             }
//               if(!empty($array['image'][3])){
//                 $arr['before_img4']=$array['image'][3];
//             }
//           Log::record($a);   
//             $files = request()->file('image');
//            
//    foreach($files as $file){
//        // 移动到框架应用根目录/public/uploads/ 目录下
//        $info = $file->move(ROOT_PATH . '/public/comment/');
//        if($info){
//             
//          //echo $info->getExtension(); 
//            // 输出 42a79759f284b767dfcb2a0197904287.jpg
//           $array['img'][]=$info->getFilename();  
//	 
//        }else{
//            // 上传失败获取错误信息
//           $b= $file->getError();
//           echo json_encode($b);
//        }    
//    }  
//     
//              if(!empty($array['img'][0])){
//                 $arr['before_img1']=$array['img'][0];
//             }
//              if(!empty($array['img'][1])){
//                 $arr['before_img2']=$array['img'][1];
//             }
//              if(!empty($array['img'][2])){
//                 $arr['before_img3']=$array['img'][2];
//             }
//               if(!empty($array['img'][3])){
//                 $arr['before_img4']=$array['img'][3];
//             }

            $list = DB::table('mariah_comment')->insert($arr);
            if ($list) {
                echo json_encode($data);
            }
        }
    }

    //评论展示
    function comment() {
        if (request()->isPost()) {
            $info = Db::table('mariah_comment')->where('body', $_POST['body'])->select();
            if ($info) {
                echo json_encode($info);
            }
        }
    }

    //给ＡＰＰ热门项目的名称
    function hot() {

        $info = Db::table('mariah_classify')->field('classify')->select();
        if ($info) {
            echo json_encode($info);
        }
    }

    //店铺评论
    function shopcomment() {
        if (request()->isPost()) {
            if ($_POST['classify'] == '') {
                $info = Db::table('mariah_comment')->where(array('shopname' => $_POST['shopname']))->select();
                if ($info) {
                    echo json_encode($info);
                }
            } else {
                $list = Db::table('mariah_production')->where(array('classify' => $_POST['classify']))->field('production')->select();
                for ($i = 0; $i < count($list); $i++) {
                    $production = $list[$i]['production'];
                    $info[] = Db::table('mariah_comment')->where(array('shopname' => $_POST['shopname'], 'body' => $production))->select();
                }
                for ($j = 0; $j < count($info); $j++) {
                    if (!empty($info[$j])) {
                        echo json_encode($info[$j]);
                    }
                }
            }
        }
    }

    function ceshi() {
        $_POST['classify'] = '半永久';
        //$classify=$_POST['classify'];
        $_POST['shopname'] = '福州玛瑞娅-爱琴海店';
        // $shopname=$_POST['shopname'];
        $list = Db::table('mariah_production')->where(array('classify' => $_POST['classify']))->field('production')->select();
        for ($i = 0; $i < count($list); $i++) {
            $production = $list[$i]['production'];
            $arr['shopname'] = $_POST['shopname'];
            $arr['body'] = $production;
            $info[] = Db::table('mariah_comment')->where($arr)->select();
        }
        for ($j = 0; $j < count($info); $j++) {
            if (!empty($info[$j])) {
                echo json_encode($info[$j]);
            }
        }
    }

    //删除评论
    function del() {
        $arr['success'] = '评论删除';
        if (request()->isPost()) {
            $info = Db::table('mariah_comment')->where('pid', $_POST['pid'])->delete();
            if ($info) {
                echo json_encode($arr);
            }
        }
    }

}
