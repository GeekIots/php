<?php
    include $_SERVER['DOCUMENT_ROOT']."/common/fun.php";
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    header('Content-type:application/json');

    //获取文章列表API，支持get，post

	//获取page
    $page = get_post_para('page',true);

    //获取limit
    $limit = get_post_para('limit',true);

    //获取总数
    $sql_select="select count(*) from blog";
    $res=mysqli_query($con,$sql_select);
    list($count)=mysqli_fetch_row($res);
    $myArray["count"] = $count;

    $StartNum=$limit*($page-1);

    $sql="select * from blog order by dates desc limit $StartNum,$limit ";
    $query=mysqli_query($con,$sql); 
    while($rs=mysqli_fetch_array($query))
    {
        //读取回复数量
        $sqlanswer="select count(*) from bloganswer where toid='".$rs['id']."'";
        $queryanswer=mysqli_query($con,$sqlanswer);
        $answernum=mysqli_fetch_array($queryanswer);
        // print_r($answernum);
        // 获取用户信息
        $sql11="select * from user where userid='{$rs['userid']}'";
        $query11=mysqli_query($con,$sql11);
        $row11 = mysqli_fetch_array($query11);


        $indexArray["id"]=$rs['id'];//帖子id
        $indexArray["avatar"]=$row11['avatar'];//用户头像
        $indexArray["title"]=$rs['title'];//帖子标题
        $indexArray["nickname"]=$row11['nickname'];//发帖人昵称
        $indexArray["userid"]=$row11['userid'];//发帖ID
        $indexArray["dates"]=$rs['dates'];//发布时间
        $indexArray["answer"] = $answernum[0];//回复数
        $indexArray["browser"] = $rs['hits'];//浏览量
        $indexArray["classify"] = $rs['classify'];//分类

        $myArray["data"][] = $indexArray;
    }

    $myArray["code"] = 0;
    $myArray["resault"] = 'success';  
    // mysqli_close($con);
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>

