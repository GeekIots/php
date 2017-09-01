<?php session_start();
function my_file_exists($file)  
{  
    if(preg_match('/^http:\/\//',$file)){  
        //远程文件  
        if(ini_get('allow_url_fopen')){  
            if(@fopen($file,'r')) return true;  
        }  
        else{  
            $parseurl=parse_url($file);  
            $host=$parseurl['host'];  
            $path=$parseurl['path'];  
            $fp=fsockopen($host,80, $errno, $errstr, 10);  
            if(!$fp)return false;  
            fputs($fp,"GET {$path} HTTP/1.1 \r\nhost:{$host}\r\n\r\n");  
            if(preg_match('/HTTP\/1.1 200/',fgets($fp,1024))) return true;  
        }  
        return false;  
    }  
    return file_exists($file);  
}       
function console($value='')
{
    echo("<script>console.log('{$value}');</script>");
}
  if(isset($_SESSION['login'])) {
          //用户头像
          $file = "http://www.smtvoice.com/public/upload-head/userheadimg/".$_SESSION['login'].".jpg";
          console($file);
          if(my_file_exists($file)) {
              //存在
              $avatar = $file;
              console('存在');
          }
          else{
              //不存在
              $avatar = "http://www.smtvoice.com/public/upload-head/default.jpg";
              console('不存在');
          }
  } else {
      console('未登录');
      $avatar = "http://www.smtvoice.com/public/upload-head/default.jpg";
  }
?>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="renderer" content="webkit">
  <meta name="keywords" content="开发者社区,物联网开发者论坛,物联网开发">
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="css/base.css"/>
  <link rel="stylesheet" type="text/css" href="css/layout_head.css"/>

  <link rel="stylesheet" href="css/common.css">
  <link rel="stylesheet" href="css/index.css">
  <!-- 分页需要的样式 -->
  <link rel="stylesheet" type="text/css" href="css/upload.css" />
  <script src="../js/jquery.min.js"></script>
</head>
<div class="head" id="header">
  <div class="head_box js_head_box">
    <h1 class="logo"><a href="/index.php?" title="极客物联网 论坛"></a></h1>
    <div class="header_ctrls js_header_ctrls">
      <div class="header_ctrls_meta">
        <a href="/index.php">首页</a>
      </div>
      <div class="header_ctrls_meta">
        <a href="/blog/index.php">社区</a>
      </div>
      <div class="header_ctrls_meta">
        <a href="/blog/index.php">文档</a>
      </div>
      <div class="header_ctrls_meta top_notice_box">
        <a href="javascript:;" class="account_inbox_switch js_notice_box_switch">
          <i class="icon_inbox"></i>
        </a>
        <div class="account_message_box skin_pop js_account_notice_box"></div>
      </div>

      <div class="header_ctrls_meta top_user_box">
        <a class="top_user_switch" href="#">
          <img class="user_avatar" src="<?php echo($avatar); ?>" alt="">
        </a>
        <i class="icon_arrow_right_global"></i>
        <div class="skin_pop">
          <div class="skin_pop_inner">
            <div class="skin_pop_bd">
              <a href="#" class="user_name"><?php echo($_SESSION['login']); ?></a>
            </div>
            <div class="skin_pop_ft">
              <a class="javascript:;" id="logout" href="/accut/logout.php">退出</a>
            </div>
          </div>
          <i class="icon_skin_pop_arrow"></i>
        </div>
      </div>
    </div>

  </div>

</div>
</html>