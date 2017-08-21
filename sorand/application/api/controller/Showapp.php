<?php
namespace app\api\controller;

use think\Controller;
use think\Db;
use think\View;
use think\paginator;


// use Think;
//  extends controller
class Showapp{

    function showapp(){
        $vi=new View();
        return $vi->fetch();
    }


}
