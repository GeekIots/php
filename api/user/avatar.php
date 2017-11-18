<?php
    include $_SERVER['DOCUMENT_ROOT']."/common/fun.php";
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    header('Content-type:application/json');

    //获取文章列表API，支持get，post

    //获取userid
    $userid = get_post_para('userid',true);
    check_userid($userid,$con);

    //获取avatar
    $avatar = get_post_para('avatar',true);

    $sql_insert = "UPDATE  user set avatar='{$avatar}' where userid='{$userid}'";  
    if(mysqli_query($con,$sql_insert))
    {
        //成功
        $myArray["resault"] = 'success';
    }  
    else  
    {  
        // 失败
        $myArray["msg"]=mysqli_error($con);
        $myArray["resault"] = 'fail';
    } 
   
    // mysqli_close($con);
    // print_r($myArray); 
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>  