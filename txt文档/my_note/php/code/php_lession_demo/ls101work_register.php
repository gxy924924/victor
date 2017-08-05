<?php
header("Content-type: text/html;charset=utf-8");

echo "<pre>";
echo print_r($_POST);
echo "</pre>";

 $smile=$_POST['smile'];
$angry=$_POST['angry'];
$hobby=$_POST['hobby'];
//echo $hobby[0];
foreach($hobby as $key=>$value ){ echo $key."=>".$value; }

$mysqli=new MYSQLI("localhost","root","root","test");


	if($mysqli->connect_error){
		die($mysqli->connect_error);
	}
$sql="insert into happy(smile,angry) values($smime,$angry)";
$mysqli->query($sql);

?>
