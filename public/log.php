<?php include("../public/header.php");?>
<!DOCTYPE HTML>
<html>
<head>
  
</head>
<body>
  <main>
  <div style="margin-left: 10%;margin-right: 10%;margin-top: 1% ">
    <p style="font-size: 20px;color: blue;">
      
     <?php
   /********************
   1、写入内容到文件,追加内容到文件
   2、打开并读取文件内容
   ********************/
    $file  = '../log.txt';//要写入文件的文件名（可以是任意文件名），如果文件不存在，将会创建一个
    if($_SESSION['login']=="sun")
    {
      if($data = @file_get_contents($file)){ // 这个函数支持版本(PHP 4 >= 4.3.0, PHP 5) 
       echo "$data";
      }
      else
        echo "未找到日志文件！";
    }
    else
    {
       echo "Sorry,您没有访问权限！";
    }
    ?>
    </p> 
   </div>
 </main>
</body>
</html>
<?php include '../public/footer.php';?>