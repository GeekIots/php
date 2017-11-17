<?php
    include $_SERVER['DOCUMENT_ROOT']."/common/fun.php";
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    header('Content-type:application/json');

    // 更改密码API，支持get，post
    
    // 传入参数：
    // 用户id:userid

	//获取userid
    $userid = get_post_para('userid',true);

    //判断userid是否存在
    $user = check_userid($userid,$con);

    // 解除绑定
    $sql_update = "UPDATE user set qq_openid=NULL where userid='$userid'";
    $res_update = mysqli_query($con,$sql_update);
    if ($res_update)   
    {
        // print_r($user);
        $myArray["resault"] = 'success';
    } 
    else{
        $myArray["msg"]=mysqli_error($con);
        $myArray["resault"] = 'fail';
    }     

    // mysqli_close($con);
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>

