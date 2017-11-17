<?php 
  // 根据sensor id获取开关信息

  error_reporting(E_ALL^E_NOTICE); //取消警告显示
  header('Content-type:application/json');
  date_default_timezone_set("Asia/Shanghai");
  include "../conn.php";//https

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }
  else{
    $myArray["msg"] = '缺少字段:id！';
    $myArray["resault"] = 'fail';
    $json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    echo $json;
    exit();
  }

    $myArray["resault"] = 'success';
	$result = mysqli_query($con, "SELECT * FROM sensor WHERE id = '$id' ");
	$myArray["num"] = $result->num_rows;
	$row = mysqli_fetch_array($result);
	if ($myArray["num"]>0) {
		$myArray["id"]=$row['id'];
		$myArray["name"]=$row['name'];
		$myArray["type"]=$row['type'];
		$myArray["pic"]=$row['pic'];
		$myArray["data"]=$row['data'];       
		$myArray["heat"]=$row['heat'];
		$myArray["latest"]=$row['latest'];
		$myArray["created"]=$row['created'];
	}

	// mysqli_close($con);
 // print_r($myArray); 
	$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
	echo $json;
?>