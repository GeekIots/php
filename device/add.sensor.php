<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>添加传感器 | 极客物联网</title>
  <!-- 引入 Bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div style="padding: 10% 15% 5%;">
    <form class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-2 control-label">名称:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="name" placeholder="白鹿原温度" value="白鹿原温度">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">图片:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="pic" placeholder="" value="">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">类型:</label>
            <div class="col-sm-6">
                <select class="form-control" id="type">
                    <option value ="temperature">温度 ℃</option>
                    <option value ="humidity">湿度 RH</option>
                    <option value="pm2.5">PM2.5</option>
                    <option value="gps">GPS位置</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="btn btn-default" id="btn-add" >添加</div>
                <a class="btn btn-default" href="/device/Management.php">取消</a>
            </div>
        </div>
    </form>
  <?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
  </body>
</html>

<script type="text/javascript">
  //所有的button引起的变化
  $("#btn-add").bind("click",function(){
    var name = $("#name").val();
    var type = $("#type").val();
    var pic = $("#pic").val();

    //打印引起事件的标签信息
    console.log('click:', this);
    // 发送指令并等待响应
    $.ajax({
      url: "/api/device/add.sensor.php",
      async: true,
      type:"GET",
      data:{"userid":user_d.userid,"name":name,"type":type,"pic":pic},
      success: function (res) {
        console.log('success:',res);
        // 显示成功，用户确认后跳转
        if (res.resault=='success') {
              layer.msg('添加成功！', {
              time: 5000, //5s后自动关闭
              btn: ['好的']
              ,yes: function(){
                // 跳转回原来页面
                location.href = '/device/management.php';  
              }
            });
        }
        else{
            // 显示错误信息
            layer.msg('Sorroy,创建失败!'+res.msg, {
                  time: 20000, //20s后自动关闭
                  btn: ['知道了']
                  ,yes: function(){
                    layer.closeAll();
                  }
                });
          }
      },
      error:function (res) {
        console.log('fail:',res);
      }
    });
  }); 
</script>















