<?php

//上传文件

//1.接收提交文件的用户
//$username=$_POST['username'];
//$fileintro=$_POST['fileintro'];

//echo $username."</br>".$fileintro;

//这里我们需要使用到 $_FILE
function fileInfo(){
	echo "<pre>";
	print_r($_FILES['myfile']);
	print_r($_SERVER['DOCUMENT_ROOT']);
	echo "<pre>";
	echo "<pre>";
		var_dump($_FILES);
	echo "</pre>";
}

//控制文件上传的大小
function fileSize1(){
	$file_size=$_FILES['myfile']['size'];
	echo $file_size;
	if($file_size>2*1024*1024){
		echo "文件过大";
		exit();
	}
}
//控制文件类型
function fileType1(){
	$file_type=$_FILES['myfile']['type'];
	echo $file_type;
	if($file_type=="text/plain"){
		echo "文件类型通过";
	}else{
		echo "文件类型禁止通过";
		exit();
	}
}
//判断是否上传 
function fileUpload1(){
	if(is_uploaded_file($_FILES['myfile']['tmp_name'])){
		//把文件转存到想要放的位置
		//$_FILE是文件已经被缓存的，再用下面的函数相当于copy
		$uploaded_file=$_FILES['myfile']['tmp_name'];
		$move_to_file=$_SERVER['DOCUMENT_ROOT']."/file/up/".$_FILES['myfile']['name'];
		//move_uploaded_file($uploaded_file,$move_to_file);
		//echo $uploaded_file."</br>".$move_to_file;
		//var_dump(move_uploaded_file($uploaded_file,$move_to_file));
		if(move_uploaded_file($uploaded_file,$move_to_file)){
			echo $move_to_file."上传成功";
		}else{
			echo "上传失败2";
		}
	}else{
		echo "上传失败1";
	}
}

//动态的给每个用户创建一个文件
function fileUpload2($username){
	if(is_uploaded_file($_FILES['myfile']['tmp_name'])){
		//把文件转存到想要放的位置
		$uploaded_file=$_FILES['myfile']['tmp_name'];
		//我们动态的给每个用户创建一个文件
		$user_path=$_SERVER['DOCUMENT_ROOT']."/file/up/".$username;
		//给文件创建随机名，使其不会重复
		$file_true_name=$_FILES['myfile']['name'];
		$file_last_word=substr($file_true_name,strrpos($file_true_name,"."));
		$file_new_name=time().rand(1,1000).$file_last_word;
		$move_to_file=$user_path."/".$file_new_name;
		//判断该用户是否银镜有文件夹
		if(file_exists($user_path)){
		}else{
			mkdir($user_path);
		}
		if(move_uploaded_file($uploaded_file,$move_to_file)){
			echo $move_to_file."上传成功";
		}else{
			echo "上传失败2";
		}
	}else{
		echo "上传失败1";
	}
}

//fileUpload2("my_user");
fileInfo();
?>