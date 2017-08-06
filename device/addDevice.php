<?php include "../public/header.php";?>
<?php include "../public/conn.php";?>
<?php
function create_id($prefix = ""){    //可以指定前缀
    $str = md5(uniqid(mt_rand(), true));   
    $uuid  = substr($str,0,4);   
    return $prefix . $uuid;
}
?>

<?php
if (isset($_POST["Submit"]) && $_POST["Submit"] == "添加") {
    $name = $_POST["devicename"];
    $opencmd = $_POST["openCmd"];
    $closecmd = $_POST["closeCmd"];
    $pic = $_POST["pic"];

    $userid = $_SESSION['login'];
    $sql_insert = "insert into switch (userid,name,state,pic,opencmd,closecmd,heat) values('$userid','$name','$closecmd','$pic','$opencmd','$closecmd','0')";
    $res_insert = mysqli_query($con,$sql_insert);
    if ($res_insert) 
    {
    	echo '<script>window.location = "deviceManagement.php";</script>'; 
    } 
    else
	{
		echo "<script>alert('添加失败！');history.go(-1);</script>";
	}
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>添加设备</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>

<body>

<div style="padding: 10% 15% 5%;">
    <form class="form-horizontal" role="form" action="addDevice.php" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label">设备名称:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="devicename" placeholder="客厅灯" value="客厅灯">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">开指令:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="openCmd" placeholder="open" value="open">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">关指令:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="closeCmd" placeholder="close" value="close">
            </div>
        </div>
<!--         <div class="form-group">
            <label class="col-sm-2 control-label">图片:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="pic" placeholder="" value="">
            </div>
        </div> -->

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit"  name="Submit" class="btn btn-default" value="添加">添加</button>
				<a class="btn btn-default" href="deviceManagement.php">取消</a>
            </div>
        </div>
    </form>

    <!--    </form>-->
</body>

</html>
