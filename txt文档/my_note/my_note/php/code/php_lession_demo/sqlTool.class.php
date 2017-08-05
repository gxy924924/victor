<?php

class sqlTool{
	private $conn;
	private $host="localhost";
	private $user="root";
	private $password="root";
	private $db="worddb";
	private $sqlq="select * from words";
	
	function sqlTool(){

		$this->conn=mysql_connect($this->host,$this->user,$this->password);
		if(!$this->conn){
			die("连接失败".mysql_error());
		}
		mysql_select_db($this->db,$this->conn) or die(mysql_error());
		mysql_query("set names utf-8");
	}
	//mysql_query的返回值是一个资源标识符
	function execute_dqlq($sql){
		$sqlq="select * from ".$sql;
		$res=mysql_query($this->sqlq,$this->conn);
		return $res;
	}
	//查询
	function execute_dql($sql){
		$res=self::execute_dqlq($sql);
		while($row=mysql_fetch_row($res)){
			foreach($row as $key=>$val){
				echo "--$val";
			}
			echo "</br>";
		}
	}
	//查询2
	function execute_dql2($sql){
		$res=mysql_query($sql,$this->conn);
		return $res;
	
	}
	//增删改
	function execute_dml($sql){
		$b=mysql_query($sql,$this->conn);
		if(!$b){
			echo "操作失败".mysql_error();//失败
		}else{
			if(mysql_affected_rows($this->conn)>0){
				echo "操作成功";//表示成功
			}else{
				echo "没有影响到行数";//表示没有行数影响
			}
		}
	}
	//mysql_fetch_field函数使用(可显示表头信息)
	function execute_fetch_field($type){
		$sql="select * from user1";
		$res=mysql_query($sql,$this->conn);
		
		while($field_info=mysql_fetch_field($res)){
			echo $field_info->$type."</br>";
		}
	}
	//知道多少行 mysql_affect_rows 取得前一次 MySQL 操作所影响的记录行数
	//mysql_num_rows  取得取得结果集中行的数目
	//$sql所查表
	function execute_row($sql){
		$res=self::execute_dqlq($sql);
		$row=mysql_num_rows($res);
		return $row;
	}
	//知道有多少列  mysql_num_fields取得结果集中字段的数目
	function execute_colms($sql){
		$res=self::execute_dqlq($sql);
		$colms=mysql_num_fields($res);
		return $colms;
	}
	function execute_table($sql){
		$res=self::execute_dqlq($sql);
		$row=self::execute_row($sql);
		$colums=self::execute_colms($sql);
		echo "<table border=1px><tr>";
		for($i=0;$i<$colums;$i++){
			$field_name=mysql_field_name($res,$i);
			echo "<th>$field_name</th>";
		}
		echo "</tr>";

		while($row=mysql_fetch_row($res)){
			echo "<tr>";
			for($i=0;$i<$colums;$i++){
				echo "<td>$row[$i]</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
}



//增=================================
//$sql="insert into user1 (name,password,email,age) values('小明',md5('123456'),'xiaomi@sohu.com',34)";
//删======================================
//$sql="delete from user1 where id=4";
//改======================================
//$sql="update user1 set age=100 where id=3";

//mysql_free_result($res);
//关闭链接（可有可无）(写不写都是过一会自己关闭)
?>

