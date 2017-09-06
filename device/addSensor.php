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
    $name = $_POST["sensorname"];
    $type = $_POST["type"];
    $pic = $_POST["pic"];

    $userid = $_SESSION['login'];
    $sql_insert = "insert into sensor (userid,name,type,pic,data,heat) values('$userid','$name','$type','$pic','','')";
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
    <title>添加传感器</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>

<body>

<div style="padding: 10% 15% 5%;">
    <form class="form-horizontal" role="form" action="addSensor.php" method="post">
        <div class="form-group">
            <label class="col-sm-2 control-label">名称:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="sensorname" placeholder="狄村的温度" value="狄村的温度">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">图片:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="pic" placeholder="" value="">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">类型:</label>
            <div class="col-sm-6">
                <select class="form-control" name="type">
                    <option value ="temperature">温度 ℃</option>
                    <option value ="humidity">湿度 RH</option>
                    <option value="pm2.5">PM2.5</option>
                    <option value="gps">GPS位置</option>
                </select>
            </div>
        </div>

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
