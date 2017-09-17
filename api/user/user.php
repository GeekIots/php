<?php
    session_start();
    date_default_timezone_set("Asia/Shanghai");
    // 获取用户登陆状态和用户信息
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    header('Content-type:application/json');
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";

    /*
    //未登录
    {
        resault:"success",
        login:"false"
    }
    //已登录
    {
        resault:"success",
        login:"true",
        nickname:"test",
        avatar:"image/avatar/20170917/20170917160838.png",
        phonenumber:"15339287330",
        email:"sunyiming537@126.com",
        address:"陕西省西安市灞桥区狄寨镇狄存",
        qq:"574287254",
        level:"2", //用户级别
        active:"1" //激活状态
    }
    //错误
    {
        resault:"fail",
        msg:"错误信息"
    }
    */
    $myArray["resault"] = 'fail';
    if (!isset($_SESSION['login'])) {
        // 未登录
        $myArray["resault"] = 'success';
        $myArray["login"] = 'false';
    }
    else
    {
        if (!$con)
        {
            $myArray["resault"]='fail';
            $myArray["msg"]= mysqli_error($con);
        }
        else
        {
            // 获取用户信息
            $myArray["resault"] = 'success';
            $myArray["login"] = 'true';

            $sql = "select * from user where email = '{$_SESSION['login']}'"; //SQL语句
            $result = mysqli_query($con,$sql);//执行SQL语句
            $row=mysqli_fetch_array($result);
            // 返回用户信息
            $myArray["nickname"] = $row['nickname'];
            // $myArray["avatar"] = 'http://www.geei-iot.com'.$row['avatar'];
            $myArray["avatar"] = $row['avatar'];
            $myArray["phonenumber"] = $row['phonenumber'];
            $myArray["email"] = $row['email'];
            $myArray["address"] = $row['address'];
            $myArray["qq"] = $row['qq'];
        }
    }

    mysqli_close($con);
    // print_r($myArray); 
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>

