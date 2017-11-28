<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>我的消息 | 极客物联网</title>
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
  <div class="main fly-user-main layui-clear">
  <ul class="layui-nav layui-nav-tree layui-inline" lay-filter="user">
    <li class="layui-nav-item">
      <a href="home.php">
        <i class="layui-icon">&#xe609;</i>
        我的主页
      </a>
    </li>
    <li class="layui-nav-item">
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
    <li class="layui-nav-item layui-this">
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
	  <div class="layui-tab layui-tab-brief" lay-filter="user" id="LAY_msg" style="margin-top: 15px;">
	    <button class="layui-btn layui-btn-danger" id="LAY_delallmsg">清空全部消息</button>
	    <div  id="LAY_minemsg" style="margin-top: 10px;">
        <!--<div class="fly-none">您暂时没有最新消息</div>-->
        <ul class="mine-msg">
          <li data-id="123">
            <blockquote class="layui-elem-quote">
              <a href="/jump?username=Absolutely" target="_blank"><cite>Absolutely</cite></a>回答了您的求解<a target="_blank" href="/jie/8153.html/page/0/#item-1489505778669"><cite>layui后台框架</cite></a>
            </blockquote>
            <p><span>1小时前</span><a href="javascript:;" class="layui-btn layui-btn-small layui-btn-danger fly-delete">删除</a></p>
          </li>
          <li data-id="123">
            <blockquote class="layui-elem-quote">
              系统消息：欢迎使用 layui
            </blockquote>
            <p><span>1小时前</span><a href="javascript:;" class="layui-btn layui-btn-small layui-btn-danger fly-delete">删除</a></p>
          </li>
        </ul>
      </div>
	  </div>
	</div>
  </div>
  <?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
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
  });
</script>

</body>
</html>