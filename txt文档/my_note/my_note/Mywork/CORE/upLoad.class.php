<?php
class upLoad{
	public $uploaded_file;						//缓存文件位置+名称
	public $user_path="./Public/upload/";		//文件想要放到的位置
	public $file_true_name;						//原文件名
	public $move_to_file;						//上传位置+文件名
	function fileupload(){
		if(is_uploaded_file($_FILES["img_file"]['tmp_name'])){
		//控制文件类型（默认image）
			$info=$this->controller_fileType();
			if(!empty($info)) return $info;
		//控制文件大小（默认最大2M）
			$this->controller_fileSize();
			if(!empty($info)) return $info;
			$this->uploaded_file=$_FILES["img_file"]['tmp_name'];
		//给文件创建随机名，使其不会重复
			$this->make_file_name();
		//如果三级地址不存在，创建它
			$this->dirmake();
			if(move_uploaded_file($this->uploaded_file,$this->move_to_file)){
			$get_file_info=array("user_path"=>$this->user_path,"file_true_name"=>$this->file_true_name,"move_to_file"=>$this->move_to_file);
			return $get_file_info;
		}else{
			return "上传失败 move_upoaded_file 失败";
		}
		}else{
			return "上传失败 is_uploaded_file 失败";
		}
	}

//给文件创建随机名，使其不会重复
	function make_file_name(){
	//获取原文件名
		$this->file_true_name=$_FILES['img_file']['name'];
	//获取文件后缀
		$file_last_word=substr($this->file_true_name,strrpos($this->file_true_name,"."));
	//创建新文件名
		$file_new_name=time().rand(1,1000).$file_last_word;
	//新文件目录+名
		$this->move_to_file=$this->user_path.$file_new_name;
	}

//如果三级地址不存在，创建它
	function dirmake(){
		if(!file_exists($this->user_path)){
			mkdir($this->user_path);
		}
	}

//控制文件上传的大小
	function controller_fileSize($file_max_size=2*1024*1024){
		$file_size=$_FILES['img_file']['size'];
		if($file_size>$file_max_size){
			return "不能大于2M文件过大";
		}
	}
//控制文件类型
	function controller_fileType($file_type_control1="image",$file_type_control2="*"){
		$file_type=$_FILES['img_file']['type'];
		$file_type=explode("/",$file_type);
		if($file_type[0]==$file_type_control1){
			if($file_type[1]==$file_type_control2){
			}else if($file_type_control2=="*"){
			}else{
				return "文件类型需要是".$file_type_control1."/".$file_type_control2."禁止通过";
			}
		}else{
			return "文件类型需要是".$file_type_control1."/".$file_type_control2."禁止通过";
		}
	}

}
?>