<?php
//第一步：定义命名空间
namespace Index\Model;
//第二步：引入父类控制器
use Think\Model;
//第三步：定义控制器并且继承父类
class UserModel extends Model {
	//protected $tableName="user";
	protected $_map =array(
		'name'=>'username',		//
		'pass'=>'password',
	);
	protected $_auto=array(
		array('password','md5','3','function'),
		array('regtime','time','3','function'),
	);
	protected $_validate=array(
		array('username','require','用户名不能为空'),
		array('username','check_length','用户名长度不能小于6位',2,'callback'),
		array('password','require','密码不能为空'),
		array('fcode','require','验证码不能为空'),
		array('repassword','password','两次密码不相同',2,'confirm'),
		array('fcode','scode','两次验证码不相同',2,'confirm'),
		array('email','email','邮箱地址有误'),
	);
	function check_length($v){
		if(strlen($v)>6){
			return true;
		}else{
			return false;
		}
	}
	protected $patchValidate = true;	//系统支持数据的批量验证功能
}