<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use think\View;
use think\File;
use think\Paginator;

class Production extends controller {
    /*
     * 项目显示
     *      */

    public function index() {
        $list = Db::table('mariah_production')->order("id asc")->paginate(10);

        //dump($list);exit;
        echo json_encode($list);
    }

    //项目分类查询
    public function classify() {
        $list = Db::table('mariah_classify')->order("id asc")->select();
        for ($i = 0; $i < count($list); $i++) {
            $v[$i]['classify'] = $list[$i]['classify'];
        }
        echo json_encode($v);
    }

    //项目分类请求找到相对应的项目
    public function requestClassify() {
        if (request()->ispost()) {
            $arr['classify'] = $_POST['classify'];
            $list = Db::table('mariah_production')->where('classify', $arr['classify'])->order("id asc")->select();
            echo json_encode($list);
        }
    }

}
