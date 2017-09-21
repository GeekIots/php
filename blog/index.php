<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php'); ?>
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
        <a href="add.php" class="layui-btn jie-add">发表新帖</a>
      </div>

      <!-- 普通贴 -->
      <script id="Tpl_1" type="text/html">
      <ul class="fly-list fly-list-top">
        {{#  layui.each(d.list, function(index, item){ }}
          <li class="fly-list-li">
            <a href="/user/home.html" class="fly-list-avatar">
              <img src="/{{item.avatar}}" alt="">
            </a>
            <h2 class="fly-tip">
              <!-- 标题 -->
              <a href="view.php?id={{item.id}}">{{item.title}}</a>
            </h2>
            <p>
              <!-- 用户昵称 -->
              <span><a href="user/home.html">{{item.nickname}}</a></span>
              <!-- 发布时间 -->
              <span>{{item.dates}}</span>
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
    <div class="fly-panel leifeng-rank"> 
      <h3 class="fly-panel-title">近一月回答榜 - TOP 12</h3>
      <dl>
        <!-- 本月回答问题前12名 -->
        <?php 
          $sqlsort = "select nickname,count(*) from bloganswer group by nickname 
order by count(*) desc limit 12";
          $sqlsort=mysqli_query($con,$sqlsort);
          while($top12=mysqli_fetch_array($sqlsort))
          {
             // 获取用户信息,用于显示用户头像
            $sql11="select * from user where nickname='{$top12['nickname']}'";
            $query11=mysqli_query($con,$sql11);
            $row11 = mysqli_fetch_array($query11);
          ?>
            <dd>
              <a href="/user/home.php">
                <img src="/<?php echo($row11['avatar']) ?>">
                 <cite><?php echo($top12['nickname']) ?></cite>
                 <i><?php echo($top12['count(*)']) ?>次回答</i>
              </a>
            </dd>
        <?php
          }
        ?>
      </dl>
    </div>

    <!-- 最近热帖 -->
    <dl class="fly-panel fly-list-one"> 
      <dt class="fly-panel-title">最近热帖</dt>
      <?php 
          $sqlhit = "select title,hits,id from blog order by hits desc limit 10";
          $sqlhit=mysqli_query($con,$sqlhit);
          while($hit=mysqli_fetch_array($sqlhit))
          {
          ?>
            <dd>
              <a href="view.php?id=<?php echo($hit['id']); ?>"><?php echo($hit['title']) ?></a>
              <span ><i class="iconfont">&#xe60b;</i><?php echo($hit['hits']) ?></span>
            </dd>
        <?php
          }
        ?>
    </dl>
    <!-- 近期热议 -->
    <!-- 回复最多的帖子，暂未实现 -->
 <!--    <dl class="fly-panel fly-list-one"> 
      <dt class="fly-panel-title">近期热议</dt>
      <dd>
        <a href="jie/detail.html">使用 layui 秒搭后台大布局之基本结构</a>
        <span><i class="iconfont">&#xe60c;</i> 96</span>
      </dd>
    </dl> -->
    
<!--     <div class="fly-panel fly-link"> 
      <h3 class="fly-panel-title">友情链接</h3>
      <dl>
        <dd>
          <a href="http://www.geek-iot.com/" target="_blank">物联网开发平台</a>
        </dd>
      </dl>
    </div> -->

  </div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
</body>
<script>
  var bloglist;
  // 每页包含8条数据
  var inpagenumber = 8; 

  var answerlist;
  var talklist;
  var browselist; 
  
  //获取url中的参数
  function getUrlParam(name) {
      var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
      var r = window.location.search.substr(1).match(reg);  //匹配目标参数
      if (r != null) return unescape(r[2]); return null; //返回参数值
  }

  //获取当前页码
  var _curr = getUrlParam('page');
  // 不存在页码默认为1
  if (_curr==null) {_curr=1};

  layui.use(['laypage','laytpl','element','jquery','layer'], function(){
  var laypage = layui.laypage;
  var element = layui.element,$ = layui.jquery,layer=layui.layer,laytpl = layui.laytpl;
  

  // 获取帖子列表
  $.ajax({
    type:'POST',
    url: "../api/blog/getbloglist.php",
    data:{"num":inpagenumber,"page":_curr},
    success: function (res) {
      console.log('success:',res);
      bloglist = res;
      //渲染数据
      var getTpl = Tpl_1.innerHTML;
      var view = document.getElementById('view_1');
      laytpl(getTpl).render(bloglist, function(html){
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

  // 获取近期热议
  // 获取最近热帖

  });
</script>
</html>

