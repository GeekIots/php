<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>注册</title>
</head>
<body>
<form action="">
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
                  <input type="text" id="L_nickname" name="nickname" required lay-verify="required" autocomplete="off" class="layui-input">
                </div>
              </div>
              <div class="layui-form-item">
                <label for="L_pass" class="layui-form-label">密码</label>
                <div class="layui-input-inline">
                  <input type="password" id="L_pass" name="pass" required lay-verify="password" autocomplete="off" class="layui-input">
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
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                <button class="layui-btn" lay-filter="register-btn" lay-submit>立即注册</button>
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
</form>
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
<script>
  //监听注册
  form.on('submit(register-btn)', function(data){
    // layer.msg(JSON.stringify(data.field));
    console.log(data.field);
    //判断确认密码
    if(data.field.pass!=data.field.repass)
    {
      layer_msg('确认密码与密码不一致！');
    }
    else
    //判断验证码
    if(data.field.vercode!='4')
    {
      layer_msg('验证信息不正确！');
    }
    else
    {
      $.ajax({
        type:'POST',
        url: "/api/user/register.php",
        data:{'email':data.field.email,'nickname':data.field.nickname,'password':data.field.pass},
         success: function (argument) {
          var backurl = getUrlParam('backurl');
          if(!backurl)backurl = '/index.php';
          if (argument.resault=='success') {
            layer.open({
              type: 1
              ,title: false //不显示标题栏
              ,closeBtn: false
              ,area: '300px;'
              ,shade: 0.8
              ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
              ,resize: false
              ,btn: ['前往首页', '原路返回']
              ,btnAlign: 'c'
              ,moveType: 1 //拖拽模式，0或者1
              ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">恭喜你,注册成功！我们已经将激活邮件发送到'+data.field.email+',请尽快激活账号！</div>'
              ,success: function(layero){
                var btn = layero.find('.layui-layer-btn');
                btn.find('.layui-layer-btn0').attr({href: '/index.php'});
                btn.find('.layui-layer-btn1').attr({href: backurl});
              }
            });
          }
          else{
            console.log("错误：",argument);
            layer_msg('注册失败:'+argument.msg,4);
          }
        },
        error:function (argument) {
          console.log(argument);
          layer_msg('注册失败！',4);
        }
      });
    }    
    return false;
  });
</script>
</body>
</html>