<?php 
// header("Content-type: text/html; charset=utf-8"); 
set_time_limit(0);


class redis_test{
	public $redis; 					//链接php-redis指针
	public $link_info; 	 			//连接结果

	public $db="key";
	public $table="keyword_newkey_table";
	public $title="keyword";
	public $keyword='id';

	public $redis_key=""; 			//redis的key键

	public $time_begin="";
	public $time_end="";
 	
 	//$conn_w 链接方式选择持续连接（pconn）还是短时间连接(输入empty)
	function __construct($conn_w=""){
		$this->redis=new redis();

		if(empty($conn_w)){
			//短时间连接
			$link_info=$this->redis->connect('localhost',6379,3);
		}else{
			//持续连接
			$this->link_info=$this->redis->pconnect('localhost',6379);
		}
	}

	//拼装redis_key
	function redis_get_name(){
		$this->redis_key=$this->db.':'.$this->table.":".$this->title.".".$this->keyword;
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
}

$info1="";
$info2='';

$t=new redis_test();
// $info1=$t->redis_set('key:keyword_newkey_table:keyword.id1',rand(1,123456));
// $info2=$t->redis_get('key:keyword_newkey_table:keyword.id1');
$info1=$t->get_test();
$info2=$t->get_test("get");

$info[0]=$info1;
$info[1]=$info2;
echo "<pre>";
var_dump($info);
// var_dump($info2);
echo "</pre>";



//测试。。。
// $info=$redis->set('name','pipi');
// $res=$redis->get('name');

//检查redis是否连通
// $ping_info=$redis->ping();

?>