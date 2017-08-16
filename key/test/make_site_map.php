<?php 
// header("Content-type: text/xml");
define('TITLE_URL','http://slidecityinflatables.com/');

//从数据库获取关键字并将关键字整理成二维数组（每块100url）
function get_key_info(){
	require_once "sqlHelper.class.php";
	$sql=new sqlHelper('key');
	$keyword=$sql->settable('keyword_newkey_table')->select();
	$arr=[];
	$i=1;
	$k=0;
	foreach ($keyword as $key => $val) {
		$i++;
		$keyword_info_url=str_replace(" ", "+", $val['keyword']);
		$arr[$k][$i]=TITLE_URL.$keyword_info_url;
		if($i==100){
			$k++;
			$i=1;
		}
	}
	return $arr;
}

//二级xml的时间组装
function time_maker($time){
	$time=$time+rand(1,86400);
	$date=date('Y-m-d',$time);
	$hour_t=date('H:i:s',$time);
	$date_time=$date."T".$hour_t."+00:00";
	return $date_time;
}

//xml中内容规则处理
function xml_rule_make($val){
	$val=str_replace('&', '&amp;', $val);
	$val=str_replace('<', '&lt;', $val);
	$val=str_replace('>', '&gt;', $val);
	return $val;
}

//单块url的xml组装
function xml_one_make($time,$site=""){
	$date_time=time_maker($time);
	$body_header='<url>
	<loc>'.$site;
	$body_body='</loc>
	<lastmod>'.$date_time;
		$body_footer='</lastmod>
		<changefreq>monthly</changefreq>
		<priority>0.7</priority>
	</url>
	';
	$body=$body_header.$body_body.$body_footer;
	return $body;
}

//第二级xml组装，将单块的关键字转变成xml文件，并返回文件相关的url
function second_xml_maker($arr="",$time){
	$title='<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:n="http://www.google.com/schemas/sitemap-news/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd">';
	$footer='</urlset>';
	$body="";
	foreach ($arr as $key => $val) {
		$val=xml_rule_make($val);
		$body.=xml_one_make($time,$val);
	}
	$xml=$title.$body.$footer;
	$file="./sitemap/".date("Y-m-d",$time).".xml";
	file_put_contents($file,$xml);
	// echo $xml;
}

//单块url的xml组装
function main_xml_one_make($time){
	$get_info=date("\y\y\y\y=Y&\m\m=m&\d\d=d",$time);
	$site=TITLE_URL."sitemap.xml?".$get_info;
	$site=xml_rule_make($site);
	
	$body_header='<sitemap>
	<loc>'.$site;
	$body_body='</loc>
</sitemap>
	';
	$body=$body_header.$body_body;
	return $body;
}

//生成sitemap.xml文件
function main_xml_maker(){
	$arr=get_key_info();
	$time=strtotime(date('Y-m-d'));
	$minus=24*60*60;
	$title='<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	$footer='</sitemapindex>';
	$body="";
	foreach ($arr as $key => $val) {
		$body.=main_xml_one_make($time);
		second_xml_maker($val,$time);
		$time=$time-$minus;
	}
	$xml=$title.$body.$footer;
	$file="sitemap.xml";
	file_put_contents($file,$xml);
	// echo $xml;
}

//
function main_xml_do(){
	main_xml_maker();
}

main_xml_do();

?>
<a href="sitemap.xml">sitemap</a>