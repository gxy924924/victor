keyword 说明
用途：以下文件用于从数据库抽取seo关键词并拼装成图片和相关链接
文件：	必要|	get_url.php 				//主文件
			|	sqlHelper.class.php 		//数据库操作工具

		附件|	key.sql 					//数据库文件

使用：	1.必要文件要在同一目录下，
		2.数据库要在key（数据库名）下导入key.sql
		3.访问链接：如 xxx/get_url.php?keyword=inflatable&rand=1&num=10
				//这里如果不传get值，则默认	keyword=inflatable
											rand=1
											num=10
				//	keyword=inflatable 		//关键字 默认是inflatable
					rand=1   				//是否随机 1为是， 2为否
					num=10 					//传入图片链接的数量



get_url 内部重要方法说明：
	keyword_url_get()  				//获取关键字的图片的url
									//内部传入的get（keyword rand num）
									//默认会根据是否有数据库信息来决定是否从网上抓取图片

	about_keyword_url_get()  		//获取关键字的相关关键字
									//内部传入的get（rand）

	put_key_file($filename,$file)	//导入关键字文件的方法，关键字文件应为*.txt
									//filename是文件名，不要带 .txt
									//file是文件的相对路径，如果在本文件目录下可以不填