<?php
class download{
	public $filename;
	public $file_true_name;
	public function setfile($filename,$file_true_name){
		$this->filename=$filename;
		$this->file_true_name=$file_true_name;
	}
	public function file_down(){
		//echo $this->filename;
		if($this->check_file()){
		$fp=fopen($this->filename,"r");
		//获取下载文件的大小
		$file_size=filesize($this->filename);
		//返回的是文件的形式（stream流）
		header("Content-type:application/octet-stream");
		//按照字节大小返回
		header("Accept-ranges:bytes");
		//返回文件大小
		header("Accept-Length:$file_size");
		//这里客户端的弹出对话框，对应的文件名
		header("Content-Disposition:attachement;filename=".$this->file_true_name);
		//向客户端回送数据
		$buffer=1024;
		//为了下载的安全，最好做一个文件读取计数器
		$file_count=0;
		//这句话用于判断文件是否结束 
		//说明：eof(end of file)//&&($file_size-$file_count>0)
		while(!feof($fp)&&($file_size-$file_count>0)){
			$file_data=fread($fp,$buffer);
			//统计读了多少个字节
			$file_count+=$buffer;
			//把部分数据回送给浏览器
			echo $file_data;
		}
		//关闭文件
		fclose($fp);
		}
		
	}
	function check_file(){
		if (file_exists($this->filename)) {
			return true;
		}else{
			echo "文件不存在";
			return false;
		}
	}
}
?>
