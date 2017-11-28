<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>设备管理 | 极客物联网</title>
  <meta charset="utf-8">
  <meta name="keywords" content="物联网">
  <!-- vue -->
  <script src="https://cdn.bootcss.com/vue/2.5.3/vue.js"></script>
  <!-- layui -->
  <link rel="stylesheet" href="/frame/layui-master/src/css/layui.css">
  <link rel="stylesheet" href="/frame/layui-master/src/css/gloabal/global.css">
  <script src="/frame/layui-master/src/layui.js"></script>
  <!-- QQ登录 -->
  <script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js"></script>
  <!-- 自定义函数 -->
  <script src="/common/fun.js"></script>
</head>
<body style="background: white;padding-top: 10px">
  <?php require($_SERVER['DOCUMENT_ROOT'].'/common/header.php'); ?>
  <div id="app">
	<main v-if="user.login=='true'" style="padding-left: 60px;padding-right: 60px;" >
		    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
			  <legend>设备管理 - 开关</legend>
			</fieldset>
		  	<table class="layui-table lay-skin='line' lay-size='lg' ">
		  	  <thead>
			      <tr>
			        <th style="width: 30px">ID</th>
			        <th style="width: 30px">名称</th>
			        <th style="width: 30px">状态</th>
			        <th style="width: 30px">图片</th>
			        <th style="width: 30px">开指令</th>
			        <th style="width: 30px">关指令</th>
			        <th style="width: 30px">热度</th>
			        <th style="width: 30px">更改</th>
			        <th style="width: 30px">删除</th>
			      </tr>
		      </thead>
		      <tbody>
		      	<template v-for="item in switchlist.list">
		    	  <tr>
		    		<td>{{item.id}}</td>
		    		<td>{{item.name}}</td>
		    		<td>{{item.state}}</td>
		    		<td><img :src='item.pic' onerror="javascript:this.src='/image/default/error.jpg';" style='width: 50px;width: 50px;border-radius:5px; '></td>
		    		<td>{{item.opencmd}}</td>
		    		<td>{{item.closecmd}}</td>
		    		<td>{{item.heat}}</td>
		    		<td><a class="layui-btn layui-btn-warm" :href="'update.switch.php?id='+item.id">更改</a></td>
		    		<td><a class="layui-btn layui-btn-danger" :href="'delete.switch.php?id='+item.id">删除</a></td>
	    		  </tr>
		      	</template>
		      </tbody>
		  </table>
		  
		  <div style="text-align: right;padding-top: 30px;">
		  	<a class="layui-btn" href="device.php"> 控制开关 </a>
		  	<a class="layui-btn" href="add.switch.php"> 添加开关 </a>
			<a class="layui-btn layui-btn-normal" href="/index.php">首页</a>
		  </div>

		    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
			  <legend>设备管理 - 传感器</legend>
			</fieldset>	  
		  <table class="layui-table">
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
		    	<template v-for="item in sensorlist.list">
		    	  <tr>
					<td>{{item.id}}</td>
		    		<td>{{item.name}}</td>
		    		<td>{{item.type}}</td>
		    		<td><img :src='item.pic' onerror="javascript:this.src='/image/default/error.jpg';" style='width: 50px;width: 50px;border-radius:5px; '></td>
		    		<td>{{item.data}}</td>
		    		<td><a class="layui-btn layui-btn-warm" :href="'update.sensor.php?id='+item.id">更改</a></td>
		    		<td><a class="layui-btn layui-btn-danger" :href="'delete.sensor.php?id='+item.id">删除</a></td>
	    		  </tr>
		      	</template>
		    </tbody>
		</table>
		 <div style="text-align: right;padding-top: 30px;">
		  	<a class="layui-btn" href="add.sensor.php">添加传感器</a>
			<a class="layui-btn layui-btn-normal" href="/index.php">首页</a>
		  </div>
		<br>
	</main>
  </div>
</body>
</html>
<?php include $_SERVER ['DOCUMENT_ROOT']."/common/footer.php";?>

<script>
  // 开关列表
  var switchlist;
  var sensorlist;
  layui.use(['layer','laydate','laypage','laytpl','layedit','form','upload','tree','table','element','util','flow','carousel','code','jquery'], function(){
    var layer,laydate,laypage,laytpl,layim,layedit,form,upload,tree,table,element,util,flow,carousel,code,$,mobile;
    layer = layui.layer;
    laydate = layui.laydate;
    laypage = layui.laypage;
    laytpl = layui.laytpl;
    layedit = layui.layedit;
    form = layui.form;
    upload = layui.upload;
    tree = layui.tree;
    table = layui.table;
    element = layui.element;
    util = layui.util;
    flow = layui.flow;
    carousel = layui.carousel;
    code = layui.code;
    $  = layui.jquery;

  	if (user.login=='false') {
  	 //公告层
      layer.open({
        type: 1
        ,title: false //不显示标题栏
        ,closeBtn: false
        ,area: '300px;'
        ,shade: 0.8
        ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
        ,btn: ['前去登陆', '看看再说']
        ,btnAlign: 'c'
        ,moveType: 1 //拖拽模式，0或者1
        ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 400;">亲,进入设备管理需要登陆哦！</div>'
        ,success: function(layero){
          var btn = layero.find('.layui-layer-btn');
          btn.find('.layui-layer-btn0').attr({
            href: '/user/login.php'
            ,target: '_blank'
          });
          btn.find('.layui-layer-btn1').attr({
            href: '/index.php'
          });
        }
      });
  }
  // 获取列表
  $.ajax({
    type:'GET',
    async: false, //同步
    url: "/api/device/device.php",
    data:{"device":'switch',"type":'getlist',"userid":user.userid},
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
    async: false, //同步
    url: "/api/device/device.php",
    data:{"device":'sensor',"type":'getlist',"userid":user.userid},
    success: function (res) {
      sensorlist  = res;
      console.log('sensorlist:',res);
    },
    error:function (res) {
      console.log('fail:',res);
    }
  });

 	new Vue({
	el: '#app',
	  data: {
	  	user:user,
	    switchlist: switchlist,
	    sensorlist:sensorlist
	  }
	}) 
  });
</script>