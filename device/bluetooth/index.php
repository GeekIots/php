<?php
include $_SERVER['DOCUMENT_ROOT']."/public/header.php";
//phpinfo();
if(!$_SESSION['login'])
{
	//跳转到登录界面
	echo '<script>window.location = "../../accut/login.php";</script>'; 
	exit;
}
else
{
	$userid = $_SESSION['login'];
}
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
			    <th style="width: 10%">显示/隐藏</th>
			  </tr>
			  <?php 
			  for ($i=0; $i < 12; $i++) { 
			  	echo "<tr>
					    <td>$i</td>
					    <td><input type='text' id='1-1-$i' style='width:95%;height:90%;'></td>
					    <td><input type='text' id='1-2-$i' style='width:95%;height:90%;'></td>
					    <td><input type='text' id='1-3-$i' style='width:95%;height:90%;'></td>
					    <td><img id='1-4-$i' style='width: 95%;height:auto; '></td>
					    <td><input type='text' id='1-5-$i' style='width:95%;height:90%;'></td>
					    <td><input type='checkbox' id='1-6-$i' checked='checked' style='width: 20%;height: 100%'/></td>
					  </tr>";
			  }
			  ?>
			</table>
			<div style="text-align: center;">
				<button id="upload1" class="btn btn-default _button" >上传到服务器</button>
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
			    <th style="width: 10%">显示/隐藏</th>
			  </tr>
			  <?php 
			  for ($i=0; $i < 12; $i++) { 
			  	echo "<tr>
					    <td>$i</td>
					    <td><input type='text' id='2-1-$i' style='width:95%;height:90%;'></td>
					    <td><input type='text' id='2-2-$i' style='width:95%;height:90%;'></td>
					    <td><input type='text' id='2-3-$i' style='width:95%;height:90%;'></td>
					    <td><img id='2-4-$i' style='width: 95%;height:auto; '></td>
					    <td><input type='text' id='2-5-$i' style='width:95%;height:90%;'></td>
					    <td><input type='checkbox' id='2-6-$i' checked='checked' style='width: 20%;height: 100%'/></td>
					  </tr>";
			  }
			  ?>
			</table>
			<div style="text-align: center;">
				<button id="upload2" class="btn btn-default _button">上传到服务器</button>
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
			    <th style="width: 10%">显示/隐藏</th>
			  </tr>
			  <?php 
			  for ($i=0; $i < 12; $i++) { 
			  	echo "<tr>
					   <td>$i</td>
					    <td><input type='text' id='3-1-$i' style='width:95%;height:90%;'></td>
					    <td><input type='text' id='3-2-$i' style='width:95%;height:90%;'></td>
					    <td><input type='text' id='3-3-$i' style='width:95%;height:90%;'></td>
					    <td><img id='3-4-$i' style='width: 95%;height:auto; '></td>
					    <td><input type='text' id='3-5-$i' style='width:95%;height:90%;'></td>
					    <td><input type='checkbox' id='3-6-$i' checked='checked' style='width: 20%;height: 100%'/></td>
					  </tr>";
			  }
			  ?>
			</table>
			<div style="text-align: center;">
				<button id="upload3" class="btn btn-default _button">上传到服务器</button>
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
		url: "fun.php?type=get&num=1&userid=<?php echo $userid; ?>",
		success: function (argument) {
			console.log(argument);
			// 将json字符串转换为json对象
			item1=JSON.parse(argument.item[0]);
			// 将拉取的数据显示到页面
			for (var i = 12 - 1; i >= 0; i--) {
				$("#1-1-"+i.toString()).val(item1[i].name);
				$("#1-2-"+i.toString()).val(item1[i].down);
				$("#1-3-"+i.toString()).val(item1[i].up);
				$("#1-5-"+i.toString()).val(item1[i].icon);
				$("#1-6-"+i.toString()).attr("checked",item1[i].show);
				$("#1-4-"+i.toString()).attr("src",item1[i].icon);
			}
		},
		error:function (argument) {
			console.log(argument);
		}
		});
		$.ajax({
		url: "fun.php?type=get&num=2&userid=<?php echo $userid; ?>",
		success: function (argument) {
			console.log(argument);
			// 将json字符串转换为json对象
			item2=JSON.parse(argument.item[0]);
			// 将拉取的数据显示到页面
			for (var i = 12 - 1; i >= 0; i--) {
				$("#2-1-"+i.toString()).val(item2[i].name);
				$("#2-2-"+i.toString()).val(item2[i].down);
				$("#2-3-"+i.toString()).val(item2[i].up);
				$("#2-5-"+i.toString()).val(item2[i].icon);
				$("#2-6-"+i.toString()).attr("checked",item2[i].show);
				$("#2-4-"+i.toString()).attr("src",item2[i].icon);
			}
		},
		error:function (argument) {
			console.log(argument);
		}
		});
		$.ajax({
		url: "fun.php?type=get&num=3&userid=<?php echo $userid; ?>",
		success: function (argument) {
			console.log(argument);
			// 将json字符串转换为json对象
			item3=JSON.parse(argument.item[0]);
			// 将拉取的数据显示到页面
			for (var i = 12 - 1; i >= 0; i--) {
				$("#3-1-"+i.toString()).val(item3[i].name);
				$("#3-2-"+i.toString()).val(item3[i].down);
				$("#3-3-"+i.toString()).val(item3[i].up);
				$("#3-5-"+i.toString()).val(item3[i].icon);
				$("#3-6-"+i.toString()).attr("checked",item3[i].show);
				$("#3-4-"+i.toString()).attr("src",item3[i].icon);
			}
		},
		error:function (argument) {
			console.log(argument);
		}
		});
	})

	//所有的input引起的变化
	$(":input").bind("change",function(){
		//打印引起事件的标签信息
  		console.log('change:', this);
  		var arr = $(this).attr('id').split('-');
		console.log('configID:', arr[0]);
		console.log('列:', arr[1]);
		console.log('行号:', arr[2]);
  		
  		switch(arr[1])
  		{
  			case '1'://name
				eval('item' + arr[0])[arr[2]].name = $(this).val();
  				break;
			case '2'://down
				eval('item' + arr[0])[arr[2]].down = $(this).val();
  				break;
  			case '3'://up
				eval('item' + arr[0])[arr[2]].up = $(this).val();
  				break;
			
  			case '5'://icon
				eval('item' + arr[0])[arr[2]].icon = $(this).val();
				//更新显示图片
				var id = '#'+arr[0]+'-4-'+arr[2];
				console.log(id);
				$(id).attr("src",$(this).val());
  				break;
  			case '6'://show
				eval('item' + arr[0])[arr[2]].show = $(this).prop('checked');
				break;
  		}
		// console.log('1:',item1);
		// console.log('2:',item2);
		// console.log('3:',item3);
	});	

	//上传到服务器
	$('[id^="upload"]').click(function(){
		console.log('开始上传');
		var id = $(this).attr('id').replace('upload','');
		var item;	 
		if (id==1) {
			item = item1;
		}
		else
		if (id==2) {
			item = item2;
		}
		else
		if (id==3) {
			item = item3;	
		}
		var str = JSON.stringify(item);
		// console.log(str);
		$.ajax({
		url: "fun.php?type=set&num="+id+"&userid=<?php echo $userid; ?>",
		data:{"str":str},//数据长度太长，放到data里面传送
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
