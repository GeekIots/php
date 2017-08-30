<!DOCTYPE html>
<html>
<head>
  <title>开发者社区</title>
</head>
<body class="zh_CN">
  <?php include('header.php'); ?>
  <div id="body" class="body page_simple index_page">
    <div class="container_box">

      <div class="index_extra_area" >
        <div class="index_extra_box mod_default_box">
          <div class="index_extra_hd">
            <h4>官方公告</h4>
          </div>
          <div class="index_extra_bd">
            <ul class="index_extra_list">
              <li class="index_extra_item post_title">
                <a href="/blogdetail?action=get_post_info&lang=zh_CN&token=2108255711&docid=49d5add8ffd174a3bbd5f69de9505201" target="_blank">微信小程序审核相关贴指引</a>
              </li>
              <li class="index_extra_item post_title">
                <a href="/blogdetail?action=get_post_info&lang=zh_CN&token=2108255711&docid=47e9b796f3c941368b1ad9f5d73b14d1" target="_blank">WXS 脚本语言公测</a>
              </li>
              <li class="index_extra_item post_title">
                <a href="/blogdetail?action=get_post_info&lang=zh_CN&token=2108255711&docid=190e8b231d0fc2582d7d3bb21f954c3c" target="_blank">【变更通知】打开不同 shareTicket 的消息将改成不会重启小程序</a>
              </li>
              <li class="index_extra_item post_title">
                <a href="/blogdetail?action=get_post_info&lang=zh_CN&token=2108255711&docid=2c58b2aa1d932e62df2e9ce8b360c192" target="_blank">微信小程序接入指南</a>
              </li>
              <li class="index_extra_item post_title">
                <a href="/blogdetail?action=get_post_info&lang=zh_CN&token=2108255711&docid=c53fb90c11590a1b86c109b4006fae27" target="_blank">微信小程序平台常见拒绝情形</a>
              </li>
              <li class="index_extra_item post_title">
                <a href="/blogdetail?action=get_post_info&lang=zh_CN&token=2108255711&docid=c45683ebfa39ce8fe71def0631fad26b" target="_blank">获取用户信息方案介绍</a>
              </li>
              <li class="index_extra_item post_title">
                <a href="/blogdetail?action=get_post_info&lang=zh_CN&token=2108255711&docid=2fcdb7794d48c59f7624f53e94d0ae22" target="_blank">微信小程序常见FAQ</a>
              </li>
              <li class="index_extra_item post_title">
                <a href="/blogdetail?action=get_post_info&lang=zh_CN&token=2108255711&docid=0fcfcc67790e857a8ebfa9e56cd4cdbf" target="_blank">开发者问题反馈模版</a>
              </li>
              <li class="index_extra_item post_title">
                <a href="/blogdetail?action=get_post_info&lang=zh_CN&token=2108255711&docid=800026caeb042e45681583652b70910a" target="_blank">Chrome 56/57 内核对 WoSign、StartCom 证书限制周知</a>
              </li>
              <li class="index_extra_item post_title">
                <a href="/blogdetail?action=get_post_info&lang=zh_CN&token=2108255711&docid=548016916c6e3c35ccc70e663ed2aea7" target="_blank">面向个人开发者开放的服务类目</a>
              </li>
              <li class="index_extra_item post_title">
                <a href="/blogdetail?action=get_post_info&lang=zh_CN&token=2108255711&docid=e1ba247bc51c6355894e6bffc8e443e6" target="_blank">微信开发者社区管理规定v1.0</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="index_extra_box mod_default_box">
          <div class="index_extra_hd">
            <h4>开源推荐</h4>
            <a href="javascript:;" class="extra_hd_opr js_new_recommend">我要推荐</a>
          </div>
          <div class="index_extra_bd">
            <p class="recommend_bd_desc">鼓励开发者推荐GitHub上的优秀开源项目，包括开源框架、模板、组件、开发工具和第三方工具等。</p>
          </div>
          <div class="index_extra_ft"><a href="/home?action=list_recommendblog&page=1&limit=10&lang=zh_CN&token=2108255711">进入 &gt;&gt;</a></div>
        </div>
      </div>
      <div class="main_area mod_default_box ">
        <div class="main_hd">
          <h2>
            <span>全部帖子</span>
          </h2>
          <div class="extra_info align_title">
            <a class="btn btn_primary js_new_blog_btn" href="/blog/add.php"><span class="icon_write"></span>发表新帖</a>
          </div>
          <div class="title_tab_wrp title_tab post_filter_opr" id="topTab"><ul class="tab_navs title_tab" data-index="0">
            <li data-index="0" class="tab_nav first selected" ><a href="/blog/index.php">全部</a></li>
            <li data-index="1" class="tab_nav "><a href="/blog/index.php">未解决</a></li>
            <li data-index="2" class="tab_nav "><a href="/blog/index.php">已解决</a></li>
          </ul>
        </div>
      </div>
      <div class="main_bd ">
        <!-- 帖子列表 -->
        <ul class="post_list">
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
            <li class="post_item post_overview">
              <h4 class="post_title">
                <a href="/blog/view.php?id=<?php echo $rs['id'];?>" target="_blank"><?php echo $rs['title'];?></a>
              </h4>
              <div class="post_info">
                <strong class="post_owner post_info_meta"><?php echo $rs['userid'];?></strong>
                <em class="post_time post_info_meta" ><?php echo $rs['dates'];?></em>
                <span class="post_tags post_info_meta">
                 <a class="post_tag" href="#">未分类</a>
               </span>
               <span class="post_discuss_num post_info_meta"><i class="icon_post_opr discuss"></i><?php echo $answernum[0];?></span>
             </div>
           </li>
           <?php
         }
         ?>
       </ul>
       <!-- 分页 -->
       <div class="pagination_wrp js_pagination">
        <div class="pagination">
          <span class="page_nav_area"><!-- style="display: none;" -->
            <!-- 前一页 -->
            <a href="/blog/index.php?page=<?php echo ($NowPageNuber-1); ?>" class="btn page_prev" ><i class="arrow"></i></a>
            <?php 
            if ($PageNumber<=3) {
             switch ($PageNumber) {
              case 1:
              echo '<!-- 当前页 -->
              <a href="/blog/index.php?page=1" class="btn page_nav current">1</a>';
              break;
              case 2:
              echo '<!-- 当前页 -->
              <a href="/blog/index.php?page=1" class="btn page_nav '?><?php if($NowPageNuber==1)echo("current");else echo("js_mid");?><?php echo '">1</a>
              <!-- 第二页 -->
              <a href="/blog/index.php?page=2" class="btn page_nav '?><?php if($NowPageNuber==2)echo("current");else echo("js_mid");?><?php echo '">2</a>';
              break;
              case 3:
              echo '<!-- 当前页 -->
              <a href="/blog/index.php?page=1" class="btn page_nav '?><?php if($NowPageNuber==1)echo("current");else echo("js_mid");?><?php echo '">1</a>
              <!-- 第二页 -->
              <a href="/blog/index.php?page=2" class="btn page_nav '?><?php if($NowPageNuber==2)echo("current");else echo("js_mid");?><?php echo '">2</a>
              <!-- 第三页 -->
              <a href="/blog/index.php?page=3" class="btn page_nav '?><?php if($NowPageNuber==3)echo("current");else echo("js_mid");?><?php echo '">3</a>';
              break;
            }
          }
          else
          {
            if($NowPageNuber<3){
              echo '<!-- 当前页 -->
              <a href="/blog/index.php?page=1" class="btn page_nav '?><?php if($NowPageNuber==1)echo("current");else echo("js_mid");?><?php echo '">1</a>
              <!-- 第二页 -->
              <a href="/blog/index.php?page=2" class="btn page_nav '?><?php if($NowPageNuber==2)echo("current");else echo("js_mid");?><?php echo '">2</a>
              <!-- 第三页 -->
              <a href="/blog/index.php?page=3" class="btn page_nav '?><?php if($NowPageNuber==3)echo("current");else echo("js_mid");?><?php echo '">3</a>';
            }
            else if($NowPageNuber<$PageNumber)
            {
              echo '<!-- 当前页 -->
              <a href="/blog/index.php?page='?><?php echo ($NowPageNuber-1);?><?php echo '" class="btn page_nav js_mid">'?><?php echo ($NowPageNuber-1);?><?php echo '</a>
              <!-- 第二页 -->
              <a href="/blog/index.php?page='?><?php echo ($NowPageNuber);?><?php echo '" class="btn page_nav current">'?><?php echo ($NowPageNuber);?><?php echo '</a>
              <!-- 第三页 -->
              <a href="/blog/index.php?page='?><?php echo ($NowPageNuber+1);?><?php echo '" class="btn page_nav js_mid">'?><?php echo ($NowPageNuber+1);?><?php echo '</a>';
            }
            else if($NowPageNuber==$PageNumber)
            {
              echo '<!-- 当前页 -->
              <a href="/blog/index.php?page='?><?php echo ($NowPageNuber-2);?><?php echo '" class="btn page_nav js_mid">'?><?php echo ($NowPageNuber-2);?><?php echo '</a>
              <!-- 第二页 -->
              <a href="/blog/index.php?page='?><?php echo ($NowPageNuber-1);?><?php echo '" class="btn page_nav js_mid">'?><?php echo ($NowPageNuber-1);?><?php echo '</a>
              <!-- 第三页 -->
              <a href="/blog/index.php?page='?><?php echo ($NowPageNuber);?><?php echo '" class="btn page_nav current">'?><?php echo ($NowPageNuber);?><?php echo '</a>';
            }
          }
          ?>
          <!-- ... -->
          <span class="gap_next">...</span>
          <!-- 总页数 -->
          <a href="/blog/index.php?page=<?php echo $PageNumber; ?>" class="btn page_nav"><?php echo $PageNumber; ?></a>
          <!-- 下一页 -->
          <a href="/blog/index.php?page=<?php echo ($NowPageNuber+1); ?>" class="btn page_next"><i class="arrow"></i></a>
        </span>
        <span class="goto_area">
          <!-- 页面电梯直达 -->
          <input type="text"  onchange="gotofloor()" id="floorvalue">
          <a href="/blog/index.php?page=" class="btn page_go" id="floorNumber">跳转</a>
          <script>
            function gotofloor() {
              $("#floorNumber").attr('href',"/blog/index.php?page="+$("#floorvalue").val());
            }
          </script>
        </span>
      </div>
    </div>
    <!-- 分页完 -->
    <div class="pagination_wrp js_pagination"></div>
  </div>
</div>
</div>
</div>
<?php include('footer.php') ?>
</body>
</html>

