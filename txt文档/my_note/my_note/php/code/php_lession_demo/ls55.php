<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8 ">
</head>
<body>
<h1>请输入五个小孩的成绩，用空格隔开</h1>
<?php
error_reporting(E_ALL ^ E_NOTICE);
$grades=$_REQUEST['grade'];

$grades1=explode(" ",$grades);
//var_dump($grades1);
$allGrades=0;
foreach($grades1 as $k=>$v){
	
	$allGrades+=$v;//隐藏转换string->float
}?>
<form action="ls55.php" method="post">
<input type="text"name="grade" value="<?php echo $grades;?>"/>
<input type="submit"value="开始统计">
</form>
<?php
echo "平均时间=".$allGrades/count($grades1);
?>
</body>
</html>