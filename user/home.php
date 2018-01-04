<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>我的消息 | 极客物联网</title>
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
  <div style="margin-top: 65px;">
    <!-- 用户信息模板 -->
    <script id="home_moduel" type="text/html">
      <div class="fly-home" style="background-image: url();">
        <img src="{{user.avatar}}" alt="{{user.nickname}}">
        <h1>
          {{user.nickname}}
          <!-- 0：男 ，1：女 -->
          <i class="iconfont 
          {{# if(user.sex == 0){ }}
            icon-nan
          {{# } else if(user.sex == 1){ }}
            icon-nv
          {{# } }}
          "></i> 
          <!-- <i class="iconfont icon-nv"></i> -->
          <!-- <span style="color:#c00;">（超级码农）</span>
          <span style="color:#5FB878;">（活雷锋）</span>
          <span>（该号已被封）</span> -->
        </h1>
        <p class="fly-home-info">
          <!-- <i class="iconfont icon-zuichun" title="飞吻"></i><span style="color: #FF7200;">67206飞吻</span> -->
          <i class="iconfont icon-shijian"></i><span>{{ layui.util.timeAgo(user.datetime)}} 加入</span>
          <i class="iconfont icon-chengshi"></i><span>来自{{user.city}}</span>
        </p>
        <p class="fly-home-info"><i class="iconfont"></i><span>用户ID:{{user.userid}}</span></p>
        <p class="fly-home-sign">（{{user.signature}}）</p>
      </div>
      
      <!-- 发帖列表 -->
      <div class="main fly-home-main">
        <div class="layui-inline fly-home-jie">
          <div class="fly-panel">
            <h3 class="fly-panel-title">{{user.nickname}} 最近的帖子</h3>
            <ul class="jie-row">
              {{user_blog.length == 0 ? '还没有发帖！' : ''}}
              {{#  layui.each(user_blog.list, function(index, item){ }}
                <li>
                  <!-- <span class="fly-jing">精</span> -->
                  <a href="/blog/view.php?id={{item.id}}" target="_blank" class="jie-title">{{item.title}}</a>
                  <i>{{layui.util.timeAgo(item.dates)}}</i>
                  <em>{{item.browser}}阅/{{item.answer}}答</em>
                </li>
              {{#  }); }}
            </ul>
            <!-- <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><i style="font-size:14px;">没有发表任何求解</i></div> -->
          </div>
        </div> 
        <!-- 回帖列表 -->
        <div class="layui-inline fly-home-da">
          <div class="fly-panel">
            <h3 class="fly-panel-title">{{user.nickname}} 最近的回复</h3>
            <ul class="home-jieda">
              {{user_answer.length == 0 ? '没有回复过！' : ''}}
              {{#  layui.each(user_answer.list, function(index, item){ }}
                <li>
                  <span>{{ layui.util.timeAgo(item.dates)}}</span>
                  在<a href="/blog/view.php?id={{item.id}}" target="_blank">{{item.title}}</a>中回答：
                  <div class="home-dacontent">
                    {{item.contents}}
                  </div>
                </li>
              {{#  }); }}
            </ul>
            <!-- <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><span>没有回答任何问题</span></div> -->
          </div>
        </div>
      </div>
    </script>
    <!-- 建立视图。用于呈现模板渲染结果。 -->
    <div id="home_view"></div>
  <?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
  </div>
</html> 
<script>
  var user_blog;
  var user_answer;
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
    //获取请求的userid
    var _userid = getUrlParam('userid');  
    if(!_userid)
    {
      layer.msg("没有userid信息！");
    }
    else
    {
      //获取用户信息
      $.ajax({
        url: "/api/user/user.php",
        type:'POST',
        async: false, //同步
        data:{'userid':_userid},
        success: function (res) {
          console.log('success:',res);
          user = res;      
        },
        error:function (res) {
            console.log('fail:',res);
        }
      }); 
      //获取发帖列表
      $.ajax({
        url: "../api/blog/userbloglist.php",
        type:'POST',
        async: false, //同步
        data:{'userid':user.userid},
          success: function (res) {
          console.log('success:',res);
          user_blog = res;
        },
        error:function (res) {
            console.log('fail:',res);
        }
      });
      //获取回复列表
      $.ajax({
        url: "../api/blog/useranswer.php",
        type:'POST',
        async: false, //同步
        data:{'userid':user.userid},
        success: function (res) {
          console.log('success:',res);
          user_answer = res;
          //渲染数据
          var getTpl = home_moduel.innerHTML;
          var view = document.getElementById('home_view');
          laytpl(getTpl).render(res, function(html){
            view.innerHTML = html;
          });
        },
        error:function (res) {
            console.log('fail:',res);
        }
      });
    }
  });
</script>