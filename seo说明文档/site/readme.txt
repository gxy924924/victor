site 说明
用途：以下文件用于获取模板文件的信息，将访问的ip记录进入数据库，根据不同的url信息获取不同的文件信息，并输出
文件：	必要|	make_url.php 				//主文件
			|	sqlHelper.class.php 		//数据库操作工具
			|	inflatable.html			 	//显示图片和相关链接的页面
			|	.htaccess 					//rewrite
			|	.check_site_map.php			//获取sitemap文件信息并输出

		附件|	guest_ip_in.sql 			//数据库结构文件

注意：如果有新的网站要加入本模块需要更改check_ip()函数中的session[web_site_id]
	$_SESSION['web_site_id']=1;	//将1改为2,3,4.。。以记录是访问哪个网站的ip

使用：	1.必要文件要在同一目录下，
		2.数据库放在了show_ip 数据库下
		3.访问链接：如 
				~1.直接访问-如：xxx.com/xxx.html会访问这个文件下的html文件
				~2.访问相关图片信息-如：xxx.com/inflatable toy 会访问inflatable.html将获取到的图片及相关链接输出

设置：如果不想要记录ip，则将下面的函数调用注销即可			
//检测进入的ip
check_ip();

