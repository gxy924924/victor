<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use think\View;

class Threeuser extends controller {

//用QQ微信等注册，第一次写入用户表
    public function index() {
        if (request()->isPost()) {
            $str = array();
            $str['success'] = '第三方写入成功';
            $arr['username'] = json_encode($_POST['nickname']);
            $arr['headimgurl'] = $_POST['headimgurl'];
            $arr['openid'] = $_POST['openid'];
            $arr['sex'] = $_POST['sex'];
            $arr['type'] = $_POST['type'];
            $arr['status'] = '1';
            $info = Db::table('mariah_user')->where('openid', $arr['openid'])->select();
            if ($info) {
                echo json_encode($info);
            } else {
                $list = Db::table('mariah_user')->insert($arr);
                if ($list) {
                    echo json_encode($str);
                }
            }
        }
    }

    //获取用户id
    public function open() {
        if (request()->isPost()) {
            $arr['openid'] = $_POST['openid'];
            $arr['tel'] = $_POST['phone'];
            if ($arr['tel'] == '') {
                $info = Db::table('mariah_user')->where('openid', $arr['openid'])->find();

                if ($info) {
                    echo json_encode($info);
                }
            } else {
                $list = Db::table('mariah_user')->where('tel', $arr['tel'])->find();
                if ($list) {

                    $list['id'] = string($list['id']);
                    echo json_encode($list);
                }
            }
        }
    }

    //第三方登入
    public function user() {
        if (request()->isPost()) {
            $arr['tel'] = $_POST['phone'];
            $arr['openid'] = $_POST['openid'];
            if ($arr['openid'] == '') {
                $appo_info = Db::table('mariah_user')->where('tel', $arr['tel'])->find();
                $appo_info['username'] = json_decode($appo_info['username']);
                echo json_encode($appo_info);
            } else {
                $list = Db::table('mariah_user')->where('openid', $arr['openid'])->find();
                $list['username'] = json_decode($list['username']);
                echo json_encode($list);
            }
        }
    }

    //更新用户信息     
    public function giveUser() {
        if (request()->isPost()) {
            $str['success'] = '更新成功';
            $arr['headimgurl'] = $_POST['headimgurl'];
            $arr['sex'] = $_POST['sex'];
            $arr['position'] = $_POST['position'];
            $arr['birthday'] = $_POST['birthday'];
            $arr['username'] = json_encode($_POST['username']);
            $arr['tel'] = $_POST['phone'];
            $arr['openid'] = $_POST['openid'];
            if ($arr['openid'] == '') {
                $appo_info = Db::table('mariah_user')->where('tel', $arr['tel'])->update($arr);
                if ($appo_info) {
                    echo json_encode($str);
                }
            } else {
                $list = Db::table('mariah_user')->where('openid', $arr['openid'])->update($arr);
                echo json_encode($str);
            }
        }
    }

    //更改用户信息的头像
    public function img() {
        $str['success'] = '更新成功';
        if (request()->isPost()) {
            $arr['tel'] = $_POST['phone'];
            $arr['openid'] = $_POST['openid'];
            $file = request()->file('img');
            ;

            if (isset($file)) {
                // dump($file);exit;
                // 获取表单上传文件 例如上传了001.jpg
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->validate(['ext' => 'jpg,jpeg,png,gif'])->move(ROOT_PATH . '/public/uploads');
                if ($info) {
                    // 成功上传后 获取上传信息
                    $a = $info->getSaveName();
                    $imgp = str_replace("\\", "/", $a);
                    $imgpath = '/uploads/' . $imgp;
                    $data['headimgurl'] = $imgpath;
                } else {
                    // 上传失败获取错误信息
                    echo $file->getError();
                }
                if (isset($arr['openid'])) {
                    $appo_info = Db::table('mariah_user')->where('tel', $arr['tel'])->update($data);
                    if ($appo_info) {
                        echo json_encode($str);
                    }
                } else {
                    $list = Db::table('mariah_user')->where('openid', $arr['openid'])->update($data);
                    echo json_encode($str);
                }
            }
        }
    }

}
