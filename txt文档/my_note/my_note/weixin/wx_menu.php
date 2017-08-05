<?php 
require_once "test.php";
header("Content-type:text/html;charset=utf-8");

	//PHP curl函数模拟GET请求
	//1.初始化
class wx_menu{
    public $ch;
    public $access_token;
    function __construct(){
    	$this->ch = curl_init();
        $this->access_token=$this->get_acToken();
    }
	//从微信获取token码
    function get_acToken_online(){   
        $url = " https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxf7194c23a658275b&secret=80fff401142a264b0fd86f7dc35f6fb0";

        curl_setopt($this->ch,CURLOPT_URL,$url);//设置请求地址
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);//获取的信息以文件流的形式返回

        $json = curl_exec($this->ch);

        //echo $json;
        //4.释放cURL
        curl_close($this->ch);
        return $json;
    }
    //在本地获取token如果存在并且时间未超过7200秒，则使用本地的，反之，则从微信获取并存在本地
    function get_acToken(){
    	$file=new save_and_load();//使用自制storage方法存放token
		$file->set_file("wx_access_token.txt");
        if(!empty($arr=$file->show_object())){
        	$json=$arr->body;
            $load_time=$arr->headers["time"]."</br>";
            $now_time=time()."</br>";
            $exp_time=$now_time-$load_time;
            if($exp_time>=7200){
            	$json=$this->get_acToken_online();
        		$file->save_file($json);
            }
        }else{
            $json=$this->get_acToken_online();
        	$file->save_file($json);
        }
        $arr=json_decode($json);
        //echo "<pre>";var_dump($arr);echo "</pre>";
        return $arr->access_token;
    }
    //设置菜单
    function set_menu(){
    	$url = " https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$this->access_token}";
        //echo $url."</br>";

        curl_setopt($this->ch,CURLOPT_URL,$url);//设置请求地址
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);//获取的信息以文件流的形式返回
        curl_setopt($this->ch,CURLOPT_POST,1);//post请求

        $post = '
            {
                "button":[
                    {
                    	"name":"事件",
                        "sub_button":[
                            {
                            "type":"click",
                       		"name":"news",
                        	"key":"news"
                            },
                            {
                            "type":"CLICK",
                       		"name":"time",
                        	"key":"time"
                            }]
                        
                    },
                    {
                        "name":"微官网",
                        "sub_button":[
                            {
                            "type":"view",
                            "name":"微官网",
                            "url":"http://1.gweixin.applinzi.com/"
                            },
                            {
                            "type":"view",
                            "name":"aaa",
                            "url":"http://1.gweixin.applinzi.com/"
                            }]
                    }]
            }';//一个一级菜单-->下面可以有三个子菜单
        //echo $post;

        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post);		//请求post数据

        $json = curl_exec($this->ch);

        echo $json;
        //4.释放cURL
        curl_close($this->ch);
    
    }
    //显示上传的菜单
    function show_menu(){

        $url = " https://api.weixin.qq.com/cgi-bin/menu/get?access_token={$this->access_token}";

        curl_setopt($this->ch,CURLOPT_URL,$url);//设置请求地址
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);//获取的信息以文件流的形式返回


        $json = curl_exec($this->ch);
        $arr=json_decode($json,1);

        echo "<pre>";
            var_dump($arr);
        echo "</pre>";
        //echo $json;
        //4.释放cURL
        curl_close($this->ch);
    }
    //删除上传的菜单
    function delete_menu(){
        $url = " https://api.weixin.qq.com/cgi-bin/menu/delete?access_token={$this->access_token}";

        curl_setopt($this->ch,CURLOPT_URL,$url);//设置请求地址
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);//获取的信息以文件流的形式返回

        $json = curl_exec($this->ch);

        echo $json;
        //4.释放cURL
        curl_close($this->ch);
    }
}

$menu=new wx_menu();
echo $menu->get_acToken();
$menu->set_menu();
//$menu->show_menu();
	

	

?>