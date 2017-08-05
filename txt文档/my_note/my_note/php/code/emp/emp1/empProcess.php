<?php
require_once 'empService.class.php';
$empService=new empService();
    //接收用户要删除的id
if (!empty($_GET['flag'])){
    $flag=$_GET['flag'];
    
    //这时知道我们要删除
    if ($flag=="del"){
        $id=$_GET['id'];
        $errno_del=$empService->delById($id);
        if ($errno_del==1){
            header("Location:ok.php");
        }else {
            header("Location:error.php");
        }
    }
    //添加雇员
    else if ($flag=="add"){
        //接收数据
        $name=$_POST['name'];
        $grade=$_POST['grade'];
        $email=$_POST['email'];
        $salary=$_POST['salary'];
        //完成添加->数据库
        $errno_add=$empService->addEmp($name,$grade,$email,$salary);
        if ($errno_add==1){
            header("Location:ok.php");
        }else {
            header("Location:error.php");
        }
    }
    //
    else if ($flag=="update"){
        $id=$_POST['id'];
        $name=$_POST['name'];
        $grade=$_POST['grade'];
        $email=$_POST['email'];
        $salary=$_POST['salary'];
        $errno_update=$empService->updateEmp($id,$name,$grade,$email,$salary);
        if ($errno_update==1){
            header("Location:ok.php");
        }else {
            header("Location:error.php");
        }
        
    }
}

?>