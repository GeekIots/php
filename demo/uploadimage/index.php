<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>upload模块快速使用</title>
  <link rel="stylesheet" href="../../frame/layui-v2.1.0/layui/css/layui.css" media="all">
  <style type="text/css">
	.site-demo-upload,
	.site-demo-upload img{width: 200px; height: 200px; border-radius: 100%;}
	.site-demo-upload{position: relative; background: #e2e2e2;}
	.site-demo-upload .site-demo-upbar{position: absolute; top: 50%; left: 50%; margin: -18px 0 0 -56px;}
	.site-demo-upload .layui-upload-button{background-color: rgba(0,0,0,.2); color: rgba(255,255,255,1);}
	</style>
</head>
<body>
 <div style="width:1000px; margin: 0 auto;">
		<div style="width: 100%;height:50px;line-height:50px;font-weight:700;font-size:30px; text-align:center;">
			Layui上传图片
		</div>
		<!-- <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
			<legend>上传图片</legend>
		</fieldset> -->
           
		<div class="site-demo-upload">
			<img id="LAY_demo_upload" src="default.jpg">
			<button type="button" class="layui-btn" style="margin-top: 20px;margin-left: 40px;" id="img_upload">
			  <i class="layui-icon">&#xe67c;</i>上传图片
			</button>
		</div>
</div>
<script src="../../frame/layui-v2.1.0/layui/layui.js"></script>
<script>
layui.use('upload', function(){
  var upload = layui.upload;
  //执行实例
  var uploadInst = upload.render({
    elem: '#img_upload' //绑定元素
    ,url: 'upload.php?act=images', //上传接口
	before : function(){
	//执行上传前的回调	可以判断文件后缀等等
	layer.msg('上传中，请稍后......', {icon:16, shade:0.5, time:0});
	}
    ,done: function(res){
      //上传完毕回调
      console.log(res);
      if(res.code != 0){
			layer.msg(res.msg, {icon:2, shade:0.5, time:res.time});
		}
		else{
			layer.msg("文件上传成功", {icon:1, shade:0.5, time:res.time});
			layui.jquery('#LAY_demo_upload').attr("src", res.msg);
		}
	}
    ,error: function(res){
      //请求异常回调
      console.log(res);
    }
  });
});
</script>
</body>
</html>