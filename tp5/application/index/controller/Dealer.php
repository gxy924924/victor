<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\View;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
*/
class Dealer extends Base {
	//用户管理
	public function one() {
		$appo_info = Db::table('mariah_user')->select();
                for($i=0;$i<count($appo_info);$i++){
                    $appo_info[$i]['username']= json_decode($appo_info[$i]['username']);
                    
                }
		$this->assign('appo_info', $appo_info);
		return view('one');
	}
	public function details() {
		$list = Db::table('mariah_user')->where("id", $_GET['id'])->select();
		$frist = Db::table('mariah_user')->where('parentid1', $_GET['id'])->select();
		$second = Db::table('mariah_user')->where('parentid2', $_GET['id'])->select();
		$three = Db::table('mariah_user')->where('parentid3', $_GET['id'])->select();
		$count = count($frist) + count($second) + count($three);
                  for($i=0;$i<count($list);$i++){
                    $list[$i]['username']= json_decode($list[$i]['username']);
                    
                }
            $list1=0;
            $list2=0;
            $list3=0;
            $info1=0;
            $info2=0;
            $info3=0;
           $yongjin = Db::table('mariah_commision')->field('commision1,commision2,commision3')->select();
	  $one = $yongjin[0]['commision1'];
	  $second = $yongjin[0]['commision2'];
	  $three = $yongjin[0]['commision3']; 
            
        $first=  Db::table('mariah_user')->where('parentid1',$_GET['id'])->field('id')->select();
        for($i=0;$i<count($first);$i++){
            
            $aa=$first[$i]['id'];
            $ary[]=Db::table('mariah_balance_money')->where('uid',$aa)->field('money')->select();
            if($ary[$i]){   
            $list1=$list1+$ary[$i][0]['money'];
           
            $info1=$info1+count($ary[$i]);
            }
        }
        
      
        $two=  Db::table('mariah_user')->where('parentid2',$_GET['id'])->field('id')->select();
        for($i=0;$i<count($two);$i++){
            $bb=$two[$i]['id'];
           // dump($bb);exit;
            $bry[]=Db::table('mariah_balance_money')->where('uid',$bb)->field('money')->select();
            if($bry[$i]){
          //  dump($bry);exit;    
            $list2=$list2+$bry[$i][0]['money'];
             $info2=$info2+count($bry[$i]);
            }
        }
        $third=  Db::table('mariah_user')->where('parentid3',$_GET['id'])->field('id')->select();
        for($i=0;$i<count($third);$i++){
            $cc=$third[$i]['id'];
            $cry[]=Db::table('mariah_balance_money')->where('uid',$cc)->field('money')->select();
           if($cry[$i]){
            $list3=$list3+$cry[$i][0]['money'];
              $info3=$info3+count($cry[$i]);
           }
        }
          $ticheng=$list1 * $one / 100+$list2 * $second / 100+$list3 * $three / 100;
          $money=$list1+$list2+$list3;  

          $order=$info1+$info2+$info3;  
          $shuliang=count($first)+count($two)+count($third);
	  $this->assign('ticheng', $ticheng);
          $this->assign('money', $money);
	  $this->assign('order', $order); 
          $this->assign('shuliang', $shuliang); 
           $this->assign('list', $list); 
	   return view('details');
	}
	//订单管理
	public function order() {
		$list = DB::table("mariah_balance_money a")->join('mariah_user b on  a','a.uid=b.id','left')->field('a.*,b.username,b.tel')->select();
                for($i=0;$i<count($list);$i++){
                    $list[$i]['username']=json_decode($list[$i]['username']);
                }
                $this->assign('list', $list);
		return view('order');
	}
	//佣金管理
	public function commision() {
		if (request()->isPost()) {
			$arr = $this->sql_arr_search("mariah_commision", $_POST);
			$info = Db::table("mariah_commision")->where('id', '1')->update($arr);
		}
		$list = Db::table('mariah_commision')->select();
		$this->assign('list', $list);
		return view('commision');
	}

	function get_spread_pid($code){
		if(empty($code)){
			return 0;
		}else{
			$arr_id=Db::table('mariah_spread_code')->where('spread_code',$code)->find();
			if(empty($arr_id['user_id'])){
				return 0;
			}else{
				return $pid=$arr_id['user_id'];
			}
		}
	}
	//添加订单
	public function addorder() {
		if (request()->isPost()) {
			$arr = $this->sql_arr_search("mariah_order", $_POST);
			$info = Db::table("mariah_order")->insert($arr);
			$uid = $_POST['uid'];
			$money = $_POST['money'];
			$list = Db::table('mariah_user')->where('id', $uid)->field('parentid1,parentid2,parentid3')->select();
			$yongjin = Db::table('mariah_commision')->field('commision1,commision2,commision3')->select();
			$first = $yongjin[0]['commision1'];
			$second = $yongjin[0]['commision2'];
			$three = $yongjin[0]['commision3'];
			//给一级代理抽成
			if (!empty($list[0]['parentid1'])) {
				$arry['uid'] = $list[0]['parentid1'];
				$arry['money'] = $money * $first / 100;
				$info = Db::table("mariah_orderlog")->insert($arry);
			}
			//给二级代理抽成
			if (!empty($list[0]['parentid2'])) {
				$arry['uid'] = $list[0]['parentid2'];
				$arry['money'] = $money * $second / 100;
				$info = Db::table("mariah_orderlog")->insert($arry);
			}
			//给二级代理抽成
			if (!empty($list[0]['parentid3'])) {
				$arry['uid'] = $list[0]['parentid3'];
				$arry['money'] = $money * $three / 100;
				$info = Db::table("mariah_orderlog")->insert($arry);
			}
			if ($info) {
				$this->redirect("index/dealer/order");
			} else {
				return "添加失败";
			}
		}
		return view('addorder');
	}
	//用户管理删除
	public function del() {
		$info = Db::table('mariah_user')->delete($_GET['id']);
		if ($info) {
			$this->redirect("index/dealer/one");
		}
	}
	//用户管理编辑
	public function edit() {
		if (request()->isPost()) {
			$arr = $this->sql_arr_search("mariah_user", $_POST);
			$info = Db::table("mariah_user")->where('id', $_GET['id'])->update($arr);
			if ($info) {
				$this->redirect("index/dealer/one");
			}
		}
		$list = Db::table('mariah_user')->where('id', $_GET['id'])->select();
                 for($i=0;$i<count($list);$i++){
                    $list[$i]['username']= json_decode($list[$i]['username']);
                    
                }
		$this->assign('list', $list);
		return view('edit');
	}
	//订单管理删除
	public function orderdel() {
		$info = Db::table('mariah_order')->delete($_GET['id']);
		if ($info) {
			$this->redirect("index/dealer/order");
		}
	}
	//订单管理编辑
	public function orderEdit() {
		$list = Db::table('mariah_balance_money')->where('id', $_GET['id'])->select();
		$this->assign('list', $list);
		return view('orderEdit');
	}
}
