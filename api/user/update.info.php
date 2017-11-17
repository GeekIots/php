<?php
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    header('Content-type:application/json');
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    date_default_timezone_set("Asia/Shanghai");

    // 参数判断
    if (isset($_POST['userid'])) {
        $userid = $_POST['userid'];
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

    //获取昵称
    if (isset($_POST['nickname'])) {
        $nickname = $_POST['nickname'];
    }
    else{
        $myArray["msg"] = '缺少字段:nickname！';
        $myArray["resault"] = 'fail';
        $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
        echo $json;
        exit();
    }

    //获取昵称
    if (isset($_POST['sex'])) {
        $sex = $_POST['sex'];
    }
    else{
        $myArray["msg"] = '缺少字段:sex！';
        $myArray["resault"] = 'fail';
        $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
        echo $json;
        exit();
    }

    //获取城市
    if (isset($_POST['city'])) {
        $city = $_POST['city'];
    }
    else{
        $myArray["msg"] = '缺少字段:city！';
        $myArray["resault"] = 'fail';
        $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
        echo $json;
        exit();
    }

    //获取签名
    if (isset($_POST['signature'])) {
        $signature = $_POST['signature'];
    }
    else{
        $myArray["msg"] = '缺少字段:signature！';
        $myArray["resault"] = 'fail';
        $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
        echo $json;
        exit();
    }

    $sql_update = "UPDATE user set nickname='$nickname',sex='$sex',city='$city',signature='$signature' where userid='$userid'";
    $res_update = mysqli_query($con,$sql_update);
    if ($res_update)   
    {
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