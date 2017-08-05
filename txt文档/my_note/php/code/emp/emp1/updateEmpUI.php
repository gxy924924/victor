<?php
require_once 'empService.class.php';
//该页面要显示要修改的信息
$id=$_GET['id'];

$empService=new EmpService();
$row=$empService->getEmpById($id);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<h1>修改雇员</h1>
</head>
<form action="empProcess.php?flag=update" method="post">
<table>
<tr><td>id</td><td><input type="text" readonly="readonly" name="id" value="<?php echo $row[0]?>"></td></tr>
<tr><td>名字</td><td><input type="text" name="name" value="<?php echo $row[1]?>"></td></tr>
<tr><td>级别</td><td><input type="text" name="grade" value="<?php echo $row[2]?>"></td></tr>
<tr><td>电邮</td><td><input type="text" name="email"value="<?php echo $row[3]?>"></td></tr>
<tr><td>薪水</td><td><input type="text" name="salary"value="<?php echo $row[4]?>"></td></tr>
<tr><td><input type="submit" value="修改用户"></td>
<td><input type="reset" value="重新填写"></td></tr>
</table>
</form>

</html>