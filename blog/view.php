<?php include("../public/header.php");?>
<!DOCTYPE html>
<html>
<head>
  <head>
  <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config.js"></script>
  <script type="text/javascript" charset="utf-8" src="ueditor/_examples/editor_api.js"></script>
  <script src="ueditor/ueditor.parse.js" type="text/javascript"></script>
  <meta name="description" content="极客物联网，属于每个人的DIY物联网开发平台，欢迎到小程序微信搜索“极客物联网”，更多精彩期待您的加入！"/>
</head>
<!-- 读取博文数据 -->
<?php
    date_default_timezone_set('prc');
    include("conn.php");
    if(!empty($_GET['id']))
    { 
      $sql="select * from blog where id='".$_GET['id']."'";
      $query=mysql_query($sql);
      $rs=mysql_fetch_array($query);
      
      $sql="update blog  set hits = hits+1 where id='".$_GET['id']."'";
      mysql_query($sql);
    }
?>
<body>
<main>
 <div style="margin-left: 10%;margin-right: 10%;margin-top: 1%;">
  <!--  <a href="index.php" class="btn btn-default">首页</a> -->
      <table class="table table-bordered box-shadow">
      <tbody>
      <tr style="background-color: #555;color:#fff">
        <th style="width:22%;">
        <h4>
            用户信息
        </h4>
        </th>
        <!-- 文章标题 -->
        <th style="width:80%;">
          <h4>
            <?php echo $rs['title']?>
          </h4>
        </th>
      </tr>
      
      <tr>
        <!-- 用户信息 -->
        <td style="background-color: #E0EEEE">
          <!-- 用户头像 -->
          <?php 
           //用户头像
              $file = "../public/upload-head/userheadimg/".$_SESSION['login'].".jpg";
              if(file_exists($file))
              {
                  //存在
                  $avatar = $file;
              }
              else
              {
                  //不存在
                  $avatar = "../public/upload-head/default.jpg";
              }           
          ?>

          <img src="<?php echo $avatar?>" width="80px" height="80px" style="border-radius: 5px;">
          <h5>昵  称：<?php echo $rs['userid']?></h5>
          <h5>点击量：<?php echo $rs['hits']?></h5>
          <h5>发布时间：<?php echo $rs['dates']?></h5>
        </td>
        <!-- 内容 -->
        <td style="background-color:#EEE5DE">
          <!-- 编辑和删除按钮 -->
          <?php 
            if($_SESSION['login']==$rs['userid'])
            {
              echo '<a href="edit.php?id='.$rs['id'].'">编辑</a>';
              // echo '<a href="edit.php?id='.$rs['id'].'">编辑</a> | <a href="del.php?del='.$rs['id'].'">删除</a>';
              echo "<hr>";
            } 
          ?>
               
          <!-- 文章内容 -->
          <?php
          echo  htmlspecialchars_decode($rs['contents']); 
          ?>
          <!--分享接口 JiaThis Button BEGIN -->
          <div class="jiathis_style_32x32" style="float: right;">
            <a class="jiathis_button_tsina"></a>
            <a class="jiathis_button_qzone"></a>
            <a class="jiathis_button_tqq"></a>
            <a class="jiathis_button_weixin"></a>
            <a class="jiathis_button_renren"></a>
            <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
            <a class="jiathis_counter_style"></a>
          </div>
          <script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
          <!-- JiaThis Button END -->
          <!-- UJian Button BEGIN -->
            <div class="ujian-hook"></div>
<!--             <script type="text/javascript" src="http://v1.ujian.cc/code/ujian.js"></script> -->
          <!-- UJian Button END -->

        </td>
      </tr>
      <!-- 遍历回复内容 -->
      <?php
        $sqlanswer="select * from bloganswer where toid='".$rs['id']."'";
        $queryanswer=mysql_query($sqlanswer);
        $answernum = 0;
        while($rsanswer=mysql_fetch_array($queryanswer))
        {
          $answernum++;
      ?>
        <!-- 回复标题 -->
        <tr>
          <td style="background-color:#BDBDBD">
            <h7>
              <?php echo $answernum; ?>楼
          </h7> 
          </td>
          <td style="background-color:#BDBDBD">
            <h7>
              回复时间：<?php echo $rsanswer['dates']?>
            </h7>
          </td>
        </tr>
          <!-- 回复内容 -->
          <tr>
            <td style="background-color:#E0EEEE">
              <h5>昵称：<?php echo $rsanswer['userid'] ?></h5>
            </td>
            <td style="background-color:#EEE5DE">
              
              <?php
                echo  htmlspecialchars_decode($rsanswer['contents']); 
              ?>
            </td>
          </tr>
      <?php 
        }
      ?>
       <tr hidden id="huifu1">
        <td style="background-color:#E0EEEE">
        </td>
        <td style="background-color:#EEE5DE">
        </td>
      </tr>     
      <tr >
        <td style="background-color:#E0EEEE">
        </td>
        <td style="background-color:#EEE5DE;">
          <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel panel-primary" id="liuyankuang">
              <div class="panel-heading">
                    <h3 class="panel-title">留言</h3>
              </div>
              <div class="panel-body">
                <script type="text/plain" id="myEditor" name="myEditor">
                </script>
                <div style="text-align: right;padding-top: 5px">
                  <button id="queding" class="btn btn-default">回复</button>
                  <a class="btn btn-default" href="index.php" >返回</a> 
                </div>
              </div>
            </div>
          </div>
        </td>
      </tr>
     </tbody>
    </table>
  </div>
 </main>
</body>
</html>

<?php include '../public/footer.php';?>

<script type="text/javascript">
  //初始化编辑框长度和宽度
    var editor_a = UE.getEditor('myEditor',
      {
        toolbars:[['FullScreen',"fontfamily", "fontsize", "bold", "italic", "underline", "forecolor", "backcolor", "insertorderedlist", "insertunorderedlist"]],
        //focus时自动清空初始化时的内容  
        autoClearinitialContent:true,
        //开启字数统计  
        wordCount:true,
        //允许的最大字符数
        maximumWords:800,     
        //关闭元素路径
        elementPathEnabled:false,
        //默认的编辑区域高度  
        initialFrameWidth:800,
        initialFrameHeight:160
        //更多其他参数，请参考ueditor.config.js中的配置项  
      });
</script>

<script type="text/javascript">
var floornum=<?php echo $answernum;?>;
var tbNum=1;
//确定按钮
$("#queding").click(function(){
    // 游客不能留言
    <?php 
      if ($_SESSION['login'])
      {
    ?>
        var dd=getContent();
        if(dd[0])
        {
          $.post("answer.php",
          {
              data:dd[0],//回复内容
              toid:<?php echo $rs['id'];?>//文章id
          },
              function(data,status){
                if(data=="ok")
                  {
                    floornum++;
                    $("#huifu"+tbNum).after("<tr><td style=\"background-color:#BDBDBD\"><h7>"+floornum+"楼</h7></td><td style=\"background-color:#BDBDBD\"><h7>回复时间：<?php echo date('Y-m-d H:i:s',time()); ?></h7></td></tr><tr id=\"huifu"+(tbNum+1)+"\"><td style=\"background-color:#E0EEEE\"><h5>昵称：<?php echo $_SESSION['login'] ?></h5></td><td style=\"background-color:#EEE5DE\">"+getContent()+"</td></tr>");
                      tbNum++;
                      //清空内容
                      setContent();
                  }
          });
        }  
        else
        {
          alert('回复内容不能为空！');          
        } 
    <?php
      }
      else
      {
        echo "alert('游客不能留言，请登录！');";
      }
    ?> 
});

//获取文本框内容
function getContent() {
        var arr = []  ;
        arr.push(UE.getEditor('myEditor').getContent());
        return arr;
    }

function setContent(isAppendTo) {
        UE.getEditor('myEditor').setContent('', isAppendTo);
    }
</script>