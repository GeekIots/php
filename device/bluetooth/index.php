<?php
include "../../public/header.php";
//phpinfo();
?>
<!DOCTYPE html>
<html>
<head>
	<title>遥控器设置</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
<main class="contain">
	<table>
	  <tr>
	    <th style="width: 10%">编号</th>
	    <th style="width: 10%">名称</th>
	    <th style="width: 15%">按下指令</th>
	    <th style="width: 15%">抬起指令</th>
	    <th style="width: 10%">预览</th>
	    <th style="width: 20%">链接</th>
	  </tr>
	  <?php 
	  for ($i=0; $i < 12; $i++) { 
	  	echo "<tr>
			    <td>$i</td>
			    <td><input type='text' id='a$i' style='width:95%;height:90%;'></td>
			    <td><input type='text' id='b$i' style='width:95%;height:90%;'></td>
			    <td><input type='text' id='c$i' style='width:95%;height:90%;'></td>
			    <td><img id='img$i' src='http://www.easyicon.net/api/resizeApi.php?id=1206083&size=128' style='width: 95%;height:auto; '></td>
			    <td><input type='text' id='e$i' style='width:95%;height:90%;'></td>
			  </tr>";
	  }
	  ?>
	</table>
</main>
	
</body>
</html>

<script type="text/javascript">
	// 图片链接变化时赋给预览图
	$("#e0").bind("change", function(){ 
		// console.log("msg:%s", $("#e0").val()); 
		$("#img0").attr("src",$("#e0").val());
	});
	$("#e1").bind("change", function(){
		$("#img1").attr("src",$("#e1").val());
	});
	$("#e2").bind("change", function(){ 
		$("#img2").attr("src",$("#e2").val());
	});
	$("#e3").bind("change", function(){ 
		$("#img3").attr("src",$("#e3").val());
	});
	$("#e4").bind("change", function(){ 
		$("#img4").attr("src",$("#e4").val());
	});
	$("#e5").bind("change", function(){ 
		$("#img5").attr("src",$("#e5").val());
	});
	$("#e6").bind("change", function(){ 
		$("#img6").attr("src",$("#e6").val());
	});
	$("#e7").bind("change", function(){ 
		$("#img7").attr("src",$("#e7").val());
	});
	$("#e8").bind("change", function(){ 
		$("#img8").attr("src",$("#e8").val());
	});
	$("#e9").bind("change", function(){ 
		$("#img9").attr("src",$("#e9").val());
	});
	$("#e10").bind("change", function(){ 
		$("#img10").attr("src",$("#e10").val());
	});
	$("#e11").bind("change", function(){ 
		$("#img11").attr("src",$("#e11").val());
	});
</script>
