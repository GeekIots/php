<?php require($_SERVER['DOCUMENT_ROOT'].'/common/header.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>开发者社区 | 极客物联网</title>
</head>
<body>
  <div class="main layui-clear">
    <!-- 主内容区 -->
    <div class="wrap">
      <div class="content">
        <div class="fly-tab fly-tab-index">
          <span>
            <a href="/blog/index.php">全部</a>
            <!--   -->
          </span>
          <form action="http://cn.bing.com/search" class="fly-search">
            <i class="iconfont icon-sousuo"></i>
            <input class="layui-input" autocomplete="off" placeholder="搜索内容，未启用！" type="text" name="q">
          </form>
          <!-- 判断是否已经登陆 -->
          <a class="layui-btn jie-add" id="add_blog">发表新帖</a>
        </div>

        <!-- 普通贴 -->
        <script id="Tpl_1" type="text/html">
          <ul class="fly-list fly-list-top">
            {{# layui.each(d.list, function(index, item){ }}
            <li class="fly-list-li">
              <a href="/user/home.php?userid={{item.userid}}" class="fly-list-avatar">
                <img src="{{item.avatar}}" onerror="javascript:this.src='/image/default/error.jpg';" alt="">
              </a>
              <h2 class="fly-tip">
                <!-- 标题 -->
                <a href="view.php?id={{item.id}}">{{item.title}}</a>
                <span class="layui-btn layui-btn-mini jie-admin " type="collect" data-type="add">{{item.classify}}</span>
              </h2>
              <p>
                <!-- 用户昵称 -->
                <span><a href="user/home.html">{{item.nickname}}</a></span>
                <!-- 发布时间 -->
                <span>{{util.timeAgo(item.dates)}}</span>
                <!-- 分类 -->
                <span></span>
                <span class="fly-list-hint"> 
                  <i class="iconfont" title="回答">&#xe60c;</i>{{item.answer}}
                  <i class="iconfont" title="人气">&#xe60b;</i>{{item.browser}}
                </span>
              </p>
            </li>
            {{#  }); }}
          </ul>
        </script>
        <!-- 建立视图。用于呈现模板渲染结果。 -->
        <div id="view_1"></div>  
        <!-- 分页 -->
        <div style="text-align: right;margin-right: 2%;">
          <div class="pagination" id="laypage1"></div>
        </div><!-- 分页完 -->
      </div>
    </div>

    <!-- 右边栏 -->
    <div class="edge">
      <!-- 近一月回答榜 TOP 12-->
      <script id="Tpl_2" type="text/html">
        <div class="fly-panel leifeng-rank"> 
          <h3 class="fly-panel-title">近一月回答榜 - TOP 12</h3>
          <dl>
            {{#  layui.each(d.list, function(index, item){ }}
            <dd>
              <a href="/user/home.php?userid={{item.userid}}">
                <img src="{{item.avatar}}" onerror="javascript:this.src='/image/default/error.jpg';" >
                <cite>{{item.nickname}}</cite>
                <i>{{item.count}}次回答</i>
              </a>
            </dd>
            {{#  }); }}
          </dl>
        </div>
      </script>
      <!-- 建立视图。用于呈现模板渲染结果。 -->
      <div id="view_2"></div>  


      <!-- 最近热帖 -->
      <script id="Tpl_3" type="text/html">
        <dl class="fly-panel fly-list-one"> 
          <dt class="fly-panel-title">最近热帖</dt>
          {{#  layui.each(d.list, function(index, item){ }}
          <dd>
            <a href="view.php?id={{item.id}}">{{item.title}}</a>
            <span ><i class="iconfont">&#xe60b;</i>{{item.count}}</span>
          </dd>          
          {{#  }); }}
        </dl>      
      </script>
      <!-- 建立视图。用于呈现模板渲染结果。 -->
      <div id="view_3"></div> 

      <!-- 近期热议 -->
      <!-- 回复最多的帖子，暂未实现 -->
      <script id="Tpl_4" type="text/html">
        <dl class="fly-panel fly-list-one"> 
          <dt class="fly-panel-title">近期热议</dt>
          {{#  layui.each(d.list, function(index, item){ }}
          <dd>
            <a href="view.php?id={{item.id}}">{{item.title}}</a>
            <span><i class="iconfont">&#xe60c;</i>{{item.count}}</span>
          </dd>  
          {{#  }); }}
        </dl>
      </script>
      <!-- 建立视图。用于呈现模板渲染结果。 -->
      <div id="view_4"></div> 
    </div>
  </div>
  <?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
</body>
<script>
  // 每页包含8条数据
  var inpagenumber = 14; 
  var bloglist;

  //获取当前页码
  var _curr = getUrlParam('page');
  // 不存在页码默认为1
  if (_curr==null) {_curr=1};
  //发表新帖
  $('#add_blog').on('click', function(){
    // 判断是否已经登陆
    if(user_d.login === "true")
    {
      $(location).attr('href', 'add.php');
    }
    else
    {
      layer.msg('请先登录！');    
    }
  });

  // 获取帖子列表
  $.ajax({
    type:'POST',
    url: "/api/blog/getbloglist.php",
    data:{"num":inpagenumber,"page":_curr},
    success: function (res) {
      console.log('success:',res);
      bloglist = res;
      //渲染数据
      var getTpl = Tpl_1.innerHTML;
      var view = document.getElementById('view_1');
      laytpl(getTpl).render(res, function(html){
        view.innerHTML = html;
      });

      // 渲染分页
      laypage.render({
        elem: 'laypage1' //注意，这里的 laypage1 是 ID，不用加 # 号
        ,count: bloglist.total //数据总数，从服务端得到
        ,limit: inpagenumber //每页条数
        ,curr:_curr//当前页码
        ,layout: [ 'prev', 'page', 'next', 'skip']
        ,next:'<i class="layui-icon">&#xe602;</i>'
        ,prev:'<i class="layui-icon">&#xe603;</i>'
        ,jump:function (obj,first) {
          console.log(obj);
          // 首次不执行
          if(!first)
            window.location.href = "/blog/index.php?page="+obj.curr;
        }
      });
    },
    error:function (res) {
      console.log('fail:',res);
    }
  });
  // 获取回贴月榜
  $.ajax({
    type:'POST',
    url: "/api/blog/getsortlist.php",
    data:{"num":'12',"type":'answer'},
    success: function (res) {
      console.log('success:',res);
      //渲染数据
      var getTpl = Tpl_2.innerHTML;
      var view = document.getElementById('view_2');
      laytpl(getTpl).render(res, function(html){
        view.innerHTML = html;
      });
    },
    error:function (res) {
      console.log('fail:',res);
    }
  });
  // 获取最近热帖
  $.ajax({
    type:'POST',
    url: "/api/blog/getsortlist.php",
    data:{"num":'12',"type":'browse'},
    success: function (res) {
      console.log('success:',res);
      //渲染数据
      var getTpl = Tpl_3.innerHTML;
      var view = document.getElementById('view_3');
      laytpl(getTpl).render(res, function(html){
        view.innerHTML = html;
      });
    },
    error:function (res) {
      console.log('fail:',res);
    }
  });
  // 获取近期热议
  $.ajax({
    type:'POST',
    url: "/api/blog/getsortlist.php",
    data:{"num":'12',"type":'talk'},
    success: function (res) {
      console.log('success:',res);
      //渲染数据
      var getTpl = Tpl_4.innerHTML;
      var view = document.getElementById('view_4');
      laytpl(getTpl).render(res, function(html){
        view.innerHTML = html;
      });
    },
    error:function (res) {
      console.log('fail:',res);
    }
  });
</script>
</html>

