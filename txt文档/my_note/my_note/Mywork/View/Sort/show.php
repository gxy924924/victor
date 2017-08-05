<html>
<head>
<meta charset="utf-8">
<title></title>
<script src="./Public/jquery-1.4.2/jquery.js"></script>
<style>
#main{
	border:1px solid #ccc;
	width:500px;
	margin-top:100px;
}
</style>
</head>
<body>
<center>
	<div id="main">
		<div id="">
		<select name="" id="s1"> 
			<?php foreach($this->rows as $key=>$val): ?>
				<option value="<?=$val["child_key"]?>"><?=$val["child_key"]?></option>
			<?php endforeach; ?>
		</select>
		
		<select name="" id="s2">
			<?php foreach($this->rows2 as $key=>$val): ?>
				<option value="<?=$val["child_key"]?>"><?=$val["child_key"]?></option>
			<?php endforeach; ?>
		</select>
		</div>
	</div>
</center>

</body>
<script>
$("#s1").change(function(){
	var s1_v=$(this).val();
	$("#s2").empty();
	$.post("<?=U_PATH?>?c=Sort&v=change_sort",{parent_key:s1_v},function(data){
		//alert(data+data.length);
		var obj = eval('('+data+')');
		var key_length=obj["child_key"].length;
		//alert(obj["child_key"][0]);
		for(var i=0;i<key_length;i++){
			//alert(obj["child_key"][i]);
			var html="<option value="+obj["child_key"][i]+">"+obj["child_key"][i]+"</option>";
			$("#s2").append(html);

		}
	});
});
</script>
</html>