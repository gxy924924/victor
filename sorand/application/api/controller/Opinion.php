<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use think\View;
use think\File;
use think\Paginator;

class Opinion extends controller {

    //app提出建议
    public function index() {
        if (request()->isPost()) {
            $arr['success'] = '成功';
            $data['view'] = $_POST['view'];
            $data['uid'] = $_POST['uid'];
            $data['phone'] = $_POST['phone'];
            $data['openid'] = $_POST['openid'];

            $info = DB::table('mariah_view')->insert($data);
            if ($info) {
                echo json_encode($arr);
            }
        }
    }

}
