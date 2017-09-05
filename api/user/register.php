<?php
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    header('Content-type:application/json');
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    require_once('../email.class.php'); 

    //初始化发送邮件类
    $smtp = new smtp('','','',true,'');
    //$smtp->mail("15339287330@126.com", "群发", "测试");

    //获取邮箱
    $email = $_POST['email'];
    //获取昵称
    $nickname = $_POST['nickname'];
    //获取密码
    $password = $_POST['password'];

    $myArray["resault"] = 'fail';

    // 参数判断
    if (!empty($email)) {
        // 判断昵称是否已经存在
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
                        $sql_insert = "insert into user (nickname,password,email) values('$nickname','$psw','$email')";  
                        if(mysqli_query($con,$sql_insert))
                        {
                            //注册成功
                            $myArray["resault"] = 'success';
                            $smtp->mail($email, "极客物联网注册认证！", "恭喜您成为极客物联网会员，请点击链接激活账号"."www.smtvoice.com/api/blog/register.check.php?nickname=".$nickname);
                            $smtp->mail("15339287330@126.com", "新会员注册提示！",'昵称:' $nickname."注册邮箱:".$email);
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