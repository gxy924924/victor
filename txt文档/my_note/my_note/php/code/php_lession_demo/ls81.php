<!--php-->
<?php
//返回自从 Unix 纪元（格林威治时间 1970 年 1 月 1 日 00:00:00）到当前时间的秒数。
echo time();
//设置时区
date_default_timezone_set('Asia/Shanghai');
//date — 格式化一个本地时间／日期
echo date("Y年m月d日 G:i:s");
?>

