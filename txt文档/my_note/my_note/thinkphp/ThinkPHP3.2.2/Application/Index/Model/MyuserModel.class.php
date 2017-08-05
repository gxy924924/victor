<?php
//第一步：定义命名空间
namespace Index\Model;
//第二步：引入父类控制器
use Think\Model\RelationModel;
//第三步：定义控制器并且继承父类
class MyuserModel extends RelationModel {
	protected $_link =array(
		'tel'=>array(				//这里的数组名称并不是模型的类名，是（映射）名
			//'mapping_type'=>self::HAS_ONE,		//关联类型
			'mapping_type'=>self::HAS_MANY,		//关联类型
			'class_name'=>'tel',			//关联的模型的类名
			'foreign_key'=>'user_id',		//关联外键名称
			'mapping_fields'=>'code',		//关联要查询的字段
			'mapping_name'=>'telephone',	//关联的映射名称(修改映射名)
			//'as_fields'=>'user_id,code',	//直接把关联的字段值映射成数据对象中的某个字段
			
		),
		'class'=>array(
			'mapping_type'=>self::BELONGS_TO,		//关联类型
			'class_name'=>'class',			//关联的模型的类名
			'foreign_key'=>'class_id',		//关联外键名称
			'as_fields'=>'num',
			
		),
	);
}