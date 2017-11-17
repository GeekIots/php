<?php
    // 设置session
    session_start();
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    header('Content-type:application/json');
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";

	//获取qq_openid
    $qq_openid = $_POST['qq_openid'];

    $myArray["resault"] = 'fail';

    // 参数判断
    if (!empty($qq_openid)) {
        // 判断是否存在
        $sql = "select qq_openid from user where qq_openid = '$qq_openid'"; //SQL语句
        $result = mysqli_query($con,$sql);//执行SQL语句
        if (mysqli_num_rows($result)) {
            $sql = "select * from user where qq_openid = '$qq_openid'"; //SQL语句
            $result = mysqli_query($con,$sql);//执行SQL语句
            $row=mysqli_fetch_array($result);
            
            $myArray["resault"] = 'success';
            // 返回用户信息
            $myArray["nickname"] = $row['nickname'];
			$myArray["password"] = $password;
			$myArray["phonenumber"] = $row['phonenumber'];
            $myArray["userid"] = $row['userid'];
            $myArray["sex"] = $row['sex'];
			$myArray["email"] = $row['email'];
			$myArray["city"] = $row['city'];
			$myArray["qq"] = $row['qq'];
            $myArray["regtime"] = $row['regtime'];
            $myArray["qq_openid"] = $row['qq_openid'];
			$myArray["avatar"] = 'http://www.geei-iot.com/picture/avatar/nickname.jpg';

            // 目前是以邮箱登录,userid是唯一标志
            $_SESSION['login'] = $row['userid'];
        }
        else{
            // qq_openid不存在
            $myArray["msg"] = 'qq_openid不存在！';
        }
    }
    else{
        $myArray["msg"] = '缺少字段:qq_openid！';
    }
    // mysqli_close($con);
    // print_r($myArray); 
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>

