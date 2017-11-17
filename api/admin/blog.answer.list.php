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
    $sql_select="select count(*) from bloganswer";
    $res=mysqli_query($con,$sql_select);
    list($count)=mysqli_fetch_row($res);
    $myArray["count"] = $count;

    $StartNum=$limit*($page-1);

    $sql="select * from bloganswer order by dates desc limit $StartNum,$limit ";
    $query=mysqli_query($con,$sql); 
    while($rs=mysqli_fetch_array($query))
    {
        // 获取用户信息
        $sql11="select * from user where userid='{$rs['userid']}'";
        $query11=mysqli_query($con,$sql11);
        $row11 = mysqli_fetch_array($query11);

        // 获取对应帖子标题
        $sql12="select title from blog where id='{$rs['toid']}'";
        $query12=mysqli_query($con,$sql12);
        $row12 = mysqli_fetch_array($query12);

        $indexArray["id"]=$rs['id'];//回帖ID
        $indexArray["toid"]=$rs['toid'];//帖子ID
        $indexArray["avatar"]=$row11['avatar'];//回帖头像
        $indexArray["nickname"]=$row11['nickname'];//回帖昵称
        $indexArray["title"]=$row12['title'];//帖子标题
        $indexArray["contents"]=$rs['contents'];//回帖内容
        $indexArray["dates"]=$rs['dates'];//回帖时间

        $myArray["data"][] = $indexArray;
    }

    $myArray["code"] = 0;
    $myArray["resault"] = 'success';  
    // mysqli_close($con);
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>

