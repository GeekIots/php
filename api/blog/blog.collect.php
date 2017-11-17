<?php
    include $_SERVER['DOCUMENT_ROOT']."/common/fun.php";
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    header('Content-type:application/json');

    //获取、收藏、取消收藏帖子API，支持get，post
    /*
	获取列表：
	  type：get
	  userid：用户id
	查询帖子是否被本用户收藏：
	  type：check
	  userid：用户id
	  blogid：收藏的帖子id
	设置收藏：
	  type：set
	  userid：用户id
	  blogid：收藏的帖子id
	取消收藏：
	  type：cancel
	  userid：用户id
	  blogid：取消收藏的帖子id	
	*/

	//获取type
    $type = get_post_para('type',true);

    //获取userid
    $userid = get_post_para('userid',true);
    // 判断userid是否存在
    check_userid($userid,$con);

    //获取blogid,获取时不需要blogid
    $retVal = ($type=='get') ? false : true;
    $blogid = get_post_para('blogid',$retVal);

	// 获取收藏
	if ($type=='get') {
		$sql="select * from blog_collect where userid = '{$userid}' order by dates desc";
		$query=mysqli_query($con,$sql); 
		$num = 0;
		while($rs=mysqli_fetch_array($query))
		{
			//获取标题
			$sqlblog="select title from blog where id='{$rs['blogid']}'";
			$queryblog=mysqli_query($con,$sqlblog);
			$blog=mysqli_fetch_array($queryblog);
			
			$indexArray["id"]=$rs['blogid'];//帖子id
			$indexArray["title"]=$blog['title'];//帖子标题
			$indexArray["dates"]=$rs['dates'];//收藏时间
			$indexArray["classify"] = $blog['classify'];//分类

			$myArray["list"][] = $indexArray;
			$num++;
		}
		$myArray["length"] = $num; //list列表元素个数 
		$myArray["resault"] = 'success';
  	}
  	else
	// 查询帖子是否被本用户收藏
	if ($type=='check') {
		$sql="select count(*) from blog_collect where userid = '{$userid}' and blogid=$blogid";
		$query=mysqli_query($con,$sql);
		list($count)=mysqli_fetch_row($query); 
		if ($count) {
			$myArray["collect"] = 'true';
		}
		else
			$myArray["collect"] = 'false';
		$myArray["resault"] = 'success';
  	}
	// 设置收藏
	else
	if ($type=='set') {
		$sql_insert="insert into blog_collect (userid,blogid,dates) values ($userid,$blogid,now())";
	    if (mysqli_query($con, $sql_insert))
	    {
	    	$myArray["msg"] = '已经收藏！';
	        $myArray["resault"] = 'success';
	    }
	    else
	    {
	        $myArray["msg"]=mysqli_error($con);
	        $myArray["resault"] = 'fail';
	    }
	}
	// 取消收藏
	else
	if ($type=='cancel') {
		$sql_delete = "delete from blog_collect where userid=$userid and blogid=$blogid";  
	    $res_delete = mysqli_query($con,$sql_delete); 
	    if($res_delete) 
	    {
	    	$myArray["msg"] = '已经取消！';
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