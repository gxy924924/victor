<!--二维数组-->
<?php
$arr=array(
array(0,0,0,0,0),
array(0,0,0,0,0),
array(0,0,0,0,0),
array(0,0,0,0,0),
array(0,0,0,0,0));
for($i=0;$i<count($arr);$i++){
	for($j=0;$j<count($arr[$i]);$j++){
		echo $arr[$i][$j]."&nbsp";
	}
		echo "</br>";
}



?>