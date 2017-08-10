<?php
namespace app\api\controller;
use think\Controller;
use think\Db;
use think\View;
class Pendingpayment extends controller {
    function    index(){
         if(request()->isPost()){
          $uid=$_POST['uid'];
          $info=DB::table('mariah_wxpay')->where(array('status'=>'0','uid'=> $uid))->select();
          if($info){
              echo json_encode($info);
          }
         }
    }
    
    
    function  pendingpay(){
        if(request()->isPost()){
          require __DIR__.'/WechatAppPay.class.php';
        $weixinPay = new WechatAppPay();
        $para['body']=$_POST['body'];
        $para['out_trade_no']=$_POST['out_trade_no'];
        $para['total_fee']=$_POST['total_fee']*100;//分为单位
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
    
    }     
    }
 


    public   function   appointmentpay(){
         if(request()->isPost()){
          $uid=$_POST['uid'];
          $info=DB::table('mariah_money_detail')->where('uid',$uid)->select();
          if($info){
              echo json_encode($info);
          }
         }
    }
    
    //已付款订单
        public   function  pay(){
         if(request()->isPost()){
          $uid=$_POST['uid'];
          $info=DB::table('mariah_balance_money')->where('uid',$uid)->select();
          if($info){
              echo json_encode($info);
          }
         }
    }
    
    //取消预约退款后台审核
    public    function   tuikuan(){
           $arr['err']='正在申请';
           if(request()->isPost()){
           $info = Db::table("mariah_money_detail")->where('out_trade_no',$_POST['out_trade_no'])->find();
           if ($info['status'] == 0) {
                $data = array(
                    'status'=>1,
                );
        $list= Db::table("mariah_money_detail")->where('out_trade_no',$_POST['out_trade_no'])->update($data);
      if($list){
           $array = Db::table("mariah_money_detail")->where('out_trade_no',$_POST['out_trade_no'])->field('status')->find();
           echo json_encode($array);
      }
        }  else {
            echo json_encode($arr);
        }
        
         
     }
    }
}
