<?php 

	//PHP curl函数模拟GET请求
	//1.初始化
class wx_menu{
    public $ch;
    public $access_token;
    private $appid="wxf7194c23a658275b";
    private $secret="80fff401142a264b0fd86f7dc35f6fb0";
    private $url="";
    function __construct(){
    	// $this->ch = curl_init();
        $this->access_token=$this->get_acToken();
    }
	
    //url转换设置
    function url_set($url){
        return urlencode($url);
    }

//从微信获取token码
    //在本地获取token如果存在并且时间未超过7200秒，则使用本地的，反之，则从微信获取并存在本地
    function get_acToken(){
        $sql=new sqlHelper();
        $sql->settable('wx_token');
        $res=$sql->where("token_type='menu'")->select();

        
        // var_dump($res[0]);
        // echo "</br>";
        if(empty($res[0])){
            $res[0]=$this->get_acToken_online();
            $res[0]['save_time']=time();
            $res[0]['token_type']="menu";
            $sql->add($res[0]);
            
        }else{
            $time=$res[0]['save_time']+$res[0]['expires_in'];
            // echo "</br>";
            $nowtime=time();
            $intime=$time>=$nowtime?true:false;

            if($intime){
            }else{
                $res[0]=$this->get_acToken_online();
                $res[0]['save_time']=$nowtime;
                $res[0]['token_type']="menu";
                $res[0]['id']=1;
                $err=$sql->update($res[0]);
                // var_dump($err);
                // echo $sql->getlastsql();
                // var_dump($res[0]);
            // var_dump($intime);
            }
        }
        // //echo "<pre>";var_dump($arr);echo "</pre>";
        return $res[0]['access_token'];
        // return $res;
    }

    function curl_do_get($url){
        $this->ch = curl_init();
        curl_setopt($this->ch,CURLOPT_URL,$url);//设置请求地址
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);//获取的信息以文件流的形式返回

        //调整ssl设置
        curl_setopt($this->ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        //输出错误
        // var_dump(curl_error($this->ch));
        $json = curl_exec($this->ch);
        curl_close($this->ch);
        $res=json_decode($json,true);
        return $res;
    }

    function curl_do_post($url,$post){
        $this->ch = curl_init();
        curl_setopt($this->ch,CURLOPT_URL,$url);//设置请求地址
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,1);//获取的信息以文件流的形式返回
        curl_setopt($this->ch,CURLOPT_POST,1);//post请求

        //调整ssl设置
        curl_setopt($this->ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        
        //请求post数据
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $post);      
        //输出错误
        // var_dump(curl_error($this->ch));
        $json = curl_exec($this->ch);
        curl_close($this->ch);
        $res=json_decode($json,true);
        return $res;
    }

    function get_acToken_online(){   
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxf7194c23a658275b&secret=80fff401142a264b0fd86f7dc35f6fb0";

        
        $res=$this->curl_do_get($url);
        // var_dump($json);
        // var_dump($res);
        return $res;
    }

    //设置菜单
    function set_menu(){
    	$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$this->access_token}";
        $userurl="";
        $post = '
            {
                "button":[
                    {
                    	"name":"事件",
                        "sub_button":[
                            {
                            "type":"click",
                       		"name":"太原天气",
                        	"key":"weather"
                            },
                            {
                            "type":"click",
                       		"name":"主机名",
                        	"key":"name"
                            },
                            {
                            "type":"click",
                       		"name":"时间戳",
                        	"key":"time"
                            }]
                    },
                    {
                        "name":"微官网",
                        "sub_button":[
                            {
                            "type":"view",
                            "name":"微官网(原值)",
                            "url":"http://www.gweixin.top/"
                            },
                            {
                            "type":"view",
                            "name":"userinfo",
                            "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->appid.'&redirect_uri='.$this->url_set('http://www.gweixin.top/index.php?m=weixin&c=Index&v=weixin_userinfo').'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect"
                            },
                            {
                            "type":"view",
                            "name":"微官网(跳)",
                            "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->appid.'&redirect_uri='.$this->url_set('http://www.gweixin.top/index.php?m=Index&c=Index&v=index').'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect"
                            }]
                    },
                    {
                    	  "name":"发图",
                          "sub_button": [
                        {
                            "type": "pic_sysphoto", 
                            "name": "系统拍照发图", 
                            "key": "rselfmenu_1_0", 
                           "sub_button": [ ]
                         }, 
                        {
                            "type": "pic_photo_or_album", 
                            "name": "拍照或者相册发图", 
                            "key": "rselfmenu_1_1", 
                            "sub_button": [ ]
                        }, 
                        {
                            "type": "pic_weixin", 
                            "name": "微信相册发图", 
                            "key": "rselfmenu_1_2", 
                            "sub_button": [ ]
                        	}]
                    }]
            }';//一个一级菜单-->下面可以有三个子菜单
        
        $res=$this->curl_do_post($url,$post);

        echo "<pre>";
            var_dump($res);
        echo "</pre>";
        //4.释放cURL
        // curl_close($this->ch);
    
    }
    //显示上传的菜单
    function show_menu(){

        $url = "https://api.weixin.qq.com/cgi-bin/menu/get?access_token={$this->access_token}";

        $res=$this->curl_do_get($url);
        echo "<pre>";
            var_dump($res);
        echo "</pre>";

    }
    //删除上传的菜单
    function delete_menu(){
        $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token={$this->access_token}";

        $res=$this->curl_do_get($url);

        echo "<pre>";
            var_dump($res);
        echo "</pre>";
    }
    //获取用户信息
    function show_user_info($openid){

        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$this->access_token}&openid={$openid}&lang=zh_CN";

        $arr=$this->curl_do_get($url);

        return $arr;
    }
}

//$menu=new wx_menu();
//$menu->show_user_info();
//echo $menu->get_acToken();
//$menu->set_menu();
//$menu->show_menu();
	

	

?>