<?php
    include $_SERVER['DOCUMENT_ROOT']."/common/fun.php";
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    header('Content-type:application/json');

    //获取、点赞、取消点赞API，支持get，post
    /*
	获取帖子点赞数量：
	  type：get
	  blogid：blogid
	设置点赞：
	  type：set
	  userid：用户id
	  blogid：收藏的帖子id
	取消点赞：
	  type：cancel
	  userid：用户id
	  blogid：取消收藏的帖子id	
	*/

	//获取type
    $type = get_post_para('type',true);

    //获取userid,获取帖子点赞数量不需要userid
    $retVal = ($type=='get') ? false : true;
    $userid = get_post_para('userid',$retVal);
    // 判断userid是否存在
    check_userid($userid,$con);

    //获取blogid
    $blogid = get_post_para('blogid',true);

	// 获取帖子点赞数量
	if ($type=='get') {
		$sql="select count(*) from blog_zan where blogid = '{$blogid}'";
		$count=mysqli_fetch_array($sql); 
		$myArray["count"] = $count[0]; //个数 
		$myArray["resault"] = 'success';
  	}
  	else
  	// 设置点赞
	if ($type=='set') {
		$sql_insert="insert into blog_zan (userid,blogid,dates) values ($userid,$blogid,now())";
	    if (mysqli_query($con, $sql_insert))
	    {
	        $myArray["resault"] = 'success';
	    }
	    else
	    {
	        $myArray["msg"]=mysqli_error($con);
	        $myArray["resault"] = 'fail';
	    }
	}
	// 取消点赞
	else
	if ($type=='cancel') {
		$sql_delete = "delete from blog_zan where userid=$userid and blogid=$blogid";  
	    $res_delete = mysqli_query($con,$sql_delete); 
	    if($res_delete) 
	    {
	        $myArray["resault"] = 'success';
	    } 
	    else{
	        $myArray["msg"]=mysqli_error($con);
	        $myArray["resault"] = 'fail';
	    }
	}
	else
	{
		$myArray["msg"] = '不支持类型：{$type}!'; //list列表元素个数 
		$myArray["resault"] = 'false';
	}

	// mysqli_close($con);
	// print_r($myArray); 
	$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
	echo $json;
?>