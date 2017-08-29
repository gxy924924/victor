<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use think\View;

class Shop extends controller {

    //显示店铺
    public function shopname() {
        $appo_info = Db::table('mariah_shopstore')->order("id asc")->select();
        echo json_encode($appo_info);
    }

    //显示单个店铺的所有项目
    public function index() {
        if (request()->isPost()) {
            $arr['code'] = 1;
            $appo_info = Db::table('mariah_shopstore')->order("id asc")->select();
            $pid = Db::table('mariah_shopping')->where('shopid', $_POST['id'])->field("pid")->select();
            // dump($pid);exit;
            if (empty($_POST['classify'])) {
                for ($i = 0; $i < count($pid); $i++) {
                    $p[$i] = unserialize($pid[$i]['pid']);

                    for ($j = 0; $j < count($p[$i]); $j++) {
                        $cc[$j] = $p[$i][$j];
                        $production[] = Db::table('mariah_production')->where('id', $cc[$j])->find();
                    }
                }
                $arr['production'] = $production;
                echo json_encode($arr);
            } else {
                for ($i = 0; $i < count($pid); $i++) {
                    $p[$i] = unserialize($pid[$i]['pid']);

                    for ($j = 0; $j < count($p[$i]); $j++) {
                        $cc[$j] = $p[$i][$j];
                        $list = Db::table('mariah_production')->where(array('id' => $cc[$j], 'classify' => $_POST['classify']))->find();
                        if (!empty($list)) {
                            $production[] = $list;
                        }
                    }
                }
                if (!isset($production)) {
                    $arr['code'] = 0;
                } else {
                    $arr['production'] = $production;
                }
                echo json_encode($arr);
            }
        }
    }

    public function ceshi() {
       $arr['code']=1;
        $_POST['id'] = '70';
        $_POST['classify'] = '冰垫';
        $appo_info = Db::table('mariah_shopstore')->order("id asc")->select();
        $pid = Db::table('mariah_shopping')->where('shopid', $_POST['id'])->field("pid")->select();
        // dump($pid);exit;
        if (empty($_POST['classify'])) {
            for ($i = 0; $i < count($pid); $i++) {
                $p[$i] = unserialize($pid[$i]['pid']);

                for ($j = 0; $j < count($p[$i]); $j++) {
                    $cc[$j] = $p[$i][$j];
                    $production[] = Db::table('mariah_production')->where('id', $cc[$j])->find();
                }
            }
            echo json_encode($production);
          
        } else {
          for ($i = 0; $i < count($pid); $i++) {
                    $p[$i] = unserialize($pid[$i]['pid']);

                    for ($j = 0; $j < count($p[$i]); $j++) {
                        $cc[$j] = $p[$i][$j];
                        $list = Db::table('mariah_production')->where(array('id' => $cc[$j], 'classify' => $_POST['classify']))->find();
                        if(!empty($list)){
                            $production[]=$list;
                        } 
                    }
          }
          if(!isset($production)){
              $arr['code']=0;
          }  else {
              $arr['production']=$production;
          }
          echo json_encode($arr);
        }
    }

    //查询单个店铺的详情
    public function shop() {
        $help['error'] = '失败';
        if (request()->isPost()) {
            $arr['id'] = $_POST['id'];
            $appo_info = Db::table('mariah_shopstore')->where('id', $arr['id'])->find();
            if ($appo_info) {

                echo json_encode($appo_info);
            } else {
                echo json_encode($help);
            }
        }
    }

    //获取省会
    public function provice() {
        $list = Db::table('mariah_provice')->field('provice')->select();
        echo json_encode($list);
    }

    //根据省会获取对应的店铺
    public function requestshop() {
        $arr['error'] = '0';
        if (request()->isPost()) {
            $data["provice"] = $_POST['provice'];
            $list['array'] = Db::table('mariah_shopstore')->where('position', 'like', '%' . $data["provice"] . '%')->select();
            if ($list['array']) {
                $list['error'] = '1';
                //  dump($list);
                echo json_encode($list);
            } else {
                echo json_encode($arr);
            }
        }
    }

}
