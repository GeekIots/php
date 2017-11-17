<?php
    session_start();
    date_default_timezone_set("Asia/Shanghai");
    // 获取用户登陆状态和用户信息
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    header('Content-type:application/json');
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";

    /*
    1.获取指定id的用户信息

        需要传递userid参数

    2.获取当前登录的用户信息

        不需要任何参数

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

    if(isset($_POST['userid']))
    {
        $userid = $_POST['userid'];
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

            $sql = "select * from user where userid = '$userid'"; //SQL语句
            $result = mysqli_query($con,$sql);//执行SQL语句
            $row=mysqli_fetch_array($result);
            // 返回用户信息
            $myArray["nickname"] = $row['nickname'];//昵称
            $myArray["userid"] = $row['userid'];//用户id
            $myArray["sex"] = $row['sex'];//昵称
            // 检测图像是否存在
            if(!@fopen( $row['avatar'], 'r' )){
              $myArray["avatar"] = "http://www.geek-iot.com/image/default/avatar.jpg";
            }
            else
            {
                $myArray["avatar"] = $row['avatar'];//头像路径
            }
            $myArray["phonenumber"] = $row['phonenumber'];//手机号码
            $myArray["email"] = $row['email'];//绑定邮箱
            $myArray["city"] = $row['city'];//城市
            $myArray["qq"] = $row['qq'];//qq号码
            $myArray["signature"] = $row['signature'];//个性签名
            $myArray["value"] = $row['value'];//用户积分
            $myArray["level"] = $row['level'];//用户等级
            $myArray["datetime"] = $row['regtime'];//注册时间
            $myArray["qq_openid"] = $row['qq_openid'];//绑定qq登录
        }
    }
    else
    {
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

                $sql = "select * from user where userid = '{$_SESSION['login']}'"; //SQL语句
                $result = mysqli_query($con,$sql);//执行SQL语句
                $row=mysqli_fetch_array($result);
                // 返回用户信息
                $myArray["nickname"] = $row['nickname'];//昵称
                $myArray["userid"] = $row['userid'];//用户id
                $myArray["sex"] = $row['sex'];//昵称
                // $myArray["avatar"] = 'http://www.geei-iot.com'.$row['avatar'];

                // 检测图像是否存在
                if(!@fopen( $row['avatar'], 'r' )){
                  $myArray["avatar"] = "http://www.geek-iot.com/image/default/avatar.jpg";
                }
                else
                {
                    $myArray["avatar"] = $row['avatar'];//头像路径
                }
                
                $myArray["phonenumber"] = $row['phonenumber'];//手机号码
                $myArray["email"] = $row['email'];//绑定邮箱
                $myArray["city"] = $row['city'];//城市
                $myArray["qq"] = $row['qq'];//qq号码
                $myArray["signature"] = $row['signature'];//个性签名
                $myArray["value"] = $row['value'];//用户积分
                $myArray["level"] = $row['level'];//用户等级
                $myArray["datetime"] = $row['regtime'];//注册时间
                $myArray["qq_openid"] = $row['qq_openid'];//绑定qq登录
            }
        }
    } 

    // mysqli_close($con);
    // print_r($myArray); 
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>

