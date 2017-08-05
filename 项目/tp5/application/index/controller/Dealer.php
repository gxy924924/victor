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
		$this->assign('appo_info', $appo_info);
		return view('one');
	}
	public function details() {
		$list = Db::table('mariah_user')->where("id", $_GET['id'])->select();
		$frist = Db::table('mariah_user')->where('parentid1', $_GET['id'])->select();
		$second = Db::table('mariah_user')->where('parentid2', $_GET['id'])->select();
		$three = Db::table('mariah_user')->where('parentid3', $_GET['id'])->select();
		$money = Db::table('mariah_orderlog')->where('uid', $_GET['id'])->field('money')->select();
		$a = count($money);
		$sum = 0;
		for ($i = 0;$i < count($money);$i++) {
			$sum = $sum + $money[$i]['money'];
		}
		$count = count($frist) + count($second) + count($three);
		$this->assign('sum', $sum);
		$this->assign('a', $a);
		$this->assign('count', $count);
		$this->assign('list', $list);
		return view('details');
	}
	//订单管理
	public function order() {
		$list = DB::table("mariah_order")->select();
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
	//添加用户
	public function adduser() {
		if (request()->isPost()) {
			$arr = $this->sql_arr_search("mariah_user", $_POST);
			//判断是否有上级
			$_POST['parentid']=$this->get_spread_pid($_POST['spread_code']);
			if (empty($_POST['parentid'])) {
				$arr['parentid1'] = 0;
				$arr['parentid2'] = 0;
				$arr['parentid3'] = 0;
			} else {
				//有上级的情况下，parentid1字段加入一级经销商的ID
				$arr['parentid1'] = $_POST['parentid'];
				//一级经销商有上级的情况
				$list = Db::table('mariah_user')->where('id', $arr['parentid1'])->select();
				if ($list) {
					foreach ($list as $v) {
						$father['parentid1'] = $v['parentid1'];
					}
					//parentid2字段加入二级经销商的ID
					$arr['parentid2'] = $father['parentid1'];
				} else {
					$arr['parentid2'] = 0;
				}
				//二级经销商有上级的情况
				$info = Db::table('mariah_user')->where('id', $arr['parentid2'])->select();
				if ($info) {
					foreach ($info as $v) {
						$granddd['parentid1'] = $v['parentid1'];
					}
					//parentid2字段加入三级经销商的ID
					$arr['parentid3'] = $granddd['parentid1'];
				} else {
					$arr['parentid3'] = 0;
				}
			}
			$info = Db::table("mariah_user")->insert($arr);
			if ($info) {
				$this->redirect("index/dealer/one");
			} else {
				return "添加失败";
			}
		}
		return view('adduser');
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
		$list = Db::table('mariah_order')->where('id', $_GET['id'])->select();
		$this->assign('list', $list);
		return view('orderEdit');
	}
}
