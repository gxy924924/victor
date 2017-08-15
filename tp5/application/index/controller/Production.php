<?php
namespace app\index\controller;
import('aliyun.autoload',EXTEND_PATH);
use OSS\OssClient;
use OSS\Core\OssException;
use think\Controller;
use think\Db;
use think\View;
use think\File;
use think\Paginator;
class Production extends Base {
  //上传图片
      public function img($image)
    {
            import('upload.UploadFile',EXTEND_PATH);
            $upload = new \UploadFile();// 实例化上传类
            $upload->maxSize = 3145728 ;// 设置附件上传大小
            $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath = './public/upload/';// 设置附件上传目录
            if(!$upload->upload()){
            $this->error($upload->getErrorMsg());die;//输出错误提示
            }else{
             $info = $upload->getUploadFileInfo();
            //  dump($info);exit;
             $this->aliyun($info);
             }
             }
   
       public   function aliyun($info){
          $accessKeyId = 'LTAIBPzjrAhbdISO';
          $accessKeySecret = 'qD0akARRo0dPD8arrZmWqH6yHMgOlQ';
          $endpoint = 'oss-cn-hangzhou.aliyuncs.com';
          $bucket = 'mariah1';
          $object = date('Y-m-d').'/'.$info[0]['savename'];
        // dump($object);exit;
          $content = './public/upload/'.$info[0]['savename'];
          
           try {
            $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
            $ossClient->putObject($bucket, $object, $content);
           } catch (OssException $e) {
           print $e->getMessage();
         }   
         try {
    $ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);
    $content = $ossClient->getObject($bucket, $object);
  
   } catch (OssException $e) {
    print $e->getMessage();
    }
       }
      
	
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
                        $image= request()->file('image');
                        $b=$this->img($image);
			$file = request()->file('img');
			if (isset($file)) {
				// dump($file);exit;
				// 获取表单上传文件 例如上传了001.jpg
				// 移动到框架应用根目录/public/uploads/ 目录下
				$info = $file->validate(['ext'=>'jpg,jpeg,png,gif'])->move(ROOT_PATH . 'public/uploads');
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
                     $list =Db::table('mariah_classify')->order("id asc")->select();
                       
                        $this->assign('list',$list);
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
                 $lists=Db::table('mariah_classify')->order("id asc")->select();
                       
                    
		$list = Db::table('mariah_production')->where('id', $_GET['id'])->select();
                $this->assign('lists',$lists);
		$this->assign('list', $list);
		return view('edit');
	}
        
	public function  classify(){
		$vi=new View();
		
		$vi->classify =Db::table('mariah_classify')->select();



		return  $vi->fetch();
	}

	function show_update_classify(){
		$vi=new View();
		$vi->classify =Db::table('mariah_classify')->where('id',$_GET['id'])->find();
		return  $vi->fetch();
	}

	function update_classify(){
		var_dump($_GET);
		var_dump($_POST);
		$res=Db::table('mariah_classify')->where('id',$_GET['id'])->update($_POST);
		$this->redirect(url('classify'));
	}

	function add_classify(){
		if(!empty($_POST['classify'])){
            	// var_dump($_POST);
			$res=Db::table('mariah_classify')->insert($_POST);
		}
		$this->redirect(url('classify'));
	}

	function delete_classify(){
		$res=Db::table('mariah_classify')->where('id',$_GET['id'])->delete();
		// var_dump($_GET);
		$this->redirect(url('classify'));
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
