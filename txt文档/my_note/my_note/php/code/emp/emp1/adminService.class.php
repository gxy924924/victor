<?php

require_once 'sqlHelper.class.php';

//该类是一个业务逻辑类，主要对admin表操作
class adminService{
    
    //提供一个验证用户是否合法的方法
    public function checkAdmin($admin){
        $sql="select password,name from admin where id={$admin->getId()}";
        
        //1.通过输入的id来获取数据库的密码，然后再和输入的密码比对
        //创建一个sqlHelper对象
        $sqlHelper=new sqlHelper();
        $res=$sqlHelper->execute_dql($sql);
        if ($row=$res->fetch_assoc()){
            //查询到
            //2。取出数据库密码
            if ($row['password']==md5($admin->getPassword())){
                //说明合法
                //
                session_start();
                $admin->setName($row['name']);
                $_SESSION['name']=$admin->getName();
                header("Location:empManage.php?name={$admin->getName()}");
                exit();
            }else {
                header("Location:login.php?errno=2");
                exit();
            }
        }else {
            header("Location:login.php?errno=1");
            exit();
        }
        $res->close();
        $sqlHelper->close_connect();
    }
    //验证码验证
    function tryCheckCode($checkCode){
        session_start();
        if ($checkCode==$_SESSION['checkCode']){   
        }else {
            header("Location:login.php?errno=3");
            exit();
        }
    }
    
    
}

?>