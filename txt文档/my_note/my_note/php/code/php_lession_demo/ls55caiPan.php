<!--裁判-->
<?php
$point=array(3,5,6,8,4,6,54,5);
$maxNum=0;$minNum=0;$sum=0;
foreach($point as $maxNum=>$v){echo $maxNum.'='.$v."</br>";}
for($i=0;$i<count($point);$i++){
//求得最高分
if($point[$maxNum]<$point[$i]){$maxNum=$i;}
}
echo 'maxNum='.$maxNum.'max='.$point[$maxNum]."</br>";
//求得最低分
for($i=0;$i<count($point);$i++){
if($point[$minNum]>$point[$i]){$minNum=$i;}
}
echo 'minNum='.$minNum.'min='.$point[$minNum]."</br>";
//计算平均分
for($i=0;$i<count($point);$i++){if($i!=$maxNum&&$i!=$minNum)
{$sum+=$point[$i];}}
$jun=$sum/(count($point)-2);
echo 'sum='.$sum.'PingJun='.$jun."</br>";
//最佳裁判
$cha=abs($point[0]-$jun);
for($i=0;$i<count($point);$i++){
	if(abs($point[$i]-$jun)<$cha){$best=$i;$cha=abs($point[$i]-$jun);}
	}
	echo 'best='.$best."</br>";
//最差裁判
for($i=0;$i<count($point);$i++){
	if(abs($point[$i]-$jun)>$cha){$worst=$i;$cha=abs($point[$i]-$jun);}
	}
	echo 'worst='.$worst;
?>
