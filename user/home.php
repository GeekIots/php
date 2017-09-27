<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>用户主页</title>
</head>
<body style="margin-top: 65px;">
  <!-- 用户信息模板 -->
  <script id="home_moduel" type="text/html">
    <div class="fly-home" style="background-image: url();">
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
        <i class="iconfont icon-shijian"></i><span>{{user_d.datetime}} 加入</span>
        <i class="iconfont icon-chengshi"></i><span>来自{{user_d.city}}</span>
      </p>
      <p class="fly-home-sign">（{{user_d.describe}}）</p>
    </div>
    
    <!-- 发帖列表模板 -->
    <div class="main fly-home-main">
      <div class="layui-inline fly-home-jie">
        <div class="fly-panel">
          <h3 class="fly-panel-title">{{user_d.nickname}} 最近的帖子</h3>
          <ul class="jie-row">
            {{#  layui.each(user_blog.list, function(index, item){ }}
              <li>
                <!-- <span class="fly-jing">精</span> -->
                <a href="/blog/view.php?id={{item.id}}" target="_blank" class="jie-title">{{item.title}}</a>
                <i>{{item.dates}}</i>
                <em>{{item.browser}}阅/{{item.answer}}答</em>
              </li>
            {{#  }); }}
          </ul>
          <!-- <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><i style="font-size:14px;">没有发表任何求解</i></div> -->
        </div>
      </div> 
      <!-- 回帖列表模板 -->
      <div class="layui-inline fly-home-da">
        <div class="fly-panel">
          <h3 class="fly-panel-title">{{user_d.nickname}} 最近的回复</h3>
          <ul class="home-jieda">
            {{#  layui.each(user_answer.list, function(index, item){ }}
              <li>
                <span>{{item.dates}}</span>
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
</body>
</html> 
<script>
  var user_d;
  var user_blog;
  var user_answer;
  layui.use(['laytpl','layedit','layer','jquery',],function(){
  var layedit = layui.layedit,layer = layui.layer,$ = layui.jquery,laytpl = layui.laytpl;
  //获取用户信息
  $.ajax({
    url: "../api/user/user.php",
    success: function (res) {
      console.log('success:',res);
      user_d = res;
      //获取发帖列表
      $.ajax({
          url: "../api/blog/userbloglist.php",
          type:'POST',
          data:{'nickname':user_d.nickname},
            success: function (res) {
            console.log('success:',res);
            user_blog = res;
            //获取回复列表
            $.ajax({
                url: "../api/blog/useranswer.php",
                type:'POST',
                data:{'nickname':user_d.nickname},
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
          },
          error:function (res) {
              console.log('fail:',res);
          }
      });
    },
    error:function (res) {
        console.log('fail:',res);
    }
  });
  
});
</script>