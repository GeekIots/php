<?php
  error_reporting(E_ALL^E_NOTICE); //取消警告显示
  header('Content-type:application/json');
  date_default_timezone_set("Asia/Shanghai");
  include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";

  // 参数判断
  if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];
    // 判断用户是否存在
    $sql = "select userid from user where userid = '$userid'"; //SQL语句
    $result = mysqli_query($con,$sql);//执行SQL语句
    if (!mysqli_num_rows($result)) {
      // 用户不存在
      $myArray["msg"] = '用户不存在，请确认后再试！';
      $myArray["resault"] = 'fail';
      $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
      echo $json;
      // mysqli_close($con);
      exit();
    }
  }
  else{
    $myArray["msg"] = '缺少字段:userid！';
    $myArray["resault"] = 'fail';
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
  }

  if (isset($_GET['name'])) {
    $name = $_GET['name'];
  }
  else{
    $myArray["msg"] = '缺少字段:name！';
    $myArray["resault"] = 'fail';
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
  }

  if (isset($_GET['opencmd'])) {
    $opencmd = $_GET['opencmd'];
  }
  else{
    $myArray["msg"] = '缺少字段:opencmd！';
    $myArray["resault"] = 'fail';
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
  }

  if (isset($_GET['closecmd'])) {
    $closecmd = $_GET['closecmd'];
  }
  else{
    $myArray["msg"] = '缺少字段:closecmd！';
    $myArray["resault"] = 'fail';
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
  }

  if (isset($_GET['pic'])) {
    $pic = $_GET['pic'];
  }
  
  //检查图片有效性，无效启用默认图片
  if(!@fopen( $pic, 'r' )){
    $pic = "http://www.geek-iot.com/image/default/switch.jpg";
  }

  // 存储开关信息
  $sql_insert = "insert into switch (userid,name,state,pic,opencmd,closecmd,heat,online,latest,created) values('$userid','$name','$closecmd','$pic','$opencmd','$closecmd','0','离线',now(),now())";
  $res_insert = mysqli_query($con,$sql_insert);
  if ($res_insert){
    $myArray["resault"] = 'success';
  } 
  else{
    $myArray["msg"]=mysqli_error($con);
    $myArray["resault"] = 'fail';
  }           

  // mysqli_close($con);
  // print_r($myArray); 
  $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
  echo $json;
?>