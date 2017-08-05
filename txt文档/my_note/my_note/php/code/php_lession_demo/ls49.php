<?php
function aa($a=0,$b=2){//$a不赋值默认会给0，但会报警告。
$c=$a+$b;
return $c;
}
$c=aa();
echo "aa=".$c;
echo 8<<2;
?>