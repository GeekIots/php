<?php
    include $_SERVER['DOCUMENT_ROOT']."/common/fun.php";
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    header('Content-type:application/json');

    //获取站点信息API，支持get，post

    //获取page
    $page = get_post_para('page',true);

    //获取limit
    $limit = get_post_para('limit',true);
    
    //获取总数
    $sql_select="select count(*) from info where class='web'";
    $res=mysqli_query($con,$sql_select);
    list($count)=mysqli_fetch_row($res);
    $myArray["count"] = $count;

    $StartNum=$limit*($page-1);

    $sql="select * from info where class='web' limit $StartNum,$limit";
    $query=mysqli_query($con,$sql); 
    while($row=mysqli_fetch_array($query))
    {
        $indexArray["id"] = $row['id'];//ID
        $indexArray["name"] = $row['name'];//名称
        $indexArray["content"] = $row['content_html'];//内容
        $indexArray["des"] = $row['des'];//描述
        $indexArray["dates"] = $row['latest'];//更新时间

        $myArray["data"][] = $indexArray;
    }

    $myArray["code"] = 0;
    $myArray["resault"] = 'success';  
    // mysqli_close($con);
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>