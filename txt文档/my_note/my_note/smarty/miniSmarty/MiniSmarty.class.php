<?php
//模板引擎类
class MiniSmarty{
	public $template_dir="./view/";//模板目录
	public $templatec_dir="./view_c/";//编译文件目录
	//给该类声明属性，用于存储外部的变量信息
	public $tpl_var=array();
	//把外部变量设置为类内部属性的一部分
	function assign($k,$v){
		$this->tpl_var[$k]=$v;
	}
	
	function display($tpl){
		$n=$this->compile($tpl);
		require_once "$n";
	}


	//编译模板文件
	function compile($tpl){
		$com_file=$this->templatec_dir.$tpl.".php";
		$tpl_file=$this->template_dir.$tpl;
		//1.判断该混编文件是否存在
		//2.混编文件的修改时间要大于模板文件的修改时间
		if(file_exists($com_file)&& filemtime($com_file)>filemtime($tpl_file)){
			return "$com_file";
		}else{
			echo "new file";
			//获得模板文件内部具体的模板内容
			$cont=file_get_contents($tpl_file);
			/*//替换
			//替换 {  ----->  < ?php echo $this->tpl_var['
			//替换 }  ----->  ']; ?>*/
			$cont=str_replace("{\$","<?php echo \$this->tpl_var['",$cont);
			$cont=str_replace("}","'] ?>",$cont);
			//把生成好的编译内容（php+html混编内容）放入一个文件里边
			
			file_put_contents("$com_file",$cont);
			//引入混编文件
			return "$com_file";
		}

		
	
	}
}