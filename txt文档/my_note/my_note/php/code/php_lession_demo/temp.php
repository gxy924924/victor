<?php

	$conn=mysqli_connect("localhost","root","root");
	if($conn){
		echo"连接mysql数据库ok";
	}else{
		echo"连接数据库失败";
	}
?>