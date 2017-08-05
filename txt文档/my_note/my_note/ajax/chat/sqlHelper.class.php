<?php
//这是一个工具类
class sqlHelper{
    public $conn;
    public $dbname="chat";
    public $username="root";
    public $password="root";
    public $host="localhost";
    
    public function __construct(){
        $this->conn=new MYSQLI($this->host,$this->username,$this->password,$this->dbname);
        if($this->conn->connect_error){
             die("连接数据库失败".$this->conn->connect_error);
        } 
		//$this->conn->query("set names utf8");
    }
    
    //执行dql语句(查询)
    public function execute_dql($sql){
        $res=$this->conn->query($sql) or die($this->conn->error());
        return $res; 
    }
    
    //执行dml语句
    public function execute_dml($sql){
        $b=$this->conn->query($sql);
        if (!$b){
            return 0;
        }else {
            if ($this->conn);
			if($this->conn->affected_rows>0){
				return 1;//表示成功
			}else{
				return 2;//表示没有行收到影响
			}
        }
    }

	 //执行dql语句(查询)(已分组)
    public function execute_dql2($sql){
		$arr=array();
        $res=$this->conn->query($sql) or die($this->conn->error);

		//把$res=>$arr 结果集内容转移到一个数组中
		while($row=mysqli_fetch_assoc($res)){
				$arr[]=$row;
		}
        return $arr; 
		close_connect();
    }

    //关闭链接的方法
    public  function close_connect(){
        
        if(!empty($this->conn)){
            $this->conn->close();
        }
    }
    
    //考虑分页情况的查询
    //例：$sql1="select * from 表名  limit 0,6"
    //例：$sql2="select count(id) from 表名  "
    public function execute_dql_fenye($sql1,$sql2,&$fenYePage){
        //这里我们查询了要分页显示的数据
        $res=$this->conn->query($sql1) or die($this->conn->error());
        //$res=>array
        $res=array();
        //把$res转移到$arr
        while ($row=$this->conn->fetch_assoc($res)){
            $arr[]=$row;
        }
        
        //
        $fenyePage->$res_array=$arr;
        $res->free();
    }
}
?>