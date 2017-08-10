<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;

// use Think;
//  extends controller
class User extends Base{
    function select_user(){
        $vi=new view();
        $vi->userinfo=Db::table('mariah_user_info')->select();
        $vi->fetch();

    }
    
    function add_user(){

    }


}
