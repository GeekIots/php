<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <title>QQ快速登录</title>
  <meta name="keywords" content="物联网">
  <!-- vue -->
  <script src="https://cdn.bootcss.com/vue/2.5.3/vue.js"></script>
  <!-- layui -->
  <link rel="stylesheet" href="/frame/layui-master/src/css/layui.css">
  <link rel="stylesheet" href="/frame/layui-master/src/css/gloabal/global.css">
  <script src="/frame/layui-master/src/layui.js"></script>
  <!-- QQ登录 -->
  <script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" data-appid="101435544" charset="utf-8"></script>
  <!-- 自定义函数 -->
  <script src="/common/fun.js"></script>
</head>
<body style="background-color: white" >
  <?php require($_SERVER['DOCUMENT_ROOT'].'/common/header.php'); ?>
  <script id="Tpl_1" type="text/html">
    <form action="">
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
                      <label class="layui-form-label">邮箱</label>
                      <div class="layui-input-inline">
                        <input type="text" name="email" required lay-verify="email" autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">将会成为您唯一的登入名</div>
                    </div>

                    <div class="layui-form-item">
                      <label for="L_nickname" class="layui-form-label">昵称</label>
                      <div class="layui-input-inline">
                        <input type="text" id="Reg_nickname" name="nickname" required lay-verify="required" autocomplete="off" class="layui-input" value="{{qq_info.nickname}}" >
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
                      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                      <button class="layui-btn" lay-filter="register-btn" lay-submit >立即注册</button>
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
                      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                      <button class="layui-btn" lay-filter="login-btn" lay-submit>立即登录</button>
                      <span style="padding-left:20px;">
                      <a href="/user/forget.php">忘记密码？</a>
                      </span>
                    </div>

                  </div>
                </div>  
            </div>
          </div>
        </div>
        </div>
      </div>  
    </form>
  </script>
  <!-- 建立视图。用于呈现模板渲染结果。 -->
  <div id="view_1"></div>  
  <?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
<script>
  var qq_openid;//qq openid
  var qq_info;//qq信息，包含昵称，头像等 
 // 加载需要的模块
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

   //加载层
  layer.load(0, {shade: false}); //0代表加载的风格，支持0-2
  
  //如果已登录  
  if(QC.Login.check()){
    console.log("已经登陆");
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
      // $('#Reg_nickname').val(s.data.nickname);

      // 尝试以qq_openid登录，如果登录失败，用户自主登录
      console.log("以openid登陆");
      var backurl = getUrlParam('backurl');
      // location.href = backurl+"&qq_openid="+qq_openid; 
      $.ajax({
        type:'POST',
        async: false, //同步
        url: "/api/user/login_qq_openid.php",
        data:{'qq_openid':qq_openid},
        success: function (res) {
            console.log('登陆结果:',res);
            console.log('openid:',qq_openid);
            if (res.resault=='success') {
              // 执行登陆流程
              var backurl = getUrlParam('backurl');
              if(backurl==''){  
                  location.href = '/index.php'; 
                  // window.open('/index.php', "_blank");
              } 
              else
                // window.open(backurl, "_blank");
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
    //渲染数据
    var getTpl = Tpl_1.innerHTML;
    var view = document.getElementById('view_1');
    laytpl(getTpl).render(qq_info, function(html){
      view.innerHTML = html;
    }); 

    layer.closeAll();

    });




    //监听注册登录
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
      // 读取本地数据
        user_location = layui.data('user_location');
        console.log('注册',user_location);
        $.ajax({
          type:'POST',
          url: "/api/user/register.php",
          data:{'email':data.field.email,'nickname':data.field.nickname,'password':data.field.pass,'city':user_location.location,'qq_openid':qq_openid,'avatar':qq_info.figureurl_qq_2},
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
                ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">恭喜你,注册成功！我们已经将激活邮件发送到'+L_email+',请尽快激活账号！</div>'
                ,success: function(layero){
                  var btn = layero.find('.layui-layer-btn');
                  btn.find('.layui-layer-btn0').attr({href: '/index.php'});
                  btn.find('.layui-layer-btn1').attr({href: backurl});
                }
              });
            }
            else{
              console.log("错误：",argument);
              layer.msg(argument.msg,{time:1000});
            }
          },
          error:function (argument) {
            console.log(argument);
            layer.msg('注册失败！');
          }
        });
      }    
      return false;
    });

    //绑定登录
    form.on('submit(login-btn)', function(data){
       // layer.msg(JSON.stringify(data.field));
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
          url: "/api/user/login.php",
          data:{'email':data.field.email,'password':data.field.pass,'nickname':qq_info.nickname,'qq_openid':qq_openid,'avatar':qq_info.figureurl_qq_2},
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
                ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">恭喜你,绑定成功！以后您可以用该QQ号直接登录本站！</div>'
                ,success: function(layero){
                  var btn = layero.find('.layui-layer-btn');
                  btn.find('.layui-layer-btn0').attr({href: '/index.php'});
                  btn.find('.layui-layer-btn1').attr({href: backurl});
                }
              });
            }
            else{
              console.log("错误：",argument);
              layer.msg(argument.msg,{time:1000});
            }
          },
          error:function (argument) {
            console.log(argument);
            layer.msg('登陆失败！');
          }
        });
      }    
      return false;
    });
  });
</script>
</body>
</html>