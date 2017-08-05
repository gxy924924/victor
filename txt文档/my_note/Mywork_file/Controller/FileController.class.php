<?php 
class FileController extends Controller{
	public function show_file(){
		$user=new sqlHelper();
		$user->settable("file_upload");
		$this->rows=$user->select();
		// echo "<pre>";
		// var_dump($this->rows);
		// echo "</pre>";
		$this->display();
	}

	function upload_file(){
		$this->display();
	}
	//上传文件
	function file_insert(){
		$file=new upLoad();
		$fileinfo=$file->fileupload("file");
		// echo "<pre>";
		// var_dump($fileinfo);
		// var_dump($_POST);
		// print_r($_FILES['file']);
		// echo "</pre>";
		if(is_array($fileinfo)){
			$fileinfo=array_merge_recursive($fileinfo,$_POST,$_FILES['file']);
			//echo "<pre>";	var_dump($fileinfo);echo "</pre>";
			$info= "图片上传成功</br> 数据库";
			$user=new sqlHelper();
			$user->settable("file_upload");
			$jieguo=$user->add($fileinfo);//添加并返回结果
			//echo $user->getlastsql();
			echo $info.=$jieguo;
			//$this->jump($info,$url);
		}else{
			//$url=U_PATH."?c=Picture&v=show";
			//$this->jump($fileinfo,$url);
			echo "failed";
		}
	}
	//下载文件
	function download(){
		// echo "<pre>";
		// var_dump($_GET);
		// echo "</pre>";
		$filename=$_GET['file'];
		$filetruename=$_GET['filename'];
		$file=new download();
		$file->setfile($filename,$filetruename);
		$file->file_down($filename);
	}
}
?>
