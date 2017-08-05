<?php
$i=1;
while(++$i){
if($i==8){goto a;}
echo "$i</br>";
}
a:echo "end";
?>
<?php
define("TAX_RATE","0.08");
echo 'tax1='.TAX_RATE;
const TAX_RATE2=0.1;
echo 'tax2='.TAX_RATE2;
?>