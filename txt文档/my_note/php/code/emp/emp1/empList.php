<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<img src="./image/1.png">
<hr/>
<title>雇员信息列表</title>
<script type="text/javascript">
<!--  
    function confirmDele(val){
       return window.confirm("是否要删除id="+val+"的用户");
    }
//-->
</script>
</head>
<?php
require_once 'common.php';
checkUserValidate();
echo "欢迎你".$_SESSION['name'].",登录成功</br>";
    echo "<a href='empManage.php?'>主页</a>";
    echo "<a href='login.php'>退出</a> ";
    //一个函数可以获取共多少页
    require_once 'empService.class.php';
    $empService=new empService();
    //传递分页信息
    require_once 'fenYePage.class.php';
    $fenyepage=new FenYePage();
    //基础工具类（使用其分页跳转方法）
    require_once 'sqlHelper.class.php';
    $sqlhelper=new sqlHelper();
        //赋值并查询数据
        $fenyepage->pageSize=3;
        $fenyepage->pageNow=1;
        $fenyepage->gotoUrl="empList.php";
        if(!empty($_GET["pageNow"])){
            $fenyepage->pageNow=$_GET["pageNow"];
        }

        //使用empService类getPageCount（）方法得到总页数
        $fenyepage->pageCount=$empService->getPageCount($fenyepage->pageSize);
        //打印表格
        $empService->empListPage($fenyepage->pageNow,$fenyepage->pageSize);
        //跳转页码
        $sqlhelper->fenyeJump($fenyepage);

?>

<hr/>
<img src="./image/2.png">
</html>