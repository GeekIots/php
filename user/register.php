<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>注册</title>
</head>
<body>
<div class="main layui-clear">
  <div class="fly-panel fly-panel-user" pad20 >
    <div class="layui-tab layui-tab-brief">
      <ul class="layui-tab-title">
        <li><a href="login.php">登入</a></li>
        <li class="layui-this">注册</li>
      </ul>
      <div class="layui-form layui-tab-content" id="LAY_ucm">
        <div class="layui-tab-item layui-show">
          <div class="layui-form layui-form-pane">
            <div class="layui-form-item">
              <label for="L_email" class="layui-form-label">邮箱</label>
              <div class="layui-input-inline">
                <input type="text" id="L_email" name="email" required lay-verify="email" autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">将会成为您唯一的登入名</div>
            </div>
            <div class="layui-form-item">
              <label for="L_nickname" class="layui-form-label">昵称</label>
              <div class="layui-input-inline">
                <input type="text" id="L_nickname" name="username" required lay-verify="required" autocomplete="off" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label for="L_pass" class="layui-form-label">密码</label>
              <div class="layui-input-inline">
                <input type="password" id="L_pass" name="pass" required lay-verify="required" autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid layui-word-aux">6-20位字母数字组合</div>
            </div>
            <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">确认密码</label>
              <div class="layui-input-inline">
                <input type="password" id="L_repass" name="repass" required lay-verify="required" autocomplete="off" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item">
              <label for="L_vercode" class="layui-form-label">人类验证</label>
              <div class="layui-input-inline">
                <input type="text" id="L_vercode" name="vercode" required lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
              </div>
              <div class="layui-form-mid">
                <span style="color: #c00;">2+2=?</span>
              </div>
            </div>
            <div class="layui-form-item">
              <button class="layui-btn">立即注册</button>
            </div>
            <div class="layui-form-item fly-form-app">
              <span>或者直接使用社交账号快捷注册</span>
              <a onclick="qqLogin()" class="iconfont icon-qq" title="QQ登入"></a>
              <!-- <a href="#" onclick="layer.msg('正在通过微博登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-weibo" title="微博登入"></a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
<script>
  //注册 
  $('.layui-btn').on('click', function(){
    //获取注册信息
    var L_email = $('#L_email').val();
    var L_pass = $('#L_pass').val();
    var L_repass = $('#L_repass').val();
    var L_vercode = $('#L_vercode').val();
    var L_nickname = $('#L_nickname').val();
    if(L_email.length!=0)
    {
      var Regex = /^(?:\w+\.?)*\w+@(?:\w+\.)*\w+$/;            
　　    if (!Regex.test(L_email)){
        layer.msg('邮箱格式不正确！',{time:1000});
      }
      else{
        if(L_nickname.length==0)
        {
          layer.msg('昵称不能为空！',{time:1000});
        }
        else
        if(L_pass.length==0)
        {
          layer.msg('密码不能为空！',{time:1000});
        }
        else{
          // 密码复杂度校验（6-20位数字和字母组合）
          var reg = new RegExp(/^[A-Za-z0-9]{6,20}$/);
          if (!reg.test(L_pass)) {
              layer.msg('密码过于简单！',{time:1000});
          }
          else {
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
                url: "../api/user/register.php",
                data:{'email':L_email,'nickname':L_nickname,'password':L_pass},
                //数据长度太长，放到data里通过post传送
                 success: function (argument) {
                   if (argument.resault=='success') {
                      layer.msg('恭喜你,注册成功！我们已经将激活邮件发送到'+L_email+',请尽快激活账号！', {
                      time: 20000, //20s后自动关闭
                      btn: ['OK']
                      ,yes: function(){
                        // 跳转到首页
                      }
                      ,btn2: function(){
                      }
                    });
                      // layer.msg('注册成功！',{icon:1,time:800},function(){
                      //     // window.location.reload();
                      //   });
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
        }
      }            
    }
    else {
      layer.msg('邮箱不能为空！');
    }
  });
</script>

</body>
</html>