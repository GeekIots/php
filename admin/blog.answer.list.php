<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>后台管理</title>
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
<body>
  <?php require($_SERVER['DOCUMENT_ROOT'].'/common/header.php'); ?>
  <script type="text/javascript">
    // 判断是否位管理员
    layui.use(['jquery'], function(){
    $  = layui.jquery;
    $.ajax({
      url: "/api/user/user.php",
      async: false, //同步
      success: function (res) {
          console.log('success:',res);
        if (!res) {
          window.location.href = "/";
        }
        if (res.level!='admin-1') {
          window.location.href = "/";
        }
      },
      error:function (res) {
          window.location.href = "/";
      }
    });
  });
  </script>
  <div class="layui-layout layui-layout-admin">
    <div class="layui-side layui-bg-black">
      <div class="layui-side-scroll">
        <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
        <ul class="layui-nav layui-nav-tree"  lay-filter="test">
          <li class="layui-nav-item">
            <a class="" href="javascript:;">用户管理</a>
            <dl class="layui-nav-child">
              <dd><a href="/admin/user.list.php">用户列表</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item">
            <a href="javascript:;">信息管理</a>
            <dl class="layui-nav-child">
              <dd><a href="/admin/info.wxin.php">小程序信息</a></dd>
              <dd><a href="/admin/info.web.php">网站信息</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item layui-nav-itemed">
            <a href="javascript:;">论坛管理</a>
            <dl class="layui-nav-child">
              <dd><a href="/admin/blog.list.php">帖子列表</a></dd>
              <dd class="layui-bg-green"><a href="/admin/blog.answer.list.php">回帖列表</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item">
            <a href="javascript:;">设备管理</a>
            <dl class="layui-nav-child">
              <dd><a href="/admin/device.switch.list.php">开关</a></dd>
              <dd><a href="/admin/device.sensor.list.php">传感器</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item">
            <a href="javascript:;">站点统计</a>
            <dl class="layui-nav-child">
              <dd><a href="/admin/acess.list.php">访问列表</a></dd>
            </dl>
          </li>
        </ul>
      </div>
    </div>
    
    <div class="layui-body" style="padding: 20px;">
      <!-- 内容主体区域 -->
      <table class="layui-table" id='laytable' lay-filter="tabetool">
      </table>
      <script type="text/html" id="barDemo">
          <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detail">查看</a>
          <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
          <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
      </script>
      <div class="layui-footer">
        <!-- 底部固定区域 -->
        © geek-iot.com
      </div>
    </div>
  </div>
</body>
<script>
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
    
      table.render({
      elem: '#laytable'
      ,loading: true
      ,url:'/api/admin/blog.answer.list.php'
      ,height: 500
      ,cols: [[ //标题栏
      {checkbox: true, LAY_CHECKED: true} //默认全选
      ,{field: 'id', title: '回帖ID', width: 140, sort: true}
      ,{field: 'toid', title: '帖子ID', width: 140, sort: true}
      ,{title: '头像', width: 60  , align: 'center',templet: '<div><img src="{{d.avatar}}" width="26px" height="26px"style="border-radius: 13px;" onerror="javascript:this.src=\'/image/default/error.jpg\';"/></div>'}
      ,{field: 'nickname', title: '昵称', width: 80, sort: true}
      ,{field: 'title', title: '帖子标题', width: 140, sort: true}
      ,{field: 'contents', title: '回帖内容', width: 140, sort: true}
      ,{field: 'dates', title: '回帖时间', width: 180, sort: true}
      ,{field:'right', title: '操作', width:260,toolbar:"#barDemo"}
      ]] 
      ,skin: 'row' //表格风格
      ,even: true
      ,page: true //是否显示分页
      ,limits: [10, 20, 30]
      ,limit: 10 //每页默认显示的数量
      ,response: {
        countName: 'count' //数据总数的字段名称，默认：count
        ,dataName: 'data' //数据列表的字段名称，默认：data
      }    
    });

    //监听工具条
    table.on('tool(tabetool)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
      var data = obj.data; //获得当前行数据
      var layEvent = obj.event; //获得 lay-event 对应的值
      var tr = obj.tr; //获得当前行 tr 的DOM对象
     
      if(layEvent === 'detail'){ //查看
          console.log(data);
          window.location.href="/blog/view.php?id="+data.toid; 
      } else if(layEvent === 'del'){ //删除
        layer.confirm('真的删除行么', function(index){
          obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
          layer.close(index);
          //向服务端发送删除指令
          $.ajax({
            url: "/api/admin/blog.answer.delete.php?id="+data.id,
            async: true, //同步
            success: function (res) {console.log('success:',res);layer.msg('删除成功！');},
            error:function (res) {console.log('fail:',res);layer.msg('删除失败！');}
          });
        });
      } else if(layEvent === 'edit'){ //编辑
        layer.alert('编辑行：<br>'+ JSON.stringify(data));
        //同步更新缓存对应的值
        // obj.update({
        //   nickname: '123'
        // });
      }
    });
    element.init();
  }); 
</script>
</body>
</html>