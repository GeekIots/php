<div class="header">
  <div>
    <!-- 模板 -->
    <script id="tpl_header" type="text/html">
      <ul class="layui-nav" style="background-color:#23262E;" >
        <img src='/image/default/header_logo.png'>
        <li class="layui-nav-item"><a href="/index.php" class="iconfont">首页</a></li>
        
        <li class="layui-nav-item">
          <a href="javascript:;" class="iconfont">控制台</a>
          <dl class="layui-nav-child">
            <a href="/device/bluetooth/index.php" class="iconfont">配置蓝牙</a>
            <a href="/device/device.php" class="iconfont">设备控制</a>
            <a href="/device/management.php" class="iconfont">设备管理</a>
          </dl>
        </li>
       <!--  <li class="layui-nav-item"><a href="/about/index.php" class="iconfont">智能硬件</a></li> -->
<!--         <li class="layui-nav-item">
          <a href="/showdoc/index.php?s=/1&page_id=2" class="iconfont" target = "_blank">文档</a>
        </li> -->
        <li class="layui-nav-item"><a href="http://geek-iot.com/forum/forum.php?mod=viewthread&tid=4&page=1&extra=#pid5" class="iconfont" target = "_blank">示例</a></li>
        <li class="layui-nav-item"><a href="/forum" class="iconfont" target = "_blank">社区</a></li>
        <li class="layui-nav-item"><a href="/about/index.php" class="iconfont">关于</a></li>
        <div class="nav-user">
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
            <a href="javascript:location.href='/user/login.php?backurl='+location.href">登入</a>
            <a href="javascript:location.href='/user/register.php?backurl='+location.href">注册</a>
          </span>
          <p class="out-login">
            <a class="iconfont icon-qq" title="QQ登入" onclick="qqLogin()" target=""></a>
            <!-- <a class="iconfont icon-weibo" title="微博登入"></a> -->
          </p>
        </div>
        {{#  } }} 
      </ul> 
    </script>
    <!-- 建立视图。用于呈现模板渲染结果。 -->
    <div id="view_header"></div> 
  </div>
</div>
<script>
  // 定义用户数据变量
  var user;
  //用户位置信息
  var user_location;
  // 加载需要的模块
  layui.use(['laytpl','jquery'], function(){
  var laytpl,$;
  laytpl = layui.laytpl;
  $  = layui.jquery;

  // 域名不是geek-iot时自动跳转
  if (!(isContains(window.location.href,'geek-iot')||isContains(window.location.href,'localhost')))
  {
    window.location.href = "http://geek-iot.com";
  }
  

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

    
    //判断是否包含字符串，返回true和false
    function isContains(str, substr) {
         return new RegExp(substr).test(str);
     }

    //访客计数，存储访问次数，地区，时间，访问来源

    // 当前url
    var nowurl = document.URL;
    // 获取来源url
    var fromurl = document.referrer; 
    var iscount = true;
    // 读取本地数据
    var localcount = layui.data('count');
    // console.log('localcount:',localcount);
    // console.log('nowurl:',nowurl);
    // console.log('fromurl:',fromurl);
   if (localcount) {
      if ((localcount.nowurl==nowurl)&&(localcount.fromurl==fromurl)) {
        // 当前页面刷新，不计
        iscount = false;
        console.log("刷新页面");
      }
      else
      {
        // 不是刷新，正常计数
        //存储到本地
        layui.data('count', {
          key: 'nowurl',
          value: nowurl
        });
        layui.data('count', {
          key: 'fromurl',
          value: fromurl
        });
        console.log("跳转页面");
      }
    }
    else
    {
      // 未检测到，正常计数
      //存储到本地 
      layui.data('count', {
        key: 'nowurl',
        value: nowurl
      });
      layui.data('count', {
        key: 'fromurl',
        value: fromurl
      });
      console.log("进入本站页面");
    }

    // 获取地区
    // 读取本地数据
   user_location = layui.data('user_location');
   if (user_location.location) {
      if (fromurl!=''&&(nowurl!=fromurl)&&iscount) {
          if(isContains(fromurl,'geek-iot')||isContains(fromurl,'localhost')){  
            //来自于本网站url  
            fromurl = '站内->'+fromurl;
          } 
          else
          {
            fromurl = '外网->'+fromurl;
          }
          
          //判断访问者身份
          var user_nickname;
          if (user.nickname) {user_nickname=user.nickname}
            else user_nickname = '游客';

          $.ajax({
            url: "/api/admin/access.count.php",
            data:{'nickname':user_nickname,type:'set','city':user_location.location,'nowurl':nowurl,'fromurl':fromurl},
            async: true, 
            success: function (res) {
                console.log('访客计数:',res);
              },
              error:function (res) {
                  console.log('访客计数:',res);
              }
          });     
        }
    }
    else
    {
      
      // 未检测到，获取
      $.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js', function(res) {
        console.log('remote_ip_info:'+remote_ip_info);
        var res = remote_ip_info;
        if (res.ret == '1') {
            //存储到全局变量,修改位置信息格式为 “陕西·西安”
            user_location=res.country+"·"+res.province.replace(/省/, "")+"·"+res.city.replace(/市/, "");
         }
         else
         {
          user_location = '火星';
         }

         //存储到本地 
        layui.data('user_location', {
          key: 'location',
          value: user_location
        });

         user_location = layui.data('user_location');
         console.log("位置："+user_location.location);

         if (fromurl!=''&&(nowurl!=fromurl)&&iscount) {
          if(isContains(fromurl,'geek-iot')||isContains(fromurl,'localhost')){  
            //来自于本网站url  
            fromurl = '站内->'+fromurl;
          } 
          else
          {
            fromurl = '外网->'+fromurl;
          }
          
          //判断访问者身份
          var user_nickname;
          if (user.nickname) {user_nickname=user.nickname}
            else user_nickname = '游客';

          $.ajax({
            url: "/api/admin/access.count.php",
            data:{'nickname':user_nickname,type:'set','city':user_location.location,'nowurl':nowurl,'fromurl':fromurl},
            async: true, 
            success: function (res) {
                console.log('访客计数:',res);
              },
              error:function (res) {
                  console.log('访客计数:',res);
              }
          });     
        }
      }); 
    }
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


