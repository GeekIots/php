<?php
    // 设置session
    session_start();
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    header('Content-type:application/json');
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";

	//获取邮箱
    $email = $_POST['email'];
    if (empty($email)) {
        $email = $_GET['email'];
    }

    //获取密码
    $password = $_POST['password'];
    if (empty($password)) {
        $password = $_GET['password'];
    }
    

    // qq登录传递的参数
    $qq_openid = '';
    if (isset($_POST['qq_openid'])) {
        $qq_openid = $_POST['qq_openid'];
    }
    $avatar = '';
    if (isset($_POST['avatar'])) {
        $avatar = $_POST['avatar'];
    }
    $nickname = '';
    if (isset($_POST['nickname'])) {
        $nickname = $_POST['nickname'];
    }

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
                $myArray["qq_openid"] = $row['qq_openid'];


                // 检测图像是否存在
                if(!@fopen( $row['avatar'], 'r' )){
                  $myArray["avatar"] = "http://www.geek-iot.com/image/default/avatar.jpg";
                }
                else
                {
                    $myArray["avatar"] = $row['avatar'];//头像路径
                }

                // 目前是以邮箱登录,userid是唯一标志
                $_SESSION['login'] = $row['userid'];

                // 将qq_openid更新到用户信息
                if ($qq_openid) {
                    $sql_update="UPDATE user set nickname='$nickname',qq_openid='$qq_openid',avatar='$avatar' where email='$email'";
                    mysqli_query($con,$sql_update);
                }
               
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
    // mysqli_close($con);
    // print_r($myArray); 
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>

