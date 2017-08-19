<?php
include "./public/header.php";
//phpinfo();
?>
<!DOCTYPE HTML>  
<html>  
<head>  
  
    <meta charset="utf-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />  
    <meta http-equiv="X-UA-Compatible" content="IE=9" />  
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
    <!-- 响应式布局 -->  
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->  
    <title>视频管理</title>  
    <!--bootstrap-->  
  
    <!--必须在bootstrap后导入-->  
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>

    <script type="text/javascript" src="http://apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script>  
  
    <!--jquery滑块ui-->  
    <link href="css/jquery-ui.css" rel="stylesheet">  
    <script src="js/jquery-ui.js"></script>  
  
  
    <link rel="stylesheet" href="css/profileCss.css">  
    <link rel="stylesheet" type="text/css" href="font/iconfont.css">  
    <script src="js/allJs.js"></script>  
    <style>  
    </style>  
    <script type="text/javascript">  
        $(function(){  
//            $("#configurationTab").children("li").children("a").css("border","1px 1px 1px 1px");  
//            $("#configurationTab").children("li").css("margin","0 0 0 -1px")  
        });  
    </script>  
</head>  
  
<body>  
<div style="height: 100px;">  
  
    <div class="tab-content vertical-tab-content col-xs-10">  
        <div role="tabpanel" class="tab-pane active" id="tab1">.本地..</div>  
        <div role="tabpanel" class="tab-pane" id="tab2">.系统..</div>  
        <div role="tabpanel" class="tab-pane" id="tab3">..网络.</div>  
        <div role="tabpanel" class="tab-pane" id="tab4">.视音频..</div>  
        <div role="tabpanel" class="tab-pane" id="tab5">..图像.</div>  
        <div role="tabpanel" class="tab-pane" id="tab6">..事件.</div>  
        <div role="tabpanel" class="tab-pane" id="tab7">..存储.</div>  
    </div>  
    <div class="col-xs-2">  
        <ul class="nav nav-tab vertical-tab" role="tablist" id="vtab">  
            <li role="presentation" class="active">  
                <a href="#tab1" aria-controls="home" role="tab"  
                   data-toggle="tab">本地</a>  
            </li>  
            <li role="presentation">  
                <a href="#tab2" aria-controls="inbox" role="tab"  
                   data-toggle="tab">系统</a>  
            </li>  
            <li role="presentation">  
                <a href="#tab3" aria-controls="outbox" role="tab"  
                   data-toggle="tab">网络</a>  
            </li>  
            <li role="presentation">  
                <a href="#tab4" aria-controls="inbox1" role="tab"  
                   data-toggle="tab">视音频</a>  
            </li>  
            <li role="presentation">  
                <a href="#tab5" aria-controls="outbox1" role="tab"  
                   data-toggle="tab">图像</a>  
            </li>  
            <li role="presentation">  
                <a href="#tab6" aria-controls="outbox1" role="tab"  
                   data-toggle="tab">事件</a>  
            </li>  
            <li role="presentation">  
                <a href="#tab7" aria-controls="outbox1" role="tab"  
                   data-toggle="tab">存储</a>  
            </li>  
        </ul>  
    </div>  
</div>  
</body>  
</html>  