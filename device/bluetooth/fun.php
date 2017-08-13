<?php 
	error_reporting(E_ALL^E_NOTICE); //取消警告显示
	header('Content-type:text/json');
	include $_SERVER['DOCUMENT_ROOT']."/public/conn.php";

   $default  = array
    (
    array("wid"=>"1","name"=>"左上","up"=>"TZ","down"=>"ZS","icon"=>"img/1.png"),
    array("wid"=>"2","name"=>"前进","up"=>"TZ","down"=>"QJ","icon"=>"img/2.png"),
    array("wid"=>"3","name"=>"右上","up"=>"TZ","down"=>"YS","icon"=>"img/3.png"),
    array("wid"=>"4","name"=>"左移","up"=>"TZ","down"=>"ZY","icon"=>"img/4.png"),
    array("wid"=>"5","name"=>"停止","up"=>"TZ","down"=>"TZ","icon"=>"img/5.png"),
    array("wid"=>"6","name"=>"右移","up"=>"TZ","down"=>"YY","icon"=>"img/6.png"),
    array("wid"=>"7","name"=>"左下","up"=>"TZ","down"=>"ZX","icon"=>"img/7.png"),
    array("wid"=>"8","name"=>"后退","up"=>"TZ","down"=>"HT","icon"=>"img/8.png"),
    array("wid"=>"9","name"=>"右下","up"=>"TZ","down"=>"YX","icon"=>"img/9.png"),
    array("wid"=>"10","name"=>"左转","up"=>"TZ","down"=>"ZZ","icon"=>"img/10.png"),
    array("wid"=>"11","name"=>"演示","up"=>"TZ","down"=>"YS","icon"=>"img/11.png"),
    array("wid"=>"12","name"=>"右转","up"=>"TZ","down"=>"YZ","icon"=>"img/12.png"),
    );

    // var_dump($default);
    //转为json字符串
    $default_json = json_encode($default,JSON_UNESCAPED_UNICODE);
    // echo $default_json;

	//获取后面的所有参数并解码
	// $str = urldecode($_SERVER["QUERY_STRING"]);  
    $userid = $_GET['userid'];
	$type = $_GET['type'];
	$num = $_GET['num'];
    $str = $_GET['str'];
	if (!$con)
    {
      $myArray["resault"]='fail';
      $myArray["error"] = '数据库链接失败';
      $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
      echo $json;
    }
    else
    {
        if ($type) {
            if ($type=="get") {
                if ($num&&$userid) {
                    //查询目标
                    $sql_select = "SELECT str FROM bluetooth where userid = '$userid' and configid = '$num'";
                    $result = mysqli_query($con, $sql_select);
                    $obj = mysqli_fetch_array($result);
                    // var_dump($obj);
                    
                    if (!$obj) {
                        // 目标不存在,创建默认值
                        $sql_insert = "INSERT INTO bluetooth (userid,configid,str) VALUES ('$userid','$num','$default_json')";
                        // echo($sql_insert);
                        if (!mysqli_query($con, $sql_insert))
                        {
                            // die('Error: ' . mysqli_error($con));
                            $myArray["error"]=mysqli_error($con);
                            $myArray["resault"] = 'fail';
                        }
                        else
                        {
                            $myArray["item"] = $default_json;
                            $myArray["resault"] = 'success';
                        }
                    }
                    else
                    {
                        $myArray["item"] = $obj;
                        $myArray["resault"] = 'success';
                    }
                } else {
                    $myArray["resault"] = 'fail';
                    if (!$num) {
                        $myArray["error"]= 'num不能为空';
                    }
                    else if (!$userid) {
                        $myArray["error"]= 'userid不能为空';
                    }
                }
            }
            elseif ($type=="set") {
                if ($num&&$userid&&$str) {
                    // 更新到数据库
                    $sql_update = "UPDATE bluetooth set str='$str' where userid='$userid' and configid='$num'";
                    if (!mysqli_query($con, $sql_update))
                    {
                        // die('Error: ' . mysqli_error($con));
                        $myArray["error"] = mysqli_error($con);
                        $myArray["resault"] = 'fail';
                    }
                    else{
                        $myArray["resault"] = 'success';
                    }
                } else {
                    $myArray["resault"] = 'fail';
                    if (!$num) {
                        $myArray["error"]= 'num不能为空';
                    }
                    else if (!$userid) {
                        $myArray["error"]= 'userid不能为空';
                    }
                    else if (!$str) {
                        $myArray["error"]= 'str不能为空';
                    }
                }
            }
        }
        else
        {
            $myArray["resault"] = 'fail';
            $myArray["error"]= 'type不能为空';
        }
    }
    mysqli_close($con);
    // print_r($myArray); 
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
 ?>