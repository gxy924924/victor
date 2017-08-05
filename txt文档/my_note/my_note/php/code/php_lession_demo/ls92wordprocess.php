<?php
//var_dump($_POST['enword']);
require_once 'sqlTool.class.php';
header("Content-type=text/html;charset=utf-8 ");
//接收type
if(isset($_POST['type'])){
	$type=$_POST['type'];
}else{
	echo "输入为空";
	echo "<a href='ls92word.php'>返回主界面</a>";
}

//接收英文单词
if($type=="search1"){
	echo "$type";
	$en_word=$_POST['enword'];
	if(!empty($en_word)){
		var_dump(isset($_POST['enword']));
		echo "英文单词：".$en_word."</br>";
	}else{
		echo "输入为空";
		echo "<a href='ls92word.php'>返回主界面</a>";
	}

//添加语句insert into words (enword,chword) values('boy','男孩');
//看看数据库中有没有这条记录(用什么查什么)
$sql="select chword from words where enword='".$en_word."' limit 0,1";
//设计表
//查询
$sqltool=new sqlTool();
$res=$sqltool->execute_dql2($sql);
//echo "$res";
if($row=mysql_fetch_row($res)){
	echo $en_word."对应英文意思：</br>".$row[0];
	echo "</br><a href='ls92word.php'>返回重新查询</a>";
}else{
	echo "查询没有这个词条";
	echo "</br><a href='ls92word.php'>返回重新查询</a>";
	}

mysql_free_result($res);
}else if($type=="search2"){
		echo "$type";
	//接收中文单词
	if(!empty($_POST['chword'])){
		$ch_word=$_POST['chword'];
		echo "中文单词：".$ch_word."</br>";
	}else{
		echo "输入为空";
		echo "<a href='ls92word.php'>返回主界面</a>";
	}
//$sql="select enword from words where chword='".$ch_word."' limit 0,1";
$sql="select enword from words where chword like '%".$ch_word."%'";
//$sql="select enword from words where chword like '%$ch_word'%";
//设计表
//查询
$sqltool=new sqlTool();
$res=$sqltool->execute_dql2($sql);
//echo "$res";
/*if($row=mysql_fetch_row($res)){
	echo $ch_word."对应英文翻译：</br>".$row[0];
}*/
echo $sql."</br>";
if(mysql_num_rows($res)>0){
	while ($row=mysql_fetch_assoc($res)){
		echo $ch_word."对应英文翻译：".$row['enword']."</br>";
	}
}else{
	echo "查询没有这个词条";
	}
	echo "</br><a href='ls92word.php'>返回重新查询</a>";

}
?>