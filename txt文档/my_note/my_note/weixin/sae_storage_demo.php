<?php

class save_and_load{
    //$access_key="0xm4kkxjw1";
    //$secret_key="ilzhyz3x3lzl54zkizkihj1ly41imjw1jjwjxmxk";	//本地可以不用这两个

    public $test;
	public $bucket="myfile";
    public $filename="1.txt";
    
    public function __construct(){
    	$this->test=new sinacloud\sae\Storage();
    }
    public function set_bucket($bucket){
    	$this->bucket=$bucket;
    }
    public function set_file($file){
    	$this->filename=$file;
    }
    public function showbuckets(){
    	$arr=$this->test->listBuckets();	//显示bucket列表
        return $arr;
    }

    
	public function show_file(){
    	$arr=$this->test->getBucket($bucket);		//显示一个名叫（myfile的）bucket中的文件列表
    	return $arr;
    }
    
	public function save_file($str){//（写入的字串，bucket名，文件名）
    	$this->test->putObject($str, $this->bucket ,$this->filename , array(), array('Content-Type' => 'text/plain'));//上传$test_arr到名叫myfile的bucket中的1.txt文件中
    
    }
    
	public function show_object(){
    	$arr=$this->test->getObject($this->bucket,$this->filename);		//显示文件的内容
        return $arr;
    }

}
?>