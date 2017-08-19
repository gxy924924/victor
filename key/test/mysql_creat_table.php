<?php 
// header("Content-type: text/html; charset=utf-8"); 

// echo urlencode($_GET['test']);
$db=new mysqli('localhost','root','root','');
if (!$db) {
    die('Connect Error: ' . mysqli_connect_errno());
}
$db_name="mysqli_test_creat_table";
// $info=$db->query('create database '.$db);
$db->select_db($db_name);
$info=$db->query('create table test21231215(id int not null auto_increment,aa varchar(50) not null ,bb int not null,primary key (id),index(bb))');

echo "<pre>";
var_dump($info);
var_dump($db->error);
echo "</pre>";
?>