<?php

class SqlHelper{
	private $mysqli;
	//将来这里写死的数据信息，是需要配置到一个文件（会写成活的）
	private static $host="localhost";
	private static $user="root";
	private static $pwd="root";
	private static $db="test";

	public function __construct(){
		//完成初始化任务
		$this->mysqli=new MYSQLI(self::$host,self::$user,self::$pwd,self::$db);
		if($this->mysqli->connect_error){
			die("连接失败".$this->mysqli->connect_error);
		}
		$this->mysqli->query("set names utf8");
	}
	public function execute_dql($sql){
		$res=$this->mysqli->query($sql) or die("操作dql错误：".$this->mysqli->error);
		return $res;
	}
	public function execute_dml($sql){
		$res=$this->mysqli->query($sql) or die("操作dml错误：".$this->mysqli->error);
		if(!$res){
			return 0;//表示失败;
		}else {
			if($this->mysqli->affected_rows>0){
				return 1;//表示成功
			}else{
				return 2;//表示没有行收到影响
			}
		}
	}
}



?>