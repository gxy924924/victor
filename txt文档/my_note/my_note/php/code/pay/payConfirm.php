<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=gbk">
</head>
<body>
<?php
//这里我们获取用户提交的信息

//1.获取订单号
$p0_Cmd="Buy";
$p1_MerId="10001126856";

$p2_Order=$_REQUEST['p2_Order'];
$p3_Amt=$_REQUEST['p3_Amt'];
$p4_Cur="CNY";
//商品名称
$p5_Pid="";
$p6_Pcat="";//种类
$p7_Pdesc="";//商品介绍
//这是易宝支付成功后，给URL返回信息
$p8_Url="http://localhost/www/pay/res.php";//
$p9_SAF="0";
$pa_MP="";
$pr_NeesResponse="1";

$pd_FrpId=$_REQUEST['pd_FrpId'];

//我们把请求参数一个一个拼接(拼接时，顺序很重要！)
$data="";
$data=$data.$p0_Cmd;
$data=$data.$p1_MerId;
$data=$data.$p2_Order;
$data=$data.$p3_Amt;
$data=$data.$p4_Cur;
$data=$data.$p5_Pid;
$data=$data.$p6_Pcat;
$data=$data.$p7_Pdesc;
$data=$data.$p8_Url;//
$data=$data.$p9_SAF;
$data=$data.$pa_MP;
$data=$data.$pd_FrpId;
$data=$data.$pr_NeesResponse;

$merchantKey="69cl1522AV6q613Ii4W6u8K6XuW8vM1N6bDgyv769220IuYe9u37N4y7rI4P1";

//hmac是签名串，是用于易宝和商家互相确认的关键字
//这里我们需要使用算法来生成
$hmac=HmacMd5();
?>

</body>
</html>