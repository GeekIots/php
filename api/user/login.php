<?php
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    header('Content-type:application/json');
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";

	//获取邮箱
    $email = $_POST['email'];

    //获取密码
    $password = $_POST['password'];

    $myArray["resault"] = 'fail';

    // 参数判断
    if (!empty($email)) {
        // 判断邮箱是否存在
        $sql = "select email from user where email = '$email'"; //SQL语句
        $result = mysqli_query($con,$sql);//执行SQL语句
        if (mysqli_num_rows($result)) {
            // 邮箱通过,判断密码是否正确
            $psw = md5($password);
            $sql = "select * from user where email = '$email'"; //SQL语句
            $result = mysqli_query($con,$sql);//执行SQL语句
            $row=mysqli_fetch_array($result);
            if ($row['password'] == $psw) {
                // 密码正确
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
				$myArray["avatar"] = 'http://www.geei-iot.com/picture/avatar/nickname.jpg';
                // 设置session
                session_start();
                // 目前是以邮箱登录,userid是唯一标志
                $_SESSION['login'] = $row['userid'];
            }
            else{
                // 密码错误
                $myArray["msg"] = '密码不正确！';
            }  
        }
        else{
            // email不存在
            $myArray["msg"] = '邮箱账号不存在！';
        }
    }
    else{
        $myArray["msg"] = '缺少邮箱字段:email！';
    }
    mysqli_close($con);
    // print_r($myArray); 
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>

