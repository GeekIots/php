<?php
    include $_SERVER['DOCUMENT_ROOT']."/common/fun.php";
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    header('Content-type:application/json');

    //获取开关列表API，支持get，post

	//获取page
    $page = get_post_para('page',true);

    //获取limit
    $limit = get_post_para('limit',true);

    //获取总数
    $sql_select="select count(*) from sensor";
    $res=mysqli_query($con,$sql_select);
    list($count)=mysqli_fetch_row($res);
    $myArray["count"] = $count;

    $StartNum=$limit*($page-1);

    $sql="select * from sensor order by created desc limit $StartNum,$limit";
    $query=mysqli_query($con,$sql); 
    while($rs=mysqli_fetch_array($query))
    {
        // 获取用户信息
        $sql11="select * from user where userid='{$rs['userid']}'";
        $query11=mysqli_query($con,$sql11);
        $row = mysqli_fetch_array($query11);

        $indexArray["id"] = $rs['id'];//开关id
        $indexArray["pic"] = $rs['pic'];//图片
        $indexArray["type"] = $rs['type'];//类型
        $indexArray["data"] = $rs['data'];//类型
        $indexArray["heat"] = $rs['heat'];//热度
        $indexArray["created"] = $rs['created'];//创建时间
        $indexArray["latest"] = $rs['latest'];//更新时间


        $indexArray["usrid"] = $row['userid'];//用户id
        $indexArray["nickname"] = $row['nickname'];//昵称
        $indexArray["sex"] = ($row['sex']==0) ? '男' : '女' ;//性别
        $indexArray["avatar"] = $row['avatar'];//头像路径
        $indexArray["email"] = $row['email'];//绑定邮箱
        $indexArray["city"] = $row['city'];//城市

        $myArray["data"][] = $indexArray;
    }

    $myArray["code"] = 0;
    $myArray["resault"] = 'success';  
    // mysqli_close($con);
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>

