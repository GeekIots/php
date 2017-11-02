<?php
    // 设置session
    session_start();
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    header('Content-type:application/json');
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    require_once('/common/phpmailer/mail.php'); 
    date_default_timezone_set("Asia/Shanghai");

    // 毫秒级时间戳
    function uuid() {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
    }

    // $sendto:发送到
    // $subject:标题
    // $body:内容
    // sendmail('15339287330@126.com','测试标题','<h1>极客物联网邮件系统测试！</h1>');

    //获取邮箱
    $email = $_POST['email'];
    //获取昵称
    $nickname = $_POST['nickname'];
    //获取密码
    $password = $_POST['password'];

    // 随机生成唯一id作为用户的身份id
    $userid = '';

    // qq登录传递的参数
    $qq_openid = '';
    if (isset($_POST['qq_openid'])) {
        $qq_openid = $_POST['qq_openid'];
    }
    $avatar = '';
    if (isset($_POST['avatar'])) {
        $avatar = $_POST['avatar'];
    }

    $myArray["resault"] = 'fail';

    // 参数判断
    if (!empty($email)) {
        // 判断邮箱是否已经存在
        $sql = "select email from user where email = '$email'"; //SQL语句
        $result = mysqli_query($con,$sql);//执行SQL语句
        if (!mysqli_num_rows($result)) {
            // 邮箱通过
            if (!empty($nickname)) {
                // 判断昵称是否已经存在
                $sql = "select nickname from user where nickname = '$nickname'"; //SQL语句
                $result = mysqli_query($con,$sql);//执行SQL语句
                if (!mysqli_num_rows($result)) {
                    // 昵称通过
                    if (empty($password)) {
                        $myArray["msg"] = '缺少密码字段:password！';
                    }  
                    else{
                        // 验证通过,开始注册
                        $psw = md5($password);
                        // 根据毫秒级时间戳生成唯一id作为用户的身份id，共计13位
                        $userid = uuid();
                        $sql_insert = "insert into user (nickname,password,email,userid,qq_openid,avatar,regtime) values('$nickname','$psw','$email','$userid','$qq_openid','$avatar',now())";  
                        if(mysqli_query($con,$sql_insert))
                        {
                            //注册成功
                            $myArray["resault"] = 'success';
                            sendmail($email,'极客物联网注册认证！',"恭喜您成为极客物联网会员，请点击链接激活账号 www.geek-iot.com/api/blog/user/register.check.php?userid={$userid}");
                            sendmail("15339287330@126.com", "新会员注册提示！","昵称:".$nickname.",用户ID:".$userid.",注册邮箱:".$email);
                            // 目前是以邮箱登录,userid是唯一标志
                            $_SESSION['login'] = $userid;
                        }  
                        else  
                        {  
                            // 注册失败
                            // die('Error: ' . mysqli_error($con));
                            $myArray["msg"]=mysqli_error($con);
                            $myArray["resault"] = 'fail';
                        }   
                    } 
                }
                else{
                    // 昵称已存在
                    $myArray["msg"] = '昵称已被占用,请更换！';
                }

            }
            else {
                $myArray["msg"] = '缺少昵称字段:nickname！';
            }    
        }
        else{
            // email存在
            $myArray["msg"] = '邮箱已被占用！';
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