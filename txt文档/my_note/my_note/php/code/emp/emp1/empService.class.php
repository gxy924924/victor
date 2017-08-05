<?php
require_once 'sqlHelper.class.php';
//进行增删改查的类
class empService{
    
    //一个函数可以获取共多少页
    function getPageCount($pageSize){
        //查询$rowCount
        $sql="select count(id) from emp";
        $sqlHelper=new sqlHelper();
        $res=$sqlHelper->execute_dql($sql);
        
        //计算$pageCount
        if ($row=$res->fetch_row()){
            $pageCount=ceil($row[0]/$pageSize);
        }
        //
        $res->free();
        $sqlHelper->close_connect();
        return $pageCount;
    }
    //打印表格的方法
    public function empListPage($pageNow,$pageSize){
        $sql="select * from emp limit ".($pageNow-1)*$pageSize.",".$pageSize;
        $sqlHelper=new sqlHelper();
        $res=$sqlHelper->execute_dql($sql);
        
        echo "雇员信息列表</br>";
        echo "<table border=1 cellspacing=0 bordercolor='green'>";
        echo "<tr><th>id</th><th>name</th><th>grade</th><th>email</th><th>salary</th>".
            "<th>删除用户</th><th>修改用户</th></tr>";
        while ($row=$res->fetch_row()){
            echo "<tr>";
            foreach ($row as $val){
                echo "<td>";
                echo $val;
                echo "</td>";
            }
            echo "<td><a return onclick='return confirmDele($row[0])' 
            href='empProcess.php?id=$row[0]&pageNow=$pageNow&
            flag=del'>删除用户</a></td><td><a href='updateEmpUI.php?
            id=$row[0]'>修改用户
            </a></td></tr>";
        }
        echo "</table></br>";
        //释放资源和关闭链接
        $res->free();
        $sqlHelper->close_connect();
    }
    
    //
    function delById($id){
        $sqlHelper=new sqlHelper();
        $sql="delete from emp where id={$id}";
        return $errno_del=$sqlHelper->execute_dml($sql);
    }
    //添加雇员
    function addEmp($name,$grade,$email,$salary){
        $sql="insert into emp(name,grade,email,salary) values('$name','$grade','$email','$salary')";
        
        $sqlHelper=new SqlHelper();
        $res=$sqlHelper->execute_dml($sql);
        return $res;
        $sqlHelper->close_connect();
    }
    //根据id获取一个雇员的信息
    function getEmpById($id){
        $sql="select * from emp where id=$id";
        $sqlHelper=new sqlHelper();
        $res=$sqlHelper->execute_dql($sql);
        $row=$res->fetch_row();
        return $row;
        $sqlHelper->close_connect();
        
    }
    //
    function updateEmp($id,$name,$grade,$email,$salary){
        $sql="update emp set name='$name',grade='$grade',
        email='$email',salary='$salary'where id=$id";
        
        $sqlHelper=new SqlHelper();
        $res=$sqlHelper->execute_dml($sql);
        return $res;
        $sqlHelper->close_connect();
    }

}

?>