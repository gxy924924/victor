<?php 
//Index model
class IndexController extends Controller{
	function index(){
		if ($this->catch_play()) {
			ob_start();
			$this->res=$this->get_user_info();
			$type_id=6;
			$this->type1=$this->type_sql_show($type_id);
			$this->list1=$this->list_sql_show($type_id);
			$type_id=7;
			$this->type2=$this->type_sql_show($type_id);
			$this->list2=$this->list_sql_show($type_id);
			$this->display();
			$content=ob_get_contents();
			file_put_contents($this->catch_file, $content);
		}
			
	}

	function get_user_info(){
		if (!empty($_GET['code'])) {
			$wx_web=new wx_web($_GET['code']);
			$res=$wx_web->get_userinfo();
			return $res;
		}
		if(!empty($_GET['openid'])){
			$sql=new sqlHelper();
			$sql->settable('wx_userinfo');
			$res_sql=$sql->where('openid='.$_GET['openid'])->select();
			return $res_sql;
		}
		// echo "</br>".USERNAME;
	}

	function list_sql_show($type_id){
		$sql=new sqlHelper();
		$sql->settable("myweb_list");
		$list=$sql->where('type_id='.$type_id)->order("id desc")->limit(0,5)->select();
		return $list;
	}
	//获取类型
	function type_sql_show($type_id){
		$sql=new sqlHelper();
		$sql->settable("myweb_sort_type");
		$type=$sql->where('id='.$type_id)->select();
		return $type;
	}

	function sql_test(){
		$sql=new sqlHelper();
		$res=$sql->select();
		echo "<pre>";
		var_dump($res);
		echo "</pre>";
	}

	function db_test(){
		$sql=new sqlHelper();
		// $host="";
		// $username="";
		// $password="";
		// $sql->setsql($host,$username,$password);
		$res=$sql->showtable();
		echo $sql->getlastsql();
		echo "<pre>";
		var_dump($res);
		echo "</pre>";

	}

	function get_qrcode(){
		require_once PUBLIC_PATH.'phpqrcode/phpqrcode.php';
		QRcode::png('http://www.gweixin.top/index.php');   
	}

	function js_test(){
		$this->display();
	}
}
?>