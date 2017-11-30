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
          <li class="layui-nav-item">
            <a href="javascript:;">论坛管理</a>
            <dl class="layui-nav-child">
              <dd><a href="/admin/blog.list.php">帖子列表</a></dd>
              <dd><a href="/admin/blog.answer.list.php">回帖列表</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item">
            <a href="javascript:;">设备管理</a>
            <dl class="layui-nav-child">
              <dd><a href="/admin/device.switch.list.php">开关</a></dd>
              <dd><a href="/admin/device.sensor.list.php">传感器</a></dd>
            </dl>
          </li>
          <li class="layui-nav-item  layui-nav-itemed">
            <a href="javascript:;">站点统计</a>
            <dl class="layui-nav-child">
              <dd class="layui-bg-green"><a href="javascript:;">访问列表</a></dd>
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

    table.render({
      elem: '#laytable'
      ,loading: true
      ,url:'/api/admin/access.count.php?type=get&sort=list'
      ,height: 500
      ,cols: [[ //标题栏
      {checkbox: true, LAY_CHECKED: true} //默认全选
      ,{field: 'id', title: 'ID', width: 80, sort: true}
      ,{field: 'country', title: '国家', width: 80, sort: true}
      ,{field: 'province', title: '省份', width: 80, sort: true}
      ,{field: 'city', title: '城市', width: 80, sort: true}
      ,{field: 'nowurl', title: '页面', width: 260, sort: true}
      ,{field: 'fromurl', title: '访问来源', width: 260, sort: true}
      ,{field: 'dates', title: '更新时间', width: 180, sort: true}
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
      	layer.alert('编辑行：<br>'+ JSON.stringify(data));
        console.log(data);
      } else if(layEvent === 'del'){ //删除
        
      } else if(layEvent === 'edit'){ //编辑
        layer.alert('编辑行：<br>'+ JSON.stringify(data));
      }
    });
   element.init(); 
  });
</script>
</body>
</html>