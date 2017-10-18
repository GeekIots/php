<!DOCTYPE html>
<html>
<head>
  <title>用户主页</title>
  <?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
</head>
<body>
  <script id="moduel" type="text/html">
  </script>
  <!-- 建立视图。用于呈现模板渲染结果。 -->
  <div id="view"></div>
  <?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
</body>
</html> 
<script>
  layui.use(['laytpl','layedit','layer','jquery','util'],function(){
  var layedit = layui.layedit,layer = layui.layer,$ = layui.jquery,laytpl = layui.laytpl;
  util = layui.util;
  //获取请求的userid
  var _userid = getUrlParam('userid');  
  if(!_userid)
  {
    layer.msg("没有userid信息！");
  }
  else
  {
    //获取用户信息
    $.ajax({
      url: "../api/user/user.php",
      type:'POST',
      data:{'userid':_userid},
      success: function (res) {
        console.log('success:',res);
        user_d = res;      
      },
      error:function (res) {
          console.log('fail:',res);
      }
    }); 
  }
});
</script>