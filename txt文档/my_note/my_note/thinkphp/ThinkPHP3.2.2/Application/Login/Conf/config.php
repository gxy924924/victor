<?php
return array(
	//'配置项'=>'配置值'
	//模板常量
	'TMPL_PARSE_STRING' => array(	//增加一个自定义模板常量
		'__ADMIN__' => __ROOT__.'/Public/Admin'
	),
	'TMPL_L_DELIM'          =>  '<{',            // 模板引擎普通标签开始标记
    'TMPL_R_DELIM'          =>  '}>',            // 模板引擎普通标签结束标记
	//数据库配置
    'DB_NAME'               =>  'test',          // 数据库名
	//url访问模式设置
	'URL_MODEL'             =>  1,       // URL访问模式,可选参数0、1、2、3,
);