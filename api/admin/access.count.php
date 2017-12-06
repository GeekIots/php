<?php
    include $_SERVER['DOCUMENT_ROOT']."/common/fun.php";
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    header('Content-type:application/json');
    /*
    获取访问量:
      type：get
      sort:
        --list 列表
        --count 数量
    设置访问量:
      type：set 设置
      nickname：昵称
      city：城市
      nowurl: 当前页面
      fromurl: 来源页面
    */

    //获取type
    $type = get_post_para('type',true);

    if ($type=='set') {
        //获取
        $nickname = get_post_para('nickname',true);            
        //获取
        $city = get_post_para('city',true);
        //获取
        $nowurl = get_post_para('nowurl',true);
        //获取
        $fromurl = get_post_para('fromurl',true);   
    }
    elseif ($type=='get') {
        //获取sort
        $sort = get_post_para('sort',true);

        if ($sort=='list') {
            //获取page
            $page = get_post_para('page',true);
            //获取limit
            $limit = get_post_para('limit',true);            
        }
    }

    if ($type=='set') {
        //添加记录
        $sql_insert = "insert into admin_count (nickname,city,nowurl,fromurl,dates) values('$nickname','$city','$nowurl','$fromurl',now())";
        $res_insert = mysqli_query($con,$sql_insert);
        if ($res_insert) 
        {
            $myArray["resault"] = 'success';
        } 
        else{
            $myArray["msg"]=mysqli_error($con);
            $myArray["resault"] = 'fail';
        }           
    }
    elseif ($type=='get') {
        //获取总数
        $sql_select="select count(*) from admin_count";
        $res=mysqli_query($con,$sql_select);
        list($count)=mysqli_fetch_row($res);
        $myArray["count"] = $count;

        if ($sort=='list') {
            $StartNum=$limit*($page-1);
            $sql="select * from admin_count order by dates desc limit $StartNum,$limit";
            $query=mysqli_query($con,$sql); 
            while($row=mysqli_fetch_array($query))
            {
                $indexArray["id"] = $row['id'];//ID
                $indexArray["nickname"] = $row['nickname'];//昵称
                $indexArray["city"] = $row['city'];//城市
                $indexArray["nowurl"] = $row['nowurl'];//页面
                $indexArray["fromurl"] = $row['fromurl'];//访问来源
                $indexArray["dates"] = $row['dates'];//更新时间

                $myArray["data"][] = $indexArray;
            }            
        }
    
        $myArray["code"] = 0;
        $myArray["resault"] = 'success';
     }
    // mysqli_close($con);
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>