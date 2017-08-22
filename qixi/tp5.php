<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2017 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace think;

// ThinkPHP 引导文件
// 加载基础文件
// 定义应用目录
// define('ROOT','www.sorand.cn');
define('APP_PATH', __DIR__ . '/thinkphp5/application/');

// define('BS_URL',"http://".$_SERVER['HTTP_HOST']."/");//相当于http://xxx.com/
// define('URL_PATH',BS_URL."index.php/");//相当于http://xxx.com/index.php/
//定义开启调试模式
define('APP_DEBUG',true);
session_start();
// 加载框架引导文件
require __DIR__ . '/thinkphp5/thinkphp/start.php';

// require __DIR__ . '/base.php';
// // 执行应用
// App::run()->send();
