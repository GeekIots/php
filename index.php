<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta name="keywords" content="物联网">
  <title>极客物联网</title>
  <!-- vue -->
  <script src="https://cdn.bootcss.com/vue/2.5.3/vue.js"></script>
  <!-- layui -->
  <link rel="stylesheet" href="/frame/layui-master/src/css/layui.css">
  <link rel="stylesheet" href="/frame/layui-master/src/css/lay-icon.css">
  <link rel="stylesheet" href="/frame/layui-master/src/css/gloabal/global.css">
  <script src="/frame/layui-master/src/layui.js"></script>
  <!-- QQ登录 -->
  <script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js"></script>
  <!-- 自定义函数 -->
  <script src="/common/fun.js"></script>
</head>
<body style="background-color: white;" >
  <?php require($_SERVER['DOCUMENT_ROOT'].'/common/header.php'); ?>
    <div style=" background-color:#23262E ;transform: 0.5;padding-top: 220px; text-align: center;">

	    <h2 style="font-size: 50px;font-family:Arial;color:rgba(255,255,255,0.8); ">快速、高效、跨平台的云平台解决方案</h2>
	    <div id="count" style="color:rgba(255,255,255,0.8); padding-top: 160px;padding-bottom: 50px;">
	    	<div id="count"></div>
	    </div>
	</div>

	<div class="layui-container" style="padding-top: 80px;">   
	  <div class="layui-row" style="line-height: 70px; padding-bottom: 80px;" >
	    <div class="layui-col-md6">
	        <div style="font-size: 24px;color: #0e83cd;font-family:sans-serif;"><i class="layui-icon" style="font-size: 24px; color: #1E9FFF;">&#xe681;</i>&nbsp超快响应速度
	  		</div>
	        <div style="font-size: 16px;font-family:sans-serif;line-height: 30px;padding-right: 60px;padding-left: 40px;text-indent: 2em;">极客云精简的API让用户快速接入云端，开关类设备响应速度快达0.1秒。</div>
	    </div>
	    <div class="layui-col-md6">
	        <div style="font-size: 24px;color: #0e83cd;font-family:sans-serif;"><i class="layui-icon" style="font-size: 24px; color: #1E9FFF;">&#xe636;</i>&nbsp多平台支持
	  		</div>
	        <div style="font-size: 16px;font-family:sans-serif;line-height: 30px;padding-right: 60px;padding-left: 40px;text-indent: 2em;">极客云支持STM32、51单片机、8266、Arduino、树莓派等硬件设备，同时也支持Web、Android和IOS等APP个性开发。</div>
	    </div>
	  </div>
	  <div class="layui-row" style="line-height: 70px; padding-bottom: 80px;" >
	  		<div class="layui-col-md6">
		        <div style="font-size: 24px;color: #0e83cd;font-family:sans-serif;"><i class="layui-icon" style="font-size: 24px; color: #1E9FFF;">&#xe715;</i>&nbsp标准库函数支持
		  		</div>
		        <div style="font-size: 16px;font-family:sans-serif;line-height: 30px;padding-right: 60px;padding-left: 40px;text-indent: 2em;">极客云向用户提供整套完整库函数，用户只需要调用库函数，就可以轻松控制远程设备，上传采集的温湿度及GPS信息。</div>
		    </div>
		    <div class="layui-col-md6">
		        <div style="font-size: 24px;color: #0e83cd;font-family:sans-serif;"><i class="layui-icon" style="font-size: 24px; color: #1E9FFF;">&#xe64e;</i>&nbsp丰富的案例、软件下载
		  		</div>
		        <div style="font-size: 16px;font-family:sans-serif;line-height: 30px;padding-right: 60px;padding-left: 40px;text-indent: 2em;">极客云为用户提供了零基础入门的应用案例，100%开源，共享于Github；同时还编写了PC端调试工具，方便用户模拟硬件设备接入！</div>
		    </div>
	    </div>
	</div>
  <?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
</body>
<script>
 // 加载需要的模块
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
 
  // 轮播
  carousel.render({
    elem: '#test4'
    ,width: '1080px'
    ,height: '400px'
    ,interval: 5000
    // ,arrow: 'always'
    //,autoplay: false
    //,indicator: 'outside'
    // ,trigger: 'hover'
    // ,anim: 'updown'
    // ,full: true
  });

  // 获取点击量
  $.ajax({
    type:'POST',
    url: "/api/admin/access.count.php",
    async: true,
    data:{type:'get',sort:'count'},
    success: function (res) {
      console.log('success:',res);
      $("#count").html('<div id="count" class="layui-btn layui-btn-sm layui-btn-primary" style="font-size: 18px;"><span class="layui-icon layui-icon-star-fill" ></span><span></span>Click&nbsp'+res.count+'</div>');
    }
  });

});
</script>
</html>