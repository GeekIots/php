<!DOCTYPE html>
<html>
<head>
  <title>开发者社区 | 极客物联网</title>
</head>
<body>
<?php include('header.php'); ?>
<div class="main layui-clear">
  <!-- 主内容区 -->
  <div class="wrap">
    <div class="content">
      <div class="fly-tab fly-tab-index">
        <span>
          <a href="jie/index.html">全部</a>
          <!--   -->
        </span>
        <form action="http://cn.bing.com/search" class="fly-search">
          <i class="iconfont icon-sousuo"></i>
          <input class="layui-input" autocomplete="off" placeholder="搜索内容，回车跳转" type="text" name="q">
        </form>
        <a href="jie/add.html" class="layui-btn jie-add">发表新帖</a>
      </div>

      <!-- 普通贴 -->
      <ul class="fly-list fly-list-top">
      <?php
        include("conn.php");
        //定义每页显示数量
        $InPageNumber = 8;
        //页数初始化为0
        $PageNumber = 0;
        if (!empty($_GET['page'])) {
          $NowPageNuber = $_GET['page'];
        }
        else
          $NowPageNuber = 1;

        //获取帖子总量
        $sqlselect="select count(*) from blog";
        $queryselect=mysql_query($sqlselect);
        $noteTotalNumber=mysql_fetch_array($queryselect)[0];
        //总页数
        $PageNumber = ceil($noteTotalNumber/$InPageNumber);//向上取整，有小数就加1 ceil(),向下取整：floor()

        $NowPageNuber = ($NowPageNuber>0) ? $NowPageNuber : 1 ;  
        $NowPageNuber = ($NowPageNuber>$PageNumber) ? $PageNumber : $NowPageNuber ;


        // 判断显示哪一页
        if(!empty($NowPageNuber)){
          $startNum = ($NowPageNuber-1)*$InPageNumber;
          $sql="select * from blog order by dates desc limit {$startNum}, {$InPageNumber}";
        }
        else
          $sql="select * from blog order by dates desc limit {$InPageNumber}";
        $query=mysql_query($sql);       
        while($rs=mysql_fetch_array($query))
        {
        //读取回复数量
          $sqlanswer="select count(*) from bloganswer where toid='".$rs['id']."'";
          $queryanswer=mysql_query($sqlanswer);
          $answernum=mysql_fetch_array($queryanswer);
        // print_r($answernum);
          ?>
          <li class="fly-list-li">
          <a href="user/home.html" class="fly-list-avatar">
            <img src="../res/images/avatar/default.png" alt="">
          </a>
          <h2 class="fly-tip">
            <!-- 标贴 -->
            <a href="view.php?id=<?php echo $rs['id'];?>"><?php echo $rs['title'];?></a>
          </h2>
          <p>
            <!-- 用户昵称 -->
            <span><a href="user/home.html"><?php echo $rs['userid'];?></a></span>
            <!-- 发布时间 -->
            <span><?php echo $rs['dates'];?></span>
            <!-- 分类 -->
            <span></span>
            <span class="fly-list-hint"> 
              <i class="iconfont" title="回答">&#xe60c;</i> <?php echo $answernum[0];?>
              <i class="iconfont" title="人气">&#xe60b;</i> <?php echo $rs['hits'];?>
            </span>
          </p>
          </li>
         <?php
       }
      ?>

      <!-- 分页 -->
      <div style="text-align: right;margin-right: 2%;">
          <div class="pagination" id="laypage1"></div>
      </div>
      </ul> <!-- 分页完 -->
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
          $sqlsort = "select userid,count(*) from bloganswer group by userid 
order by count(*) desc limit 12";
          $sqlsort=mysql_query($sqlsort);
          while($top12=mysql_fetch_array($sqlsort))
          {
          ?>
            <dd>
              <a href="user/home.html">
                <img src="../res/images/avatar/default.png">
                 <cite><?php echo($top12['userid']) ?></cite>
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
          $sqlhit = "select title,hits from blog order by hits desc limit 10";
          $sqlhit=mysql_query($sqlhit);
          while($hit=mysql_fetch_array($sqlhit))
          {
          ?>
            <dd>
              <a href="jie/detail.html"><?php echo($hit['title']) ?></a>
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
<?php include('footer.php') ?>
</body>
<script src="../frame/layui-v2.1.0/layui/layui.js"></script>
<script>
  layui.use('laypage', function(){
  var laypage = layui.laypage;
  //执行一个laypage实例
  laypage.render({
    elem: 'laypage1' //注意，这里的 laypage1 是 ID，不用加 # 号
    ,count: <?php echo($noteTotalNumber); ?> //数据总数，从服务端得到
    ,limit: 8 //每页条数
    ,curr:<?php echo($NowPageNuber); ?>
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
  });
</script>
</html>

