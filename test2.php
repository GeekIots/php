 
<?php 
	// 毫秒级时间戳
	function uuid() {
	list($t1, $t2) = explode(' ', microtime());
	return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
	}
	echo uuid();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="//res.layui.com/layui/dist/css/layui.css"  media="all">
  <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/frame/layui-v2.1.0/layui/layui.js"></script>
  <link rel="stylesheet" href="/frame/layui-v2.1.0/layui/css/layui.css">
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
              
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
  <legend>水平导航菜单</legend>
</fieldset>
 
<ul class="layui-nav">
  <li class="layui-nav-item"><a href="">最新活动</a></li>
  <li class="layui-nav-item layui-this">
    <a href="javascript:;">产品</a>
    <dl class="layui-nav-child">
      <dd><a href="">选项1</a></dd>
      <dd><a href="">选项2</a></dd>
      <dd><a href="">选项3</a></dd>
    </dl>
  </li>
  <li class="layui-nav-item"><a href="">大数据</a></li>
  <li class="layui-nav-item">
    <a href="javascript:;">解决方案</a>
    <dl class="layui-nav-child">
      <dd><a href="">移动模块</a></dd>
      <dd><a href="">后台模版</a></dd>
      <dd class="layui-this"><a href="">选中项</a></dd>
      <dd><a href="">电商平台</a></dd>
    </dl>
  </li>
  <li class="layui-nav-item"><a href="">社区</a></li>
</ul>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
  <legend>导航带徽章和图片</legend>
</fieldset>
 
<ul class="layui-nav">
  <li class="layui-nav-item">
    <a href="">控制台<span class="layui-badge">9</span></a>
  </li>
  <li class="layui-nav-item">
    <a href="">个人中心<span class="layui-badge-dot"></span></a>
  </li>
  <li class="layui-nav-item">
    <a href="javascript:;"><img src="http://t.cn/RCzsdCq" class="layui-nav-img">我</a>
    <dl class="layui-nav-child">
      <dd><a href="javascript:;">修改信息</a></dd>
      <dd><a href="javascript:;">安全管理</a></dd>
      <dd><a href="javascript:;">退了</a></dd>
    </dl>
  </li>
</ul>

<script>
layui.use('element', function(){
  var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块
  
  //监听导航点击
  element.on('nav(demo)', function(elem){
    //console.log(elem)
    layer.msg(elem.text());
  });
});
</script>

</body>
</html>