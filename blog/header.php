<?php
 // session_start();
function my_file_exists($file)  
{  
    if(preg_match('/^http:\/\//',$file)){  
        //远程文件  
        if(ini_get('allow_url_fopen')){  
            if(@fopen($file,'r')) return true;  
        }  
        else{  
            $parseurl=parse_url($file);  
            $host=$parseurl['host'];  
            $path=$parseurl['path'];  
            $fp=fsockopen($host,80, $errno, $errstr, 10);  
            if(!$fp)return false;  
            fputs($fp,"GET {$path} HTTP/1.1 \r\nhost:{$host}\r\n\r\n");  
            if(preg_match('/HTTP\/1.1 200/',fgets($fp,1024))) return true;  
        }  
        return false;  
    }  
    return file_exists($file);  
}       
function console($value='')
{
    echo("<script>console.log('{$value}');</script>");
}
  if(isset($_SESSION['login'])) {
          //用户头像
          $file = "http://www.smtvoice.com/public/upload-head/userheadimg/".$_SESSION['login'].".jpg";
          console($file);
          if(my_file_exists($file)) {
              //存在
              $avatar = $file;
              console('存在');
          }
          else{
              //不存在
              $avatar = "http://www.smtvoice.com/public/upload-head/default.jpg";
              console('不存在');
          }
  } else {
      console('未登录');
      $avatar = "http://www.smtvoice.com/public/upload-head/default.jpg";
  }
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Geek-Iot | 极客社区</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="keywords" content="geek,geekiot,物联网,物联网社区">
  <meta name="description" content="极客社区是极客物联网开发平台的官网社区，致力于为物联网开发提供强劲动力">

  <link rel="stylesheet" href="../frame/layui-v2.1.0/layui/css/layui.css">
  <link rel="stylesheet" href="res/css/global.css">

</head>
<div class="header">
  <div class="main">
    <a class="logo" href="/bbs/html/index.html" title="Geek-Iot">Fly社区</a>
    <div class="nav">
      <a class="nav-this" href="jie/index.html">
        <i class="iconfont"></i>首页
      </a>
      <a href="/blog" target="_blank">
        <i class="iconfont"></i>社区
      </a>
      <a href="http://www.layui.com/" target="_blank">
        <i class="iconfont"></i>控制台
      </a>
      <a href="http://www.layui.com/" target="_blank">
        <i class="iconfont"></i>关于
      </a>
    </div>
    
    <div class="nav-user">
      <!-- 未登入状态 -->
      <a class="unlogin" href="user/login.html"><i class="iconfont icon-touxiang"></i></a>
      <span><a href="user/login.html">登入</a><a href="user/reg.html">注册</a></span>
      <p class="out-login">
        <a href="" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-qq" title="QQ登入"></a>
        <a href="" onclick="layer.msg('正在通过微博登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-weibo" title="微博登入"></a>
      </p>   
      
      <!-- 登入后的状态 -->
      <!-- 
      <a class="avatar" href="user/index.html">
        <img src="http://tp4.sinaimg.cn/1345566427/180/5730976522/0">
        <cite>贤心</cite>
        <i>VIP2</i>
      </a>
      <div class="nav">
        <a href="/user/set/"><i class="iconfont icon-shezhi"></i>设置</a>
        <a href="/user/logout/"><i class="iconfont icon-tuichu" style="top: 0; font-size: 22px;"></i>退了</a>
      </div> -->
      
    </div>
  </div>
</div>