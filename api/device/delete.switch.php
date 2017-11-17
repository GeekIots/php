<?php 
  // 删除开关
  error_reporting(E_ALL^E_NOTICE); //取消警告显示
  header('Content-type:application/json');
  date_default_timezone_set("Asia/Shanghai");
  include "../conn.php";//https

  // 参数判断
  if (isset($_GET['userid'])) {
  	$userid = $_GET['userid'];
    // 判断用户是否存在
    $sql = "select userid from user where userid = '$userid'"; //SQL语句
    $result = mysqli_query($con,$sql);//执行SQL语句
    if (!mysqli_num_rows($result)) {
      // 用户不存在
    	$myArray["msg"] = '用户不存在，请确认后再试！';
    	$myArray["resault"] = 'fail';
    	$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
    	echo $json;
    	// mysqli_close($con);
    	exit();
    }
}
else{
	$myArray["msg"] = '缺少字段:userid！';
	$myArray["resault"] = 'fail';
	$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
	echo $json;
	exit();
}

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

$sql_delete = "DELETE FROM switch where userid='$userid' and id = '$id'";
$res_delete = mysqli_query($con,$sql_delete);
if ($res_delete){
	$myArray["resault"] = 'success';
} 
else{
	$myArray["msg"]=mysqli_error($con);
	$myArray["resault"] = 'fail';
}

// mysqli_close($con);
 // print_r($myArray); 
$json = json_encode($myArray,JSON_UNESCAPED_UNICODE);
echo $json;
?>


