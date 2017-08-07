<?php session_start();
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    include $_SERVER ['DOCUMENT_ROOT']."/public/online.php";
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>smtvoice</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.bootcss.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <style>
            /* Remove the navbar's default margin-bottom and rounded borders */
            .navbar {
                margin-bottom: 0;
                border-radius: 0;
            } 
            /*阴影效果，悬浮效果*/
            /*{box-shadow:[inset] x-offset y-offset blur-radius spread-radiuscolor}*/
            .box-shadow{  
                box-shadow:-3px 0 5px rgba(100,100,80,0.4), /*左边阴影*/  
                5px 0 5px rgba(100,100,80,0.4), /*右边阴影*/  
                4px 5px 5px rgba(100,100,80,0.4), /*顶部阴影*/ 
                4px 6px 5px rgba(100,100,80,0.4); /*底边阴影*/  
            } 
            /*下面几个样式规定了头，身，和底部的位置关系，不可随意更改！*/
            html
            {
                height:100%;
            }
            body
            {
                min-height:100%;
                margin:0;
                padding:0;
                position:relative;
                background-color: lightgray;
            }
            header
            {
                /*background-color: #39C7AF;*/
            }
            main
            {
                padding-bottom:20%;
                
            }
            /* main的padding-bottom值要等于或大于footer的height值 */
            footer
            {
                position:absolute;
                bottom:0;
                width:100%;
                background-color: #ffc0cb;
            }
        </style>
    </head>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php" >极客物联网</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="../index.php">首页</a></li>
                    <!-- <li><a href="../device/userdevice.php">设备</a></li> -->
                    <li>
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        设备 <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $_SERVER['localhost'] ?>/device/userdevice.php">远程设备</a></li>
                            <li class="divider"></li>
                            <li><a href="../device/bluetooth/index.php">蓝牙遥控</a></li>
                            <!-- <li class="divider"></li>
                            <li><a href="#">Udp Data</a></li>
                            <li class="divider"></li>
                            <li><a href="../phpMyAdmin/index.php">Mysql</a></li>
                            <li class="divider"></li>
                            <li><a href="../public/log.php">log</a></li>
                            <li class="divider"></li>
                            <li><a href="../public/onlinetxt.php">online</a></li> -->
                        </ul>
                    </li>





                    <!-- <li><a href="../Weather/Weather.php">Weather</a></li> -->
                    <li><a href="../blog/index.php">论坛</a></li>
                    <li><a href="../about/about.php">关于</a></li>
                    
                   <!--  <li>
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Tools <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="../tools/touch.php">摇杆</a></li>
                            <li class="divider"></li>
                            <li><a href="../tools/control.php">遥控器</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Udp Data</a></li>
                            <li class="divider"></li>
                            <li><a href="../phpMyAdmin/index.php">Mysql</a></li>
                            <li class="divider"></li>
                            <li><a href="../public/log.php">log</a></li>
                            <li class="divider"></li>
                            <li><a href="../public/onlinetxt.php">online</a></li>
                        </ul>
                    </li> -->
            </ul>
            <ul class="nav navbar-nav navbar-right">
               <?php
               if($_SESSION['login'])
               {
                    //用户头像
                    $file = $_SERVER['localhost']."public/upload-head/userheadimg/".$_SESSION['login'].".jpg";
                    if(file_exists($file))
                    {
                        //存在
                        $avatar = $file;
                    }
                    else
                    {
                        //不存在
                        $avatar = $_SERVER['localhost']."public/upload-head/default.jpg";
                    }

                echo '<li><a href="../public/upload-head/index.html" >欢迎 '.$_SESSION['login'].'</a></li><li><a href="../accut/logout.php" ><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
                echo '<li><img src="'.$avatar.'" width="35px" height="35" style="margin-left:5px; margin-top: 8px; border-radius: 35px;" /></li>';
            }
            else
            {
                echo '<li><a href="'.$_SERVER['localhost'].'/accut/login.php" ><span class="glyphicon glyphicon-log-in"></span> Login</a></li><li><a href="'.$_SERVER['localhost'].'/accut/register.php" >Register</a></li>';
            }
            ?>
        </ul>
    </div>
</div>
</nav>
</html>