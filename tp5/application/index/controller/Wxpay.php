<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\View;
class Wxpay extends controller {
  //生成订单
     public  function  index(){
         
        if(request()->isPost()){
        
            if(empty($_POST['openid'])){
               $tel=$_POST['phone'];
               $list= Db::table("mariah_user")->where('tel',$tel)->field('id')->find(); 
              
            }
            if(empty($_POST['phone'])){
            $openid=$_POST['openid'];
                $list= Db::table("mariah_user")->where('openid',$openid)->field('id')->find(); 
            }
            $out_trade_no=date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $data=array(
	    'body'  =>$_POST['body'],
	    'out_trade_no'  =>$out_trade_no,
            'total_fee'  =>$_POST['total_fee'],
            'uid'=>$list['id'],
            'status'=>'0',
            'creatime'=>date("YmdHis")
	    ); 
           
         $info = Db::table("mariah_wxpay")->insert($data);
         //import('WechatAppPay',EXTEND_PATH);
        require __DIR__.'/WechatAppPay.class.php';
        $weixinPay = new WechatAppPay();
        $para['body']=$data['body'];
        $para['out_trade_no']=$out_trade_no;
        $para['total_fee']=$data['total_fee'];//分为单位
        $notify_type = 'sub_live_course';
        try{
            $prepayId = $weixinPay->getPrepayId($para,$notify_type);
            
        }catch(Exception $e){
            $cache = array('errno' => '020', 'errmsg' => '异常了', 'result' => "");
            echo json_encode($cache);
            exit;
        }
        // $payPara这个是需要传给客户端的参数（数组）
        $payPara = $weixinPay->getPayPara($prepayId);
        $payPara['pay_id'] = $para['out_trade_no'];
        if ($info > 0) {
            $cache = array('errno' => '000', 'errmsg' => '', 'result' => $payPara);
            echo json_encode($cache);
        } else {
            $cache = array('errno' => '010', 'errmsg' => '出错了', 'result' => '');
            echo json_encode($cache);
        }
    
    }      return  view('index');    
    }
	/**
     * 微信支付回调地址
     */
    public function subLiveCourseNotifyUrl(){
       
       // $data = $GLOBALS['HTTP_RAW_POST_DATA'];
        $resp = simplexml_load_string($data);
        $item = (array)$resp;
        $result_code = (string)$resp->result_code;
        
        //商户订单号
        $notes['is_subscribe'] = (string)$resp->is_subscribe;
        $notes['out_trade_no'] = (string)$resp->out_trade_no;
        $notes['trade_status'] = (string)$resp->result_code;
        $notes['time_end'] = (string)$resp->time_end;
        $notes['total_fee'] = (intval($resp->total_fee)) / 100;
        $notes['trade_type'] = (string)$resp->trade_type;
        $notes['transaction_id'] = (string)$resp->transaction_id;

        if ('SUCCESS' == $result_code){
            $tradeNo = (string)$resp->out_trade_no;
            $info = Db::table("mariah_wxpay")->where('out_trade_no',$tradeNo)->find();
              if ($info['status'] == 0) {
                $data = array(
                    'status'=>1,
                    'changetime'=>date('Y-m-d H:i:s', mktime())
                );
             $result = Db::table("mariah_wxpay")->where('out_trade_no',$tradeNo)->save($data);
            } 
        } else {
            return "找不到订单";
        }
     
        $result = '<xml>'.
            '<return_code><![CDATA[SUCCESS]]></return_code>'.
            '<return_msg><![CDATA[OK]]></return_msg>'.
            '</xml>';
        $this->ajaxReturn($result,'EVAL');
    }


}



