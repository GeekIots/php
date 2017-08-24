<?php 
	include "../public/header.php";
	include "../public/conn.php";
	if(!$_SESSION['login'])
	{
		//跳转到登录界面
		echo '<script>window.location = "../accut/login.php";</script>'; 
		exit;
	}
	else
	{
		$userid = $_SESSION['login'];
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>信息管理</title>
</head>
<body>
<div style="width: 90%;padding-left: 10%;padding-top: 10px;padding-bottom: 10px;">
<table class="table table-bordered"> 
		<tr> 
		<td>用户名</td> 
		<td>手机</td> 
		<td>邮箱</td> 
		<td>激活</td> 
	</tr> 
	<?php
	    if (!$con)
	    {
	        die('数据库连接失败: '.mysqli_error());
	    }
	    else
	    {
	        $name = $_SESSION['login'];
	        $result = mysqli_query($con, "SELECT * FROM user");
	    }
	    while ($row = mysqli_fetch_array($result)) {
	       ?>
				<tr> 
					<td><?php echo($row['username']); ?></td>
			  		<td><?php echo($row['phonenumber']); ?></td>
			  		<td><?php echo($row['email']); ?></td>
			  		<td><?php echo($row['active']); ?></td>
				</tr> 
	       <?php
	    }
	    mysqli_close($con);
	?>
	</table> 
</div>
</body>
</html>
<script type="text/javascript">

</script>


<!-- <?php include '../public/footer.php';?> -->