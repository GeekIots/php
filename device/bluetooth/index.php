<?php
include $_SERVER['DOCUMENT_ROOT']."/public/header.php";
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

	<ul id="myTab" class="nav nav-tabs">
		<li class="active">
			<a href="#config1" data-toggle="tab" style="font-size: 25px;">配置1</a>
		</li>
		<li>
			<a href="#config2" data-toggle="tab" style="font-size: 25px;">配置2</a>
		</li>
		<li>
			<a href="#config3" data-toggle="tab" style="font-size: 25px;">配置3</a>
		</li>
	</ul>

	<div id="myTabContent" class="tab-content">
		<div class="tab-pane fade in active" id="config1">
			<p style="font-size: 25px;"> </p>
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
					    <td><input type='text' id='a1$i' style='width:95%;height:90%;'></td>
					    <td><input type='text' id='b1$i' style='width:95%;height:90%;'></td>
					    <td><input type='text' id='c1$i' style='width:95%;height:90%;'></td>
					    <td><img id='img1$i' src='http://www.easyicon.net/api/resizeApi.php?id=1206083&size=128' style='width: 95%;height:auto; '></td>
					    <td><input type='text' id='e1$i' style='width:95%;height:90%;'></td>
					  </tr>";
			  }
			  ?>
			</table>
			<div style="text-align: center;">
				<button id="upload1" class="btn btn-default" style="width: 15%;height: auto;font-size: 30px;margin-top: 3%;">上传到服务器</button>
			</div>
		</div>
		<div class="tab-pane fade" id="config2">
			<p style="font-size: 25px;"> </p>
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
					    <td><input type='text' id='a2$i' style='width:95%;height:90%;'></td>
					    <td><input type='text' id='b2$i' style='width:95%;height:90%;'></td>
					    <td><input type='text' id='c2$i' style='width:95%;height:90%;'></td>
					    <td><img id='img2$i' src='http://www.easyicon.net/api/resizeApi.php?id=1206083&size=128' style='width: 95%;height:auto; '></td>
					    <td><input type='text' id='e2$i' style='width:95%;height:90%;'></td>
					  </tr>";
			  }
			  ?>
			</table>
			<div style="text-align: center;">
				<button id="upload2" class="btn btn-default" style="width: 15%;height: auto;font-size: 30px;margin-top: 3%;">上传到服务器</button>
			</div>
		</div>
		<div class="tab-pane fade" id="config3">
			<p style="font-size: 25px;"> </p>
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
					    <td><input type='text' id='a3$i' style='width:95%;height:90%;'></td>
					    <td><input type='text' id='b3$i' style='width:95%;height:90%;'></td>
					    <td><input type='text' id='c3$i' style='width:95%;height:90%;'></td>
					    <td><img id='img3$i' src='http://www.easyicon.net/api/resizeApi.php?id=1206083&size=128' style='width: 95%;height:auto; '></td>
					    <td><input type='text' id='e3$i' style='width:95%;height:90%;'></td>
					  </tr>";
			  }
			  ?>
			</table>
			<div style="text-align: center;">
				<button id="upload3" class="btn btn-default" style="width: 15%;height: auto;font-size: 30px;margin-top: 3%;">上传到服务器</button>
			</div>
		</div>
	</div>
</main>
	
</body>
</html>
<script type="text/javascript">
	// console.log(JSON.stringify(item));
	
    var item1,item2,item3;
	$(document).ready(function(){
	    //获取遥控器界面参数
		$.ajax({
		url: "fun.php?type=get&num=1",
		// cache:false,
		// data: '',
		success: function (argument) {
			console.log(argument);
		},
		error:function (argument) {
			console.log(argument);
		}
		});
		$.ajax({
		url: "fun.php?type=get&num=2",
		// cache:false,
		// data: '',
		success: function (argument) {
			console.log(argument);
		},
		error:function (argument) {
			console.log(argument);
		}
		});
		$.ajax({
		url: "fun.php?type=get&num=3",
		// cache:false,
		// data: '',
		success: function (argument) {
			console.log(argument);
		},
		error:function (argument) {
			console.log(argument);
		}
		});
	})

	//图片链接变化时赋给预览图
	$('[id^="e"]').bind("change",function(){
		//打印引起事件的标签信息
  		// console.log('change:', this);
  		//打印ID号
  		// console.log('change:', $(this).attr('id'));
  		var imgid = $(this).attr('id').replace('e','#img');
  		//将当前值赋给预览框
  		 $(imgid).attr("src",$(this).val());
	});	

	//上传到服务器
	$('[id^="upload"]').click(function(){
		console.log('开始上传');
		var id = $(this).attr('id').replace('upload','');

		$.ajax({
		url: "fun.php",
		// cache:false,
		data: JSON.stringify(item),
		success: function (argument) {
			console.log(argument);
		},
		error:function (argument) {
			console.log(argument);
		}
		});
	});



</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/footer.php';?>
