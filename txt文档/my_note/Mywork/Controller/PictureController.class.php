<?php 
class PictureController extends Controller{
	public function show(){
		$this->verify();
		$user=new sqlHelper();
		$user->settable("myshop_img");
		$this->rows=$user->where("username='".$_SESSION['username']."'")->select();

		//echo "<pre>";var_dump($this->rows);echo "</pre>";
		$this->display();
	}

	function add(){
		$this->verify();
		$this->display();
	}
	function insert(){
		$file=new upLoad();
		$fileinfo=$file->fileupload();
		if(is_array($fileinfo)){
			$us=array("username"=>$_SESSION['username']);
			$fileinfo=array_merge_recursive($fileinfo,$_POST,$_FILES['img_file'],$us);
			//echo "<pre>";	var_dump($fileinfo);echo "</pre>";
			$info= "图片上传成功</br> 数据库";
			$user=new sqlHelper();
			$user->settable("myshop_img");
			$jieguo=$user->add($fileinfo);//添加并返回结果
			//echo $user->getlastsql();
			$info.=$jieguo;
			$url=U_PATH."?c=Picture&v=show";
			$this->jump($info,$url);
		}else{
			$url=U_PATH."?c=Picture&v=show";
			$this->jump($fileinfo,$url);
		}
	}

	function delete(){
		$user=new sqlHelper();
		$user->settable("myshop_img");
		$info=$user->delete("move_to_file='".$_GET['file']."'");
		//echo $user->getlastsql();
		if($info=="删除成功"){
			unlink($_GET['file']);
		}
		$url=U_PATH."?c=Picture&v=show";
		$this->jump($info,$url);
	}

	function test(){
		$user=new sqlHelper();
		echo $user->settable("myshop_img");
		$rows=$user->gettitle();
		echo "<pre>";
			var_dump($rows);
		echo "</pre>";
		echo $user->getlastsql();
	}
}
?>