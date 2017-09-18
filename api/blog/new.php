<?php session_start();
    error_reporting(E_ALL^E_NOTICE); //取消警告显示
    header('Content-type:application/json;');
    include $_SERVER['DOCUMENT_ROOT']."/api/conn.php";
    /*
        发布新帖到服务器
        #### 需要传递的参数
        |    参数名 |    关键字    |    重要性    |
        | --------  |    :----:    |    :----:    |
        |    标题   |    title     |     必须     |
        |    内容   |    contents  |     必须     |
        |    分类   |    classify  |     必须     |
        |    昵称   |    nickname  |     必须     |
        ```
        {
            "status": "success"
        }
        ```
        ```
        {
            "status": "fail",
            "msg": "错误信息！"
        }
        ```
    */
	//获取标题内容
	$title = $_POST['title'];
    
    //获取编辑器内容
    $contents = $_POST['contents'];

    // 获取类型选择内容
    $classify = $_POST['classify']; 

    // 获取昵称
    $nickname = $_POST['nickname'];
	
	$myArray["resault"] = 'fail';
	// 参数判断
    if (!empty($nickname)) {
    	// 判断昵称是否存在
        $sql = "select nickname from user where nickname = '$nickname'"; //SQL语句
        $result = mysqli_query($con,$sql);//执行SQL语句
    	if (mysqli_num_rows($result)) {
		    if (empty($title)) {
		    	$myArray["msg"] = '缺少标题字段:title！';
		    }
		    else
		    if (empty($contents)) {
		    	$myArray["msg"] = '缺少内容字段:contents！';
		    }  
			else
		    if (empty($classify)) {
		    	$myArray["msg"] = '缺少类型字段:classify！';
		    }
		    else{
		    	// 验证通过，存储新帖
				$sql_insert="insert into blog (id,dates,contents,nickname,title,classify) values (null,now(),'$contents','$nickname','$title','$classify')";
				if (!mysqli_query($con, $sql_insert))
                {
                    // die('Error: ' . mysqli_error($con));
                    $myArray["msg"]=mysqli_error($con);
                    $myArray["resault"] = 'fail';
                }
                else
                {
                    $myArray["resault"] = 'success';
                }
		    } 		
    	}
    	else{
    		// 昵称不存在
    		$myArray["msg"] = '昵称不存在，请确认后再试！';
    	}
    }
    else{
    	$myArray["msg"] = '缺少昵称:nickname！';
    }
 	mysqli_close($con);
    // print_r($myArray); 
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
?>