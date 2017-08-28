<?php 
// header("Content-type: text/html; charset=utf-8"); 
set_time_limit(0);

//------------------------------------函数部分-------------------------------
//显示单条或多条redis存取测试
	function show_redis_test_info($singel=""){
		$info1="";
		$info2='';

		$t=new redis_test();
		if(empty($singel)){
			$info1=$t->get_test();
			$info2=$t->get_test("get");
		}else{
			$info1=$t->redis_set('key:keyword_newkey_table:keyword.id1',rand(1,123456));
			$info2=$t->redis_get('key:keyword_newkey_table:keyword.id1');
		}

		$info[0]=$info1;
		$info[1]=$info2;
		echo "<pre>";
		var_dump($info);
		echo "</pre>";
	}

// 创建redis_test 库  创建test 表
	function creat_db_table(){
	// 数据库部分设定
	$t=new redis_test();
	$info['db_select']=$t->select_db('redis_test');
//如果数据库不存在则创建数据库
	if(!$info['db_select']){
		$info['db_select']=$t->creat_db('redis_test');
	}
//验证数据库表是否存在
	$info['table_select']=$t->sql_query('show tables like "test"');
//若不存在则创建数据库表
	if(!$info['table_select']){
		$table_arr=['id'=>"int not null auto_increment",'name'=>" varchar(50) null default null"];
		$table_arr_adder=['PRIMARY'=>"KEY (`id`)"];
		$info['create_table']=$t->create_table('test',$table_arr,$table_arr_adder);
	}
	echo "<pre>";
	var_dump($info);
// var_dump($info2);
	echo "</pre>";
}

// --------------------------redis工具类---------------------------------
class redis_test{
	public $redis; 					//链接php-redis指针
	public $link_info; 	 			//连接结果

	public $mysql; 					//链接php-redis指针
	public $mysql_conn_err; 	 			//连接结果
	public $mysql_db_info; 			//数据库连接结果
	public $mysql_query; 			//mysql查询语句

	public $db="redis_test";
	public $table="keyword_newkey_table";
	public $title="keyword";
	public $keyword='id';

	public $redis_key=""; 			//redis的key键

	public $time_begin="";
	public $time_end="";
 	
 	//$conn_w 链接方式选择持续连接（pconn）还是短时间连接(输入empty)
	function __construct($redis="",$conn_w="",$db=""){
		if(!empty($db)){
			$this->db=$db;
		}

		if(empty($redis)){
			$this->redis=new redis();
			if(empty($conn_w)){
			//短时间连接
				$link_info=$this->redis->connect('localhost',6379,3);
			}else{
			//持续连接
				$this->link_info=$this->redis->pconnect('localhost',6379);
			}
		}
		//mysql---------------------
		$this->mysql=new mysqli('localhost','root','root','');
		if (!$this->mysql) {
			$this->mysql_conn_err='Connect Error: ' .$this->mysql->mysqli_connect_errno();
			die($this->mysql_conn_err);
		}
		$this->mysql_db_info=$this->mysql->select_db($this->db);
	}

	//另外设置key的方法
	function set_key($db="",$table="",$title="",$keyword=""){
		$this->db=$db;
		$this->table=$table;
		$this->title=$title;
		$this->keyword=$keyword;
	}

	//拼装redis_key
	function redis_get_name($db="",$table="",$title="",$keyword=""){
		if(empty($db)){
			$db=$this->db;
		}
		if(empty($table)){
			$table=$this->table;
		}
		if(empty($title)){
			$title=$this->title;
		}
		if(empty($keyword)){
			$keyword=$this->keyword;
		}

		$this->redis_key=$db.':'.$table.":".$title.".".$keyword;
	}

	//单条存入
	function redis_set($key,$val){
		return $this->redis->set($key,$val);
	}

	//单条取出
	function redis_get($key){
		return  $this->redis->get($key);
	}

	//多条redis存入（set存入）
	function redis_set_10w(){
		$flag=1;
		for ($i=1; $i <= 10000 ; $i++) { 
			$redis_key=$this->redis_key.$i;
			$rand=rand(1,123456789);
			if($flag){
			$res[$redis_key]=$this->redis->set($redis_key,$rand);
			$flag=$res[$redis_key];

			}
		}
		return $res;
	}

	//多条取出
	function redis_get_10w(){
		for ($i=1; $i <= 10000 ; $i++) { 
			$redis_key=$this->redis_key.$i;
			$arr[$redis_key]=$this->redis->get($redis_key);
		}
		return $arr;
	}

	//将microtime 制作成数组
	function microt_arr_make(){
		$time_begin=microtime();
		$arr_t=explode(" ", $time_begin);
		return $arr_t;
	}

//计算时间
	function cal_microt($arr_t_end,$arr_t_begin){
		return $time_pass=$arr_t_end[0]-$arr_t_begin[0]+$arr_t_end[1]-$arr_t_begin[1];
	}

	//进行测试
	function get_test($get=''){
		$this->redis=new redis();
	// $link_info=$redis->connect('localhost',6379,3);
		$this->link_info=$this->redis->pconnect('localhost',6379,3);

		$this->redis_get_name();

		$arr_t_begin=$this->microt_arr_make();

		if (empty($get)) {
		//写10万条
			$arr_info=$this->redis_set_10w($this->redis_key,$this->redis);
			
		}else{
		//读10w
			$arr_info=$this->redis_get_10w($this->redis_key,$this->redis);
		}
	// redis_set_10w($redis_key,$redis);

		$arr_t_end=$this->microt_arr_make();
		$time_passed=$this->cal_microt($arr_t_end,$arr_t_begin);
		$show_time=implode('+',$arr_t_end) ."->".implode('+',$arr_t_begin)."->".$time_passed;
		$info['arr']=$arr_info;
		$info['time']=$show_time;
		return $info;
	}



	//----------------------------------mysql---------------------------------


	//创建数据库
	function creat_db($db){
		$info=$this->mysql->query('create database '.$db);
		return  $this->select_db($db);
	}

	//创建数据库表
	/*	数据表中的键值：
			table:数据库表名
			arr:key=>val  	key为键名 val 为key键的sql设定
				如：id=>" int not null auto_increment"
					name=>" varchar(50) null default null"
			
	例子：	CREATE TABLE `redis_test`.`asdfsd` ( `id` INT NOT NULL AUTO_INCREMENT , `bb` VARCHAR(50) NULL DEFAULT NULL , PRIMARY KEY (`id`), INDEX (`bb`)) ENGINE = MyISAM;
	*/
	function create_table($table,$arr,$arr2){
		$sql='CREATE TABLE `'.$table.'` (';
		$i=1;
		foreach ($arr as $key => $val) {
			if(empty($i)){
				$sql.=',';
			}
			$sql.=" `".$key."` ".$val;
			$i=0;
		}
		foreach ($arr2 as $key => $val) {
			$sql.=",".$key." ".$val;
		}
		$sql.=') ENGINE = MyISAM';
		$info['res']=$this->mysql->query($sql);
		$info['err']=$this->mysql->error;
		$info['sql']=$sql;
		return $info;
	}

	//另外选用一个数据库
	function select_db($db){
		$this->mysql_db_info=$this->mysql->select_db($db);
		$this->db=$db;
		return $this->mysql_db_info;
	}

	function show_error(){
		return $this->mysql->error;
	}

	//查询
	function sql_query($query="",$way=""){
		if(!empty($query)) $this->mysql_query=$query;
		$res=$this->mysql->query($this->mysql_query);
		if(!$res) return "sql查询语句有误";
		$i=0;
		if($way=="select"){
			while($row=$res->fetch_assoc()){
				$rows[$i]=$row;
				$i++;
			}
		}
		
		if(empty($rows)) $rows=null;
		return $rows;
	}

	// INSERT INTO `test` (`id`, `name`) VALUES (NULL, 'aa')
	//insert('test',['name'=>'aa','test'=>'bb'])
	function insert($table,$arr){
		$i=1;
		foreach ($arr as $key => $val) {
			if(empty($i)){
				$key_str.=",`{$key}`";
				$val_str.=",'{$val}'";
			}else{
				$key_str="`{$key}`";
				$val_str="'{$val}'";
				$i=0;
			}
		}
		$this->mysql_query="INSERT INTO `{$table}` ({$key_str}) VALUES ({$val_str})";
		return $this->sql_query();
	}

	function select($where){

	}
}
// class-------------------end-------------------------------------


// 数据库部分设定
$t=new redis_test('no');
// $info['db_select']=$t->select_db('redis_test');

$info['insert']=$t->insert('test',['name'=>'aa']);
$info['test_table']=$t->sql_query('select * from test','select');

echo "<pre>";
var_dump($info);
// var_dump($info2);
echo "</pre>";


//测试多条redis读写时间
	// show_redis_test_info();

?>