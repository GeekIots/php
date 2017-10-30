<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>QQ快速登录</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="keywords" content="geek,geekiot,物联网,物联网社区">
  <meta name="description" content="极客社区是极客物联网开发平台的官网社区，致力于为物联网开发提供强劲动力！">
  <link rel="stylesheet" href="/frame/layui-v2.1.0/layui/css/layui.css">
  <link rel="stylesheet" href="/common/res/css/global.css">
  <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/frame/layui-v2.1.0/layui/layui.all.js"></script>
  <!-- 预加载的layui模块 -->
  <script src="<?php $_SERVER['DOCUMENT_ROOT'] ?>/common/layerload.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" data-appid="101435544" charset="utf-8"></script>
	  <!-- data-callback="true" -->
</head>
<body>
<!-- 头部 -->
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
      <a href="/device/userdevice.php" target="">
        <i class="iconfont"></i>控制台
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
</script>
<div class="main layui-clear">
  <div class="fly-panel fly-panel-user" pad20>	 
	<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
	  <ul class="layui-tab-title">
	    <li class="layui-this">快速注册新号</li>
	    <li>绑定已有账号</li>
	  </ul>
	  <div class="layui-tab-content">
	  	<!-- 快速注册新号 -->
	    <div class="layui-tab-item layui-show">
	    	<div class="layui-tab-item layui-show">
	          <div class="layui-form layui-form-pane">
	            <div class="layui-form-item">
	              <label for="Reg_email" class="layui-form-label" >邮箱</label>
	              <div class="layui-input-inline">
	                <input type="text" id="Reg_email" name="email" required lay-verify="email" autocomplete="off" class="layui-input">
	              </div>
	              <div class="layui-form-mid layui-word-aux">将会成为您唯一的登入名</div>
	            </div>
	            <div class="layui-form-item">
	              <label for="L_nickname" class="layui-form-label">昵称</label>
	              <div class="layui-input-inline">
	                <input type="text" id="Reg_nickname" name="username" required lay-verify="required" autocomplete="off" class="layui-input">
	              </div>
	            </div>
	            <div class="layui-form-item">
	              <label for="L_pass" class="layui-form-label">密码</label>
	              <div class="layui-input-inline">
	                <input type="password" id="Reg_pass" name="pass" required lay-verify="required" autocomplete="off" class="layui-input">
	              </div>
	              <div class="layui-form-mid layui-word-aux">6-20位字母数字组合</div>
	            </div>
	            <div class="layui-form-item">
	              <label for="L_repass" class="layui-form-label">确认密码</label>
	              <div class="layui-input-inline">
	                <input type="password" id="Reg_repass" name="repass" required lay-verify="required" autocomplete="off" class="layui-input">
	              </div>
	            </div>
	            <div class="layui-form-item">
	              <label for="L_vercode" class="layui-form-label">人类验证</label>
	              <div class="layui-input-inline">
	                <input type="text" id="Reg_vercode" name="vercode" required lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
	              </div>
	              <div class="layui-form-mid">
	                <span style="color: #c00;">2+2=?</span>
	              </div>
	            </div>
	            <div class="layui-form-item">
	              <button class="layui-btn" lay-filter="*" lay-submit id="register-btn">立即注册</button>
	            </div>
	          </div>
	        </div>
	    </div>
	    <!-- 绑定已有账号 -->
	    <div class="layui-tab-item">
		    <div class="layui-tab-item layui-show">
	          <div class="layui-form layui-form-pane">
	            <div class="layui-form-item">
	              <label for="L_email" class="layui-form-label">邮箱</label>
	              <div class="layui-input-inline">
	                <input type="text" id="Login_email" name="email" required lay-verify="email" autocomplete="off" class="layui-input">
	              </div>
	            </div>
	            <div class="layui-form-item">
	              <label for="L_pass" class="layui-form-label">密码</label>
	              <div class="layui-input-inline">
	                <input type="password" id="Login_pass" name="pass" required lay-verify="required" autocomplete="off" class="layui-input">
	              </div>
	            </div>
	            <div class="layui-form-item">
	              <label for="L_vercode" class="layui-form-label">人类验证</label>
	              <div class="layui-input-inline">
	                <input type="text" id="Login_vercode" name="vercode" required lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
	              </div>
	              <div class="layui-form-mid">
	                <span style="color: #c00;">1+1=?</span>
	              </div>
	            </div>
	            <div class="layui-form-item">
	              <button class="layui-btn" lay-filter="*" lay-submit id="login-btn">立即登录</button>
	              <span style="padding-left:20px;">
	                <a href="forget.html">忘记密码？</a>
	              </span>
	            </div>
	          </div>
	        </div>	
	    </div>
	  </div>
	</div>
  </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
<script>
  var qq_openid;//qq openid
  var qq_info;//qq信息，包含昵称，头像等 
  $('.layui-btn').on('click', function(){
      //注册登录
      if ($(this).attr("id")=='register-btn') {
        //获取登录信息
        var L_email = $('#Reg_email').val();
        var L_pass = $('#Reg_pass').val();
        var L_repass = $('#Reg_repass').val();
        var L_vercode = $('#Reg_vercode').val();
        var L_nickname = $('#Reg_nickname').val();
        if(L_repass!=L_pass)
        {
          layer.msg('确认密码不一致！',{time:1000});
        }
        else
        if(L_vercode!='4')
        {
          layer.msg('验证信息不正确！',{time:1000});
        }
        else
        {
          $.ajax({
            type:'POST',
            url: "/api/user/register.php",
            data:{'email':L_email,'nickname':L_nickname,'password':L_pass,'qq_openid':qq_openid,'avatar':qq_info.figureurl_qq_2},
            //数据长度太长，放到data里通过post传送
             success: function (argument) {
               if (argument.resault=='success') {
                  layer.msg('恭喜你,注册成功！我们已经将激活邮件发送到'+L_email+',请尽快激活账号！', {
                      time: 20000, //20s后自动关闭
                      btn: ['OK']
                      ,yes: function(){
                        console.log('yes');
                      }
                      ,btn2: function(){
                        console.log('btn2');
                      }
                    });
                    var backurl = getUrlParam('backurl');
                    if(backurl==''){  
                        location.href = '/index.php';  
                  } 
                  else
                      location.href = backurl;  
                }
                else{
                  console.log(argument);
                  layer.msg(argument.msg,{time:2000});
                }
            },
            error:function (argument) {
              console.log(argument);
                layer.msg('注册失败！');
            }
          });
        }
      }
      //绑定登录
      else 
      if ($(this).attr("id")=='login-btn') {
        //获取登录信息
        var L_email = $('#Login_email').val();
        var L_pass = $('#Login_pass').val();
        var L_vercode = $('#Login_vercode').val();
        if(L_vercode!='2')
        {
          layer.msg('验证信息不正确！',{time:1000});
        }
        else
        {
          $.ajax({
            type:'POST',
            url: "/api/user/login.php",
            data:{'email':L_email,'password':L_pass,'qq_openid':qq_openid,'avatar':qq_info.figureurl_qq_2,'nickname':qq_info.nickname},
            //数据长度太长，放到data里通过post传送
            success: function (argument) {
               if (argument.resault=='success') {
                  layer.msg('登录成功！', {
                    time: 1000 //1s后自动关闭
                  });
                  console.log('登录结果:',argument);
                  // 页面跳转
                  var backurl = getUrlParam('backurl');
                  if(backurl==''){  
                      location.href = '/index.php'; 
                  } 
                  else
                      location.href = backurl;   
                }
                else{
                  // 登录失败，提示错误信息
                  console.log(argument);
                  layer.msg(argument.msg,{time:2000});
                }
            },
            error:function (argument) {
              console.log(argument);
              layer.msg('登录失败,请稍后再试！');
            }
          });
        }
      }
    });

  	//如果已登录  
	if(QC.Login.check()){
		QC.Login.getMe(function(openId, accessToken){  
		    // alert(["当前用户的", "openId为："+openId, "accessToken为："+accessToken].join("\n"));
        qq_openid = openId;  
		    console.log("openId为："+openId );
		    console.log("accessToken为："+accessToken );
		});  
		//OpenID是每个QQ唯一的，可用于绑定会员，请在本页配置数据库，写入用户表！ 
	}  


	//用JS SDK调用OpenAPI
	QC.api("get_user_info", {}).success(function(s){
			//成功回调，通过s.data获取OpenAPI的返回数据
			// alert(s.data.nickname);
      qq_info = s.data;
			console.log('用户信息:',qq_info);

      // 更新用户昵称
      $('#Reg_nickname').val(s.data.nickname);

      // 尝试以qq_openid登录，如果登录失败，用户自主登录
      //获取用户登陆信息
      $.ajax({
        type:'POST',
        url: "/api/user/login_qq_openid.php",
        data:{'qq_openid':qq_openid},
        success: function (res) {
            console.log('success:',res);
            if (res.resault=='success') {
              // 执行登陆流程
              var backurl = getUrlParam('backurl');
              if(backurl==''){  
                  location.href = '/index.php';  
              } 
              else
                  location.href = backurl;  
            }
        },
        error:function (res) {
            console.log('fail:',res);
        }
      });

		}).error(function(f){
			//失败回调
			console.log('获取用户信息失败！',f);
		}).complete(function(c){
		//完成请求回调
	}); 

</script>
</body>
</html>