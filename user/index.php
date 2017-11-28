<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>用户中心 | 极客物联网</title>
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
  <script id="moduel" type="text/html">
    <div class="main fly-user-main layui-clear">
      <ul class="layui-nav layui-nav-tree layui-inline" lay-filter="user">
        <li class="layui-nav-item">
          <a href="home.php?userid={{user.userid}}">
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
        <!-- 顶级管理员可进入后台管理界面 -->
        {{# if(user.level=='admin-1'){ }}
          <li class="layui-nav-item">
            <a href="/admin/index.php">
              <i class="layui-icon">&#xe613;</i>
              后台管理
            </a>
          </li>
        {{# } }}
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
                    <i>{{layui.util.timeAgo(item.dates)}}</i>
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
                    <i>收藏于{{layui.util.timeAgo(item.dates)}}</i>  
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
</body>
<script>
  var user_blog;//发的帖子
  var user_collect;//用户收藏的帖子
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
    //获取发帖列表
    $.ajax({
      url: "/api/blog/userbloglist.php",
      type:'POST',
      data:{'userid':user.userid},
        success: function (res) {
        console.log('success:',res);
        user_blog = res;
      },
      error:function (res) {
          console.log('fail:',res);
      }
    });

    //获取收藏列表
    $.ajax({
      url: "/api/blog/blog.collect.php",
      type:'POST',
      data:{'type':'get','userid':user.userid},
      success: function (res) {
        console.log('/api/blog/blog.collect.php,success:',res);
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
  });
</script>
</html>