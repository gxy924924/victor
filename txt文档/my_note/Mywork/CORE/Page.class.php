<?php
class Page{
	public $pagenow=1;//当前页
	public $listrows=12;//每页显示行数
	public $totalrows=1;//总行数
	public $totalpages;//分页总页面数
	public $rollpage=11;//分页栏中显示的页数
	public $p="p";	//当前页标识
	public $url="./";

	// 分页显示定制
    private $config  = array(
        'header' => '<span class="rows">共 %TOTAL_ROW% 条记录</span>',
        'prev'   => '<<',
        'next'   => '>>',
        'first'  => '1...',
        'last'   => '...%TOTAL_PAGE%',
        'theme'  => '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%',
    );
	
	//构造函数（自动计算总页数）
	function __construct($totalrows,$listrows){
		$this->totalrows=$totalrows;												// 获取总行数
		$this->listrows=$listrows;													//获取每页显示行数
		$this->totalpages=ceil($totalrows/$listrows);
		$this->pagenow    = empty($_GET[$this->p]) ? 1 : intval($_GET[$this->p]);	//从get获取pagenow信息
        $this->pagenow    = $this->pagenow>0 ? $this->pagenow : 1;					//防止0和负数的pagenow错误
		$this->pagenow    = $this->pagenow<=$this->totalpages ? $this->pagenow : $this->totalpages;					//防止当前页超出正常值
	}

	//获取url
	function url_set($url){
		$this->url=$url;
	}
	
	function href_get($page){
		return $href=$this->url."&".$this->p."=".$page ;
	}

	//显示分页
	function show(){
		if($this->totalpages == 1) return '';
		$rollpage_center=ceil($this->rollpage/2);
		$the_first = '';
		$the_end = '';
		//根据总页数判断是否需要加。。。的情况
		if($this->totalpages > $this->rollpage){
		//第一页
			$url=self::href_get(1);
			if(($this->pagenow - $rollpage_center) >= 1){
				$the_first = '<a class="first" href="'.$url.'">' . $this->config['first'] . '</a>';
			}

		//最后一页
			$url=self::href_get( $this->totalpages);
			if(($this->pagenow + $rollpage_center) < $this->totalpages){
				$the_end = '<a class="end" href="'.$url.'">' . $this->config['last'] . '</a>';
			}
		}

		 //上十页
        $up_row  = $this->pagenow - 10;
		$url=self::href_get($up_row);
        $up_page = $up_row > 0 ? '<a class="prev" href="'.$url.'">' . $this->config['prev'] . '</a>' : '';

        //下十页
        $down_row  = $this->pagenow + 10;
		$url=self::href_get($down_row);
        $down_page = ($down_row <= $this->totalpages) ? '<a class="next" href="'.$url.'">' . $this->config['next'] . '</a>' : '';

		//数字连接（中间的链接的页）
        $link_page = "";
        for($i = 1; $i <= $this->rollpage; $i++){
			if(($this->pagenow - $rollpage_center) <= 0 ){
				$page = $i;
			}else if(($this->totalpages - $this->pagenow)<=($rollpage_center - 1)){
				$page = $this->totalpages - $this->rollpage + $i;
			}else{
				$page = $this->pagenow - $rollpage_center + $i;
			}
			if($page > 0 && $page <= $this->totalpages){	//将多余的部分舍去
				if($page != $this->pagenow){	//将当前页摘出来
					$url=self::href_get($page);
					$link_page .= '<a class="num" href="'.$url.'">' . $page . '</a> ';
				}else{
					if($this->totalpages != 1){
						$link_page .= '<span class="current">' . $page . '</span> ';
					}
				}
			}
        }

		//替换分页内容
        $page_str = str_replace(
            array('%HEADER%', '%NOW_PAGE%', '%UP_PAGE%', '%DOWN_PAGE%', '%FIRST%', '%LINK_PAGE%', '%END%', '%TOTAL_ROW%', '%TOTAL_PAGE%'),
            array($this->config['header'], $this->pagenow, $up_page, $down_page, $the_first, $link_page, $the_end, $this->totalrows, $this->totalpages),
            $this->config['theme']);
        return "<div>{$page_str}</div>";
	}

}
?>