<?php include "../public/header.php";?>
<?php include "../public/conn.php";?>
<?php
	$id=$_REQUEST['id'];
	if($id)
	{
		$sql = "select * from sensor where userid = '".$_SESSION['login']."' and id = '$id'";
		$result = mysqli_query($con,$sql);
		$row = mysqli_fetch_array($result);
	}
?>


<?php
if (isset($_POST["Submit"]) && $_POST["Submit"] == "删除") {
   	$id=$_REQUEST["id"];
    $userid = $_SESSION['login']; 
    $sql_insert = "DELETE FROM sensor where userid='$userid' and id = '$id'";
    $res_insert = mysqli_query($con,$sql_insert);
	if ($res_insert)   
	{
		echo '<script>window.location = "deviceManagement.php";</script>';
   } 
   else
	{
		echo "<script>alert('删除失败！');history.go(-1);</script>";
	}
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>删除传感器</title>
</head>

<body>

<div style="padding: 10% 20% 10%;">
    <form class="form-horizontal" role="form" action="deleteSensor.php?id=<?php echo $id;?>" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label">名称:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" readonly="true" value="<?php echo $row['name']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">ID:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" readonly="true" value="<?php echo $row['id']; ?>">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit"  name="Submit" class="btn btn-default" value="删除">删除</button>
				<a class="btn btn-default" href="deviceManagement.php">取消</a>
            </div>
        </div>
    </form>
</body>

</html>