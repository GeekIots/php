<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<!-- 引入 Bootstrap -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>  
<body>
	<script id="moduel" type="text/html">
		<main class="contain">
        <!--显示到列表-->
		  <h2>设备管理</h2>
		  <div>
		  	<a class="btn btn-default" href="add.switch.php">添加开关</a>
		  	<a class="btn btn-default" href="add.sensor.php">添加传感器</a>
			<a class="btn btn-default" href="device.php">返回</a>
		  </div>
		  <br \>&nbsp;
		  <!--<p>查看和管理您的设备！</p>-->           
		  <h4>我的开关</h4>	
		  <div>
		  	<table class="table table-striped  table-hover">
		      <tr>
		        <th style="width: 30px">ID1</th>
		        <th style="width: 30px">名称</th>
		        <th style="width: 30px">状态</th>
		        <th style="width: 30px">图片</th>
		        <th style="width: 30px">开指令</th>
		        <th style="width: 30px">关指令</th>
		        <th style="width: 30px">热度</th>
		        <th style="width: 30px">更改</th>
		        <th style="width: 30px">删除</th>
		      </tr>
		      {{#  layui.each(switchlist.list, function(index, item){ }}
				<tr>
	    		<td>{{item.id}}</td>
	    		<td>{{item.name}}</td>
	    		<td>{{item.state}}</td>
	    		<td><img src='{{item.pic}}' style='width: 50px;width: 50px;border-radius:5px; '></td>
	    		<td>{{item.opencmd}}</td>
	    		<td>{{item.closecmd}}</td>
	    		<td>{{item.heat}}</td>
	    		<td><a href='update.switch.php?id={{item.id}}'>更改</a></td>
	    		<td><a href='delete.switch.php?id={{item.id}}'>删除</a></td>
	    		</tr>
		     {{#  }); }}
		  </table>
		  </div>
		  <br>
		  <h4>传感器类设备</h4>		  
		  <table class="table table-striped  table-hover">
		    <thead>
		      <tr>
		        <th>ID</th>
		        <th>名称</th>
		        <th>类型</th>
		        <th>图片</th>
		        <th>数据</th>
		        <th>更改</th>
		        <th>删除</th>
		      </tr>
		    </thead>
		    <tbody>
		      {{#  layui.each(sensorlist.list, function(index, item){ }}
	    		<tr>
	    		<td>{{item.id}}</td>
	    		<td>{{item.name}}</td>
	    		<td>{{item.type}}</td>
	    		<td><img src='{{item.pic}}' style='width: 50px;width: 50px;border-radius:5px; '></td>
	    		<td>{{item.data}}</td>
				<td><a href="update.sensor.php?id={{item.id}}">更改</a></td>
				<td><a href="delete.sensor.php?id={{item.id}}">删除</a></td>
				</tr>
			  {{#  }); }}
		    </tbody>
		  </table>
    </main>
	</script>
	<!-- 建立视图。用于呈现模板渲染结果。 -->
	<div id="view"></div>
</body>
</html>
<?php include $_SERVER ['DOCUMENT_ROOT']."/common/footer.php";?>

<script>
  // 开关列表
  var switchlist;
  var sensorlist;
  // 获取列表
  $.ajax({
    type:'GET',
    url: "/api/device/device.php",
    data:{"device":'switch',"type":'getlist',"userid":user_d.userid},
    success: function (res) {
      switchlist  = res;
      console.log('switchlist:',res);
    },
    error:function (res) {
      console.log('fail:',res);
    }
  });

  $.ajax({
    type:'GET',
    url: "/api/device/device.php",
    data:{"device":'sensor',"type":'getlist',"userid":user_d.userid},
    success: function (res) {
      sensorlist  = res;
      console.log('sensorlist:',res);
    },
    error:function (res) {
      console.log('fail:',res);
    }
  });

  //渲染数据
  var getTpl = moduel.innerHTML;
  var view = document.getElementById('view');
  laytpl(getTpl).render(switchlist, function(html){
    view.innerHTML = html;
  });
</script>