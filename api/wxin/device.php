<?php 
	error_reporting(E_ALL^E_NOTICE); //取消警告显示
	header('Content-type:application/json');
  date_default_timezone_set("Asia/Shanghai");
  include $_SERVER ['DOCUMENT_ROOT']."/api/conn.php";//http

  $device = $_GET['device'];
  $type = $_GET['type'];
  $userid = $_GET['userid'];
  $password = $_GET['password'];
  $sensor = $_GET['sensor'];
  $data = $_GET['data'];
  $id = $_GET['id'];

  if (!$con)
  {
    $myArray["resault"]='fail';
    $myArray["error"]='数据库读取错误！';
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
  }

  if ($device=='switch') 
  {
    if ($type=='getlist') 
    {
       $myArray["resault"] = 'success';
       $result = mysqli_query($con, "SELECT * FROM switch WHERE userid = '$userid' ");
       $myArray["num"] = $result->num_rows;
       $num=0;
       while ($row = mysqli_fetch_array($result)) {
         $num++;
         $indexArray = null;
         $indexArray["id"]=$row['id'];
         $indexArray["name"]=$row['name'];
         $indexArray["state"]=$row['state'];
         $indexArray["pic"]=$row['pic'];
         $indexArray["opencmd"]=$row['opencmd'];       
         $indexArray["closecmd"]=$row['closecmd'];
         $indexArray["heat"]=$row['heat'];
         // 针对微信小程序添加
         if($row['state']==$row['opencmd'])
          {$indexArray["icon"]='img/1.png';}
        else
          {$indexArray["icon"]='img/3.png';}

        $indexArray["wid"]=$num;

        $myArray["list"][]=$indexArray;
      }
      mysqli_close($con);
                 // print_r($myArray); 
      $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
      echo $json;
    }
    else if($type=='set')
    {
      // 1.与UDP服务器通信，返回成功，将结果写入数据库，失败则直接返回错误信息
      $id = $_GET['id'];
      $cmd = $_GET['cmd'];
      $sendMsg = "{\"type\":\"{$type}\",\"userid\":\"{$userid}\",\"deviceid\":\"{$id}\",\"state\":\"{$cmd}\"}";
      $ip = '120.27.45.38';
      $port = '2525';
      $handle = stream_socket_client("udp://{$ip}:{$port}", $errno, $errstr);

      fwrite($handle, $sendMsg."\n");
      $result = fread($handle, 1024);
      $result=mb_convert_encoding($result,"UTF-8","gb2312");
      $jsonArray = json_decode($result);
      fclose($handle);

      // 如果响应成功，存入数据库
      if (($jsonArray->state=="设备响应超时！")||($jsonArray->state=="设备不在线！")) 
      {
        // 不保存    
        $myArray["resault"] = 'fail';
      }
      else
      {
        $myArray["resault"] = 'success';
        $userdate = date("Y-m-d H:i:s",time());
        $myArray["latest"] = $userdate;
        $insertResault = mysqli_query($con, "update switch set state='$cmd' ,latest='$userdate' where userid='$userid' and id='$id'");
        //控制次数加一
        $sql="UPDATE switch set heat = heat+1 where id='$id'";
        mysqli_query($con,$sql);
        mysqli_close($con);
        if ($insertResault) 
        {
          $myArray["updatesever"] = "ok";
        } 
        else
        {
          $myArray["updatesever"] = "fail";
        }
      }
      $myArray["return"] = $jsonArray->state;
      $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
      echo $json;
    }
  }
  else
  if($device=='sensor')
  { 
    if ($type=='getlist'){
       $myArray["resault"] = 'success';
       $result = mysqli_query($con, "SELECT * FROM sensor WHERE type='$sensor' and userid = '$userid'");
       // print_r($result);
       $myArray["num"] = $result->num_rows;
       $num=0;
       while ($row = mysqli_fetch_array($result)) {
         $num++;
         $indexArray = null;
         $indexArray["id"]=$row['id'];
         $indexArray["name"]=$row['name'];
         $indexArray["type"]=$row['type'];
         $indexArray["pic"]=$row['pic'];
         $indexArray["data"]=$row['data'];       
         $indexArray["heat"]=$row['heat'];

         $myArray["list"][]=$indexArray;
         $id = $row['id'];
       //浏览量加一
       $sql="UPDATE sensor set heat = heat+1 where id='$id'";
       mysqli_query($con,$sql);
       }
       // print_r($myArray); 
       $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
       echo $json;
       mysqli_close($con);
    }
   else
    if ($type=='updata') {
       $result = mysqli_query($con, "UPDATE sensor set data='$data' where userid='$userid' and id='$id'");
       if ($result) {
          $myArray["resault"] = 'success';
       }
       else
       {
        $myArray["resault"] = 'fail';
        $myArray["error"] = '数据库写入错误！';
       }
       mysqli_close($con);
       // print_r($myArray); 
       $myArray["resault"] = 'success';
       $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
       echo $json;
    }
  }
?>