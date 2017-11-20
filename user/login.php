<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>登入</title>
</head>
<body>
<form action="">
  <div class="main layui-clear">
    <div class="fly-panel fly-panel-user" pad20>
      <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
          <li class="layui-this">登入</li>
          <li><a href="register.php">注册</a></li>
        </ul>
        <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
          
          <div class="layui-tab-item layui-show">
            <div class="layui-form layui-form-pane">
              <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">邮箱</label>
                <div class="layui-input-inline">
                  <input type="text" id="L_email" name="email" required lay-verify="email" autocomplete="off" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">密码</label>
                <div class="layui-input-inline">
                  <input type="password" id="L_pass" name="pass" required lay-verify="required" autocomplete="off" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label for="L_vercode" class="layui-form-label">人类验证</label>
                <div class="layui-input-inline">
                  <input type="text" id="L_vercode" name="vercode" required lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid">
                  <span style="color: #c00;">1+1=?</span>
                </div>
              </div>
              <div class="layui-form-item">
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                <button class="layui-btn" lay-filter="login-btn" lay-submit id="login-btn">立即登录</button>
                <span style="padding-left:20px;">
                  <a href="forget.php">忘记密码？</a>
                </span>
              </div>
              <div class="layui-form-item fly-form-app">
                <span>或者使用社交账号登入</span>
                <a class="iconfont icon-qq" onclick="qqLogin()" title="QQ登入"></a>
                <!-- <a href="http://fly.layui.com:8098/app/weibo/" onclick="layer.msg('正在通过微博登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-weibo" title="微博登入"></a> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
<script>
  var backurl = getUrlParam('backurl');
  if(!backurl)backurl = '/index.php';
  //登录
  form.on('submit(login-btn)', function(data){
    console.log(data.field);
    //判断验证码
    if(data.field.vercode!='2')
    {
      layer_msg('验证信息不正确！');
    }
    else
    {
      $.ajax({
        type:'POST',
        async: true,
        url: "/api/user/login.php",
        data:{'email':data.field.email,'password':data.field.pass},
        success: function (argument) {
           if (argument.resault=='success') {
              layer.msg('登录成功！');
              // 页面跳转
              location.href = backurl;   
            }
            else{
              // 登录失败，提示错误信息
              console.log(argument);
              layer_msg('登陆失败：'+argument.msg,4);
            }
        },
        error:function (argument) {
          console.log(argument);
          layer_msg('登录失败,请稍后再试！',4);
        }
      });
    }    
    return false;
  });

  //判断是否敲击了Enter键 
  $(document).keyup(function(event){ 
      if(event.keyCode ==13){ 
        $("#login-btn").trigger("click"); 
      } 
  });
</script>
</body>
</html>