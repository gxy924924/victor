<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;
use think\File;
use think\Paginator;

class Tuikuan extends Base {

    public function index() {
        $list = Db::table('mariah_money_detail')->where('status', '1')->order("id asc")->select();
        $this->assign('list', $list);
        return view('index');
    }

    public function agree() {
        $info = Db::table('mariah_money_detail')->delete($_GET['id']);
        if ($info) {
            $this->redirect("index/tuikuan/index");
        }
    }

    public function disagree() {
        $list = Db::table('mariah_money_detail')->where('id', $_GET['id'])->find();
        if ($list['status'] == '1') {
            $data = array(
                'status' => 0,
            );
        }
        $info = Db::table("mariah_money_detail")->where('id', $_GET['id'])->update($data);
        if ($info) {
            $this->redirect("index/tuikuan/index");
        }
    }

}
