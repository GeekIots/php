<?php include "../public/header.php";?>
<?php include "../public/conn.php";?>
<?php
	//echo '用户名：' . $_SESSION['login'];
	//echo '<br />';
	$id=$_REQUEST['id'];
	if($id)
	{
		$sql = "select * from switch where userid = '".$_SESSION['login']."' and id = '$id'";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
	}

    if (isset($_POST["Submit"]) && $_POST["Submit"] == "更新") {
    $name = $_POST["devicename"];
    $opencmd = $_POST["opencmd"];
    $closecmd = $_POST["closecmd"];
    $pic = $_POST["pic"];
    $id = $_POST["id"];
    
    $type = 'set';//按钮类型
    $userid = $_SESSION['login'];
    $sql_insert = "UPDATE switch set name='$name',pic='$pic',opencmd='$opencmd',closecmd='$closecmd' where userid='$userid' and id='$id'";
    $res_insert = mysqli_query($con,$sql_insert);
    if ($res_insert)   
    {
        echo '<script>window.location = "deviceManagement.php";</script>';
    } 
    else
	{
		echo "<script>alert('更新失败！');history.go(-1);</script>";
	}
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>更改设备</title>
</head>

<body>

<div style="padding: 10% 20% 10%;">
    <form class="form-horizontal" role="form" action="updataDevice.php" method="post">
       <!-- 隐藏字段，用于传递id -->
        <input type="hidden" name="id"  value="<?php echo $id; ?>"／>

        <div class="form-group">
            <label class="col-sm-2 control-label">名称:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="devicename" value="<?php echo $row['name']; ?>">
            </div>
        </div>

         <div class="form-group">
            <label class="col-sm-2 control-label">图片:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="pic" value="<?php echo $row['pic']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">开指令:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="opencmd" value="<?php echo $row['opencmd']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">关指令:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="closecmd" value="<?php echo $row['closecmd']; ?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit"  name="Submit" class="btn btn-default" value="更新">更新</button>
				<a class="btn btn-default" href="deviceManagement.php">取消</a>
            </div>
        </div>
    </form>
</body>

</html>