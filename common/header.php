<div class="header" style="display: block;">
  <div  style="width: 90%;">
    <ul class="layui-nav" >
      <img src='/image/default/header_logo.png'>
      <li class="layui-nav-item"><a href="/index.php" class="iconfont">首页</a></li>
      <li class="layui-nav-item"><a href="/blog/index.php" class="iconfont">社区</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;" class="iconfont">控制台</a>
        <dl class="layui-nav-child">
          <a href="/device/bluetooth/index.php" class="iconfont">配置蓝牙</a>
          <a href="/device/device.php" class="iconfont">设备控制</a>
          <a href="/device/management.php" class="iconfont">设备管理</a>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="/about/index.php" class="iconfont">关于</a></li>
    </ul> 
    <div class="nav-user">
      <!-- 模板 -->
      <script id="tpl_header" type="text/html">
        <!-- 已登录 -->
        {{#  if(user.login === "true"){ }}
          <a class='avatar' href='/user/home.php?userid={{user.userid}}'>

          <img id='image-avatar' src='{{ user.avatar }}'>
          <cite id='nickname'>{{ user.nickname }}</cite>
          <i>VIP</i>
          </a>
          <div class='nav'>
          <a href='/user/set.php' target = "_blank" ><i class='iconfont icon-shezhi'></i>设置</a>
          <a href='/user/logout.php'><i class='iconfont icon-tuichu' style='top: 0; font-size: 22px;'></i>退了</a>
          </div>  
        {{# }else { }} 
        <!-- 未登录 -->
          <a class="unlogin" href="/user/login.php"><i class="iconfont icon-touxiang"></i></a>
          <span>
       <!--      <a href="/user/login.php?backurl='javascript:location.href'">登入</a><a href="/user/register.php">注册</a> -->
            <a href="javascript:location.href='/user/login.php?backurl='+location.href">登入</a>
            <a href="javascript:location.href='/user/register.php?backurl='+location.href">注册</a>
          </span>
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
<script>
  // 定义用户数据变量
  var user;
  // 加载需要的模块
  layui.use(['laytpl','jquery'], function(){
  var laytpl,$;
  laytpl = layui.laytpl;
  $  = layui.jquery;
  //获取用户登陆信息
  $.ajax({
    url: "/api/user/user.php",
    async: false, //同步
    success: function (res) {
        console.log('success:',res);
        user = res;
        //渲染数据
        var getTpl = tpl_header.innerHTML;
        var view_header = document.getElementById('view_header');
        laytpl(getTpl).render(user, function(html){
          view_header.innerHTML = html;
        });
      },
      error:function (res) {
          console.log('fail:',res);
      }
    });
  });

  //QQ登录
  function qqLogin(){
    QC.Login.showPopup({
      appId:"101435544",
      redirectURI:"http://"+location.host+"/user/qq/qc_back.php?backurl="+location.href
    });
    window.close();
  }
</script>