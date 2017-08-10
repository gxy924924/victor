<?php 

	//获取userinfo专用
	//1.初始化
class wx_web{
    public $ch;
    public $access_token;
    private $appid="wxf7194c23a658275b";
    private $secret="80fff401142a264b0fd86f7dc35f6fb0";
    private $url="";
    private $openid="";
    function __construct($code){
        $this->get_openid($code);
        
    }

    function get_openid($code){
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->appid."&secret=".$this->secret."&code=".$code."&grant_type=authorization_code";
        $res=$this->curl_do_get($url);
        if (!empty($res['openid'])) {
            $this->openid=$res['openid'];
            $this->access_token=$res['access_token'];
        }
        

    }

    function get_userinfo(){
        $sql=new sqlHelper();
        $sql->settable('wx_userinfo');
        $res=$sql->where("openid='".$this->openid."'")->select();

        if(empty($res[0])){
            $res[0]=$this->get_userinfo_online();
            $res[0]['sql_return']=$sql->add($res[0]);
            return $res[0];
        }else{
            return $res[0];
        }

    }

    function get_userinfo_online(){
        $url="https://api.weixin.qq.com/sns/userinfo?access_token=".$this->access_token."&openid=".$this->openid."&lang=zh_CN";
        return $res=$this->curl_do_get($url);
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



}

?>
