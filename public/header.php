<?php session_start();
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    // include $_SERVER ['DOCUMENT_ROOT']."/public/online.php";
     function console($value='')
    {
        echo("<script>console.log('".$value."');</script>");
    }

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
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>smtvoice</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="极客物联网,远程控制,stm32,Arduino">
        <meta name="description" content="可以轻松控制控制家里的灯泡，电饭煲，热水器的物联网平台！">
        <script src="<?php echo $_SERVER ['localhost'];?>/js/jquery.min.js"></script>
        
        <!--  Bootstrap 核心 CSS 文件 -->
        <link rel="stylesheet" href="<?php echo $_SERVER ['localhost'];?>/bootstrap/css/bootstrap.min.css"  crossorigin="anonymous">

        <!--  主题文件（一般不用引入） -->
        <link rel="stylesheet" href="<?php echo $_SERVER ['localhost'];?>/bootstrap/css/bootstrap-theme.min.css" crossorigin="anonymous">

        <!-- Bootstrap 核心 JavaScript 文件 -->
        <script src="<?php echo $_SERVER ['localhost'];?>/bootstrap/js/bootstrap.min.js"  crossorigin="anonymous"></script>

                <style>
            /* Remove the navbar's default margin-bottom and rounded borders */
           /* .navbar {
                margin-bottom: 0;
                border-radius: 0;
            } */
            /*阴影效果，悬浮效果*/
            /*{box-shadow:[inset] x-offset y-offset blur-radius spread-radiuscolor}*/
            .box-shadow{  
                box-shadow:-3px 0 5px rgba(100,100,80,0.4), /*左边阴影*/  
                5px 0 5px rgba(100,100,80,0.4), /*右边阴影*/  
                4px 5px 5px rgba(100,100,80,0.4), /*顶部阴影*/ 
                4px 6px 5px rgba(100,100,80,0.4); /*底边阴影*/  
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
                <a class="navbar-brand" style="font-size: 25px" href="<?php echo $_SERVER['localhost'] ?>/index.php" >极客物联网</a>
            </div>
            <div class="collapse navbar-collapse" style="font-size: 20px" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo $_SERVER['localhost'] ?>/index.php">首页</a></li>
                    <!-- <li><a href="../device/userdevice.php">设备</a></li> -->
                    <li>
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        设备 <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" style="font-size: 20px">
                            <li><a href="<?php echo $_SERVER['localhost'] ?>/device/userdevice.php">查看设备</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo $_SERVER['localhost'] ?>/device/deviceManagement.php">管理设备</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo $_SERVER['localhost'] ?>/device/bluetooth/index.php">小程序遥控配置</a></li>
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
                    <li><a href="<?php echo $_SERVER['localhost'] ?>/blog/index.php">论坛</a></li>
                    <li><a href="<?php echo $_SERVER['localhost'] ?>/about/index.php">关于</a></li>
                    
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
                    $file = "http://www.smtvoice.com/public/upload-head/userheadimg/".$_SESSION['login'].".jpg";
                    console($file);
                    if(my_file_exists($file))
                    {
                        //存在
                        $avatar = $file;
                        console('存在');
                    }
                    else
                    {
                        //不存在
                        $avatar = "http://www.smtvoice.com/public/upload-head/default.jpg";
                        console('不存在');
                    }


                echo '
                <li>
                    <a href="'.$_SERVER['localhost'].'/public/upload-head/index.php" >欢迎 '.$_SESSION['login'].'</a>
                </li>
                <li>
                    <a href="'.$_SERVER['localhost'].'/accut/logout.php">
                    <span class="glyphicon glyphicon-log-out"></span>&nbsp Logout
                    </a>
                </li>';
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