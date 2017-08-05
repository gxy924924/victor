<?php
header("Content-type: text/html;charset=utf-8");
//批量执行语句

//1.得到mysqli对象
$mysqli=new MYSQLI("localhost","root","root","test");

if($mysqli->connect_error){
	die($mysqli->connect_error);
}
//2.批量查询
$sqls="select * from user1;";
$sqls.="select * from news;";

//3.处理结果
//如果成功，则至少有一个结果集
if($res=$mysqli->multi_query($sqls)){
	do{
		//从mysqli连接取出第一个结果集
		$result=$mysqli->store_result();
		//显示mysqli result 对象
		while($row=$result->fetch_row()){
			foreach($row as $key => $val){
				echo "--$val";
			}
			echo "</br>";
		}
		//及时释放$result
		$result->free();
		if(!$mysqli->more_results()){break;}
		echo "<br/>=================新的结果集==================<br/>";
	}while($mysqli->next_result());
}else{
	echo "执行失败".$mysqli->error;
}

//关闭资源
$mysqli->close();
?>