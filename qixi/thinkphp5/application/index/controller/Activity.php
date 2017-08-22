<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;

// use Think;
//  extends controller
class Activity extends Controller{   
    function __construct(){
        parent::__construct();
    }

    function activity_guest_info_show(){
        $vi=new View();
        $total_page=10;
        $vi->activity_info = Db::table('activity_guest_info')->order('time desc')->paginate($total_page);
        return $vi->fetch();
    }

    function activity_delete(){
        $res = Db::table('activity_guest_info')->where('id',$_GET['id'])->delete();
        $this->redirect('activity_guest_info_show');
    }


}
