<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>用户中心</title>
</head>
<body>
<script id="moduel" type="text/html">
  <div class="main fly-user-main layui-clear">
    <ul class="layui-nav layui-nav-tree layui-inline" lay-filter="user">
      <li class="layui-nav-item">
        <a href="home.php">
          <i class="layui-icon">&#xe609;</i>
          我的主页
        </a>
      </li>
      <li class="layui-nav-item layui-this">
        <a href="index.php">
          <i class="layui-icon">&#xe612;</i>
          用户中心
        </a>
      </li>
      <li class="layui-nav-item">
        <a href="set.php">
          <i class="layui-icon">&#xe620;</i>
          基本设置
        </a>
      </li>
      <li class="layui-nav-item">
        <a href="message.php">
          <i class="layui-icon">&#xe611;</i>
          我的消息
        </a>
      </li>
    </ul>
    
    <div class="site-tree-mobile layui-hide">
      <i class="layui-icon">&#xe602;</i>
    </div>
    <div class="site-mobile-shade"></div>
    
    <div class="fly-panel fly-panel-user" pad20>
      <!--
      <div class="fly-msg" style="margin-top: 15px;">
        您的邮箱尚未验证，这比较影响您的帐号安全，<a href="activate.html">立即去激活？</a>
      </div>
      -->
      <div class="layui-tab layui-tab-brief" lay-filter="user">
        <ul class="layui-tab-title" id="LAY_mine">
          <li data-type="mine-jie" lay-id="index" class="layui-this">我发的帖（<span>{{user_blog.length}}</span>）</li>
          <li data-type="collection" data-url="/collection/find/" lay-id="collection">我收藏的帖（<span>{{user_collect.length}}</span>）</li>
        </ul>
        <div class="layui-tab-content" style="padding: 20px 0;">
          <div class="layui-tab-item layui-show">
            <ul class="mine-view jie-row">
              {{# layui.each(user_blog.list, function(index, item){ }}
                <li>
                  <a class="jie-title" href="/blog/view.php?id={{item.id}}" target="_blank">{{item.title}}</a>
                  <i>{{util.timeAgo(item.dates)}}</i>
                  <a class="mine-edit" href="/blog/edit.php?id={{item.id}}">编辑</a>
                  <em>{{item.browser}}阅/{{item.answer}}答</em>
                </li>
              {{#  }); }}
            </ul>
            <div id="LAY_page"></div>
          </div>
          <div class="layui-tab-item">
            <ul class="mine-view jie-row">
              {{# layui.each(user_collect.list, function(index, item){ }}
                <li>
                  <a class="jie-title" href="/blog/view.php?id={{item.id}}" target="_blank">{{item.title}}</a>
                  <i>收藏于{{util.timeAgo(item.dates)}}</i>  
                </li>
              {{#  }); }}
            </ul>
            <div id="LAY_page1"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</script> 
<!-- 建立视图。用于呈现模板渲染结果。 -->
<div id="view"></div> 
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
<script>
  var user_d;//用户信息
  var user_blog;//发的帖子
  var user_collect;//用户收藏的帖子

  var util;
  layui.use(['laytpl','layedit','layer','jquery','util'],function(){
  var layedit = layui.layedit,layer = layui.layer,$ = layui.jquery,laytpl = layui.laytpl;
  util = layui.util;
  //获取用户信息
  $.ajax({
    url: "../api/user/user.php",
    success: function (res) {
      console.log('success:',res);
      user_d = res;
      //获取发帖列表
      $.ajax({
          url: "../api/blog/userbloglist.php",
          type:'POST',
          data:{'nickname':user_d.nickname},
            success: function (res) {
            console.log('success:',res);
            user_blog = res;
            //获取收藏列表
            $.ajax({
                url: "../api/blog/collect.php",
                type:'POST',
                data:{'type':'get','nickname':user_d.nickname},
                success: function (res) {
                  console.log('success:',res);
                  user_collect = res;
                  //渲染数据
                  var getTpl = moduel.innerHTML;
                  var view = document.getElementById('view');
                  laytpl(getTpl).render(res, function(html){
                    view.innerHTML = html;
                  });
                },
                error:function (res) {
                    console.log('fail:',res);
                    layer.msg("拉取收藏数据失败！");
                }
            });
          },
          error:function (res) {
              console.log('fail:',res);
          }
      });
    },
    error:function (res) {
        console.log('fail:',res);
    }
  });
  
});
</script>

</body>
</html>