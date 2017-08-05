<script src="./jquery-1.4.2/jquery.js"></script>
<?php
$imgsrc=$_FILES['imgname']['tmp_name'];
$imgdst=$_FILES['imgname']['name'];

if(move_uploaded_file($imgsrc,$imgdst)){
	$img="<img src=\"$imgdst\" width=50px height=50px>";
	echo "<script>var obj=top.document.getElementById('uploadimg');$(obj).append('{$img}');top.document.getElementById('hid').value='$imgdst'</script>;";
}else{
	echo "上传失败";
}
/*
	
	echo "<pre>";
	print_r($_FILES);
	echo "<pre>";

*/
?>