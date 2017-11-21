<?php
    include $_SERVER['DOCUMENT_ROOT']."/common/fun.php";
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    header('Content-type:application/json');

    //删除某个用户API，支持get，post

	//获取id
    $id = get_post_para('id',true);

    $sql_delete = "delete from bloganswer where id=$id";  
    $res_delete = mysqli_query($con,$sql_delete); 

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

