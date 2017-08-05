<?php 
	//PHP curl函数模拟GET请求
	//1.初始化
	$ch = curl_init();

	$access_token = "aXGDtpxG13yxChBNmPvbJDrdl5fSTnWQeIYBwA5puuMq_r8qKHUc_DxAoTl5C2pYy0aBDXmCHKQcY3WcITJ6OT_aTVwDiTr2x5bHgJTe1l_mHhRhkVstKe8WTCPXyh9-FHZgADAYAS";

	$url = " https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";
	//echo $url."</br>";

	curl_setopt($ch,CURLOPT_URL,$url);//设置请求地址
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//获取的信息以文件流的形式返回
	curl_setopt($ch,CURLOPT_POST,1);//post请求

	$post = '
		{
			"button":[	
				{
					"name":"微官网",
					"sub_button":[
					{
					"type":"view",
					"name":"微官网",
					"url":"http://1.gweixin.applinzi.com/",
                    "sub_button": [ ]
					},
					{
					"type":"view",
					"name":"aaa",
					"url":"http://1.gweixin.applinzi.com/",
                    "sub_button": [ ]
					},
					]
				},
				{
					"type":"click",
					"name":"帮助",
					"key":"news"
				}
			]
		}';//一个一级菜单-->下面可以有三个子菜单
	//echo $post;

	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);		//请求post数据

	$json = curl_exec($ch);

	echo $json;
	//4.释放cURL
	curl_close($ch);

?>