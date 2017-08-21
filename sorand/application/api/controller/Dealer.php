<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use think\View;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Dealer extends Controller {

    //一级  二级  三级   下级的个数
    function index() {
        if (request()->isPost()) {
            $first = Db::table('mariah_user')->where('parentid1', $_POST['uid'])->select();
            $list['dealer1'] = count($first);
            $two = Db::table('mariah_user')->where('parentid2', $_POST['uid'])->select();
            $list['dealer2'] = count($two);
            $third = Db::table('mariah_user')->where('parentid3', $_POST['uid'])->select();
            $list['dealer3'] = count($third);
            $list['sum'] = $list['dealer1'] + $list['dealer2'] + $list['dealer3'];
            echo json_encode($list);
        }
    }

    //一级的订单数和销售额
    function firstm() {
        if (request()->isPost()) {
            $sum['money'] = 0;
            $sum['order'] = 0;

            $first = Db::table('mariah_user')->where('parentid1', $_POST['uid'])->field('id')->select();
            for ($i = 0; $i < count($first); $i++) {
                $aa = $first[$i]['id'];

                $ary[] = Db::table('mariah_balance_money')->where('uid', $aa)->field('money')->select();
                if ($ary[$i]) {
                    //dump($ary);exit;    
                    $sum["money"] = $sum['money'] + $ary[$i][0]['money'];
                    $sum['order'] = $sum['order'] + count($ary[$i]);
                }
            }
            $yongjin = Db::table('mariah_commision')->field('commision1,commision2,commision3')->select();
            $one = $yongjin[0]['commision1'];

            $sum['ticheng'] = $sum["money"] * $one / 100;
            echo json_encode($sum);
        }
    }

    //二级的订单数和销售额
    function twom() {
        if (request()->isPost()) {
            $sum['money'] = 0;
            $sum['order'] = 0;
            $sum['ticheng'] = 0;
            $two = Db::table('mariah_user')->where('parentid2', $_POST['uid'])->field('id')->select();
            for ($i = 0; $i < count($two); $i++) {
                $bb = $two[$i]['id'];
                // dump($bb);exit;
                $bry[] = Db::table('mariah_balance_money')->where('uid', $bb)->field('money')->select();
                if ($bry[$i]) {
                    //  dump($bry);exit;    
                    $sum["money"] = $sum['money'] + $bry[$i][0]['money'];
                    $sum['order'] = $sum['order'] + count($bry[$i]);
                }
            }
            $yongjin = Db::table('mariah_commision')->field('commision1,commision2,commision3')->select();
            $second = $yongjin[0]['commision2'];

            $sum['ticheng'] = $sum["money"] * $second / 100;

            echo json_encode($sum);
        }
    }

    //三级的订单数和销售额
    function thirdm() {
        if (request()->isPost()) {
            $sum['money'] = 0;
            $sum['order'] = 0;
            $sum['ticheng'] = 0;
            $third = Db::table('mariah_user')->where('parentid3', $_POST['uid'])->field('id')->select();
            for ($i = 0; $i < count($third); $i++) {
                $cc = $third[$i]['id'];
                $cry[] = Db::table('mariah_balance_money')->where('uid', $cc)->field('money')->select();
                if ($cry[$i]) {
                    $sum["money"] = $sum['money'] + $cry[$i][0]['money'];
                    $sum['order'] = $sum['order'] + count($cry[$i]);
                }
            }
            $yongjin = Db::table('mariah_commision')->field('commision1,commision2,commision3')->select();
            $three = $yongjin[0]['commision3'];
            $sum['ticheng'] = $sum["money"] * $three / 100;

            echo json_encode($sum);
        }
    }

    //总的订单数和销售额
    function total() {
        if (request()->isPost()) {
            $sum['money'] = 0;
            $sum['order'] = 0;
            $list1 = 0;
            $list2 = 0;
            $list3 = 0;
            $info1 = 0;
            $info2 = 0;
            $info3 = 0;
            $yongjin = Db::table('mariah_commision')->field('commision1,commision2,commision3')->select();
            $one = $yongjin[0]['commision1'];
            $second = $yongjin[0]['commision2'];
            $three = $yongjin[0]['commision3'];

            $first = Db::table('mariah_user')->where('parentid1', $_POST['uid'])->field('id')->select();
            for ($i = 0; $i < count($first); $i++) {

                $aa = $first[$i]['id'];
                $ary[] = Db::table('mariah_balance_money')->where('uid', $aa)->field('money')->select();
                if ($ary[$i]) {
                    $list1 = $list1 + $ary[$i][0]['money'];

                    $info1 = $info1 + count($ary[$i]);
                }
            }


            $two = Db::table('mariah_user')->where('parentid2', $_POST['uid'])->field('id')->select();
            for ($i = 0; $i < count($two); $i++) {
                $bb = $two[$i]['id'];
                // dump($bb);exit;
                $bry[] = Db::table('mariah_balance_money')->where('uid', $bb)->field('money')->select();
                if ($bry[$i]) {
                    //  dump($bry);exit;    
                    $list2 = $list2 + $bry[$i][0]['money'];
                    $info2 = $info2 + count($bry[$i]);
                }
            }
            $third = Db::table('mariah_user')->where('parentid3', $_POST['uid'])->field('id')->select();
            for ($i = 0; $i < count($third); $i++) {
                $cc = $third[$i]['id'];
                $cry[] = Db::table('mariah_balance_money')->where('uid', $cc)->field('money')->select();
                if ($cry[$i]) {
                    $list3 = $list3 + $cry[$i][0]['money'];
                    $info3 = $info3 + count($cry[$i]);
                }
            }
            $sum['ticheng'] = $list1 * $one / 100 + $list2 * $second / 100 + $list3 * $three / 100;
            $sum['money'] = $list1 + $list2 + $list3;

            $sum['order'] = $info1 + $info2 + $info3;
            $sum['shuliang'] = count($first) + count($two) + count($third);
            echo json_encode($sum);
        }
    }

}
