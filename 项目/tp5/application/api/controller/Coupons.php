<?php
namespace app\api\controller;

use think\Controller;
use think\Db;
use think\View;
use think\paginator;


// use Think;
//  extends controller
class Coupons{
    //显示推广码
    //index.php/api/coupons/show_spread    post:id=>用户id     info:spread_code=>推广码
    function show_spread(){
        $id=$_POST['id'];
        // $id=$_GET['id'];
        //获取邀请码
        $arr_code=Db::table('mariah_spread_code')->where('user_id',$id)->find();
        if(empty($arr_code)){
        	$spread_code=$this->createCode($id);
        	$info=Db::table('mariah_spread_code')->insert(['user_id'=>$id,'spread_code'=>$spread_code]);
        	// var_dump($info);
        }else{
        	$spread_code=$arr_code['spread_code'];
        }
        //邀请过得好友
        $api_info['friend']=Db::table('mariah_user')->field('id,openid,username,headimgurl')->where('parentid1',$id)->select();
        $api_info['spread_code']=$spread_code;
        $this->log_helper(['get_id'=>$id],$api_info);
        $api_info=json_encode($api_info);
        return $api_info;
    }

    //检查是否已填写过邀请码
    function spread_check(){
        $id=$_POST['id'];
        $id_info=Db::table('mariah_user')->where('id',$id)->find();
        if(empty($id_info['parentid1'])){
            $api_info['res']=0;
        }else{
            $p_id_info=Db::table('mariah_user')->where('id',$id_info['parentid1'])->find();
            $api_info['res']=$p_id_info['username'];
        }
        $this->log_helper(['id'=>$id],$api_info);
        $api_info=json_encode($api_info);
        return $api_info;
    }

    //填写推广码
    function input_spread(){
        $id=$_POST['id'];
        $sp_code=$_POST['spread_code'];
        $p_id=Db::table('mariah_spread_code')->where('spread_code',$sp_code)->find();
        $coupons="";
        $api_info['res']='0';
        if(!empty($p_id['user_id'])&&$id!=$p_id['user_id']){
            $p_id=$p_id['user_id'];
            $p_id_info=Db::table('mariah_user')->where('id',$p_id)->find();
            if(!empty($p_id_info['id'])){
                $id_info=Db::table('mariah_user')->where('id',$id)->find();
                if(empty($id_info['parentid1'])){
                    $update_arr['parentid1']=$p_id_info['id'];
                    $update_arr['parentid2']=$p_id_info['parentid1'];
                    $update_arr['parentid3']=$p_id_info['parentid2'];
                    $api_info['res']=Db::table('mariah_user')->where('id',$id)->update($update_arr);
                    if(!empty($api_info['res'])){
                        $coupons=$this->generate_coupons();
                        $this->sql_code_add($coupons,1,$id);
                    }
                }
            }
        }
        
        $this->log_helper(['id'=>$id],$api_info);
        $api_info=json_encode($api_info);
        return $api_info;


        // echo "<pre>";
        // var_dump($res);
        // echo "</pre>";
    }

    //获取优惠券
    function get_coupons(){
        $id=$_POST['id'];
        $res=Db::table('mariah_discount_pool a')->join('mariah_discount_table b on a','a.pid=b.id','left')->field('a.id,a.pid,b.time_start,b.time_stop,b.price_premise,b.discount,b.shop,b.item')->where('a.got_user_id',$id)->select();
        $api_info[0]="";
        foreach ($res as $key => $val) {
            $arr['id']=$val['id'];
            $arr['pid']=$val['pid'];
            $arr['price_premise']=$val['price_premise'];
            $arr['discount']=$val['discount'];
            if($val['time_start']!="0000-00-00 00:00:00"){
                $time_stamp=strtotime($val['time_start']);
                $val['time_start']=date('Y-m-d',$time_stamp);
            }
            if($val['time_stop']!="0000-00-00 00:00:00"){
                $time_stamp=strtotime($val['time_stop'])-1;
                $val['time_stop']=date('Y-m-d',$time_stamp);
            }

            if($val['time_start']=="0000-00-00 00:00:00"&&$val['time_stop']=="0000-00-00 00:00:00"){
                $time="不限时间";
            }else if($val['time_start']=="0000-00-00 00:00:00"){
                $time=$val['time_stop']."之后";
            }else if($val['time_stop']=="0000-00-00 00:00:00"){
                $time=$val['time_start']."之前";
            }else{
                $time=$val['time_start'].'~'.$val['time_stop'];
            }
            $arr['time']=$time;
            
            if(empty($val['shop'])){
                $arr['shop']=$val['shop'];
            }else{
                $shop_info=Db::table('mariah_shopstore')->field('shopname')->where('id',$val['shop'])->find();
                $arr['shop']=$shop_info['shopname'];
            }
            if(empty($val['item'])){
                $arr['item']=$val['item'];
            }else{
                $item_info=Db::table('mariah_production')->field('production')->where('id',$val['item'])->find();
                $arr['item']=$item_info['production'];
            }
            $api_info[$key]=$arr;
        }
        $this->log_helper(['id'=>$id],$api_info);
        $api_info=json_encode($api_info);
        // return $api_info;
        // var_dump($res) ;
        $str="aaa";
        return $str;
    }

    //添加一条券码
    function sql_code_add($code,$pid,$user_id){
        $exist=Db::table('mariah_discount_pool')->where('code',$code)->count();
        // var_dump($exist);
        if(!$exist){
            $res=Db::table('mariah_discount_pool')->insert(['code'=>$code,'pid'=>$pid,'got_user_id'=>$user_id]);
            $info=Db::table('mariah_discount_table')->where('id',1)->find();
            $res2=Db::table('mariah_discount_table')->where('id',1)->update(['total_num'=>$info['total_num']+1]);
        }
    }

    //生成券码（店铺id,商品id,券码包id，生成数量）
    function generate_coupons($shop=0,$item=0){
        //不需循环
        $shop_code=$this->createCode($shop,'108000',3,60);
        $item_code=$this->createCode($item,'106000',3,60);

        $rand_num=rand(0,55*55*27);
        $time_code=$this->createCode(time(),'0',3,55);
        $random_code=$this->createCode($rand_num,'0',3,55);
        $check_code=$this->createCode($rand_num*2,'10',3,55);
        $discount_code=$shop_code.$item_code.$random_code.$time_code.$check_code;
        return $discount_code;
        
    }

    //查看用

      //创建加密码(源码，附加码，码最小长度，分割量)
    function createCode($userId,$add_num=50000,$length=5,$sep_num=35)  
    {  
        static $sourceString = [  
        0,1,2,3,4,5,6,7,8,9,  
        'a','b','c','d','e','f',  
        'g','h','i','j','k','l',  
        'm','n','p','q','r',  
        's','t','u','v','w','x',  
        'y','z',  
        'A','B','C','D','E','F',  
        'G','H','I','J','K','L',  
        'M','N','P','Q','R',  
        'S','T','U','V','W','X',  
        'Y','Z'
        ];  

        $num = $userId+$add_num;  
        $code = '';  
        while($num)  
        {  
            $mod = $num % $sep_num;  
            $num = (int)($num / $sep_num);  
            $code = "{$sourceString[$mod]}{$code}";  
        }  

    //判断code的长度  
        if( empty($code[$length-1])){
            $code=str_pad($code,$length,'0',STR_PAD_LEFT);  
        }
            

        return $code;  
    } 

    //反向解密加密码
    function get_decode($str,$add_num=50000,$sep_num=35){
        $arr=str_split($str);
        
        static $sourceString = [  
        '0','1','2','3','4','5','6','7','8','9',  
        'a','b','c','d','e','f',  
        'g','h','i','j','k','l',  
        'm','n','p','q','r',  
        's','t','u','v','w','x',  
        'y','z',  
        'A','B','C','D','E','F',  
        'G','H','I','J','K','L',  
        'M','N','P','Q','R',  
        'S','T','U','V','W','X',  
        'Y','Z'
        ];
        foreach (array_reverse($arr) as $key=>$val) {
            $key_num=$this->my_array_search($val, $sourceString);
            $arr[$key]=$key_num;
        }
        $total_value=0-$add_num;
        foreach ($arr as $key => $val) {
            $pow=pow($sep_num,$key);
            $total_value+=$val*$pow;
        }
        return $total_value;
    }

    //显示折扣券包
    function show_discount(){
    	$vi=new View();
    	$vi->shop=Db::table('mariah_shopstore')->select();
    	$vi->production=Db::table('mariah_production')->select();
    	$vi->discount=Db::table('mariah_discount_table a')->join("mariah_shopstore b","a.shop=b.id","left")->join("mariah_production c","a.item=c.id","left")->field("a.*,b.shopname,c.production")->select();
        return $vi->fetch();
    }

    //显示折扣券码池
    function show_pool(){
    	$vi=new View();
    	// $vi->code=Db::table('mariah_discount_pool')->where('pid',$_GET['id'])->page(1,20)->select();
    	$vi->page_list=Db::table('mariah_discount_pool')->where('pid',$_GET['id'])->paginate(20);
        return $vi->fetch();
    }

    //客户获取一条折扣码
    function get_one_coupon(){
    	$info=Db::table('mariah_discount_pool')->field("code")->where("pid",$_GET['id'])->where('got_user_id',$_GET['user_id'])->find();
    	if(count($info)){
    		return $info['code'];
    	}else{
    		$info1=Db::table('mariah_discount_pool')->where("pid",$_GET['id'])->where('got_user_id','0')->find();
    		$info=Db::table('mariah_discount_pool')->where('id',$info1['id'])->update(['got_user_id'=>$_GET['user_id']]);
    		$num=Db::table('mariah_discount_table')->field('generate_number')->where('id',$_GET['id'])->find();
    		$info3=Db::table('mariah_discount_table')->where("id",$_GET['id'])->update(['generate_number'=>$num['generate_number']-1]);
    		return $info1['code'];
    	}
    }

    function log_helper($input="",$output=""){
        $file='my_test_log.txt';
        if(!empty($input)){
            $arr['input']=$input;
            $arr['output']=$output;
            $str=json_encode($arr);
            file_put_contents($file, $str);
        }else{
            if(is_file($file)){
                $info=file_get_contents($file);
                $info=json_decode($info,1);
                echo "<pre>";
                var_dump($info);
                echo "</pre>";
            }
        }
    }

 



    function test(){
        $this->log_helper();
        $vi=new View();
        return $vi->fetch();
        
    }

 

}
