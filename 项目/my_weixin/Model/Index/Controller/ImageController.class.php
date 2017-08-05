<?php 
class ImageController extends Controller{
	function __construct(){
		header("Content-type:text/html;charset=utf-8");
	}

	public function index(){
		if ($this->catch_play()) {
			ob_start();
			$this->img=$this->image_sql_get();
			$this->display();
			$content=ob_get_contents();
			file_put_contents($this->catch_file, $content);
		}
			
	}

	function iamge_upload(){
		$file_path=APP."Index/Upload/Image/";
		
		$res_file=$this->image_upload_file($file_path);
		$sql_res=$this->image_sql_set($res_file);


		$url_jump=U_PATH."?m=Index&c=Image&v=index";
		$this->jump($sql_res,$url_jump);
		// echo "sql返回：$sql_res";
		// echo "<pre>";
		// var_dump($_FILES);
		// // var_dump($file_path);
		// var_dump($res_file);
		// echo "</pre>";
	}

	//上传文件
	function image_upload_file($file_path){
		$img=new upLoad();
		
		$img->set_file_path($file_path);
		$res_file=$img->file_upload_do();
		foreach ($_FILES as $key => $val) {
			if (isset($val['name'])) {
				$info=pathinfo($res_file[$key]['move_to_file']);
				$res_file[$key]=array_merge($_FILES[$key],$res_file[$key],$info);
				$res_file[$key]['move_to_file']=str_replace("\\", "/", $res_file[$key]['move_to_file']);
			}
			
		}
		return $res_file; 
	}

	//上传数据库
	function image_sql_set($arr){
		$sql=new sqlHelper();
		$sql->settable('myweb_image_upload');
		$sql_res="";
		foreach ($arr as $key=>$val) {
			if (isset($val['filename'])) {
				$sql_res_fe=$sql->add($val);
				if ($key) {
					$sql_res.="||".$key.$sql_res_fe;
				}else{
					$sql_res.=$key.$sql_res_fe;
				}
			}
		}
		return $sql_res;
	}

	function image_sql_get(){
		$sql=new sqlHelper();
		$sql->settable('myweb_image_upload');
		return $sql->select();

	}
}

?>