<?php
class SqlHelper{
	private $mysqli;
	//将来这里写死的数据信息，是需要配置到一个文件（已写json文件）
	private $host="localhost";
	private $username="root";
	// private $password="root";
	private $password="xVTPBWWn0ZeY";
	private $db="show_ip";
	private $table="guest_ip_in";
	//类中传递值
	
	private $sqlwhere="";
	private $sqlfind=0;
	private $sql="";
	public $sql_model="5";	//记录查询语句 默认为0（0-查数据 1增加数据 2删除 3修改 4其它功能 5空 6查表头 7查询后）
	//构造函数自动连接数据库
	public function __construct($db=""){
		//引入替换数据库配置
		// $json_file=PUBLIC_PATH."json/db_mysql.json";
		//检查是否存在，存在则替换数据
		// if(file_exists($json_file)){
			// $json=file_get_contents($json_file);
			// $json=json_decode($json);
			if(!empty($json->host)) $this->host=$json->host;
			if(!empty($json->username)) $this->username=$json->username;
			if(!empty($json->password)) $this->password=$json->password;
			if(!empty($json->db)) $this->db=$json->db;
			//if(!empty($json->table)) $this->table=$json->table;
		// }
		if (!empty($db)) {
			$this->db=$db;
		}

		//完成初始化任务
		$this->mysqli=new MYSQLI($this->host,$this->username,$this->password,$this->db);
		if($this->mysqli->connect_error){
			die("连接失败".$this->mysqli->connect_error);
		}
		$this->mysqli->query("set names utf8");
		//$this->sql="select * from $this->table";
		
	}

	function send_query($sql_query){
		return $this->mysqli->query($sql_query);
	}
	// //设置查询
	// function setsql($host,$username,$password){
	// 	$this->host=empty($host)?$this->host:$host;
	// 	$this->username=empty($username)?$this->username:$username;
	// 	$this->password=empty($password)?$this->password:$password;
	// }

	// //设置
	// function setdb($db){
	// 	$this->db=$db;
	// }

	//设置查询表
	function settable($table){
		$this->table=$table;
		if (!empty($this->getitle)) {
			$this->gettitle=0;//获取标题功能更新
		}
		return $this;
	}


	// //显示数据库
	// function showdb(){
	// 	$this->sql_model=6;
	// 	$this->sql="show databases";
	// 	$this->select();
	// }

	// //显示表
	// function showtable(){
	// 	$this->sql_model=6;
	// 	$this->sql="show tables";
	// 	$this->select();
	// }

	function set_query($info){
		$this->sqlmodelback();
		$this->sql=$info;
		return $this;
	}
	
	//当要使用查询功能时，将基本语句取回
	function sqlmodelback(){
		if($this->sql_model==0  || $this->sql_model==6){
		}else{
			$this->sql="select * from $this->table";
			$this->sql_model=0;
		}
	}
	
//条件查询部分
	//添加查找条件
	function where($info){
		$this->sqlmodelback();
		$this->sql.=" where $info";
		return $this;
	}

	function join($info){
		$this->sqlmodelback();
		$this->sql.=" $info";
		return $this;
	}

	function order($info){
		$this->sqlmodelback();
		$this->sql.=" order by $info";
		return $this;
	}
	//limit函数（从第几条开始-0为第一条，显示几条）
	function limit($p,$row){
		$this->sqlmodelback();
		$this->sql.=" limit $p,$row";
		return $this;
	}

	//select 查询
	public function select(){
		$this->sqlmodelback();
		//2.操作数据库（发送sql）
		$res=$this->mysqli->query($this->sql);
		//var_dump($res);
		//3.处理结果(对应 mysql_fetch_row)
		$rows=array();
		$i=0;
		//return $res;
		if(!$res) return "sql查询语句有误";
		while($row=$res->fetch_assoc()){
				$rows[$i]=$row;
				$i++;
		}
		//echo "<pre>";print_r($rows);echo "</pre>";//测试语句
		
		//释放内存
		$res->free();
		$this->sql_model=7; //返回当前模式-查询后
		return $rows;
	}

	//limit 1 查询
	function find($id=0){
		$this->sqlmodelback();
		if(!empty($id)) $this->sql.=" where id=$id";
		$this->sql.=" limit 1";
		return $this->select();
	}

	//分页函数（查询第几页，每页有几行）
	function page($p,$row){
		$this->sqlmodelback();
		$begin=($p-1)*$row;
		$this->sql.=" limit $begin,$row";
		// return $this->select();
	}

	//查找总条数
	function sqlcount(){
		$this->sql="select count(id) from $this->table";
		$res=$this->mysqli->query($this->sql);
		$row=$res->fetch_assoc();
		
		$res->free();
		$this->sql_model=4; //返回当前模式
		return $row['count(id)'];
	}
	
	//添加一条信息（需要以一维数组-array 形式发送过来）
	function add($input_arr){
	if(is_array($input_arr)){
		if (empty($this->getitle)) {
			$arr=$this->gettitle();
			$this->gettitle=1;
			$this->add_array=$arr;
		}else{
			$arr=$this->add_array;
		}
		
		//筛查相应的数据并写成字串
		foreach($input_arr as $k=>$v){
			foreach($arr as $key=>$val)
			if($val==$k){
				if(empty($title)){
					$title="`".$k."`";
					$input='"'.$input_arr[$k].'"';
				}else{
					$title.=",`".$k."`";
					$input.=',"'.$input_arr[$k].'"';
				}
			}
		}
		//2.操作数据库（发送sql）
		$this->sql="insert into $this->table(".$title.") values(".$input.")";
	}else if(is_string($input_arr)){
		$this->sql=$input_arr;
	}
		$this->mysqli->query($this->sql);
		$this->sql_model=1; //返回当前模式-添加
		if($this->mysqli->affected_rows<1){
			return "添加失败";
		}else{
			return "添加成功";
		}
		
	}
	
	//delete删除
	function delete($attr){
		$this->sql="delete from $this->table where $attr";
		$res=$this->mysqli->query($this->sql);
		$this->sql_model=2; //返回当前模式-删除
		if($this->mysqli->affected_rows<1){
			return "删除失败";
		}else{
			return "删除成功";
		}
		
	}

	//修改update 不需要where方法直接将id 放入数组
	function update($input_arr){
		$this->sqlwhere="id=".$input_arr['id'];

		if (empty($this->getitle)) {
			$arr=$this->gettitle();
			$this->gettitle=1;
			$this->add_array=$arr;
		}else{
			$arr=$this->add_array;
		}

		// $arr=$this->gettitle();
		//筛查相应的数据并写成字串
		foreach($input_arr as $k=>$v){
			foreach($arr as $key=>$val)
			if($val==$k){
				if(empty($input)){
					$input=$val.'="'.$input_arr[$k].'"';
				}else{
					$input.=",".$val.'="'.$input_arr[$k].'"';
				}
			}
		}
		//2.操作数据库（发送sql）
		$this->sql="update $this->table set $input where $this->sqlwhere";
		//echo $sql;
		$this->mysqli->query($this->sql);
		$this->sql_model=3; //返回当前模式-修改
		if($this->mysqli->affected_rows<1){
			return "修改失败或未修改任何值";
		}else{
			return "修改成功";
		}
		
	}
	//获取数据库表头
	function gettitle(){
		$this->sql="DESCRIBE $this->table";
		$arr=array();
		$i=0;
		$this->sql_model=6; //返回当前模式-取表头
		$row=$this->select();
		foreach($row as $k=>$v){
			if($v!="id"){
				$arr[$i]=$v["Field"];
				$i++;
			}
		}
		
		return $arr;
		
	}

	//获取最近一次查表语句
	function getlastsql(){
		return $this->sql;
	}

	function __destroy(){
		$this->mysqli->close();
	}
}
?>