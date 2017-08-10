<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\View;

class Opinion extends controller {
    function   index(){
        $info=DB::table('mariah_view')->select();
        $this->assign('info', $info);
        return view('index');
    }
}
