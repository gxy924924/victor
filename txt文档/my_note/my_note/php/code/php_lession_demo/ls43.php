<!--打印金字塔-->
<?php  //打印金字塔
$i=1;
$step=5;//层数
while($i<=$step){
	$j=1;
	$k=1;
	while($k<=$step-$i){
	echo "&nbsp";
	$k++;
	}
	while($j<=$i*2-1){
		
		echo '*';
		$j++;
	}
$i++;
echo '<br/>';
}

?>

<?php //打印空心金字塔
$i=1;
$step=5;
while($i<=$step){
$j=1;$k=1;
	while($k<=$step-$i){
	echo "&nbsp";
	$k++;
	}
	while($j<=$i*2-1){
		if($j==$i*2-1||$j==1||$i==$step){echo '*';}
		else{
		echo '&nbsp';}
		$j++;
	}
$i++;
echo '<br/>';
}

?>