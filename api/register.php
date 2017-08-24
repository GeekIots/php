<?php
error_reporting(E_ALL^E_NOTICE); //取消警告显示
header('Content-type:text/json');
header('Access-Control-Allow-Origin:*');
include "conn.php";
require_once('email.class.php'); 

//初始化发送邮件类
$smtp = new smtp('','','',true,'');
//$smtp->mail("15339287330@126.com", "群发", "测试");

/** 
 * 检查用户名是否符合规定 
 * 
 * @param STRING $username 要检查的用户名 
 * @return TRUE or FALSE 
 */
function is_username($username) 
{ 
    $strlen = strlen($username); 
     $v = trim($username); 
    if(empty($v))
    {
        return "用户名不能为空！"; 
    } 
    if (!preg_match("/^[a-zA-Z0-9_\x7f-\xff]/", $username)) 
    { 
        return "用户名不能包含特殊字符！"; 
    } 
    elseif (20 < $strlen || $strlen < 2) 
    { 
        return "用户名长度必须在2到20个字符之间，汉字占两个字节！"; 
    }
    return "ok"; 
}

//密码验证
function isPWD($value,$minLen=5,$maxLen=16)
{ 
    $match='/^[\\~!@#$%^&*()-_=+|{}\[\],.?\/:;\'\"\d\w]{'.$minLen.','.$maxLen.'}$/'; 
    $v = trim($value); 
    if(empty($v))
    {
        return "密码不能为空！"; 
    } 
    if (!preg_match($match,$v)) {
        return "密码必须是5到16个字符，可以包含数字，下划线和字母！";
    }
    else
    {
        return "ok";
    }
}

function isEmail($value,$match='/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i')
{ 
    $v = trim($value); 
    if(empty($v))
    return "邮箱不能为空！";
    if(!preg_match($match,$v)) 
    {
        return "邮箱格式不正确！";
    } 
    else
    {
       return "ok"; 
    } 
} 
    
    $result = TRUE;//校验结果
    $username = $_GET["username"];
    $password = $_GET["password"];
    $psw_confirm = $_GET["confirm"]; 
    $useremail =  $_GET["email"]; 
    if (is_username($username)!="ok") {
        //用户名不对
        $myArray["username"] = is_username($username);
        $myArray["error"] =  $myArray["username"];
        $result = false;
    }
    else
    {
         //在数据查询用户名是否存在
        $sql = "select username from user where username = '$username'"; //SQL语句
        $result = mysqli_query($con,$sql);    //执行SQL语句
        $num = mysqli_num_rows($result); //统计执行结果影响的行数
        if($num)    //如果已经存在该用户  
        {  
            //用户名已被占用'
            $myArray["username"] = "用户名已被占用！";
            $myArray["error"] =  $myArray["username"];
            $result = false;
        }
        else
        {
            $myArray["username"] = is_username($username);
             $myArray["password"] = isPWD($password);

            if (isPWD($password)!="ok") {
                //密码不正确
                $result = false;
                $myArray["error"] = isPWD($password);
            }
            else
            {
                if (empty($psw_confirm)) {
                    $myArray["confirm"] = "确认密码不能为空！";
                    $result = false;
                    $myArray["error"] =  $myArray["confirm"];
                }
                else
                if ($password!=$psw_confirm) {
                    //密码不一致
                    $myArray["confirm"] = "密码不一致";
                    $myArray["error"] =  $myArray["confirm"];
                    $result = false;
                 }
                else
                {
                    $myArray["confirm"] = "ok";

                    $myArray["email"] = isEmail($useremail);
                    if(isEmail($useremail)!="ok")
                    {
                        $myArray["error"] = isEmail($useremail);
                        //邮箱格式不正确
                        $result = false;
                    }
                }
            }
        }  
    }
    
    if($result)
    {
        $psw = md5($password);
        $sql_insert = "insert into user (username,password,email) values('$username','$psw','$useremail')";  
        $res_insert = mysqli_query($con,$sql_insert);
        if($res_insert)
        {
            //注册成功
            $myArray["result"] = "ok";
            $smtp->mail($useremail, "创客物联网注册认证！", "恭喜您成为创客物联网会员，请点击链接激活账号"."www.smtvoice.com/https/register.check.php?username=".$username);
            $smtp->mail("574287254@qq.com", $username."注册了新会员！",'用户名:' $username."注册邮箱:".$useremail);
        }  
        else  
        {  
            //注册失败
            $myArray["result"] = "fail";
            $myArray["error"] =  '网络错误，请稍后再试';
        }   
    }
    else
    {
        //注册失败
        $myArray["result"] = "fail";
    }
    //返回json字符串结果
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;   
?>  