<?php

namespace app\index\controller;

/**
 * Created by PhpStorm.
 * User: devin
 * Date: 15-5-2
 * Time: 下午9:24
 */
class WechatAppPay {

    public $appid; //开放平台appid
    public $mch_id;          //财付通商户号
    public $spbill_create_ip;
    public $notify_url;
    public $trade_type = 'APP';
    public $key;
    public $error = null;
    private $_config;

    const PREPAY_GATEWAY = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
    const QUERY_GATEWAY = 'https://api.mch.weixin.qq.com/pay/orderquery';

    public function __construct() {
        $this->appid = 'wx7217aeb11bbb655e';
        $this->mch_id = '1484264232';
        $this->spbill_create_ip = '127.0.0.1';
        $this->notify_url = 'https://www.test.com/index.php/index/wxpay/subLiveCourseNotifyUrl';
        $this->key = 'GC6P8QowJ5DxNpAhAvk8bX5hseitjhFj';
        $this->trade_type = 'APP';
    }

    public function getPrepayId($tradePara) {

        $data = array();
        $data['appid'] = $this->appid;
        $data['mch_id'] = $this->mch_id;
        $data['nonce_str'] = $this->getRandomStr();
        $data['spbill_create_ip'] = $this->spbill_create_ip;
        $data['notify_url'] = $this->notify_url;
        $data['trade_type'] = $this->trade_type;
        $data = array_merge($tradePara, $data);

        $data['sign'] = $this->sign($data);
        // dump($data);
        $result = $this->post(self::PREPAY_GATEWAY, $data);
        // dump($result);exit;
        if ($result['return_code'] == 'SUCCESS') {
            return $result['prepay_id'];
        } else {
            $this->error = $result['return_msg'];
            return null;
        }
    }

    public function post($url, $data) {
        //$data['sign'] = $this->sign($data);
        // dump($data);
        if (!function_exists('curl_init')) {
            throw new \Exception('Please enable php curl module!');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->array2xml($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);

        $content = curl_exec($ch);
        //  dump($content);
        $array = $this->xml2array($content);
        // dump($array);
        return $array;
    }

    /**
     * 	作用：按字典顺序格式化参数，把数组转换成 key=value&k=v 形式
     * @param $paraMap array 需要转换的数组
     * @param $urlencode bool 是否需要URL字符编码
     * @return string 
     */
    public function formatBizQueryParaMap($paraMap, $urlencode) {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v) {
            if ($urlencode) {
                $v = urlencode($v);
            }
            //$buff .= strtolower($k) . "=" . $v . "&";
            $buff .= $k . "=" . $v . "&";
        }
        if (strlen($buff) > 0) {
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        }
        return $reqPar;
    }

    public function sign($data) {
        foreach ($data as $k => $v) {
            $Parameters[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        ksort($Parameters);
        $String = $this->formatBizQueryParaMap($Parameters, false);
        //echo '【string1】'.$String.'</br>';
        //签名步骤二：在string后加入KEY
        // dump($String);
        $String = $String . "&key=" . $this->key;
        //echo "【string2】".$this->KEY."</br>";
        //签名步骤三：MD5加密
        // dump($String);
        $String = md5($String);
        //echo "【string3】 ".$String."</br>";
        //签名步骤四：所有字符转为大写
        //  dump($String);
        $sign = strtoupper($String);

        return $sign;
    }

    public function xml2array($xml) {
        $array = array();
        foreach ((array) simplexml_load_string($xml) as $k => $v) {
            $array[$k] = (string) $v;
        }
        return $array;
    }

    function array2xml($arr) {
        $xml = "<xml>";
        foreach ($arr as $key => $val) {
            if (is_numeric($val)) {
                $xml.="<" . $key . ">" . $val . "</" . $key . ">";
            } else
                $xml.="<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }
        $xml.="</xml>";
        //dump($xml);
        return $xml;
    }

    protected function getRandomStr() {
        return substr(rand(10, 999) . strrev(uniqid()), 0, 15);
    }

    public function getPayPara($prepayid) {

        try {
            $result = array(
                'appid' => $this->appid,
                'partnerid' => $this->mch_id,
                'prepayid' => $prepayid,
                'package' => 'Sign=WXPay',
                'noncestr' => $this->getRandomStr(),
                'timestamp' => time(),
            );
            $result['sign'] = $this->sign($result);
            return $result;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}
