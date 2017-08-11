<?php 
	error_reporting(E_ALL^E_NOTICE); //取消警告显示
	header('Content-type:text/json');
	include $_SERVER['DOCUMENT_ROOT']."/public/conn.php";

	
	//获取后面的所有参数并解码
	$str = urldecode($_SERVER["QUERY_STRING"]);  
	$type = $_GET['type'];
	$num = $_GET['num'];

	if (!$con)
    {
      $myArray["resault"]='fail';
      $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
      echo $json;
    }
    else
    {
    	
    	if ($type&&$num) {

    		$str_SELECT = "SELECT str FROM bluetooth where userid = 'test' and configid = '$num'";
    		// echo($str_SELECT);
	    	$result = mysqli_query($con, $str_SELECT);
	    	$myArray["item"] = mysqli_fetch_array($result);
	    	// printf($result);
    		$myArray["resault"] = 'success';
    	} else {
    		$myArray["resault"] = 'fail';
    	}
    }
    mysqli_close($con);
    // print_r($myArray); 
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
 ?>