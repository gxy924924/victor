<?php
return array(
	//'配置项'=>'配置值'
	//模板常量
	'TMPL_PARSE_STRING' => array(	//增加一个自定义模板常量
		'__ADMIN__' => __ROOT__.'/Public/Admin'
	),
	//数据库配置
    'DB_NAME'               =>  'test',          // 数据库名
	//url访问模式设置
	'URL_MODEL'             =>  1,       // URL访问模式,可选参数0、1、2、3,
	// 开启路由
	'URL_ROUTER_ON'   => true, 
	'URL_ROUTE_RULES'=>array(
	'news/:id'          => 'Index/index',
	'my'         => 'index', // 静态地址路由
	),
	//缓存设置
	//'HTML_CACHE_ON'     =>    true, // 开启静态缓存
	//'HTML_CACHE_TIME'   =>    60,   // 全局静态缓存有效期（秒）
	//'HTML_FILE_SUFFIX'  =>    '.shtml', // 设置静态缓存文件后缀
	'HTML_CACHE_RULES'  =>     array(  // 定义静态缓存规则
		'*'=>array('{:module}/{:action}',20),
	),
);