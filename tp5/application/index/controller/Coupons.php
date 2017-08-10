<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;
use think\paginator;


// use Think;
//  extends controller
class Coupons extends Base{
    function show_spread(){
        $arr_code=Db::table('mariah_spread_code')->where('user_id',$_GET['id'])->find();

        if(empty($arr_code)){
        	$spread_code=$this->createCode($_GET['id']);
        	$info=Db::table('mariah_spread_code')->insert(['user_id'=>$_GET['id'],'spread_code'=>$spread_code]);
        	// var_dump($info);
        }else{

        	$spread_code=$arr_code['spread_code'];
        }
        $vi=new View();
        $vi->spread_code=$spread_code;
        return $vi->fetch();
        // var_dump($spread_code);

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

    //添加券码包
    function add_coupons(){
    	// var_dump($_POST);
    	$info=Db::table('mariah_discount_table')->insert($_POST);
    	// var_dump($info);
    	$this->t_f_jump($info,"","添加失败",url('index/coupons/show_discount'));
    }

    function add_pool(){
    	// var_dump($_POST);
    	$info=Db::table('mariah_discount_table')->where('id',$_POST['id'])->find();
    	// var_dump($info);
    	$this->generate_coupons($info['shop'],$info['item'],$info['id'],$_POST['generate_number']);
    	$count=Db::table('mariah_discount_pool')->where('pid',$_POST['id'])->where('got_user_id','0')->count();
    	$count2=Db::table('mariah_discount_pool')->where('pid',$_POST['id'])->count();
    	$info=Db::table('mariah_discount_table')->where('id',$_POST['id'])->update(['generate_number'=>$count,'total_num'=>$count2]);
    	$this->redirect(url('index/coupons/show_pool')."?id=".$_POST['id']);

    }
    //生成券码（店铺id,商品id,券码包id，生成数量）
    function generate_coupons($shop,$item,$id,$num){
    	if(!$shop){
    		$shop=-$id;
    	}
    	if(!$item){
    		$item=-$id;
    	}

    	//不需循环
        $shop_code=$this->createCode($shop,'108000',3,60);
        $item_code=$this->createCode($item,'106000',3,60);

        $i=0; 
        while ($i <$num) { 
			 //循环
        	$rand_num=rand(0,55*55*27);
        	$time_code=$this->createCode(time(),'0',3,55);
        	$random_code=$this->createCode($rand_num,'0',3,55);
        	$check_code=$this->createCode($rand_num*2,'10',3,55);
        	$discount_code=$shop_code.$item_code.$random_code.$time_code.$check_code;

        	$info=$this->sql_code_add($discount_code,$id);
        	// var_dump($info);
        	if($info){
        		$i++;
        	}

        }

       

    }

    function sql_code_add($code,$pid){
    	$exist=Db::table('mariah_discount_pool')->where('code',$code)->count();
    	// var_dump($exist);
    	if(!$exist){
    		return $info=Db::table('mariah_discount_pool')->insert(['code'=>$code,'pid'=>$pid]);
    	}
    }

    function delete_coupons(){
    	// var_dump($_GET);
    	$info=Db::table('mariah_discount_table')->where("id",$_GET['id'])->delete();
    	$info2=Db::table('mariah_discount_pool')->where("pid",$_GET['id'])->delete();
    	// var_dump($info."||".$info2);
    	$this->t_f_jump($info,"","删除失败",url('index/coupons/show_discount'));

    }

 

}
