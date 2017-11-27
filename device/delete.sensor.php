<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>删除传感器 | 极客物联网</title>
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
  <!-- 引入 Bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php require($_SERVER['DOCUMENT_ROOT'].'/common/header.php'); ?>
  <div style="padding: 10% 15% 5%;">
    <form class="form-horizontal">
        <script id="moduel" type="text/html">

        <div class="form-group" align="center">
            <img src="{{d.pic}}" style="width: 150px;height: 150px;border-radius: 10px;" onerror="javascript:this.src='/image/default/error.jpg';">
        </div>
        
        <div class="form-group">
            <label class="col-sm-3 control-label">ID:</label>
            <div class="col-sm-6">
                <input type="text" readonly="true" class="form-control" id="id" value="{{d.id}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">名称:</label>
            <div class="col-sm-6">
                <input type="text" readonly="true" class="form-control" id="name" value="{{d.name}}">
            </div>
        </div>

         <div class="form-group">
            <label class="col-sm-3 control-label">图片:</label>
            <div class="col-sm-6">
                <input type="text" readonly="true" class="form-control" id="pic" value="{{d.pic}}">
            </div>
        </div>
       
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-10">
                <div class="btn btn-default" id="btn-delete">删除</div>
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
      
      //获取开关信息
      $.ajax({
      url: "/api/device/get.sensor.php",
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

    //所有的button引起的变化
    $("#btn-delete").bind("click",function(){
      var _id = $("#id").val();

      //打印引起事件的标签信息
      console.log('click:', this);

      layer.msg('删除后无法恢复，确定要删除吗？', {
        time: 20000, //5s后自动关闭
        btn: ['孤意已决','朕再想想']
        ,yes: function(){
          // 发送指令并等待响应
          $.ajax({
            url: "/api/device/delete.sensor.php",
            async: true,
            type:"GET",
            data:{"userid":user.userid,"id":_id},
            success: function (res) {
              console.log('success:',res);
              // 显示成功，用户确认后跳转
              if (res.resault=='success') {
                  layer.msg('删除成功！', {
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
                  layer.msg('Sorroy,删除失败!'+res.msg, {
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
        }
        ,btn1:function(){
          layer.closeAll(); 
        }
      });
    }); 
  }); 
</script>












