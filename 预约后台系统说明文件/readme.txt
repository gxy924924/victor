目录说明：
application：	应用文件入口
public： 		公共文件位置

->文件列表：
application： 
	index	|index.php 			//入口文件
			|login.php 			//登录文件
			|base.php 			//后台权限管理等功能底层模块(其它index文件继承它)
			|auth.php 			//权限模块
			|appointment.php 	//预约模块
			|article.php 		//文章管理模块
			|coupons.php 		//折扣券和推广码模块
			|privicy.php 		//隐私单页面
			|user.php 			//管理员用户模块


	api 	|coupons.php 		//折扣券接口文件
			|notification 		//通知，文章接口文件


->文件说明
	//所有继承了base的文件都会经过权限管理，包括登录认证 和 目录权限认证，无权限则会自动回跳到主页
	//所有的控制器名 都有对应的增删改的工具方法（只要有增删改）（add del update）

\public：公共文件
 		\public\sorand\
 			title.html		//引入文件包
 			left.html		//左边栏
 			header.html 	//顶部栏

--》\application\index\
index.php:入口文件
			index_do() 		//获取当天共有多少人预约、到达、未到


login.php:登录管理
			login_do() 		//进行账号密码验证，并获取用户权限信息
			login_out() 	//清除session并退出


base.php: 基础模块管理	
			__construct() 		//每次访问页面的时候进行权限验证	
			check_auth()		//检查路径权限
			add_cookie_time() 	//延长缓存时间
							（离上次缓存时间5min-60min 更新缓存时间为 60min）
			log_save() 			//在满足路径条件（增删改）时存储一次操作日志
			info_access() 		//额外权限获取（查看客户信息等）	
			createCode()		//根据给予的条件获得加密码（邀请码和折扣券用）
			get_decode() 		//根据给予的条件将加密码进行解码


auth.php:权限目录的管理
关键词：
level：			auth_level user_level_update 	
					//等级权限管理（设定某一等级的权限）（用户具有等级属性）

url:			auth_url update_url 			
					//目录权限的显示和更新的显示页（更改单条目录的分组在这里）

sort:			auth_sort update_sort 			
					//对 分过组 的权限进行分类，以便控制

group:			auth_group update_group 		
					//权限组的设定

				show_log  		 	 			
					//显示日志


appointment: 预约管理
关键词：
appo_time:		show_appo_type show_update_appo_type
					//显示、修改预约类型（如qq）界面
appointment:	appointment_add 
					//添加预约
				appointment_info
					//查看预约信息
				appointment_update
					//更新预约界面
detail:			appoint_detail show_detail
					//显示、更新下详细内容
arrive:			show_arrive
					//显示用户到达
after_sale:		after_sale_add
					//添加售后


article.php :文章管理
关键词：
hot_production		show_hot_production show_update_hot_production
						//显示、更新热点产品界面
notification		show_notification show_update_notification
						//通知消息界面
sort				show_update_sort
						//文章分类管理
article/title		show_article show_update_title
						//显示文章（标题模块）
content				show_content show_update_content
						//显示、更改内容（段落）
img/file			img_upload del_file
						//文件的上传与下载（服务器本地）


coupons.php:折扣券和推广码
	//折扣券的单条券码是没有设定时限的，如需时限，要另行设定
关键词：
					show_spread
						//显示推广码（推广码是固定的相当于进行加密的用户id）
discount/coupons	show_discount
						//显示折扣券码包
pool				show_pool
						//券码池
					get_one_coupon
						//给它一个get['id'](券码包的id)和get['user_id'](用户id)
						//他会自动给相应的用户抽一条这个券码包的券



user.php:管理员用户模块
关键词：
user 				select_user add_user update_user
						//显示用户的增，查，改的界面
user_detail			user_detail	
						//显示用户详细信息（其中有所属店铺设定，跟权限挂钩）
					update_level
					 	//直接设定用户的权限等级



privicy.php:隐私单页面
	//app专用隐私说明页面



--》\application\api：
coupons.php ：折扣券接口文件
				show_spread 
					//显示推广码和他邀请过得用户 需用户id
				spread_check
					//显示用户是否填过邀请码 需用户id
				input_spread
					//输入邀请码 被邀请
				get_coupons	
					//查看用户拥有的邀请码
				sql_code_add
					//添加一条券码（工具）（input_spread 使用）
				generate_coupons
					//生成一条券码（工具）（input_spread 使用）



notification ：通知，文章接口文件

				show_hot_production
					//热门项目接口
				show_title
					//显示文章标题
				user_watch
					//用户是否有未看通知接口
				notification_watch
					//用户查看通知