<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="keywords" content="geek,geekiot,物联网,物联网社区">
  <meta name="description" content="极客社区是极客物联网开发平台的官网社区，致力于为物联网开发提供强劲动力！">
  <link rel="stylesheet" href="/frame/layui-v2.1.0/layui/css/layui.css">
  <link rel="stylesheet" href="/common/res/css/global.css">
  <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/frame/layui-v2.1.0/layui/layui.all.js"></script>
  <!-- 预加载的layui模块 -->
  <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/common/layerload.js"></script>
  <!-- QQ登录插件 -->
  <script type="text/javascript"
  src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" charset="utf-8"></script>
  <!-- weibo登录插件 -->
  <!-- <script src="//tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=1269211443" type="text/javascript" charset="utf-8"></script> -->
</head>
<div class="header">

  <div class="main" style="width: 90%;">
    <a class="logo" href="/index.php" title="Geek-Iot">极客物联网</a>
    <div class="nav">
      <a href="/index.php">
        <i class="iconfont"></i>首页
      </a>
      <a  href="/blog/index.php" target="_self">
        <i class="iconfont"></i>社区
      </a>
      <a href="/device/device.php" target="">
        <i class="iconfont"></i>控制
      </a>
      <a href="/device/management.php" target="">
        <i class="iconfont"></i>管理
      </a>
      <a href="/about/index.php" target="">
        <i class="iconfont"></i>关于
      </a>
    </div>



    <div class="nav-user">
      <!-- 模板 -->
      <script id="tpl_header" type="text/html">
        <!-- 已登录 -->
        {{#  if(user_d.login === "true"){ }}
          <a class='avatar' href='/user/home.php?userid={{user_d.userid}}'>
          <img id='image-avatar' src='{{ user_d.avatar }}'>
          <cite id='nickname'>{{ user_d.nickname }}</cite>
          <i>VIP1</i>
          </a>
          <div class='nav'>
          <a href='/user/set.php'><i class='iconfont icon-shezhi'></i>设置</a>
          <a href='/user/logout.php'><i class='iconfont icon-tuichu' style='top: 0; font-size: 22px;'></i>退了</a>
          </div>  
        {{# }else { }} 
        <!-- 未登录 -->
          <a class="unlogin" href="/user/login.php"><i class="iconfont icon-touxiang"></i></a>
          <span><a href="/user/login.php">登入</a><a href="/user/register.php">注册</a></span>
          <p class="out-login">
            <a class="iconfont icon-qq" title="QQ登入" onclick="qqLogin()" target=""></a>
            <!-- <a class="iconfont icon-weibo" title="微博登入"></a> -->
          </p>
        {{#  } }} 
        </ul>
      </script>
      <!-- 建立视图。用于呈现模板渲染结果。 -->
      <div id="view_header"></div>   
    </div>
  </div>
</div>
<!-- <html xmlns:wb="http://open.weibo.com/wb"> -->
<!-- <wb:login-button type="3,1" onlogin="login" onlogout="logout">登录按钮</wb:login-button> -->
<!-- 隐藏的input，让浏览器填充，解决输入框被填充问题 -->
<input style="display:none" type="text" name="fakeusernameremembered"/>
<input style="display:none" type="password" name="fakepasswordremembered"/>
<script>
  // 定义用户数据变量
  var user_d;
  // 头部分当前标签高亮显示
  $(document).ready(function(){  
    $(".nav a").each(function(){  
      $this = $(this);
      // console.log('header高亮显示:',$this);
      if($this[0].href==String(window.location)){  
        $this.addClass("nav-this");  
      }
    });  
  }); 
  //获取用户登陆信息
  $.ajax({
    url: "/api/user/user.php",
    success: function (res) {
        console.log('success:',res);
        user_d = res;
        //渲染数据
        var getTpl = tpl_header.innerHTML;
        var view_header = document.getElementById('view_header');
        laytpl(getTpl).render(user_d, function(html){
          view_header.innerHTML = html;
        });
    },
    error:function (res) {
        console.log('fail:',res);
    }
  });
  //QQ登录
  function qqLogin(){
    QC.Login.showPopup({
      appId:"101435544",
      redirectURI:"http://www.geek-iot.com/user/qq/qc_back.php?backurl="+window.location.href
    });
    window.close();
  }
</script>