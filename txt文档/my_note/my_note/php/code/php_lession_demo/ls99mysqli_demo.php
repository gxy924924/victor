<?php
header("Content-type: text/html;charset=utf-8");
//
function showTable($table_name){
	$mysqli=new MYSQLI("localhost","root","root","test");

	if($mysqli->connect_error){
		die($mysqli->connect_error);
	}

	$sql="select * from $table_name";
	$res=$mysqli->query($sql);

	echo "共有 行=".$res->num_rows." 列=".$res->field_count;
	//取出表头
	echo "<table border=1px ><tr>";
	while($field=$res->fetch_field()){
		echo "<th>{$field->name}</th>";//大括号可把变量独立出来，旁边可直接写别的
	}
	echo "</tr>";
	//
	while ($row=$res->fetch_row()){
		echo "<tr>";
		foreach($row as $val){  //此处可不用谢$key=>$val,直接写$val也行
			echo "<td>$val</td>";
		}
		echo "</tr>";
		}
	echo "</table>";
	//关闭链接
	$res->free();
	$mysqli->close();
}
showTable("user1");
?>