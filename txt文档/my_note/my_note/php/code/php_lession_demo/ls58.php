<!--查找-->
<?php
$arr=array(46,90,900,0,-1);
$arr1=array(0,90,900,99990);
$flag=false;
//顺序查找
function search(&$arr,$findval){
	for($i=0;$i<count($arr);$i++){
		if($findval==$arr[$i]){
		echo "找到，下标=$i";
		$flag=true;
		}
	}
		if(!$flag){
		echo '找不到';
	}
}
//search($arr,0);
//============================================

//二分查找法(数组，查找值，左脚表，右角标)(数组要求有序)
function binarySearch(& $arr,$findVal,$leftIndex,$rightIndex){
//$rightIndex<$leftIndex说明没有数
if($rightIndex<$leftIndex){
	echo "找不到该数";
	return ;
}
//找到中间的数
$middleIndex=round(($rightIndex+$leftIndex)/2);
//如果大于，往后找
if($findVal>$arr[$middleIndex]){
	binarySearch($arr,$findVal,$middleIndex+1,$rightIndex);
}
//小于，往前找
else if($findVal<$arr[$middleIndex]){
	binarySearch($arr,$findVal,$leftIndex,$middleIndex-1);
}else{echo "找到 下标=$middleIndex";}
}
binarySearch($arr1,90,0,count($arr)-1);
?>