<?php
    include $_SERVER['DOCUMENT_ROOT']."/common/fun.php";
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    header('Content-type:application/json');

    //删除某个帖子API，支持get，post

	//获取id
    $id = get_post_para('id',true);

    // 删除帖子
    $sql_delete = "delete from blog where id=$id";  
    $res_delete = mysqli_query($con,$sql_delete); 

    // 删除回帖
    $sql_del = "delete from bloganswer where toid=$id";  
    $res_del = mysqli_query($con,$sql_del);

    // 删除帖子对应的图片文件夹
    delDirAndFile($_SERVER['DOCUMENT_ROOT']."/image/blog/{$id}");

    if($res_delete) 
    {
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

