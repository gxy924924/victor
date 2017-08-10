<?php
namespace app\api\controller;
use think\Controller;
use think\Db;
use think\View;
use  think\log;
class Pendingpayment extends controller {
    //待付款查询
    public function index() {
        if (request()->isPost()) {
            $uid = $_POST['uid'];
            $info = DB::table('mariah_wxpay')->where(array('status' => '0', 'uid' => $uid))->select();
            if ($info) {
                echo json_encode($info);
            }
        }
    }
    
    //生成假订单后，待付款继续付款
    public function pendingpay() {
          
            if(request()->isPost()){
                $id=$_POST['id'];
               $arr['out_trade_no']=date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
               $info = DB::table('mariah_wxpay')->where('id', $id)->update($arr);
                $help = DB::table('mariah_wxpay')->where('id', $id)->find();
                require __DIR__.'/WechatAppPay.class.php';
        $weixinPay = new WechatAppPay();
        $para['body']=$help['body'];
        $para['out_trade_no']=$arr['out_trade_no'];
        $para['total_fee']=$help['total_fee']*100;//分为单位
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
  
        //已预约查询
    public function appointmentpay() {
        if (request()->isPost()) {
            $uid = $_POST['uid'];
            $info = DB::table('mariah_money_detail')->where('uid', $uid)->select();
            if ($info) {
                echo json_encode($info);
            }
        }
    }
    //已付款订单
    public function pay() {
        if (request()->isPost()) {
            $uid = $_POST['uid'];
            $info = DB::table('mariah_balance_money')->where('uid', $uid)->select();
            if ($info) {
                echo json_encode($info);
            }
        }
    }
    //取消预约退款后台审核
    public function tuikuan() {
        $arr['err'] = '正在申请';
        if (request()->isPost()) {
            $info = Db::table("mariah_money_detail")->where('out_trade_no', $_POST['out_trade_no'])->find();
            if ($info['status'] == 0) {
                $data = array('status' => 1,);
                $list = Db::table("mariah_money_detail")->where('out_trade_no', $_POST['out_trade_no'])->update($data);
                if ($list) {
                    $array = Db::table("mariah_money_detail")->where('out_trade_no', $_POST['out_trade_no'])->field('status')->find();
                    echo json_encode($array);
                }
            } else {
                echo json_encode($arr);
            }
        }
    }
    
    //尾款付款后删除预约单
    public   function   del(){
        $arr['success']='删除成功';
        if(request()->isPost()){
            $info = Db::table("mariah_money_detail")->where('out_trade_no', $_POST['out_trade_no'])->delete();
          if($info){
              echo json_encode($arr);
          }  
        }
        
    }
}
