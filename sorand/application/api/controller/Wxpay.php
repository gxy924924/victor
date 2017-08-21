<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use think\View;
use think\log;

class Wxpay extends controller {

    //生成订单
    public function index() {

        if (request()->isPost()) {

            if (empty($_POST['openid'])) {
                $tel = $_POST['phone'];
                $list = Db::table("mariah_user")->where('tel', $tel)->field('id')->find();
            }
            if (empty($_POST['phone'])) {
                $openid = $_POST['openid'];
                $list = Db::table("mariah_user")->where('openid', $openid)->field('id')->find();
            }

            $out_trade_no = date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $data = array(
                'body' => $_POST['body'],
                'out_trade_no' => $out_trade_no,
                'total_fee' => $_POST['total_fee'],
                'uid' => $list['id'],
                //  'pid'=>$_POST['pid'],
                'status' => '0',
                'creatime' => date("YmdHis"),
                'shopname' => $_POST['shopname'],
                'shopposition' => $_POST['shopposition'],
                'appointmenttime' => $_POST['appointmenttime'],
                'appointmentphone' => $_POST['appointmentphone'],
                'f_img' => $_POST['f_img'],
                'price' => $_POST['price'],
            );

            $info = Db::table("mariah_wxpay")->insert($data);
            //import('WechatAppPay',EXTEND_PATH);
            require __DIR__ . '/WechatAppPay.class.php';
            $weixinPay = new WechatAppPay();
            $para['body'] = $data['body'];
            $para['out_trade_no'] = $out_trade_no;
            $para['total_fee'] = $data['total_fee'] * 100; //分为单位
            $notify_type = 'sub_live_course';
            try {
                $prepayId = $weixinPay->getPrepayId($para, $notify_type);
            } catch (Exception $e) {
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

    /**
     * 微信支付回调地址
     */
    public function subLiveCourseNotifyUrl() {
        $data = file_get_contents('php://input');
        Log::record($data);
        $resp = simplexml_load_string($data);
        Log::record($resp);
        $item = (array) $resp;


        //商户订单号
        $notes['is_subscribe'] = (string) $resp->is_subscribe;
        $notes['out_trade_no'] = (string) $resp->out_trade_no;
        $notes['trade_status'] = (string) $resp->result_code;
        $notes['time_end'] = (string) $resp->time_end;
        $notes['total_fee'] = (intval($resp->total_fee));
        $notes['trade_type'] = (string) $resp->trade_type;
        $notes['transaction_id'] = (string) $resp->transaction_id;
        Log::record($notes);
        if ('SUCCESS' == $notes['trade_status']) {
            $tradeNo = (string) $resp->out_trade_no;
            $info = Db::table("mariah_wxpay")->where('out_trade_no', $tradeNo)->find();
            log::record($info);
            if ($info['status'] == 0) {
                $data = array(
                    'status' => 1,
                    'changetime' => date("YmdHis")
                );
                try {
                    $trade = Db::table("mariah_wxpay")->where('out_trade_no', $tradeNo)->update($data);
                    $wxpay = Db::table("mariah_wxpay")->where('out_trade_no', $tradeNo)->find();
                    log::record($trade);
                    $arr['out_trade_no'] = $notes['out_trade_no'];
                    $arr['uid'] = $info['uid'];
                    $arr['money'] = $info['total_fee'];
                    $arr['body'] = $info['body'];
                    $arr['type'] = $notes['trade_type'];
                    $arr['shopname'] = $wxpay['shopname'];
                    $arr['shopposition'] = $wxpay['shopposition'];
                    $arr['appointmenttime'] = $wxpay['appointmenttime'];
                    $arr['appointmentphone'] = $wxpay['appointmentphone'];
                    //  $arr['pid']=$wxpay['pid'];
                    $arr['price'] = $wxpay['price'];
                    $arr['f_img'] = $wxpay['f_img'];
                    $arr['creatime'] = date("YmdHis");
                    $arr['status'] = '0';

                    $list = Db::table("mariah_money_detail")->insert($arr);
                    log::record($list);
                } catch (\Exception $e) {
                    throw new \Exception($e->getMessage());
                }
            }
        } else {
            echo "找不到订单";
        }
    }

    //预约店铺查询店面
    public function appointment() {
        $list = Db::table("mariah_shopstore")->field('shopname')->select();
        echo json_encode($list);
    }

    //预约店铺相对应的地址
    public function appointmentPosition() {
        if (request()->isPost()) {
            $position = Db::table("mariah_shopstore")->where('shopname', $_POST['shopname'])->field('position')->select();
            for ($i = 0; $i < count($position); $i++) {
                $shopposition = $position[$i];
            }
            echo json_encode($shopposition);
        }
    }

    //删除未完成付款的预约
    public function delpay() {
        $del['success'] = '删除成功';
        if (request()->isPost()) {
            $order = $_POST['out_trade_no'];
            $info = Db::table('mariah_wxpay')->where('out_trade_no', $order)->delete();
            if ($info) {
                echo json_encode($del);
            }
        }
    }

}
