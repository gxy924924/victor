<?php
    class FenYePage{
        public $pageSize;//每页表单数
        public $pageCount;//总计共几页
        public $res;
        public $rowCount;//总计表单数，这个变量值，要从数据库的表获取
        public $pageNow;//显示第几页，这个是一个变量（用户指定）
        public $naviagtor;
        public $gotoUrl;//表示把分页跳转到相应的页面
    }
?>