<?php
    include $_SERVER['DOCUMENT_ROOT']."/common/fun.php";
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    header('Content-type:application/json');

    //获取用户列表API，支持get，post

	//获取page
    $page = get_post_para('page',true);

    //获取limit
    $limit = get_post_para('limit',true);

    //获取总数
    $sql_select="select count(*) from user";
    $res=mysqli_query($con,$sql_select);
    list($count)=mysqli_fetch_row($res);
    $myArray["count"] = $count;

    $StartNum=$limit*($page-1);

    $sql="select * from user order by regtime desc limit $StartNum,$limit";
    $query=mysqli_query($con,$sql); 
    while($row=mysqli_fetch_array($query))
    {
        $indexArray["nickname"] = $row['nickname'];//昵称
        $indexArray["userid"] = $row['userid'];//用户id
        $indexArray["sex"] = ($row['sex']==0) ? '男' : '女' ;//性别
        $indexArray["avatar"] = $row['avatar'];//头像路径
        $indexArray["phonenumber"] = $row['phonenumber'];//手机号码
        $indexArray["email"] = $row['email'];//绑定邮箱
        $indexArray["city"] = $row['city'];//城市
        $indexArray["qq"] = $row['qq'];//qq号码
        $indexArray["signature"] = $row['signature'];//个性签名
        $indexArray["value"] = $row['value'];//用户积分
        $indexArray["level"] = $row['level'];//用户等级
        $indexArray["datetime"] = $row['regtime'];//注册时间
        $indexArray["qq_openid"] = $row['qq_openid'];//绑定qq登录

        $myArray["data"][] = $indexArray;
    }

    $myArray["code"] = 0;
    $myArray["resault"] = 'success';  
    // mysqli_close($con);
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>

