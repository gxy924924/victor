<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" >
</head>
</html>
<?php
//这是一个工具类
class sqlHelper{
    public $conn;
    public $dbname="empmanage";
    public $username="root";
    public $password="root";
    public $host="localhost";
    
    public function __construct(){
        $this->conn=new MYSQLI($this->host,$this->username,$this->password,$this->dbname);
        if($this->conn->connect_error){
             die("连接数据库失败".$this->conn->connect_error);
        } 
    }
    
    //执行dql语句
    public function execute_dql($sql){
        $res=$this->conn->query($sql) or die($this->conn->error());
        return $res; 
    }
    
    //执行dml语句
    public function execute_dml($sql){
        $b=$this->conn->query($sql);
        if (!$b){
            return 0;//执行失败
        }else {
            if ($this->conn->affected_rows>0){
                return 1;//执行成功
            }else {
                return 2;//表示没有收到影响
            }
        }
    }
    
    //关闭链接的方法
    public  function close_connect(){
        
        if(!empty($this->conn)){
            $this->conn->close();
        }
    }
    
    //考虑分页情况的查询
    //例：$sql1="select * from 表名  limit 0,6"
    //例：$sql2="select count(id) from 表名  "
    public function execute_dql_fenye($sql1,$sql2,&$fenYePage){
        //这里我们查询了要分页显示的数据
        $res=$this->conn->query($sql1) or die($this->conn->error());
        //$res=>array
        $res=array();
        //把$res转移到$arr
        while ($row=$this->conn->fetch_assoc($res)){
            $arr[]=$row;
        }
        
        //
        $fenyePage->$res_array=$arr;
        $res->free();
    }
    
    //分页跳转
    public function fenyeJump($fenyepage){
        //跳转到首页
        echo "页码：<a href='".$fenyepage->gotoUrl."?pageNow=1'>首页</a>..";
        //显示上一页
        if ($fenyepage->pageNow>1){
            $prePage=$fenyepage->pageNow-1;
            echo "<a href='".$fenyepage->gotoUrl."?pageNow=$prePage'>上一页</a>..";
        }else {
            echo "<a href='".$fenyepage->gotoUrl."?pageNow=$fenyepage->pageNow'>上一页</a>..";
        }
        //
        if ($fenyepage->pageNow<12){
        echo "<a href='".$fenyepage->gotoUrl."?pageNow=1'><<</a>..";
        }else {
            $pagejumpdown=$fenyepage->pageNow-10;
            echo "<a href='".$fenyepage->gotoUrl."?pageNow=$pagejumpdown'><<</a>..";
        }
        //调到指定页
        $start=floor(($fenyepage->pageNow-1)/10)*10+1;
        for($i=$start;$i<=($start+9)&&$i<=$fenyepage->pageCount;$i++){
        echo "<a href='".$fenyepage->gotoUrl."?pageNow=".$i."'>".$i."</a>..";
        }
        //
        if ($fenyepage->pageNow>$fenyepage->pageCount-11){
             echo "<a href='".$fenyepage->gotoUrl."?pageNow=$fenyepage->pageCount'>>></a>..";
        }else {
             $pagejumpup=$fenyepage->pageNow+10;
             echo "<a href='".$fenyepage->gotoUrl."?pageNow=$pagejumpup'>>></a>..";
        }
        //显示下一页
        if ($fenyepage->pageNow<$fenyepage->pageCount){
               $nextPage=$fenyepage->pageNow+1;
               echo "<a href='".$fenyepage->gotoUrl."?pageNow=$nextPage'>下一页</a>..";
        }else {
               echo "<a href='".$fenyepage->gotoUrl."?pageNow=$fenyepage->pageNow'>下一页</a>..";
        }
        //
        echo "<a href='".$fenyepage->gotoUrl."?pageNow=$fenyepage->pageCount'>末页</a>..";
        
        echo  "..当前页{$fenyepage->pageNow}/共".$fenyepage->pageCount."页</br>";
        echo "<form action='".$fenyepage->gotoUrl."' method='get'>
                        跳转到：<input type='text' name='pageNow' size=1px>
            <input type='submit' value='go'></form>";
    }
}
?>