<?php

namespace app\api\controller;

import('php_sdk.mns-autoloader', EXTEND_PATH);

use think\Controller;
use AliyunMNS\Client;
use AliyunMNS\Topic;
use AliyunMNS\Constants;
use AliyunMNS\Model\MailAttributes;
use AliyunMNS\Model\SmsAttributes;
use AliyunMNS\Model\BatchSmsAttributes;
use AliyunMNS\Model\MessageAttributes;
use AliyunMNS\Exception\MnsException;
use AliyunMNS\Requests\PublishMessageRequest;
use think\View;
use think\Db;

class Message extends controller {

    //发送验证码
    public function index() {
        /**
         * Step 1. 初始化Client
         */
        $data = array();
        $data['success'] = true;
        $ar = array();
        $ar['phone'] = '号码已存在';
        if (request()->isPost()) {

            $phone = $_POST['mobile'];


            //dump($phone);exit;
            for ($i = 0; $i < 6; $i++) {
                $arr[$i] = rand(0, 9);
            }

            $str = implode($arr);
            $array['tel'] = $phone;

            $array['code'] = $str;
            // dump($arr);exit;
            $befor = Db::table('mariah_user')->where('tel', $phone)->select();
            if (!$befor) {
                $message = Db::table('mariah_message')->where('tel', $phone)->select();
                if ($message) {
                    $list = Db::table('mariah_message')->where('tel', $phone)->update($array);
                } else {
                    // dump($arr);exit;
                    $info = Db::table("mariah_message")->insert($array);
                }
                $this->endPoint = "http://1599059114934273.mns.cn-hangzhou.aliyuncs.com/"; // eg. http://1234567890123456.mns.cn-shenzhen.aliyuncs.com
                $this->accessId = "LTAIBPzjrAhbdISO";
                $this->accessKey = "qD0akARRo0dPD8arrZmWqH6yHMgOlQ";
                $this->client = new Client($this->endPoint, $this->accessId, $this->accessKey);
                /**
                 * Step 2. 获取主题引用
                 */
                $topicName = "sms.topic-cn-hangzhou";
                $topic = $this->client->getTopicRef($topicName);
                /**
                 * Step 3. 生成SMS消息属性
                 */
                // 3.1 设置发送短信的签名（SMSSignName）和模板（SMSTemplateCode）
                $batchSmsAttributes = new BatchSmsAttributes("玛瑞娅", "SMS_75500001");
                // 3.2 （如果在短信模板中定义了参数）指定短信模板中对应参数的值
                $batchSmsAttributes->addReceiver($phone, array("code" => $str));


                $messageAttributes = new MessageAttributes(array($batchSmsAttributes));
                /**
                 * Step 4. 设置SMS消息体（必须）
                 *
                 * 注：目前暂时不支持消息内容为空，需要指定消息内容，不为空即可。
                 */
                $messageBody = "smsmessage";
                /**
                 * Step 5. 发布SMS消息
                 */
                $request = new PublishMessageRequest($messageBody, $messageAttributes);
                try {
                    $res = $topic->publishMessage($request);
                    echo $res->isSucceed();
                    echo $res->getMessageId();    
                } catch (MnsException $e) {
                    echo $e;
                    echo "\n";
                }
            } else {
                echo json_encode($ar);
            }
        }
    }

//用户手机注册
    public function register() {
        $data = array();
        $data['success'] = true;

        if (request()->isPost()) {

            $arr['tel'] = $_POST['phone'];

            $yanzhengs = $_POST['yanzheng'];
            //dump($yanzhengs);exit;
            $arr['password'] = md5($_POST['password']);

            //$inf = Db::table("mariah_yanzheng")->insert($arr);
            $list = Db::table('mariah_message')->where('tel', $arr['tel'])->select();
            if ($list) {
                foreach ($list as $key) {
                    $v = $list[0]['code'];
                }

                if ($yanzhengs == $v) {
                    // dump('123');exit;
                    $arr['status'] = '1';
                    $info = Db::table("mariah_user")->insert($arr);
                }
                if ($info) {
                    echo json_encode($data);
                }
            }
        }
    }

//忘记密码，发送短信
    public function forgetpassword() {
        $help['message'] = '发送成功';
        if (request()->isPost()) {
            for ($i = 0; $i < 6; $i++) {
                $array[$i] = rand(0, 9);
            }
            $str = implode($array);
            $arr['tel'] = $_POST['phone'];
            $arr['code'] = $str;

            $list = Db::table('mariah_user')->where('tel', $arr['tel'])->find();
            if ($list) {
                $info = Db::table('mariah_message')->where('tel', $arr['tel'])->find();
                if ($info) {
                    $this->endPoint = "http://1599059114934273.mns.cn-hangzhou.aliyuncs.com/"; // eg. http://1234567890123456.mns.cn-shenzhen.aliyuncs.com
                    $this->accessId = "LTAIBPzjrAhbdISO";
                    $this->accessKey = "qD0akARRo0dPD8arrZmWqH6yHMgOlQ";
                    $this->client = new Client($this->endPoint, $this->accessId, $this->accessKey);
                    /**
                     * Step 2. 获取主题引用
                     */
                    $topicName = "sms.topic-cn-hangzhou";
                    $topic = $this->client->getTopicRef($topicName);
                    /**
                     * Step 3. 生成SMS消息属性
                     */
                    // 3.1 设置发送短信的签名（SMSSignName）和模板（SMSTemplateCode）
                    $batchSmsAttributes = new BatchSmsAttributes("玛瑞娅", "SMS_75500001");
                    // 3.2 （如果在短信模板中定义了参数）指定短信模板中对应参数的值
                    $batchSmsAttributes->addReceiver($arr['tel'], array("code" => $str));


                    $messageAttributes = new MessageAttributes(array($batchSmsAttributes));
                    /**
                     * Step 4. 设置SMS消息体（必须）
                     *
                     * 注：目前暂时不支持消息内容为空，需要指定消息内容，不为空即可。
                     */
                    $messageBody = "smsmessage";
                    /**
                     * Step 5. 发布SMS消息
                     */
                    $request = new PublishMessageRequest($messageBody, $messageAttributes);
                    try {
                        $res = $topic->publishMessage($request);
                        echo $res->isSucceed();
                        echo "\n" . '88888888';
                        echo $res->getMessageId();
                        echo "\n" . '666666';
                    } catch (MnsException $e) {
                        echo $e;
                        echo "\n";
                    }
                    $app = Db::table('mariah_message')->where('tel', $arr['tel'])->update($arr);
                }if ($app) {
                    echo json_encode($help);
                }
            }
        }
    }

//忘记密码，验证验证码
    public function getforgetpassword() {
        $help['success'] = '验证成功';
        if (request()->isPost()) {
            $arr['tel'] = $_POST['phone'];
            $yanzhengs = $_POST['yanzheng'];
            //$inf = Db::table("mariah_yanzheng")->insert($arr);
            $list = Db::table('mariah_message')->where('tel', $arr['tel'])->find();


            if ($list) {
                foreach ($list as $key) {
                    $v = $list['code'];
                }

                if ($yanzhengs == $v) {
                    // dump('123');exit;
                    echo json_encode($help);
                }
            }
        }
    }

//忘记密码的修改密码
    public function forgetpassworddo() {
        $help['success'] = '修改成功';
        if (request()->isPost()) {
            $arr['tel'] = $_POST['phone'];
            $arr['password'] = md5($_POST['password']);
            $info = Db::table("mariah_user")->where('tel', $arr['tel'])->update($arr);
            if ($info) {
                echo json_encode($help);
            }
        }
    }

//用户手机登录
    public function login() {
        if (request()->isPost()) {
            $str['success'] = '登录成功';
            $arr['tel'] = $_POST['phone'];
            $arr['password'] = md5($_POST['password']);

            $list = Db::table('mariah_user')->where('tel', $arr['tel'])->find();
            if ($list) {
                $list['username'] = json_decode($list['username']);
                if ($arr['password'] == $list['password']) {
                    echo json_encode($str);
                } else {
                    $str['success'] = '登录失败';
                    echo json_encode($str);
                }
            } else {
                $str['success'] = '用户不存在';
                echo json_encode($str);
            }
        }
    }

    //修改密码
    public function changepassword() {
        $help['success'] = '修改成功';
        if (request()->isPost()) {
            $arr['tel'] = $_POST['phone'];
            $arr['password'] = md5($_POST['password']);
            $data['password'] = md5($_POST['newpassword']);
            $list = Db::table('mariah_user')->where('tel', $arr['tel'])->find();
            if ($arr['password'] == $list['password']) {
                $info = Db::table('mariah_user')->where('tel', $arr['tel'])->update($data);
            }
            if ($info) {
                echo json_encode($help);
            }
        }
    }

    public function phonecode() {
        $data['success'] = true;
        $ar = array();

        if (request()->isPost()) {

            $phone = $_POST['phone'];


            //dump($phone);exit;
            for ($i = 0; $i < 6; $i++) {
                $arr[$i] = rand(0, 9);
            }

            $str = implode($arr);
            $array['tel'] = $phone;

            $array['code'] = $str;

            $befor = Db::table('mariah_user')->where('tel', $phone)->select();
            if ($befor) {

                $message = Db::table('mariah_message')->where('tel', $phone)->select();
                if ($message) {

                    $list = Db::table('mariah_message')->where('tel', $phone)->update($array);
                }
                $this->endPoint = "http://1599059114934273.mns.cn-hangzhou.aliyuncs.com/"; // eg. http://1234567890123456.mns.cn-shenzhen.aliyuncs.com
                $this->accessId = "LTAIBPzjrAhbdISO";
                $this->accessKey = "qD0akARRo0dPD8arrZmWqH6yHMgOlQ";
                $this->client = new Client($this->endPoint, $this->accessId, $this->accessKey);
                /**
                 * Step 2. 获取主题引用
                 */
                $topicName = "sms.topic-cn-hangzhou";
                $topic = $this->client->getTopicRef($topicName);
                /**
                 * Step 3. 生成SMS消息属性
                 */
                // 3.1 设置发送短信的签名（SMSSignName）和模板（SMSTemplateCode）
                $batchSmsAttributes = new BatchSmsAttributes("玛瑞娅", "SMS_75500001");

                // 3.2 （如果在短信模板中定义了参数）指定短信模板中对应参数的值
                $batchSmsAttributes->addReceiver($phone, array("code" => $str));


                $messageAttributes = new MessageAttributes(array($batchSmsAttributes));
                /**
                 * Step 4. 设置SMS消息体（必须）
                 *
                 * 注：目前暂时不支持消息内容为空，需要指定消息内容，不为空即可。
                 */
                $messageBody = "smsmessage";
                /**
                 * Step 5. 发布SMS消息
                 */
                $request = new PublishMessageRequest($messageBody, $messageAttributes);
                try {
                    $res = $topic->publishMessage($request);
                    echo $res->isSucceed();
                    echo "\n" . '88888888';
                    echo $res->getMessageId();
                    echo "\n" . '666666';
                    echo json_encode($data);
                } catch (MnsException $e) {
                    echo $e;
                    echo "\n";
                }
            }
        }
    }

    public function phone() {
        $vv['success'] = '修改成功';
        $ar['phone'] = '号码已存在';
        if (request()->isPost()) {
            $arr['tel'] = $_POST['phone'];
            $arr['mobile'] = $_POST['mobile'];
            $hello['tel'] = $arr['mobile'];
            $yanzhengs = $_POST['yanzheng'];

            $list = Db::table('mariah_message')->where('tel', $arr['tel'])->find();
            if ($list) {

                foreach ($list as $key) {
                    $v = $list['code'];
                }
                if ($yanzhengs == $v) {

                    $data = Db::table('mariah_user')->where('tel', $arr['mobile'])->find();
                    if (!$data) {

                        $user = Db::table('mariah_user')->where('tel', $arr['tel'])->update($hello);
                        if ($user) {
                            echo json_encode($vv);
                        }
                    } else {
                        echo json_encode($ar);
                    }
                }
            }
        }
    }

}

?>