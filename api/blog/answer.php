<?php 
    include $_SERVER['DOCUMENT_ROOT']."/common/fun.php";
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    header('Content-type:application/json');

    //回复帖子API，支持get，post

    //获取回帖ID
    $id = get_post_para('id',true);

    //获取原帖ID
    $toid = get_post_para('toid',true);

    //获取内容
    $contents = get_post_para('contents',true);

    // 获取用户ID
    $userid = get_post_para('userid',true);

    // 判断用户是否存在
    $row = check_userid($userid,$con);

	// 验证通过，存储回复
    $sql_insert="insert into bloganswer (id,dates,contents,userid,toid) values ($id,now(),'$contents',$userid,$toid)";
    if (!mysqli_query($con, $sql_insert))
    {
        // die('Error: ' . mysqli_error($con));
        $myArray["msg"]=mysqli_error($con);
        $myArray["resault"] = 'fail';
    }
    else
    {
        $myArray["resault"] = 'success';
    }

 	// mysqli_close($con);
    // print_r($myArray); 
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>