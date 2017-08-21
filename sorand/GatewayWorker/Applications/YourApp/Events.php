<?php

use \GatewayWorker\Lib\Gateway;

class Events{

    // public static function onConnect($client_id) {
    //     // 向当前client_id发送数据 
    //     Gateway::sendToClient($client_id, "Hello $client_id\n");
    //     // 向所有人发送
    //     Gateway::sendToAll("$client_id login\n");
    // }
    
    public static function onConnect($client_id) {
        Gateway::sendToClient($client_id, json_encode(array(
            'type'      => 'init',
            'client_id' => $client_id
        )));
    }

   /**
    * 当客户端发来消息时触发
    * @param int $client_id 连接id
    * @param mixed $message 具体消息
    */
   public static function onMessage($client_id, $message) {
        // 向所有人发送 
        Gateway::sendToAll("$client_id said $message");
   }
   
   /**
    * 当用户断开连接时触发
    * @param int $client_id 连接id
    */
   public static function onClose($client_id) {
       // 向所有人发送 
     //  GateWay::sendToAll("$client_id logout");
   }
}
