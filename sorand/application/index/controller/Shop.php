<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;

class Shop extends Base {
    /*
     * 商店显示
     *      */

    public function index() {
        $appo_info = Db::table('mariah_shopstore')->order("id asc")->paginate(5);
        // $appo_info['pname']=Db::table('mariah_shopstore')->field('pname')->order("id asc")->select();
        //dump($appo_info);exit;
        // echo json_encode($appo_info);
        $this->assign('appo_info', $appo_info);
        return view('index');
    }

    /*
     * 商店添加
     *      */

    public function add() {
        if (request()->isPost()) {

            if (isset($_POST['city_provice']) && isset($_POST['city_city'])) {
                $position_province = explode('-', $_POST['city_provice']);
                $position_city = explode('-', $_POST['city_city']);
                $arr['position_num'] = $position_province[0] . '-' . $position_city[0];
                $arr['position'] = $position_province[1] . '-' . $position_city[1];
            }
            if (isset($_POST['city_county'])) {
                if ($_POST['city_county']) {
                    $position_county = explode('-', $_POST['city_county']);
                    $arr['position_num'].= '-' . $position_county[0];
                    $arr['position'].= '-' . $position_county[1];
                }
            }
            if (isset($_POST['addr'])) {
                if ($_POST['addr']) {
                    $position_addr = $_POST['addr'];
                    $arr['position'].= '-' . $position_addr;
                }
            }
            if (isset($_POST['checkbox'])) {
                $array = $_POST['checkbox'];
                foreach ($array as $k => $v) {

                    $arr2 = explode('-', $v);

                    $b[$k] = $arr2[0];
                    $c[$k] = $arr2[1];
                }
                $pname = implode('-', $c);
                $data['pid'] = serialize($b);
            } else {
                echo('请选择项目');
                exit;
            }

            $arr['pname'] = $pname;
            $arr['shopname'] = $_POST['shopname'];
            $arr['tel'] = $_POST['tel'];
            $arr['qq'] = $_POST['qq'];
            $arr['weixin'] = $_POST['weixin'];
            $info = Db::table("mariah_shopstore")->insert($arr);
            if ($info) {
                $sid = Db::table("mariah_shopstore")->where('shopname', $_POST['shopname'])->find();
                $data['shopid'] = $sid['id'];
                $ainfo = Db::table("mariah_shopping")->insert($data);
                $this->redirect("index/shop/add");
            } else {
                return "添加失败";
            }
        }
        $id = empty($_GET['id']) ? 0 : $_GET['id'];
        $addr = Db::table('mariah_city')->where('parentid', $id)->select();
        $list = Db::table('mariah_production')->select();
        $url = URL_PATH . "Index/shop/city_get";
        $this->assign("list", $list);
        $this->assign("city_get_url", $url);
        $this->assign("addr", $addr);
        return view('add');
    }

    //ajax传递获取城市信息
    function city_get() {
        $id = empty($_GET['id']) ? 0 : $_GET['id'];
        // return $_POST['id'];
        $city = Db::table('mariah_city')->where('parentid', $id)->select();
        if (empty($_GET['id'])) {
            return $city;
        } else {
            return json_encode($city, JSON_UNESCAPED_UNICODE);
        }
    }

    //商店删除
    function shopDelete() {
        $info = Db::table('mariah_shopstore')->delete($_GET['id']);
        if ($info) {
            $this->redirect("index/shop/index");
        }
    }

    function shopEdit() {
        if (request()->isPost()) {

            if (isset($_POST['city_provice']) && isset($_POST['city_city'])) {
                $position_province = explode('-', $_POST['city_provice']);
                $position_city = explode('-', $_POST['city_city']);
                $array['position_num'] = $position_province[0] . '-' . $position_city[0];
                $array['position'] = $position_province[1] . '-' . $position_city[1];
            }
            if (isset($_POST['city_county'])) {
                if ($_POST['city_county']) {
                    $position_county = explode('-', $_POST['city_county']);
                    $array['position_num'].= '-' . $position_county[0];
                    $array['position'].= '-' . $position_county[1];
                }
            }
            if (isset($_POST['addr'])) {
                if ($_POST['addr']) {
                    $position_addr = $_POST['addr'];
                    $array['position'].= '-' . $position_addr;
                }
            }
            if (isset($_POST['checkbox'])) {
                $array1 = $_POST['checkbox'];

                foreach ($array1 as $k => $v) {

                    $arr2 = explode('-', $v);

                    $b[$k] = $arr2[0];
                    $c[$k] = $arr2[1];
                }

                $pname = implode('-', $c);
                $data['pid'] = serialize($b);
            } else {
                echo('请选择项目');
                exit;
            }
            $array['pname'] = $pname;
            $array['shopname'] = $_POST['shopname'];
            $array['tel'] = $_POST['tel'];
            $array['qq'] = $_POST['qq'];
            $array['weixin'] = $_POST['weixin'];
            // dump($array);exit;
            $info = Db::table("mariah_shopstore")->where('id', $_GET['id'])->update($array);
            if ($info) {
                //dump($info);exit;
                $sid = Db::table("mariah_shopstore")->where('id', $_GET['id'])->find();

                $ainfo = Db::table("mariah_shopping")->where('id', $sid['id'])->update($data);
                $this->redirect("index/shop/index");
            } else {
                return "添加失败";
            }
        }
        $id = '0';
        $addr = Db::table('mariah_city')->where('parentid', $id)->select();
        //查询店铺
        $arr = Db::table('mariah_shopstore')->where('id', $_GET['id'])->select();
        foreach ($arr as $v) {
            $c['pname'] = $v['pname'];
        }
        $b = explode('-', $c['pname']);
        $city = explode('-', $arr[0]['position']);
        if (empty($city[3])) {
            $a['city'] = $city[2];
        } else {
            $a['city'] = $city[3];
        }
        $list = Db::table('mariah_production')->select();
        $url = URL_PATH . "Index/shop/city_get";
        $this->assign('b', $b);
        $this->assign('a', $a['city']);
        $this->assign('arr', $arr);
        $this->assign("list", $list);
        $this->assign("city_get_url", $url);
        $this->assign("addr", $addr);
        return view('edit');
    }

}
