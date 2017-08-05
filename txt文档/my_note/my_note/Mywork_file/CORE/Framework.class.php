<?php
// framework/core/Framework.class.php

class Framework {

	//测试
	public static function run() {

		//        echo "run()";
		
		//测试自动加载
		self::autoload();
		//测试初始化加载
		self::init();
		//路由/分发
		self::dispach();
   }

   //自动加载
   private static function autoload(){
		spl_autoload_register(array(__CLASS__,'load'));
   }

   //自动加载方法load()
   private static function load($file){
	   //类名如：Controller.class.php
		if(substr($file,-10)=="Controller"){
			$file=CONTROLLER_PATH.$file.".class.php";
	   }else{
			//mode1,类名=文件名
		   $file=$file.".class.php";
	   }
	   //var_dump($file);

	   //
		if(is_file($file)){
			require_once $file;
		}else if(is_file(CORE.$file)){
			require_once CORE.$file;
		}
		
		//mode3,类名Model.class.php
   }

   //初始化
   private static function init(){
		//定义分界符
	   define("DS",DIRECTORY_SEPARATOR);
		//定义根目录
	   define("ROOT",getcwd().DS);
		//定义公共目录
	   define("PUBLIC_PATH",ROOT."Public".DS);
	   //定义核心目录
	   define("CORE",ROOT."CORE".DS);
	   //定义引入库目录
	   define("LIB",ROOT."Lib".DS);
	   //定义Model模型目录--M
	   define("MODEL_PATH",ROOT."Model".DS);
	   //定义View模型目录--V
	   define("VIEW_PATH",ROOT."View".DS);
	   //定义Controller模型目录--C
	   define("CONTROLLER_PATH",ROOT."Controller".DS);

   //变化获取
	   //通过获取url?v="视图文件名（方法）"
		define("VIEW", isset($_GET['v']) ? $_REQUEST['v'] : "index" );
		//通过获取url?c="类文件名前部分（类）"
		define("CONTROLLER", isset($_GET['c']) ? $_REQUEST['c'] : "Index" );
		//
		define("U_PATH",$_SERVER['SCRIPT_NAME']);
	//变化相关
		//当前使用的View文件目录
		define("CURR_VIEW_PATH",VIEW_PATH.CONTROLLER.DS);

		//
		//require CORE."sqlHelper.class.php";	//已在自动加载机制中生成
		//require CORE."Page.class.php";
		require CORE."Controller.class.php";
		//不用smarty了，在网上发现有流程控制的替代语法，在加上少量的php代码可以使得结构更好，更轻量级。
		//require LIB."smarty-3.1.16".DS."libs".DS."Smarty.class.php";
		//启动session
		session_start();
		//echo VIEW;
		//echo CONTROLLER;
   }

   // Routing and dispatching 路由/分发
   private static function dispach(){
		//由url?c=Index;发出命令
		$controller_name= CONTROLLER."Controller";
		//选择方法
		$action_name=VIEW;
		$controller=new $controller_name;
		$controller->$action_name();
   }
}
?>