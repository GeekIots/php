<?php
    include $_SERVER['DOCUMENT_ROOT']."/common/fun.php";
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    require_once($_SERVER['DOCUMENT_ROOT'].'/common/phpmailer/mail.php'); 
    header('Content-type:application/json');

    // 更改密码API，支持get，post
    
    // 传入参数：
    // 用户id:userid
    // 原始密码:password
    // 新密码:new_password

	//获取userid
    $userid = get_post_para('userid',true);

    //判断userid是否存在
    $user = check_userid($userid,$con);
   
    //获取原来的密码
    $password = get_post_para('password',true);

    //获取新密码
    $new_password = get_post_para('new_password',true);

    //判断密码是否正确
    psd_verify($userid,$password,$con);

    // 更新密码并发邮件提示
    $npsw = md5($new_password);
    $sql_update = "UPDATE user set password='$npsw' where userid='$userid'";
    $res_update = mysqli_query($con,$sql_update);
    if ($res_update)   
    {
        // print_r($user);
        $myArray["resault"] = 'success';
        // 发送邮件通知用户
        sendmail($user['email'],'极客物联网密码更改通知！',"您的密码已经变更，如非本人操作，您的登录密码可能已经泄漏,请及时修改！http://geek-iot.com");
    } 
    else{
        $myArray["msg"]=mysqli_error($con);
        $myArray["resault"] = 'fail';
    }     

    // mysqli_close($con);
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>

