<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>后台管理</title>
  <script src="https://cdn.bootcss.com/vue/2.4.4/vue.js"></script>  <!-- 预加载的layui模块 -->
  <link rel="stylesheet" href="/frame/layui-v2.1.0/layui/css/layui.css">
  <script src="/frame/layui-v2.1.0/layui/layui.all.js"></script>
  <script src="/common/layerload.js"></script>
</head>
<body>
  <div id="app">
    <div class="layui-layout layui-layout-admin">
      <div class="layui-header">
        <a href="/index.php"><img class="layui-logo" style="padding: 5px; height: 80%; " src='/common/res/images/logo.png'></a> 
        <ul class="layui-nav layui-layout-right">
          <template v-if="user.login=='true'">
            <li class="layui-nav-item">
              <a :href="'/user/home.php?userid='+user.userid">
                <img :src="user.avatar" class="layui-nav-img">
                {{user.nickname}}
              </a>
            </li>
            <li class="layui-nav-item"><a href="/user/logout.php">退了</a></li>
          </template>
          <template v-if="user.login=='false'">
            <li class="layui-nav-item"><a href="/user/login.php">登入</a></li>
            <li class="layui-nav-item"><a href="/user/register.php">注册</a></li>
          </template> 
        </ul>
      </div>
      
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
            <li class="layui-nav-item layui-nav-itemed">
              <a href="javascript:;">信息管理</a>
              <dl class="layui-nav-child">
                <dd class="layui-bg-green"><a href="javascript:;">小程序信息</a></dd>
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
          </ul>
        </div>
      </div>
      
      <div class="layui-body" style="padding: 20px;">
        <!-- 内容主体区域 -->
        <table class="layui-table" id='laytable' lay-filter="tabetool">
        </table>
        <script type="text/html" id="barDemo">
            <a class="layui-btn layui-btn-primary layui-btn-mini" lay-event="detail">查看</a>
            <a class="layui-btn layui-btn-mini" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-danger layui-btn-mini" lay-event="del">删除</a>
        </script>
        <div class="layui-footer">
          <!-- 底部固定区域 -->
          © geek-iot.com
        </div>
      </div>
    </div>
  </div>
</body>
<script>
var user;
//JavaScript代码区域
// layui.use('element', function(){
//   var element = layui.element;
// });

//获取用户登陆信息
$.ajax({
  url: "/api/user/user.php",
  async: false, //同步
  success: function (res) {
      console.log('success:',res);
      user = res;
  },
  error:function (res) {
      console.log('fail:',res);
  }
});

new Vue({
  el: '#app',
  data: {
    user:user
  }
})



table.render({
  elem: '#laytable'
  ,loading: true
  ,url:'/api/admin/info.wxin.php'
  ,height: 500
  ,cols: [[ //标题栏
  {checkbox: true, LAY_CHECKED: true} //默认全选
  ,{field: 'id', title: 'ID', width: 50, sort: true}
  ,{field: 'name', title: '名称', width: 80, sort: true}
  ,{field: 'des', title: '简介', width: 120, sort: true}
  ,{field: 'content', title: '内容', width: 200, sort: true}
  ,{field: 'dates', title: '更新时间', width: 80, sort: true}
  ,{field:'right', title: '操作', width:177,toolbar:"#barDemo"}
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
      // window.location.href="/blog/view.php?id="+data.id; 
  } else if(layEvent === 'del'){ //删除
    layer.confirm('暂时不支持删除！', function(index){
      // obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
      layer.close(index);
      //向服务端发送删除指令
      // $.ajax({
      //   url: "/api/admin/blog.delete.php?id="+data.id,
      //   async: true, //同步
      //   success: function (res) {console.log('success:',res);layer.msg('删除成功！');},
      //   error:function (res) {console.log('fail:',res);layer.msg('删除失败！');}
      // });
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
</script>
</body>
</html>