<?php
header("Content-type:text/html;charset=utf-8");
echo "演示session实际运用";

echo "<h1>欢迎购买</h1>";
echo "<a href='ls119session_hall_process.php?bookid=sn1&bookname=天龙八部'>天龙八部</a></br>";
echo "<a href='ls119session_hall_process.php?bookid=sn2&bookname=红楼梦'>红楼梦</a></br>";
echo "<a href='ls119session_hall_process.php?bookid=sn3&bookname=西游记'>西游记</a></br>";
echo "<a href='ls119session_hall_process.php?bookid=sn4&bookname=聊斋'>聊斋</a></br>";
echo "<hr/>";
echo "<a href='ls119session_showCart.php'>查看购买到的商品列表</a>";

?>