<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>开发者社区 | 极客物联网 </title>
</head>
<body> 
<?php
    //读取本贴内容 
    include($_SERVER['DOCUMENT_ROOT'].'/common/conn.php');
    if(!empty($_GET['id']))
    { 
      $sql="select * from blog where id='".$_GET['id']."'";
      $query=mysqli_query($con,$sql);
      $rs=mysqli_fetch_array($query);

      //增加点击量
      $sql="update blog  set hits = hits+1 where id='".$_GET['id']."'";
      mysqli_query($con,$sql);

      //获取回复
      $sqlanswer="select count(*) from bloganswer where toid='".$rs['id']."'";
      $queryanswer=mysqli_query($con,$sqlanswer);
      $answernum=mysqli_fetch_array($queryanswer)[0];

      $sqlanswer="select * from bloganswer where toid='".$rs['id']."'";
      $queryanswer=mysqli_query($con,$sqlanswer);
    }
?>
<div class="main layui-clear">
  <div class="wrap">
    <div class="content detail">
      <div class="fly-panel detail-box">
        <h1><?php echo $rs['title']?></h1>
        <div class="fly-tip fly-detail-hint" data-id="{{rows.id}}">
          <span class="fly-tip-stick">置顶帖</span>
          <span class="fly-tip-jing">精帖</span>
          
          <!-- <span>未结贴</span> -->
          <span class="fly-tip-jie">已采纳</span>
          
          <!-- <span class="jie-admin" type="del" style="margin-left: 20px;">删除</span>
          <span class="jie-admin" type="set" field="stick" rank="1">置顶</span> 
          <span class="jie-admin" type="set" field="stick" rank="0" style="background-color:#ccc;">取消置顶</span>
          <span class="jie-admin" type="set" field="status" rank="1">加精</span> 
          <span class="jie-admin" type="set" field="status" rank="0" style="background-color:#ccc;">取消加精</span> -->
          
          <div class="fly-list-hint"> 
            <i class="iconfont" title="回答">&#xe60c;</i> <?php echo $answernum?>
            <i class="iconfont" title="人气">&#xe60b;</i> <?php echo $rs['hits']?>
          </div>
        </div>
        <div class="detail-about">
          <a class="jie-user" href="">
            <img src="http://tp4.sinaimg.cn/1345566427/180/5730976522/0" alt="">
            <cite>
              <?php echo $rs['nickname']?>
              <em><?php echo $rs['dates']?></em>
            </cite>
          </a>
          <div class="detail-hits" data-id="{{rows.id}}">
            <span style="color:#FF7200">悬赏：20飞吻</span>
            <span class="layui-btn layui-btn-mini jie-admin" type="edit"><a href="/jie/edit/{{rows.id}}">编辑此贴</a></span>
            <span class="layui-btn layui-btn-mini jie-admin " type="collect" data-type="add">收藏</span>
            <!--<span class="layui-btn layui-btn-mini jie-admin  layui-btn-danger" type="collect" data-type="add">取消收藏</span>-->
          </div>
        </div>
        
        <div class="detail-body photos" style="margin-bottom: 20px;">
          <p><?php echo htmlspecialchars_decode($rs['contents']);?></p>
        </div>
      </div>

    
      
      <!-- 回复区 -->
      <div class="fly-panel detail-box" style="padding-top: 0;">
        <div style="padding-top: 15px;">
            <fieldset class="layui-elem-field layui-field-title" style="text-align: center;">
                <legend>回帖</legend>
            </fieldset>
        </div>
       
        <a name="comment"></a>
        <ul class="jieda photos" id="jieda">

        <?php 
            // 计算楼层
            $floornumber = 0;
            while ($rsanswer=mysqli_fetch_array($queryanswer)) {
                $floornumber++;
        ?>
                <li data-id="12" class="jieda-daan">
                <a name="item-121212121212"></a>
                <div class="detail-about detail-about-reply">
                  <a class="jie-user" href="">
                    <img src="../../res/images/avatar/default.png" alt="">
                    <cite>
                      <i><?php echo($rsanswer["nickname"]); ?></i>
                      <!-- <em>(楼主)</em>
                      <em style="color:#5FB878">(管理员)</em>
                      <em style="color:#FF9E3F">（活雷锋）</em>
                      <em style="color:#999">（该号已被封）</em> -->
                    </cite>
                  </a>
                  <div class="detail-hits">
                    <span><?php echo($rsanswer["dates"]); ?></span>
                  </div>
                  <!-- 已采纳 -->
                  <!-- <i class="iconfont icon-caina" title="最佳答案"></i> -->
                </div>
                <div class="detail-body jieda-body">
                  <p><?php echo(htmlspecialchars_decode($rsanswer["contents"])); ?></p>
                </div>
                <div class="jieda-reply">
                  <!-- 赞 -->
                  <span class="jieda-zan zanok" type="zan"><i class="iconfont icon-zan"></i><em>12</em></span>
                  <span type="reply"><i class="iconfont icon-svgmoban53"></i>回复</span>
                  <!-- <div class="jieda-admin">
                    <span type="edit">编辑</span>
                    <span type="del">删除</span>
                    <span class="jieda-accept" type="accept">采纳</span>
                  </div> -->
                </div>
              </li>
        <?php
        }
        if ($floornumber==0) {
            echo("<li class='fly-none'>消灭零回复</li>");
        }
        ?>  
        </ul>
        
        <div class="layui-form layui-form-pane">
            <div class="layui-form-item layui-form-text">
              <div class="layui-input-block">
                <textarea id="demo" name="content" class="layui-textarea fly-editor" style="height: 150px;">我要回复</textarea>
              </div>
            </div>
            <div class="layui-form-item">
              <!-- <input type="hidden" name="jid" value="{{rows.id}}"> -->
              <button class="layui-btn" >提交回复</button>
            </div>
        </div>
      </div>
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
          $sqlsort=mysql_query($sqlsort);
          while($top12=mysql_fetch_array($sqlsort))
          {
          ?>
            <dd>
              <a href="user/home.html">
                <img src="../res/images/avatar/default.png">
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
              <a href="view.php?id=<?php echo($hit['id']); ?>"><?php echo($hit['title']); ?></a>
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
  layui.use(['layedit','jquery'],function(){
  var layedit = layui.layedit,$ = layui.jquery;
  layedit.set({
    uploadImage: {
      url: '/api/layui/upload.php', //接口url
      type: 'post', //默认post
      data:{type:'image',url:'repblog'}
      }
  });
  var index = layedit.build('demo', {tool: [
      'face' //表情
      ,'image' //插入图片
      ,'link' //超链接 
      ,'code'      
      // 'strong' //加粗
      // ,'italic' //斜体
      // ,'underline' //下划线
      // ,'del' //删除线
      // ,'|' //分割线
      ,'left' //左对齐
      ,'center' //居中对齐
      ,'right' //右对齐
      // ,'unlink' //清除链接
      // ,'help' //帮助
       // , 'html'
      ]
      });

  //编辑器外部操作
  $('.layui-btn').on('click', function(){
      //获取编辑器内容
      var str = layedit.getContent(index);
      if(str.length==0)
      {
          layer.msg('回复内容不能为空！');
      }
      else
      {
          $.ajax({
              type:'POST',
              url: "../api/blog/answer.php",
              data:{'contents':str,'nickname':'sun','toid':<?php echo($_GET['id']) ?>},
              //数据长度太长，放到data里通过post传送
              success: function (argument) {
                 if (argument.resault=='success') {
                    layer.msg('回复成功！',{icon:1,time:800},function(){
                        window.location.reload();
                      });
                  }
                  else{
                    layer.msg(argument.msg,{time:2000});
                  }
              },
              error:function (argument) {
                console.log(argument);
                  layer.msg('回复失败！');
              }
          });
      }
      // alert(); 
  });
  // layer.msg('极客物联网！',{ shade:0.5,time:1000});
  });
</script>
</html>