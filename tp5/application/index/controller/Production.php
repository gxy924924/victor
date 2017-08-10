<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\View;
use think\File;
use think\Paginator;
class Production extends Base {
	/*
	 * 项目显示
	 *      */
	public function index() {
                $list = Db::table('mariah_production')->order("id asc")->paginate(10);
               // dump($list);exit;
                $this->assign('list', $list); 
		return  view('index');
	}
	/*
	 * 项目添加
	 *    */
	public function add() {
		if (request()->isPost()) {
			$file = request()->file('img');
			if (isset($file)) {
				// dump($file);exit;
				// 获取表单上传文件 例如上传了001.jpg
				// 移动到框架应用根目录/public/uploads/ 目录下
				$info = $file->move(ROOT_PATH . 'public/uploads');
                                echo sprintf('%s',ROOT_PATH);exit; 
				if ($info) {
					// 成功上传后 获取上传信息
					$a = $info->getSaveName();
					$imgp = str_replace("\\", "/", $a);
					$imgpath = 'uploads/' . $imgp;
					$arr['f_img'] = $imgpath;
				} else {
					// 上传失败获取错误信息
					echo $file->getError();
				}
			}
			$arr['classify'] = $_POST['classify'];
			$arr['production'] = $_POST['production'];
			$arr['money'] = $_POST['money'];
			$arr['discount'] = $_POST['discount'];
                        $arr['special'] = $_POST['special'];
			$arr['activePrice'] = $_POST['activePrice'];
			$arr['price'] = $_POST['price'];
			$info = Db::table("mariah_production")->insert($arr);
			if ($info) {
				$this->redirect("index/production/add");
			} else {
				return "添加失败";
			}
		}
		return view('add');
	}
	//产品删除
	function producitonDelete() {
		$info = Db::table('mariah_production')->delete($_GET['id']);
		if ($info) {
			$this->redirect("index/production/index");
		}
	}
	//商品编辑
	function productionEdit() {
		if (request()->isPost()) {
			$arr = $_POST;
			$file = request()->file('img');
			if (isset($file)) {
				// dump($file);exit;
				// 获取表单上传文件 例如上传了001.jpg
				// 移动到框架应用根目录/public/uploads/ 目录下
				$info = $file->move(ROOT_PATH . 'public/uploads');
				if ($info) {
					// 成功上传后 获取上传信息
					$a = $info->getSaveName();
					$imgp = str_replace("\\", "/", $a);
					$imgpath = 'uploads/' . $imgp;
					$arr['f_img'] = $imgpath;
				} else {
					// 上传失败获取错误信息
					echo $file->getError();
				}
			}
			$info = Db::table("mariah_production")->where('id', $_GET['id'])->update($arr);
			if ($info) {
				$this->redirect("index/production/index");
			}
		}
		$list = Db::table('mariah_production')->where('id', $_GET['id'])->select();
		$this->assign('list', $list);
		return view('edit');
	}
        
         public function  classify(){
            $list =Db::table('mariah_classify')->order("id asc")->select();
             for($i=0;$i<count($list);$i++){
                 $v[$i]['classify']=$list[$i]['classify'];
             }
             
          return  view('classify');
        }
        
            public function  requestClassify(){
                if(request()->ispost()){
                    $arr['classify']=$_POST['classify'];
                    $list =Db::table('mariah_production')->where('classify',$arr['classify'])->order("id asc")->select();
               
                echo json_encode($list);
                 }
                return  view('requestClassify');
        
        }
}
