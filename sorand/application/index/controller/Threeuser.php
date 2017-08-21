<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;

class Threeuser extends controller {

    public function index() {
        if (request()->isPost()) {

            $arr['tel'] = $_POST['phone'];
            $arr['password'] = md5($_POST['password']);

            $list = Db::table('mariah_user')->where('tel', $arr['tel'])->find();
            dump($arr['password']);
            dump($list['password']);
            exit;
            if ($arr['password'] == $list['password']) {
                dump('登录成功');
            }
        }
        return view('index');
    }

    public function user() {
        if (request()->isPost) {
            $arr['tel'] = $_POST['phone'];
            $arr['openid'] = $_POST['openid'];
            if ($arr['openid'] == '') {
                $appo_info = Db::table('mariah_user')->where('tel', $arr['tel'])->find();
                echo json_encode($appo_info);
            } else {
                $list = Db::table('mariah_user')->where('openid', $arr['openid'])->find();
                echo json_encode($list);
            }
        }
    }

}
