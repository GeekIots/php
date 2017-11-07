<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>更新开关 | 极客物联网</title>
  <!-- 引入 Bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div style="padding: 10% 15% 5%;">
    <form class="form-horizontal">
        <script id="moduel" type="text/html">

        <div class="form-group" align="center">
            <img src="{{d.pic}}" id="pic-show" style="width: 150px;height: 150px;border-radius: 10px;">
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">名称:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="name" value="{{d.name}}">
            </div>
        </div>

         <div class="form-group">
            <label class="col-sm-3 control-label">图片:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="pic" value="{{d.pic}}">
            </div>
            <label class="control-label" style="color: red" id="pic-msg"></label>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">开指令:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="opencmd" value="{{d.opencmd}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">关指令:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="closecmd" value="{{d.closecmd}}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-10">
                <div class="btn btn-default" id="btn-update">更新</div>
                <a class="btn btn-default" href="/device/management.php">取消</a>
            </div>
        </div>
      </script>
    <!-- 建立视图。用于呈现模板渲染结果。 -->
    <div id="view"></div>
    </form>
  <?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
  </body>
</html>

<script type="text/javascript">
  var _id = getUrlParam('id');
  //获取开关信息
  $.ajax({
    url: "/api/device/get.switch.php",
    async: false,
    type:"GET",
    data:{"id":_id},
    success: function (res) {
    console.log('success:',res);
    // 显示成功，用户确认后跳转
    if (res.resault=='success') {
      // 渲染页面
      var getTpl = moduel.innerHTML;
      var view = document.getElementById('view');
      laytpl(getTpl).render(res, function(html){
        view.innerHTML = html;
      });
    }
    else{
        // 显示错误信息
        layer.msg('拉取数据失败!'+res.msg, {
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

  // 监控图片输入框数据变化
  $('#pic').bind('input propertychange', function() { 
    // 定义一个Image对象
    var img = new Image();
    img.src=$('#pic').val();
    // 加载成功
    img.onload = function() {
        $('#pic-show').attr('src',$('#pic').val()); 
        $("#pic-msg").text("");
    };
    // 加载失败
    img.onerror = function() {
        $("#pic-msg").text("图片地址无效！");
    }
  }); 

  //所有的button引起的变化
  $("#btn-update").bind("click",function(){
    var name = $("#name").val();
    var pic = $("#pic").val();
    var opencmd = $("#opencmd").val();
    var closecmd = $("#closecmd").val();

    //打印引起事件的标签信息
    console.log('click:', this);
    // 发送指令并等待响应
    $.ajax({
      url: "/api/device/update.switch.php",
      async: true,
      type:"GET",
      data:{"userid":user_d.userid,"id":_id,"name":name,"opencmd":opencmd,"closecmd":closecmd,"pic":pic},
      success: function (res) {
        console.log('success:',res);
        // 显示成功，用户确认后跳转
        if (res.resault=='success') {
              layer.msg('更新成功！', {
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
            layer.msg('Sorroy,更新失败!'+res.msg, {
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






