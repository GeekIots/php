<?php
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    header('Content-type:application/json');
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";

    //获取昵称
    $nickname = $_POST['nickname'];
    //获取头像地址
    $avatar = $_POST['avatar'];

    $myArray["resault"] = 'fail';

    // 参数判断
    if (!empty($nickname)) {
        // 判断昵称是否已经存在
        $sql = "select nickname from user"; //SQL语句
        $result = mysqli_query($con,$sql);//执行SQL语句
        if (mysqli_num_rows($result)) {
            // 昵称通过
            if (!empty($avatar)) {
                        $sql_insert = "UPDATE  user set avatar='{$avatar}' where nickname='{$nickname}'";  
                        if(mysqli_query($con,$sql_insert))
                        {
                            //成功
                            $myArray["resault"] = 'success';
                        }  
                        else  
                        {  
                            // 失败
                            // die('Error: ' . mysqli_error($con));
                            $myArray["msg"]=mysqli_error($con);
                            $myArray["resault"] = 'fail';
                        }   
            }
            else {
                $myArray["msg"] = '缺少头像字段:avatar';
            }    
        }
        else{
            // nickname不存在
            $myArray["msg"] = '昵称不存在！';
        }
    }
    else{
        $myArray["msg"] = '缺少昵称字段:nickname！';
    }
    // mysqli_close($con);
    // print_r($myArray); 
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>  