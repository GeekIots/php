<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>用户主页</title>
</head>
<body style="margin-top: 65px;">
<div class="fly-home" style="background-image: url();">

<!-- 用户信息模板 -->
<script id="home_moduel" type="text/html">
<img src="/{{user_d.avatar}}" alt="{{user_d.nickname}}">
  <h1>
    {{user_d.nickname}}
    <i class="iconfont icon-nan"></i> 
    <!-- <i class="iconfont icon-nv"></i> -->
    
    <!-- <span style="color:#c00;">（超级码农）</span>
    <span style="color:#5FB878;">（活雷锋）</span>
    <span>（该号已被封）</span> -->
  </h1>
  <p class="fly-home-info">
    <i class="iconfont icon-zuichun" title="飞吻"></i><span style="color: #FF7200;">67206飞吻</span>
    <i class="iconfont icon-shijian"></i><span>2015-06-17 加入</span>
    <i class="iconfont icon-chengshi"></i><span>来自杭州</span>
  </p>
  <p class="fly-home-sign">（人生仿若一场修行）</p>
</div>

<div class="main fly-home-main">
  <div class="layui-inline fly-home-jie">
    <div class="fly-panel">
      <h3 class="fly-panel-title">贤心 最近的提问</h3>
      <ul class="jie-row">
        <li>
          <span class="fly-jing">精</span>
          <a href="/jie/1.html" class="jie-title">使用 layui 秒搭后台大布局（基本结构）</a>
          <i>1天前</i>
          <em>1136阅/27答</em>
        </li>
        <li>
          <a href="/jie/1.html" class="jie-title">使用 layui 秒搭后台大布局（基本结构）</a>
          <i>1天前</i>
          <em>1136阅/27答</em>
        </li>
        <li>
          <a href="/jie/1.html" class="jie-title">使用 layui 秒搭后台大布局（基本结构）</a>
          <i>1天前</i>
          <em>1136阅/27答</em>
        </li>
        <li>
          <a href="/jie/1.html" class="jie-title">使用 layui 秒搭后台大布局（基本结构）</a>
          <i>1天前</i>
          <em>1136阅/27答</em>
        </li>
        <li>
          <a href="/jie/1.html" class="jie-title">使用 layui 秒搭后台大布局（基本结构）</a>
          <i>1天前</i>
          <em>1136阅/27答</em>
        </li>
        <li>
          <a href="/jie/1.html" class="jie-title">使用 layui 秒搭后台大布局（基本结构）</a>
          <i>1天前</i>
          <em>1136阅/27答</em>
        </li>
        <li>
          <a href="/jie/1.html" class="jie-title">使用 layui 秒搭后台大布局（基本结构）</a>
          <i>1天前</i>
          <em>1136阅/27答</em>
        </li>
      </ul>
      <!-- <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><i style="font-size:14px;">没有发表任何求解</i></div> -->
    </div>
  </div>
  
  <div class="layui-inline fly-home-da">
    <div class="fly-panel">
      <h3 class="fly-panel-title">贤心 最近的回答</h3>
      <ul class="home-jieda">
        <li>
          <p>
          <span>1分钟前</span>
          在<a href="" target="_blank">tips能同时渲染多个吗?</a>中回答：
          </p>
          <div class="home-dacontent">
            尝试给layer.photos加上这个属性试试：
<pre>
full: true         
</pre>
            文档没有提及
          </div>
        </li>
        <li>
          <p>
          <span>5分钟前</span>
          在<a href="" target="_blank">在Fly社区用的是什么系统啊?</a>中回答：
          </p>
          <div class="home-dacontent">
            Fly社区采用的是NodeJS。分享出来的只是前端模版
          </div>
        </li>
      </ul>
      <!-- <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><span>没有回答任何问题</span></div> -->
    </div>
  </div>
</script>
<!-- 建立视图。用于呈现模板渲染结果。 -->
<div id="home_view"></div>   
</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
<script>
var user_d;
layui.use(['laytpl','layedit','layer','jquery',],function(){
  var layedit = layui.layedit,layer = layui.layer,$ = layui.jquery,laytpl = layui.laytpl;
    //获取用户登陆信息
    $.ajax({
      url: "../api/user/user.php",
      success: function (res) {
          console.log('success:',res);
          user_d = res;
          //渲染数据
          var getTpl = home_moduel.innerHTML;
          var view = document.getElementById('home_view');
          laytpl(getTpl).render(user_d, function(html){
            view.innerHTML = html;
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