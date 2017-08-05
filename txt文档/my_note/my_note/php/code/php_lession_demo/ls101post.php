<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
</head>

<h1>用户注册</h1>
<form action="ls101post_register.php" method="post">
用户名：<input type="text" name="username"/></br>
密码：<input type="password" name="password"/></br>
性别：<input type="radio" name="sex" value="male"/>男<input type="radio" name="sex" value="female"/>女</br>
你喜欢什么：<input type="checkbox" name="hobby[]" value="唱歌"/>唱歌
<input type="checkbox" name="hobby[]" value="跳舞"/>跳舞
<input type="checkbox" name="hobby[]" value="偷东西"/>偷东西
<input type="checkbox" name="hobby[]" value="骑驴"/>骑驴<br/>
你的所在地是：
<select name="city">
<option value="beijing">北京</option>
<option value="tianjing">天津</option>
<option value="shanghai">南京</option>

</select></br>

个人介绍：<textarea rows=10 cols=30 name="intro">
</textarea></br>
你的照片：<input type="file" name="myphoto" ></br>
<input type="submit" value="提交" /></br>
</form>
</html>