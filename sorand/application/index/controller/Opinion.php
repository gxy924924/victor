<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;

class Opinion extends controller {

    function index() {
        $info = DB::table('mariah_view a')->join('mariah_user b on  a', 'a.uid=b.id', 'left')->field('a.*,b.username')->select();
        for ($i = 0; $i < count($info); $i++) {
            $info[$i]['username'] = json_decode($info[$i]['username']);
        }
        $this->assign('info', $info);
        return view('index');
    }

}
