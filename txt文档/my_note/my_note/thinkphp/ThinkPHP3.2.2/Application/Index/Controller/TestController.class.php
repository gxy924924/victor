<?php
//第一步：定义命名空间
namespace Index\Controller;
//第二步：引入父类控制器
use Think\Controller;
//第三步：定义控制器并且继承父类
class TestController extends Controller {
	function test(){
		echo "<pre>";
		echo $_GET;
		echo "</pre>";
	}

	function _empty(){
		//echo "您操作的方法不存在！";
		$this->myerror();
	}

	function myerror(){
		$this->display('myerror');
	}
	function index(){
		$this->display();
	}
	function show(){
		echo I('post.username')."</br>";	//过滤方法
		var_dump(IS_POST); //判断传递值类型
	}
	function myajax(){
		$this->display();
	}
	function myaj_show(){
		//echo "aaa";
		$this->display();
	}
	function myaj_return(){
		$arr=array(
			'name'=>'ggg',
			'age'=>'333',
			'sex'=>'boy',
		);
		//var_dump($arr);
		$this->ajaxReturn($arr,'json');
	}
	function read($id){
		echo $id;
	}
	function mysql(){
		$user=M('user');
		$rows=$user->select("1");
		//相当于$model=M(); $rows=$model->query('select * from user order by id');
		echo "<pre>";
		print_r($rows);
		echo "</pre>";
		echo $user->getLastSql();
		echo "</br>getPk==>".$user->getPk();
	}
	function mysql2(){
		$model=M(); 
		$rows=$model->query('select * from user order by id');
		echo get_class($model);
		echo "<pre>";
		print_r($rows);
		echo "</pre>";
	}
	function mysql3(){
		//$user=D('User');
		$user=new \Index\Model\UserModel();
		$user->say();
		echo get_class($user);
	}
	function mysql4(){
		$user=new \Think\Model("User");
		echo get_class($user);
	}
	function mysql5(){
		$user=D("User");
		$user->say();
		echo $user->getLastSql();
	}
	function mysql_p(){
		$_POST['username']='user3';
		$_POST['password']='345';
		$_POST['submit']='提交';
		$user=M('user');
		$user->create();
		$user->regtime=time();
		$user->add();
		//exit;
		echo "<pre>";
		print_r($user);
		echo "</pre>";
	}
	function mysql_s(){
		$_SESSION['scode']='abc';
		$_POST['name']='aaa';
		$_POST['pass']='';
		$_POST['repassword']='aaa';
		$_POST['fcode']='vv';
		//$_POST['email']='aaa@s.com';
		$user=D("User");		//已写好UserModel.class.php字段映射
		
		if($user->create()){
			echo "ok";
			$user->add();
		}else{
			echo "<pre>";
			print_r($user->getError());
			echo "</pre>";
		}
	}
	function mysql_del(){
		$id=5;
		$user=D('user');
		$user-> delete($id);
	}
	function mysql_del2(){
		$user=D('user');
		//$user->where('id=6')->delete();
		$user->where(array('id'=>'6'))->delete();
	}
	function mysql_sel(){
		$user=D('user');
		$rows=$user->select();
		echo "<pre>";
		print_r($rows);
		echo "</pre>";
	}
	function mysql_sel2(){
		$user=D('user');
		$rows=$user->find(3);
		echo "<pre>";
		print_r($rows);
		echo "</pre>";
	}
	function mysql_sel3(){
		$user=D('user');
		$rows=$user->where('id>2 and id<5')->select();
		echo "<pre>";
		print_r($rows);
		echo "</pre>";
	}
	function mysql_upd(){
		$_POST['username']='aaa';
		$_POST['password']='222';
		$_POST['id']='2';
		$user=M('user');
		$user->create();
		$user->save();
		echo "ok";
	}
	function mysql_lj(){
		$user=D('User');
		$sel=$user->field('username,score.num')->JOIN('left join score on user.username=score.uid')->select();
		echo $user->getLastSql();
		echo "<pre>";
		print_r($sel);
		echo "</pre>";
	}
}