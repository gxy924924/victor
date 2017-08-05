<?php
$yue=$_REQUEST['yue'];
$ri=$_REQUEST['ri'];
echo "出生于".$yue."月".$ri."日</br>";
switch($yue){
case 1:
if($ri>=1&&$ri<=19){echo "魔蝎座";}
else if($ri>=20&&$ri<=31){echo "水瓶座";}
else{echo"输入有误，请重输";}
break;
case 2:
if($ri>=1&&$ri<=18){echo "水瓶座";}
else if($ri>=19&&$ri<=29){echo "双鱼座";}
else{echo"输入有误，请重输";}	
break;
case 3:
if($ri>=1&&$ri<=19){echo "双鱼座";}
else if($ri>=20&&$ri<=31)
	{echo "白羊座";echo "<img src='by.png'>";}
//echo中“中不要套双引号”，‘中不要套单引号’
else{echo"输入有误，请重输";}		
break;
case 4:
if($ri>=1&&$ri<=19){echo "白羊座";}
else if($ri>=20&&$ri<=30){echo "金牛座";}
else{echo"输入有误，请重输";}		
break;
case 5:
if($ri>=1&&$ri<=20){echo "金牛座";}
else if($ri>=21&&$ri<=31){echo "双子座";}
else{echo"输入有误，请重输";}		
break;
case 6:
if($ri>=1&&$ri<=20){echo "双子座";}
else if($ri>=21&&$ri<=30){echo "巨蟹座";}
else{echo"输入有误，请重输";}		
break;
case 7:
if($ri>=1&&$ri<=22){echo "巨蟹座";}
else if($ri>=23&&$ri<=31){echo "狮子座";}
else{echo"输入有误，请重输";}		
break;
case 8:
if($ri>=1&&$ri<=22){echo "狮子座";}
else if($ri>=23&&$ri<=31){echo "处女座";}
else{echo"输入有误，请重输";}		
break;
case 9:
if($ri>=1&&$ri<=22){echo "处女座";}
else if($ri>=23&&$ri<=30){echo "天枰座";}
else{echo"输入有误，请重输";}		
break;
case 10:
if($ri>=1&&$ri<=22){echo "天枰座";}
else if($ri>=23&&$ri<=31){echo "天蝎座";}
else{echo"输入有误，请重输";}		
break;
case 11:
if($ri>=1&&$ri<=21){echo "天蝎座";}
else if($ri>=22&&$ri<=30){echo "射手座";}
else{echo"输入有误，请重输";}		
break;
case 12:
if($ri>=1&&$ri<=21){echo "射手座";}
else if($ri>=22&&$ri<=31){echo "魔蝎座";}
else{echo"输入有误，请重输";}		
break;
default:echo"输入有误，请重输";
}
?>