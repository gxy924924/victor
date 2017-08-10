<?php 
//Index model
class ListController extends Controller{
	//微信测试功能页首页
	function index(){
		if ($this->catch_play()) {
			ob_start();
			$this->list_admin_sql_show();
			$this->display();
			$content=ob_get_contents();
			file_put_contents($this->catch_file, $content);
		}
	}

	function article_admin(){
		if ($this->catch_play()) {
			ob_start();
			$this->type_admin_get();
			$this->image_info=$this->image_info_get();
			$this->display();
			$content=ob_get_contents();
			file_put_contents($this->catch_file, $content);
		}

		
	}

	//文章列表管理
	function list_admin(){
		if ($this->catch_play()) {
			ob_start();
			
			$this->display();
			$content=ob_get_contents();
			file_put_contents($this->catch_file, $content);
		}
		
	}

	//种类管理
	function type_admin(){

		if ($this->catch_play()) {
			ob_start();
			$this->type_admin_sql_show();
			$this->display();
			$content=ob_get_contents();
			file_put_contents($this->catch_file, $content);
		}
		
		
	}

	function article_show(){
		if ($this->catch_play()) {
			ob_start();
			echo $_GET['id'];
			$this->article=$this->article_get($_GET['id']);
			$type_id=$this->article[0]['type_id'];
			$this->bread_type=$this->article_bread_type($type_id);
			// echo "<pre>";
			// var_dump($this->article);
			// echo "</pre>";
			$this->display();
			$content=ob_get_contents();
			file_put_contents($this->catch_file, $content);
		}

	}

	function list_show(){
		if ($this->catch_play()) {
			ob_start();
			if (!empty($_GET['type_id'])) {
				$type_id=$_GET['type_id'];
				$list_id=$this->list_id_get($type_id);
				// echo $list_id;
				$this->list_res=$this->list_admin_sql_type_show($list_id);
				$this->type_res=$this->type_one_get($type_id);
			}else if(!empty($_POST['search'])){
				// echo "</br></br></br><pre>";
				// var_dump($_POST);
				// echo "</pre>";
				$this->list_res=$this->list_search($_POST['search']);

			}else{
				$this->list_res=$this->list_admin_sql_show();
			}
				
			// echo "<pre>";
			// var_dump($list_res);
			// echo "</pre>";
			$this->display();
			$content=ob_get_contents();
			file_put_contents($this->catch_file, $content);
		}

		
			
	}

//-----------------------------------	文章中图片信息--------------------------------------
	function image_info_get(){
		$sql=new sqlHelper();
		$sql->settable("myweb_image_upload");
		$sql_res=$sql->limit(0,5)->select();
		return $sql_res;
	}

//-----------------------------------	文章管理--------------------------------------

	
	function article_bread_type($id){
		$sql=new sqlHelper();
		$sql->settable("myweb_sort_type");
		$res_sql=$sql->where("id=".$id)->select();
		$type_sql=$res_sql;
		$parent_type_id=$res_sql[0]['parent_type_id'];
		while ($parent_type_id!=0) {
			// echo "</br></br></br></br></br></br>".$parent_type_id;
			$res_sql=$sql->where("id=".$res_sql[0]['parent_type_id'])->select();
			$type_sql=array_merge($res_sql,$type_sql);
			$parent_type_id=$res_sql[0]['parent_type_id'];
		}
		return $type_sql;
	}

	function article_get($id){
		$sql=new sqlHelper();
		$sql->settable("myweb_list");
		$res=$sql->where('id='.$id)->select();
		// echo $sql->getlastsql();
		return $res;
	}

	//
	function article_admin_add(){
		if (empty($_POST['title'])) {
			$sql_res="标题不能为空";
		}else{
			$path_adder=time().rand(1,1000);
			$url_path=VIEW_PATH.CONTROLLER.DS."article".DS.$_POST['title']."_".$path_adder.".php";
			$url_path=str_replace("\\", "\\\\", $url_path);
			$content="<div class='container'>";
			$content.=str_replace("\n", "</br>", $_POST['content']);
			$content.="</div>";
			$arr1=array("url"=>$url_path);
			$type_arr=explode(" ",$_POST['type_id']);
			$arr1['type_id']=$type_arr[0];
			$arr1['type_name']=$type_arr[1];
			$add=array_merge($_POST,$arr1);

			$sql_res=$this->article_admin_sql_add($add);
			if ($sql_res=="添加成功") {
				file_put_contents($url_path,$content);
			}
			
		}
		$url_jump=U_PATH."?m=Index&c=List&v=article_admin";
		$this->jump($sql_res,$url_jump);

		// echo "<pre>";
		// var_dump($_POST['type_id']);
		// var_dump($add);
		// echo "</pre>";
	}

	function article_admin_del(){
		$sql=new sqlHelper();
		$sql->settable("myweb_list");
		$sql_res=$sql->where("id=".$_GET['id'])->select();
		$file_path=$sql_res[0]['url'];
		$del_res=$sql->delete("id=".$_GET['id']);
		if($del_res=="删除成功"){
			$f_del_res=unlink($file_path);
			if ($f_del_res) $f_del_res="删除成功";
		}
		$url_jump=U_PATH."?m=Index&c=List&v=index";
		$this->jump($f_del_res,$url_jump);
		// echo "<pre>";
		// var_dump($file_path);
		// var_dump($sql_res);
		// echo "</pre>";
	}

	function article_admin_addfile(){

	}


	function article_admin_sql_add($add){
		$sql=new sqlHelper();
		$sql->settable("myweb_list");
		$res=$sql->add($add);
		// echo $sql->getlastsql();
		return $res;
	}

	// function article_admin_content_get($id){

	// }


	//获取文章列表
	function article_admin_sql_get(){
		$sql=new sqlHelper();
		$sql->settable("myweb_list");
		$res=$sql->select();
		return $res;
	}
	//文章字符串测试(textarea中的回车符表现问\n可以用替换的方法将其替换为html符号)
	function article_test(){
		$arr=$this->article_admin_sql_get();
		$url=$arr[0]['url'];
		$content=file_get_contents($url);
		$search="\n";
		$replace="</br>";
		$content=str_replace($search, $replace, $content);
		file_put_contents($url,$content);
		echo $content;
		echo "<hr>";
		require_once $url;
	}
//-----------------------------------	列表管理----------------------------------

	function list_admin_sql_show(){
		$sql=new sqlHelper();
		$sql->settable("myweb_list");
		$this->type=$sql->order("id desc")->select();
		return $this->type;
	}

	function list_search($search){
		$sql=new sqlHelper();
		$sql->settable("myweb_list");
		$search_arr=explode(" ",$search);
		foreach ($search_arr as $key => $val) {
			if ($key) {
				$sql_search.=$val."%";
			}else{
				$sql_search="%".$val."%";
			}
		}
		return $sql->where("title like '".$sql_search."'")->order("id desc")->select();
	}

	//显示列表及其子表元素
	function list_admin_sql_type_show($id_list){
		$sql=new sqlHelper();
		$sql->settable("myweb_list");
		$list=$sql->where("type_id in ".$id_list)->order("id desc")->select();
		return $list;
	}
		
	
//-----------------------------------	类型管理----------------------------------
	//数据库查询
	function type_admin_get(){
		$sql=new sqlHelper();
		$sql->settable("myweb_sort_type");
		$this->type=$sql->select();
	}

	//获取单个id的信息
	function type_one_get($type_id){
		$sql=new sqlHelper();
		$sql->settable("myweb_sort_type");
		return $sql->where("id=".$type_id)->select();
	}

	//获取用于数据查询的多个id
	function list_id_get($type_id){
		$this->sql_id="";
		$this->type_child_id_get($type_id);
		$list_id=$this->sql_id;
		$list_id=substr($list_id,1);
		$list_id="(".$list_id;
		$list_id.=")";
		return $list_id;
	}

	//根据父类的id获取所有子类id(用于查询)
	function type_child_id_get($type_id){
		$sql=new sqlHelper();
		$sql->settable("myweb_sort_type");
		$sql_res=$sql->where('id='.$type_id)->select();
		$this->sql_id.=",".$type_id;
		$has_child=$sql_res[0]['has_child'];
		while($has_child){
			$sql_res=$sql->where('parent_type_id='.$type_id)->select();
			foreach ($sql_res as $val) {
				$this->type_child_id_get($val['id']);
			}
			$has_child=0;
		}
	}

	//收到数据库数据，中转
	function type_admin_sql_show(){
		$this->type_admin_get();
		$this->show="<ul class='list-group'>";
		$this->type_admin_str_make($this->type,1,0);
		$this->show.="</ul>";

	}
	//对获得的结果进行处理（排序、html化）
	function type_admin_str_make($res,$level,$parent_type_id){
		$arrow="&nbsp&nbsp&nbsp";
		for($i=1;$i<$level;$i++){
			$arrow.="|&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
		}
		// $arrow.="->";
		
		foreach ($res as $val) {
			if ($val['sort_level']==$level&&$parent_type_id==$val['parent_type_id']) {
				$this->show.="<li class='list-group-item'>id=".$val['id'].$arrow.$val['type_name']."<span class='badge1'><a href='".U_PATH."?m=Index&c=List&v=type_admin_sql_del&id=".$val['id']."' class='btn btn-xs btn-danger'>删除</a></span></li>";
				if ($val['has_child']) {
					$level2=$level+1;
					$this->type_admin_str_make($res,$level2,$val['id']);
				}
			}
		}
	}

	//添加数据库
	function type_admin_sql_add(){
		
		$sql=new sqlHelper();
		$sql->settable("myweb_sort_type");
		$add=$_POST;
		$res=$sql->select();
		$flag=1;
		$add['sort_level']=1;
		$add['has_child']=0;
		foreach ($res as $v) {
			if($v['type_name']==$_POST['type_name']){
				$mes_res="已有此分类名，请重新命名";
				$flag=0;
			}
			if($_POST['parent_type_id']==$v['id']){
				$add['sort_level']=$v['sort_level']+1;
				$v['has_child']=1;
				$sql->update($v);
			}
		}
		if ($flag) {
			$mes_res="添加成功";
			$sql->add($add);
		}
		// echo "<pre>";
		// var_dump($add);
		// var_dump($res);
		// var_dump($flag);
		// echo "</pre>";
		$jump_url=U_PATH."?m=Index&c=List&v=type_admin";
		// $mes_res="";
		$this->jump($mes_res,$jump_url);	
	}

	function type_admin_sql_del(){
		$sql=new sqlHelper();
		$sql->settable("myweb_sort_type");
		$res=$sql->where("id=".$_GET['id'])->select();
		$this->del_sql="id in (".$res[0]['id'];
		$this->type_admin_sql_del_id($sql,$res[0]);
		$this->del_sql.=")";
		$sql_res=$sql->delete($this->del_sql);
		$jump_url=U_PATH."?m=Index&c=List&v=type_admin";
		$this->jump($sql_res,$jump_url);
		// echo "<pre>";
		// // var_dump($_GET);
		// var_dump($res);
		// var_dump($this->del_sql);
		// echo "</pre>";
	}
	//查找删除子元素
	function type_admin_sql_del_id($sql,$res){
		if($res['has_child']){
			$res2=$sql->where("parent_type_id=".$res['id'])->select();
			foreach ($res2 as $k => $v) {
				$this->del_sql.=",".$v['id'];
				$this->type_admin_sql_del_id($sql,$v);
			}
		};
	}


	//生成分类列表连接信息 
	function sort_type_page_input(){
		$this->type_admin_get();
		$this->show="<div><ul class='list-group'>";
		$this->sort_type_page_make($this->type,1,0);
		$this->show.="</ul></div>";

		$file_path=APP."Index/View/Index/sort_type_page.php";
		$file_res=file_put_contents($file_path, $this->show);
		echo $file_res;
	}

	//对获得的结果进行处理（排序、html化）功能页面
	function sort_type_page_make($res,$level,$parent_type_id){
		$arrow="&nbsp&nbsp&nbsp";
		for($i=1;$i<$level;$i++){
			$arrow.="|&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
		}
		// $arrow.="->";
		
		foreach ($res as $val) {
			if ($val['sort_level']==$level&&$parent_type_id==$val['parent_type_id']) {
				$this->show.="<li class='list-group-item'><a class='btn btn_primary' href='".U_PATH."?m=Index&c=List&v=list_show&type_id=".$val['id']."'>".$arrow.$val['type_name']."</a></li>";
				if ($val['has_child']) {
					$level2=$level+1;
					$this->sort_type_page_make($res,$level2,$val['id']);
				}
			}
		}
	}

	function get_qrcode(){
		require_once PUBLIC_PATH.'phpqrcode/phpqrcode.php';
		QRcode::png('http://www.gweixin.top/index.php');   
	}
}
?>
