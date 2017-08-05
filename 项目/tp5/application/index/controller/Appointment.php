<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\View;

// use Think;
//  extends controller
class Appointment extends Base
{   
    function __construct(){
        parent::__construct();
        $_COOKIE['left_collapse']='appointment';
    }
    //视图部分----------------------------------------------------
    // function test(){
    //     $url=$_SERVER['REQUEST_URI'];
    //     $url_sep=empty($_SERVER['QUERY_STRING'])?"?":"&";
    //     echo "<pre>";
    //     var_dump($_SERVER);
    //     var_dump($url_sep);
    //     var_dump($_GET);
    //     echo "</pre>";
    //     echo "<a href='".$url."'>aa</a>";
        

    // }    

    //新增登记
    function appointment_add(){
        $view=new View();
        //表中的信息
        $view->province=$this->city_get();
        $shop_obj=Db::table('mariah_shopstore');

        $appo_sccess=$this->info_access(['appo_info']);
        if(empty($appo_sccess['appo_info'])||$appo_sccess['appo_info']!='all'){
            $shop_num=Db::table('mariah_admin_detail')->field('shop_id')->where('id',$_SESSION['userid'])->find();
            $shop_obj=$shop_obj->where('id','in',$shop_num['shop_id']);
        }
        $view->shop=$shop_obj->select();

        $view->appointment_type=Db::table('mariah_appointment_type')->select();
        $view->appointment_style=Db::table('mariah_appointment_style')->select();
        //隐藏地址获取
        // $view->city_get_url=URL_PATH."Index/appointment/city_get";
        $view->item_get_url=URL_PATH."Index/appointment/item_get";
        $view->add_new_url=URL_PATH."Index/appointment/add_new";
        // $view->time=date("Y-m-d H:i");
        return $view->fetch();
    }

    //预约信息（查看预约与其他操作功能）
    function appointment_info(){
        // var_dump($_POST);

        $total_page=5;             //单页条数
        $view=new View();
        $view->province=$this->city_info(0);
        if(!empty($_POST['province'])){
            $id=explode('-',$_POST['province']);
            $view->city_info= $this->city_info($id[0]);
        }
        if(!empty($_POST['city'])){
            $id=explode('-',$_POST['city']);
            $view->county_info=$this->city_info($id[0]);
        }
        $view->city_get_url=URL_PATH."Index/appointment/city_get";
        $view->appointment_style=Db::table('mariah_appointment_style')->select();
        //授权管理联系方式隐藏字段
        $view->info_access=$this->info_access(["tel_info",'appo_info']);

        // $obj=$this->appo_sql($view->info_access['appo_info']);
        
        // $count=$obj->count();       //总条数
        
        // $page=empty($_GET['page'])?1:$_GET['page'];     //本页面页数
        $obj=$this->appo_sql($view->info_access['appo_info']);          //多功能筛查
        $view->appo_info = $obj->order('add_time desc')->paginate($total_page);
        // var_dump($view->appo_info);
        return $view->fetch();
    }

    //appointment_info 数据库查询函数
    function appo_sql($show_check){
        $obj=Db::table('mariah_appointment_info a')->join('mariah_admin_user b on a','a.adder_user_id=b.id','left')->field('a.*,b.username');
        $obj=$this->check_appo_info($show_check,$obj);    //权限筛查数据
        
        if(count($_POST)){
            $obj=$this->appointment_search_info($obj);  //添加条件筛查
        }
        return $obj;
    }

    //检查权限筛查
    function check_appo_info($check,$obj){
        // var_dump($check);
        if(empty($check)){

            $obj=$obj->where("adder_user_id",$_SESSION['userid']);
        }else if($check=="local"){
            $id=$_SESSION['userid'];
            $shop_num=Db::table('mariah_admin_detail')->field('shop_id')->where('id',$_SESSION['userid'])->find();
            $info=Db::table('mariah_shopstore')->field('position')->where('id','in',$shop_num['shop_id'])->select();
            if(empty($info[0]['position'])){
                $this->error('请添加用户详细信息',url('index/user/user_detail')."?id=".$_SESSION['userid']);
            }
            foreach ($info as $k => $v) {
                $arr=explode('-',$v['position']);
                if($arr['0']=='北京市'||$arr['0']=='上海市'||$arr['0']=='天津市'||$arr['0']=='重庆市'){
                    $position=$arr[0];
                }else{
                    $position=implode("-", [$arr[0],$arr[1]]);
                }
                
                $attr[$k]="%".$position."%";
            }
  
            // var_dump($attr);
            // exit;
            $obj=$obj->where('position','like',$attr,'or');
        }else if($check=="shop"){
            $shop_num=Db::table('mariah_admin_detail')->field('shop_id')->where('id',$_SESSION['userid'])->find();
            $info=Db::table('mariah_shopstore')->field('shopname')->where('id','in',$shop_num['shop_id'])->select();
            // var_dump($shop_num);
            
            if(empty($info[0]['shopname'])){
                $this->error('请添加用户详细信息',url('index/user/user_detail')."?id=".$_SESSION['userid']);
            }
            foreach ($info as $k => $v) {
                $attr[$k]="%".$v['shopname']."%";
            }

            $obj=$obj->where('shop','like',$attr,'or');
        }else if($check=="all"){

        }else{
            $obj=$obj->where("adder_user_id",$_SESSION['userid']);
        }
        return $obj;
    }

    //预约搜索信息
    function appointment_search_info($obj){
        if(!empty($_POST['search_info'])){
            if(is_numeric($_POST['search_info'])){
                 $obj=$obj->where("tel",'like',"%".$_POST['search_info']."%");
            }else{
                 $obj=$obj->where("name",'like',"%".$_POST['search_info']."%");
            }
           
        }
        if(!empty($_POST['add_time_start'])){
            $obj=$obj->where("add_time",">= time",$_POST['add_time_start']);
        }
        if(!empty($_POST['add_time_stop'])){
            $obj=$obj->where("add_time","<= time",$_POST['add_time_stop']);
        }
        if(!empty($_POST['appointment_time_start'])){
            $obj=$obj->where("appointment_time",">= time",$_POST['appointment_time_start']);
        }
        if(!empty($_POST['appointment_time_stop'])){
            $obj=$obj->where("appointment_time","<= time",$_POST['appointment_time_stop']);
        }
        if(!empty($_POST['appointment_go'])&&$_POST['appointment_go']=="0"){
            $obj=$obj->where("appointment_go",$_POST['appointment_go']);
        }else if(!empty($_POST['appointment_go'])&&$_POST['appointment_go']=="1"){
            $obj=$obj->where("appointment_go",$_POST['appointment_go']);
        }
        if(!empty($_POST['appointment_style'])){
           $obj=$obj->where("appointment_style",$_POST['appointment_style']);
        }
        if(!empty($_POST['adder_name'])){
           $obj=$obj->where("username",$_POST['adder_name']);
        }
        if(!empty($_POST['province'])){
            $province=explode("-",$_POST['province']);
            // echo $province[1];
            $attr["position"]=["like","%".$province[1]."%"];
           $obj=$obj->where($attr);
        }
        if(!empty($_POST['city'])){
            $city=explode("-",$_POST['city']);
            // echo $city[1];
            $attr["position"]=["like","%".$city[1]."%"];
           $obj=$obj->where($attr);
        }
        if(!empty($_POST['county'])){
            $county=explode("-",$_POST['county']);
            // echo $province[1];
            $attr["position"]=["like","%".$county[1]."%"];
           $obj=$obj->where($attr);
        }
        return $obj;
    }

    //更新预约
    function appointment_update(){
        // var_dump($_GET);
        $view=new View();

        //表中的信息
         $shop_obj=Db::table('mariah_shopstore');

        $appo_sccess=$this->info_access(['appo_info']);
        if(empty($appo_sccess['appo_info'])||$appo_sccess['appo_info']!='all'){
            $shop_num=Db::table('mariah_admin_detail')->field('shop_id')->where('id',$_SESSION['userid'])->find();
            $shop_obj=$shop_obj->where('id','in',$shop_num['shop_id']);
        }
        $view->shop=$shop_obj->select();
        $view->province=$this->city_get();
        $view->info_access=$this->info_access(["tel_info"]);
        $view->item_get_url=URL_PATH."Index/appointment/item_get";
        $view->appointment_type=Db::table('mariah_appointment_type')->select();
        $view->appointment_style=Db::table('mariah_appointment_style')->select();
        //隐藏地址获取
        $view->city_get_url=URL_PATH."Index/appointment/city_get";
        $view->add_new_url=URL_PATH."Index/appointment/add_new";
        //回传给前端之前填好的信息
        $view->appo_info=Db::table('mariah_appointment_info')->where('id',$_GET['appo_id'])->select();
        if(empty($view->appo_info[0]['item'])){
            $view->app_item=['',''];
        }else{
            $view->app_item=explode('-',$view->appo_info[0]['item']);
            $view->app_item2=Db::table('mariah_production')->where('classify',$view->app_item[0])->select();
        }
        
        // var_dump($view->appo_info);
        return $view->fetch();
    }

//添加、修改预约详细内容
    function appoint_detail(){
        // var_dump($_GET);
        $ap_id=$_GET['ap_id'];
        $exist=Db::table('mariah_guest_detail')->where('appo_id',$ap_id)->count();
        $vi=new View();
        if ($exist) {
            $vi->url=url('index/appointment/update_detail_do');
            $vi->do="修改";
        }else{
            $vi->url=url('index/appointment/add_detail_do');
            $vi->do="添加";
        }
        
        $vi->info_access=$this->info_access(["tel_info"]);
        $vi->info=Db::table('mariah_appointment_info')->where('id',$ap_id)->select();
        // var_dump($vi->info);
        $vi->detail=Db::table('mariah_guest_detail')->where('appo_id',$ap_id)->find();
        return $vi->fetch();


    }

    //显示详细内容
    function show_detail(){
        $vi=new View();
        $ap_id=$_GET['ap_id'];
        $vi->tel_access=$this->info_access("tel_info");
        $vi->info=Db::table('mariah_appointment_info')->where('id',$ap_id)->select();

        $g_id=$vi->info[0]['guest_id'];
        if(empty($g_id)){
            $guest_arr=$this->check_guest($vi->info[0]);
            $guest_id=$guest_arr['id'];
            // var_dump($guest_id);
            // exit;
            Db::table("mariah_appointment_info")->where('id',$ap_id)->update(['guest_id'=>$guest_id]);
            $vi->g_info=Db::table('mariah_appointment_info')->where('guest_id',$guest_id)->order('add_time')->select();
        }else{
             $vi->g_info=Db::table('mariah_appointment_info')->where('guest_id',$g_id)->order('add_time')->select();
        }

           
        

        $vi->detail=Db::table('mariah_guest_detail')->where('appo_id',$ap_id)->select();
        $vi->after_sale=Db::table('mariah_appointment_aftersale')->where('pid',$ap_id)->order('add_af_time ')->select();

        

        return $vi->fetch();
    }

    //到达信息
    function show_arrive(){
        $vi=new View();
        //查看权限
        $info_access=$this->info_access(['appo_info']);
        $show_all=!empty($info_access["appo_info"])?$info_access["appo_info"]:0;

        $obj=Db::table('mariah_guest_arrive a')->join('mariah_appointment_info b on a','a.appo_id=b.id')->join('mariah_admin_detail c on a','c.id=a.confirm_user_id','left')->field('a.*,b.adder_user_id,c.username');
        $obj=$this->check_appo_info($show_all,$obj);
        $vi->arrive=$obj->select();
        return $vi->fetch();
    }

     function after_sale_add(){
        $vi=new View();
        //查看权限
        // $info_access=$this->info_access(['appo_info']);
        // $show_all=!empty($info_access["appo_info"])?$info_access["appo_info"]:0;
        if(!empty($_GET['id'])){
            $vi->info=Db::table('mariah_appointment_info')->where('id',$_GET['id'])->select();
            $vi->form_url=url("index/appointment/after_sale_add_do");
            $vi->form_title="添加售后";
        }else if(!empty($_GET['after_id'])){
            $vi->info=Db::table('mariah_appointment_info')->where('id',$_GET['ap_id'])->select();
            $vi->after_info=Db::table("mariah_appointment_aftersale")->where('id',$_GET['after_id'])->find();
            $vi->form_url=url("index/appointment/after_sale_update")."?after_id=".$_GET['after_id'];
            $vi->form_title="修改售后";
            // var_dump($vi->after_info);
        }
        return $vi->fetch();
    }

//功能部分----------------------------------------------------

    function after_sale_delete(){
        echo "<pre>";
        var_dump($_GET);
        echo "</pre>";
        $info1=Db::table("mariah_appointment_aftersale")->delete($_GET['id']);

        $info2=Db::table("mariah_appointment_info")->where("id",$_GET['ap_id'])->update(["after_sale"=>$_GET['after_sale']]);
        $t_url=url('Index/appointment/show_detail')."?ap_id=".$_GET['ap_id'];
        $this->t_f_jump($info1&&$info2,"","$info1"." $info2"."删除失败",$t_url);
    }

    //售后确认到达
    function after_sale_arrive(){
        $date_time=date("Y-m-d H:i:s");
        var_dump($date_time);
        var_dump($_GET);
        $info1=Db::table("mariah_appointment_aftersale")->where("id",$_GET['after_id'])->update(['arrive_time'=>$date_time]);
        $t_url=url('Index/appointment/show_detail')."?ap_id=".$_GET['ap_id'];
        
        $this->t_f_jump($info1,"","{$info1}修改失败",$t_url,$t_url);
    }

    //修改售后
    function after_sale_update(){
        if($_POST['before_price']!=$_POST['after_price']){
            $this->check_update_aftersale($_POST['before_price'],$_POST['after_price'],$_GET['after_id']);
        }
        if(!empty($_POST['time_date'])&&!empty($_POST['time_time'])){
            $arr['appo_af_time']=$_POST['time_date']." ".$_POST['time_time'];
        }else{
            $arr['appo_af_time']=0;
        }
        $arr['type']=$_POST['type'];
        $arr['info']=$_POST['info'];
        $arr['after_price']=$_POST['after_price'];
        $arr['pid']=$_POST['pid'];

        echo "<pre>";
        var_dump($_GET);
        var_dump($_POST);
        echo "</pre>";
        
        $info1=Db::table("mariah_appointment_aftersale")->where("id",$_POST['after_id'])->update($arr);

        $t_url=url('Index/appointment/show_detail')."?ap_id=".$_POST['pid'];
        
        $this->t_f_jump($info1,"","{$info1}修改失败",$t_url,$t_url);
    }

    //检查更改售后价格的次数
    function check_update_aftersale($b,$a,$id){
        $date_time=date("Y-m-d H:i:s");
        $info=Db::table("mariah_appointment_aftercheck")->where('id',$id)->find();
        if(empty($info)){
            $up_arr[1]=["date_time"=>$date_time,"m_change"=>$b.'->'.$a];
            $arr['id']=$id;
            $arr['update_info']=json_encode($up_arr);
            $sql_res=Db::table("mariah_appointment_aftercheck")->insert($arr);
        }else{
            $auth_update=$this->info_access(['after_update']);;
            if($info['checked_num']>=3&&empty($auth_update)){
                $this->error("您只能修改3次售后价格",url('Index/appointment/appointment_info'));
            }else{
                $arr['checked_num']=$info['checked_num']+1;
                $up_arr=json_decode($info['update_info'],1);
                $up_arr[$arr['checked_num']]=["date_time"=>$date_time,"m_change"=>$b.'->'.$a];
                
                $arr['update_info']=json_encode($up_arr);
  
                $sql_res=Db::table("mariah_appointment_aftercheck")->where("id",$id)->update($arr);
            }
        }
        // echo "<pre>";
        // var_dump($info);
        // echo "</pre>";
        
        // exit;

    }


    //添加售后
    function after_sale_add_do(){
        if(!empty($_POST['time_date'])&&!empty($_POST['time_time'])){
            $arr['appo_af_time']=$_POST['time_date']." ".$_POST['time_time'];
        }else{
            $arr['appo_af_time']=0;
        }
        $arr['type']=$_POST['type'];
        $arr['info']=$_POST['info'];
        $arr['after_price']=$_POST['after_price'];
        $arr['pid']=$_POST['pid'];
        $update_info['after_sale']=$_POST['after_sale']+1;
        
        $info1=Db::table("mariah_appointment_aftersale")->insert($arr);

        $info2=Db::table("mariah_appointment_info")->where("id",$_POST['pid'])->update($update_info);
        $t_url=url('Index/appointment/appointment_info');
        // echo "<pre>";
        // var_dump($arr);
        // var_dump($_POST);
        // echo "</pre>";
        $this->t_f_jump($info1&&$info2,"","$info1"." $info2"."添加失败",$t_url,$t_url);

    }

    //获取产品项目信息
    function item_get(){
        $item_classify=$_GET['classify'];
        // return $item_classify;
        $item=Db::table('mariah_production')->where('classify',$item_classify)->select();
        return json_encode($item,JSON_UNESCAPED_UNICODE);
    }

    //获取城市信息
    function city_info($id){
        return  $city=Db::table('mariah_city')->where('parentid',$id)->select();
    }

//ajax传递获取城市信息
    function city_get(){
        $id=empty($_GET['id'])?0:$_GET['id'];
        $arr=explode('-',$id);
        $id=$arr[0];
        // return $id;
        // return $_POST['id'];
        
        $city=Db::table('mariah_city')->where('parentid',$id)->select();

        return json_encode($city,JSON_UNESCAPED_UNICODE);

    }

    //添加顾客预约信息
    function add_new(){

        if(!empty($_POST['time_date'])&&!empty($_POST['time_time'])){
            $arr['appointment_time']=$_POST['time_date']." ".$_POST['time_time'];
        }
        
        //数据库筛查
        $sql_arr=Db::query("describe mariah_appointment_info");

        foreach ($sql_arr as $value) {
            $field=$value["Field"];
            if(!empty($_POST[$value["Field"]])){
                $arr[$value["Field"]]=$_POST[$value["Field"]];
            }
        }

        $arr['item']=$_POST['item1']."-".$_POST['item2'];
        $arr_exp2=explode("+",$_POST['shop_info']);
        $id=$arr_exp2[0];
        $arr['shop']=$arr_exp2[1];
        $position=Db::table("mariah_shopstore")->where("id",$id)->find();

        $arr['position']=$position['position'];
        $arr['position_num']=$position['position_num'];
        // $arr['price']=$arr_exp1[0];
        $arr['adder_user_id']=$_SESSION['userid'];

        
        $guest_arr=$this->check_guest($arr);
        $arr['guest_id']=$guest_arr['id'];
        // echo "<pre>";
        // var_dump($arr);
        // echo "</pre>";
        // exit;
        $info=Db::table("mariah_appointment_info")->insert($arr);
        $t_url=url('Index/appointment/appointment_info');
        $this->t_f_jump($info,"","删除失败",$t_url,$t_url);//base中方法
    }

    //顾客验证与顾客信息加载
    function check_guest($arr){
        
        if(!empty($arr['weixin'])){
            $guest_info=Db::table('mariah_guest_info')->where('weixin',$arr['weixin'])->find();
            if(!empty($guest_info)){
                $flag=1;
                return $guest_info;
            }
        }else if(!empty($arr['tel'])){
            if(empty($flag)){
                $guest_info=Db::table('mariah_guest_info')->where('tel',$arr['tel'])->find();
                if(!empty($guest_info)){
                    $flag=1;
                    return $guest_info;
                }
            }

        }
        if(empty($flag)){
            $input_arr['name']=empty($arr['name'])?"":$arr['name'];
            $input_arr['weixin']=empty($arr['weixin'])?"":$arr['weixin'];
            $input_arr['tel']=empty($arr['tel'])?"":$arr['tel'];
            $input_arr['sex']=empty($arr['sex'])?"":$arr['sex'];
            $input_arr['age']=empty($arr['age'])?"":$arr['age'];
            $info=Db::table('mariah_guest_info')->insert($input_arr);
            if($info){
                return $this->check_guest($arr);
            }
        }
    }


    //删除预约
    function appoint_delete(){
        // return "aa";
        // var_dump($_GET);
        $info=Db::table('mariah_appointment_info')->delete($_GET['id']);
        $t_url=url('Index/appointment/appointment_info');
        $info2=Db::table('mariah_guest_detail')->where("appo_id",$_GET['id'])->delete();
        $this->t_f_jump($info,"","删除失败",$t_url,$t_url);
        
    }

    //添加详细内容（功能）
    function add_detail_do(){
        var_dump($_POST);
        $info=Db::table('mariah_guest_detail')->insert($_POST);
        $update_info=Db::table('mariah_appointment_info')->where('id',$_POST['appo_id'])->update(["detail_exist"=>1]);
        // $t_url=url('Index/Index/appointment_info');
         $this->redirect(url('index/appointment/show_detail')."?ap_id=".$_POST['appo_id']);
    }

    //执行更新详细
    function update_detail_do(){
        
        $table="mariah_guest_detail";
        $attr_info="appo_id";
        $attr=$_POST['appo_id'];
        $info=$this->sql_arr_update($table,$_POST,$attr_info,$attr);
        // var_dump($_POST);
        // var_dump($info);
        $this->t_f_jump($info,'','修改失败',url('index/appointment/show_detail')."?ap_id=".$_POST['appo_id']);
    }

    //执行更新预约信息
    function appoint_update_do(){
        $arr=$this->sql_arr_search("mariah_appointment_info",$_POST);

        $arr_exp2=explode("+",$_POST['shop_info']);
        $id=$arr_exp2[0];
        $arr['shop']=$arr_exp2[1];
        $position=Db::table("mariah_shopstore")->where("id",$id)->find();
        $arr['position']=$position['position'];
        $arr['position_num']=$position['position_num'];
        $arr['item']=$_POST['item1']."-".$_POST['item2'];

        if(!empty($_POST['time_date'])&&!empty($_POST['time_time'])){
            $arr['appointment_time']=$_POST['time_date']." ".$_POST['time_time'];
        }else{
            $arr['appointment_time']="0000-00-00 00:00:00";
        }

        $update_info=Db::table('mariah_appointment_info')->where('id',$_POST['user_id'])->update($arr);
        // var_dump($arr);
        $t_url=url('Index/appointment/appointment_info');
         $this->redirect(url('index/appointment/show_detail')."?ap_id=".$_POST['user_id']);
    }

    

    //预约到达
    function appoint_arrive(){
        // var_dump($_GET);
        $appo_id=$_GET['id'];
        $arr=Db::table('mariah_guest_arrive')->where('appo_id',$appo_id)->find();
        if(count($arr)){
           $this->success("已确认到达过了",url('index/appointment/show_arrive'));
        }else{
            $arr=Db::table('mariah_appointment_info')->where("id",$appo_id)->find();
            $info=Db::table('mariah_appointment_info')->where("id",$appo_id)->update(["appointment_go"=>1]);
            $info2=Db::table('mariah_guest_arrive')->insert(["appo_id"=>$appo_id,"name"=>$arr['name'],"confirm_user_id"=>$_SESSION['userid']]);
        }

        if($info&&$info2){
            $this->redirect(url('index/appointment/show_arrive'));
        }else{
            $f_url=url('index/appointment/show_arrive');
            $this->error("确认到达有误",$f_url);
        }
        // echo "<pre>";
        // var_dump($arr);
        // echo "</pre>";
    }

    //删除预约到达信息
    function arrive_delete(){
        $info=Db::table('mariah_appointment_info')->where("id",$_GET['ap_id'])->update(["appointment_go"=>0]);
        $info2=Db::table('mariah_guest_arrive')->delete($_GET['id']);
        $this->t_f_jump($info&&$info2,"","删除失败$info$info2",url('index/appointment/show_arrive'));

    }

    function test(){
    //     echo "<pre>";
    // var_dump($_SERVER);
    // // var_dump($str);
    // echo "</pre>";
        $info[0]=Db::table('mariah_appointment_info')->select();
        $info[1]=$info[0];
        echo "<pre>";
        var_dump($info);
        echo "</pre>";
        $info=json_encode($info);
        $info.=".";
        $info=json_decode($info);
        var_dump($info);
    }

}
