<!--封装-->
<?php
require_once "ls78calcu.class.php";
//接收三个数
if(isset($_REQUEST['num1'])){
	$num1=$_REQUEST['num1'];
	}else{
		echo "num1没有值";
	}
if(isset($_REQUEST['num2'])){
	$num2=$_REQUEST['num2'];
	}else{
		echo "num2没有值";
	}
$oper=$_REQUEST['oper'];

$operService=new operService();
echo "$num1+$num2=".$operService->getResult($num1,$num2,$oper);
?>

