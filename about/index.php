<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>关于极客物联网</title>
</head>
<body>
<div class="main fly-user-main layui-clear">
<ul class="layui-timeline">
  <li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
    <div class="layui-timeline-content layui-text">
      <h3 class="layui-timeline-title">9月13日</h3>
      <p>
        重新建设社区
        <br>无论它能走多远，抑或如何支撑？至少我曾倾注全心，无怨无悔 <i class="layui-icon"></i>
      </p>
    </div>
  </li>
  
  <li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
    <div class="layui-timeline-content layui-text">
      <h3 class="layui-timeline-title">2016年7月27日</h3>
      <div class="layui-timeline-title">开始构思极客物联网，购买服务器！</div>
    </div>
  </li>
</ul>
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
<script>
layui.use(['layedit','layer','jquery','element','upload'],function(){
  var layedit = layui.layedit
      ,layer = layui.layer
      ,$ = layui.jquery
      ,element = layui.element
      ,upload = layui.upload;
  });
</script>
</body>
</html>