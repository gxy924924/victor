<?php
class SortController extends Controller{
	function show(){
		$this->verify();
		$user=new sqlHelper();
		$user->settable("sort");
		$this->rows=$user->where("parent_key='top'")->select();
		$this->rows2=$user->where("parent_key='".$this->rows[0]['child_key']."'")->select();
		$this->display();
	}
	function add(){
		$this->verify();
		$user=new sqlHelper();
		$user->settable("sort");
		$this->rows=$user->where("parent_key='top'")->select();
		$this->display();
	}
	function insert(){
		echo "<pre>";
			var_dump($_POST);
		echo "</pre>";
		$user=new sqlHelper();
		$user->settable("sort");
		$info=$user->add($_POST);
		echo $info;
	}
	function change_sort(){
		$user=new sqlHelper();
		$user->settable("sort");
		$this->rows=$user->where("parent_key='".$_POST['parent_key']."'")->select();
		//$this->rows=$user->where("parent_key='食品'")->select();
		echo $this->my_json_encode($this->rows);
	}

	//本类中专用数组转json
	function my_json_encode($data){
		$json_data='{"child_key":[';
		foreach($data as $key=>$val){
			$json_data.='"'.$data[$key]["child_key"].'",';
		}
		$json_data=substr($json_data,0,-1);
		$json_data.="]}";
		return $json_data;
	}
}

?>