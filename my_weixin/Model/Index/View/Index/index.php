<!doctype html>
<html>
<head>
<?php require_once VIEW_PATH."Index/title.php"; ?>
<title>快乐之鱼的个人网站</title>
	<style>
		body{
		}
		#mytitle{
			height: 55px;
		}
		.container{
			/*border: 1px solid #ccc;*/
		}
		.carousel{
			width: 1170px;
		}

		#mycarousel1,.carousel{
			height: auto;
		}
		#mycarousel1{
			padding: 0px;
			margin-bottom: 10px;
		}
		.thumbnail{
			margin-bottom: 0px;
		}
		.col-md-6{
			padding-right:0px;
			padding-left: 0px;
			
		}
		.row1{
			margin-left:0px; 
			border: 1px solid #ccc;
		}
		.row{
			padding: 0;
			/*border: 1px solid #000;*/
		}
		.bottom{
			border: 1px solid #ccc;
			padding-top:10px;
			padding-bottom: 10px; 
		}
		.well{
			margin-bottom: 10px;
		}
		.panel-heading{
		}
		.panel-heading h4{
			margin: 0;
		}
		.badge{
			opacity: 0.5;
		}
		@media screen and (max-width: 1170px){
			.carousel{
				width: auto;
			}
		}
	</style>
</head>
<body >
	<?php require_once VIEW_PATH."Index/header.php"; ?>

	<div class="container" id="mycarousel1">
		<div class="carousel slide" id="mycarousel" data-ride="carousel">
			<ul class="carousel-indicators">
				<li class="active" data-target="#mycarousel" data-slide-to="0"></li>
				<li class="" data-target="#mycarousel" data-slide-to="1"></li>
				<li class="" data-target="#mycarousel" data-slide-to="2"></li>
			</ul>

			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img class="thumbnail" src="./Public/image/1.jpg" alt="">
					<div class="carousel-caption">
						first
					</div>
				</div>
				<div class="item">
					<img class="thumbnail" src="./Public/image/2.jpg" alt="">
					<div class="carousel-caption">
						second
					</div>
				</div>
				<div class="item">
					<img class="thumbnail" src="./Public/image/3.jpg" alt="">
					<div class="carousel-caption">
						third
					</div>
				</div>
			</div>

			<a href="#mycarousel" class="left carousel-control" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" ></span>
			</a>
			<a href="#mycarousel" class="right carousel-control" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			</a>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4><?=$this->type1[0]['type_name']?></h4>
					</div>
					<div class="list-group">
						<?php $i=0; foreach ($this->list1 as $val) : $i++;?>
							<a href="<?=U_PATH?>?m=Index&c=List&v=article_show&id=<?=$val['id']?>" class="list-group-item"><?=$val['title']?><span class="badge"><?=$val['addtime']?></span></a>
						<?php endforeach; ?>
						<?php for ($i; $i <5; $i++) :?>
							<a href="" class="list-group-item">暂无内容<span class="badge">year-mounth-date</span></a>
						<?php endfor; ?>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4><?=$this->type2[0]['type_name']?></h4>
					</div>
					<div class="list-group">
						<?php $i=0; foreach ($this->list2 as $val) : $i++;?>
							<a href="<?=U_PATH?>?m=Index&c=List&v=article_show&id=<?=$val['id']?>" class="list-group-item"><?=$val['title']?><span class="badge"><?=$val['addtime']?></span></a>
						<?php endforeach; ?>
						<?php for ($i; $i <5; $i++) :?>
							<a href="" class="list-group-item">暂无内容<span class="badge">year-mounth-date</span></a>
						<?php endfor; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once VIEW_PATH."Index/footer.php"; ?>
	
</body>
<script>
	$(".carousel").carousel();
</script>
</html>
