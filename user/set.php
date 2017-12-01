<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta name="keywords" content="物联网">
  <!-- vue -->
  <script src="https://cdn.bootcss.com/vue/2.5.3/vue.js"></script>
  <!-- layui -->
  <link rel="stylesheet" href="/frame/layui-master/src/css/layui.css">
  <link rel="stylesheet" href="/frame/layui-master/src/css/gloabal/global.css">
  <script src="/frame/layui-master/src/layui.js"></script>
  <!-- QQ登录 -->
  <script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js"></script>
  <!-- 自定义函数 -->
  <script src="/common/fun.js"></script>
</head>
<body>
  <?php require($_SERVER['DOCUMENT_ROOT'].'/common/header.php'); ?>
    <script id="moduel" type="text/html">
      <form action="">
        <div class="main fly-user-main layui-clear">
          <ul class="layui-nav layui-nav-tree layui-inline" lay-filter="user">
            <li class="layui-nav-item">
              <a href="home.php?userid={{user.userid}}">
                <i class="layui-icon">&#xe609;</i>
                我的主页
              </a>
            </li>
            <li class="layui-nav-item">
              <a href="index.php">
                <i class="layui-icon">&#xe612;</i>
                用户中心
              </a>
            </li>
            <li class="layui-nav-item layui-this">
              <a href="set.php">
                <i class="layui-icon">&#xe620;</i>
                基本设置
              </a>
            </li>
            <li class="layui-nav-item">
              <a href="message.php">
                <i class="layui-icon">&#xe611;</i>
                我的消息
              </a>
            </li>
            <!-- 顶级管理员可进入后台管理界面 -->
            {{# if(user.level=='admin-1'){ }}
              <li class="layui-nav-item">
                <a href="/admin/index.php">
                  <i class="layui-icon">&#xe613;</i>
                  后台管理
                </a>
              </li>
            {{# } }}
          </ul>
          
          <div class="site-tree-mobile layui-hide">
            <i class="layui-icon">&#xe602;</i>
          </div>
          <div class="site-mobile-shade"></div>
          
          <div class="fly-panel fly-panel-user" pad20>
            <div class="layui-tab layui-tab-brief" lay-filter="user">
              <ul class="layui-tab-title" id="LAY_mine">
                <li class="layui-this" lay-id="info">我的资料</li>
                <li lay-id="avatar">头像</li>
                <li lay-id="pass">密码</li>
                <li lay-id="bind">帐号绑定</li>
              </ul>
              <!-- 选项卡 -->
                <div class="layui-tab-content" style="padding: 20px 0;">
                <!-- 我的资料 -->

                  <div class="layui-form layui-form-pane layui-tab-item layui-show">
                    <div class="layui-form-item">
                      <label for="L_email" class="layui-form-label">邮箱</label>
                      <div class="layui-input-inline">
                        <input type="text" id="L_email" readonly="true" name="email" required lay-verify="email" autocomplete="off" value="{{d.email}}" class="layui-input">
                      </div>
                      <!-- <div class="layui-form-mid layui-word-aux">如果您在邮箱已激活的情况下，变更了邮箱，需<a href="activate.html" style="font-size: 12px; color: #4f99cf;">重新验证邮箱</a>。</div> -->
                    </div>
                    <div class="layui-form-item">
                      <label for="L_nickname" class="layui-form-label">昵称</label>
                      <div class="layui-input-inline">
                        <input type="text" id="L_nickname" name="nickname" required lay-verify="required" autocomplete="off" value="{{d.nickname}}" class="layui-input">
                      </div>
                      <div class="layui-inline">
                        <div class="layui-input-inline">
                          <input type="radio" name="sex" value="0" {{d.sex == '0' ? 'checked' : ''}} title="男">
                          <input type="radio" name="sex" value="1" {{d.sex == '1' ? 'checked' : ''}} title="女">
                        </div>
                      </div>
                    </div>
                    <div class="layui-form-item">
                      <label for="L_city" class="layui-form-label">城市</label>
                      <div class="layui-input-inline">
                        <input type="text" id="L_city" name="city" required lay-verify="required" autocomplete="off" value="{{d.city}}" class="layui-input">
                      </div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                      <label for="L_signature" class="layui-form-label">签名</label>
                      <div class="layui-input-block">
                        <textarea placeholder="随便写些什么刷下存在感" id="L_signature"  name="signature" required lay-verify="required" autocomplete="off" class="layui-textarea" style="height: 80px;">{{d.signature}}</textarea>
                      </div>
                    </div>
                    <div class="layui-form-item">
                      <button class="layui-btn" lay-filter="btn-update-info" lay-submit>确认修改</button>
                    </div>
                  </div>
                  <!-- 头像 -->
                  <div class="layui-form layui-form-pane layui-tab-item">
                    <div class="layui-form-item">
                      <div class="avatar-add">
                        <p>建议尺寸168*168，支持jpg、png、gif，最大不能超过30KB</p>
                        <div class="upload-img">
                          <button type="button" class="layui-btn" id="img_upload">
                          <i class="layui-icon">&#xe67c;</i>上传图片
                        </div>
                        <img id="upload-avatar" src="{{d.avatar}}">
                        <span class="loading"></span>
                      </div>
                    </div>
                  </div>
                  <!-- 密码 -->
                  <div class="layui-form layui-form-pane layui-tab-item">
                    <!-- <form action="/user/repass" method="post"> -->
                      <div class="layui-form-item">
                        <label for="L_nowpass" class="layui-form-label">当前密码</label>
                        <div class="layui-input-inline">
                          <input type="password" id="L_nowpass" name="nowpass" required lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                      </div>
                      <div class="layui-form-item">
                        <label for="L_pass" class="layui-form-label">新密码</label>
                        <div class="layui-input-inline">
                          <input type="password" id="L_pass" name="newpass" required lay-verify="password" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">6到20个数字和字符组合</div>
                      </div>
                      <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label">确认密码</label>
                        <div class="layui-input-inline">
                          <input type="password" id="L_repass" name="repass" required lay-verify="required" autocomplete="off" class="layui-input">
                        </div>
                      </div>
                      <div class="layui-form-item">
                        <button class="layui-btn" lay-filter="btn-update-password" lay-submit>确认修改</button>
                      </div>
                  </div>
                  <!-- 账号绑定 -->
                  <div class="layui-form layui-form-pane layui-tab-item">
                    <ul class="app-bind">
                      <li class="fly-msg app-havebind">
                        <i class="iconfont icon-qq"></i>
                        
                        <span>
                          {{# if(user.qq_openid){ }}
                             已成功绑定，您可以使用QQ帐号直接登录，当然，您也可以</span>
                            <a  href="#" style="cursor:hand;" id="acc-bind">解除绑定</a>
                          {{# }else{ }}
                            您还未绑定，绑定后您可以使用QQ帐号直接登录</span>
                            <a  href="#" onclick="qqLogin()" id="acc-unbind">立即绑定</a>
                          {{#  } }}
                      </li>
                    </ul>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </script> 
    <!-- 建立视图。用于呈现模板渲染结果。 -->
    <div id="view"></div> 
  <?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
<script>
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

    var getTpl = moduel.innerHTML;
    var view = document.getElementById('view');
    laytpl(getTpl).render(user, function(html){
      view.innerHTML = html;
    });

    // 有些表单元素可能是动态插入的。这时 Form模块 的自动化渲染是会对其失效的,需要重新渲染
    form.render('radio'); //更新radio

    // 更新头像
    upload.render({
      elem: '#img_upload' //绑定元素
      ,method:'POST'
      ,async:true
      ,data:{type:'avatar',userid:user.userid,'size':200}
      ,url: '/api/upload/upload.img.php' //上传接口
      ,before : function(){
        //执行上传前的回调  可以判断文件后缀等等
        layer.msg('上传中，请稍后......', {icon:16, shade:0.5, time:0});
      }
      ,done: function(res){
        //上传完毕回调
        console.log(res);
        if(res.code != 0){
        layer.msg(res.msg, {icon:2, shade:0.5, time:res.time});
      }
      else{
        layer.msg("更新头像成功！", {icon:1, shade:0.5, time:res.time});
        layui.jquery('#upload-avatar').attr("src", res.msg);
        layui.jquery('#image-avatar').attr("src", res.msg);
        // 保存头像到数据库
        $.ajax({
              type:'POST',
              url: "/api/user/avatar.php",
              data:{'userid':user.userid,'avatar':res.root},
              //数据长度太长，放到data里通过post传送
              success: function (argument) {
                  console.log(argument);
                  if (argument.resault=='success') {
                    // layer.msg('成功！',{icon:1,time:800},function(){
                        // window.location.href='/blog/index.php'
                      // });
                  }
                  else{
                    layer.msg(argument.msg,{time:2000});
                  }
              },
              error:function (argument) {
                console.log(argument);
                // layer.msg('失败！');
              }
          });
        }
      }
      ,error: function(res){
        //请求异常回调
        console.log(res);
      }
    });

    //修改资料
    form.on('submit(btn-update-info)', function(data){
      // layer_msg(JSON.stringify(data.field),2);
      console.log(data.field);
      $.ajax({
        type:'POST',
        url: "/api/user/update.info.php",
        data:{'userid':user.userid,'nickname':data.field.nickname,'sex':data.field.sex,'city':data.field.city,'signature':data.field.signature},
         success: function (argument) {
          if (argument.resault=='success') {
            layer_msg("修改成功！",1);
          }
          else{
            console.log("错误：",argument);
            layer_msg(argument.msg,6,'修改失败：');
          }
        },
        error:function (argument) {
          console.log(argument);
          layer_msg('注册失败！',4,'提示');
        }
      });  
      return false;
    });

    // 修改密码
    form.on('submit(btn-update-password)', function(data){
      // layer_msg(JSON.stringify(data.field),2);
      console.log(data.field);
      //判断确认密码
      if(data.field.newpass!=data.field.repass)
      {
        layer_msg('确认密码与密码不一致！');
      }
      else{
        $.ajax({
          type:'POST',
          url: "/api/user/update.password.php",
          data:{'userid':user.userid,'password':data.field.nowpass,'new_password':data.field.newpass},
           success: function (argument) {
            if (argument.resault=='success') {
              layer_msg("修改成功，通知邮件已经发送到您的邮箱："+user.email,1);
            }
            else{
              console.log("错误：",argument);
              layer_msg('修改失败：'+argument.msg,4);
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

    // 监听解除绑定
    $("#acc-bind").click(function() {  
       layer.confirm('确定解绑当前QQ？', {
        btn: ['很确定','再想想'] 
        }, function(index, layero){
        // layer.msg('确定');
        //更改密码
        $.ajax({
          type:'POST',
          async: true, //异步
          url: "../api/user/qq.openid.remove.php",
          data:{'userid':user.userid},
          success: function (argument) {
             if (argument.resault=='success') {
                  layer.confirm("解绑成功", {btn: ['知道了']});
                  window.location.href=window.location.href; 
              }
              else{
                // 提示错误信息
                console.log(argument.msg);
                layer.confirm('解绑失败：'+argument.msg, {btn: ['我再试一次']});
              }
          },
          error:function (argument) {
            console.log(argument);
            layer.msg('修改失败,请稍后再试！');
          }
        }); 
      });
    })
    // 监听绑定

  });  
</script>
</body>
</html>