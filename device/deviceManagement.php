<?php 
	include "../public/header.php";
	include "../public/conn.php";
	 if(!$_SESSION['login'])
	{
		//跳转到登录界面
		echo '<script>window.location = "../accut/login.php";</script>'; 
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
</head>  
<body>
	<main style="background-color: white">
	<?php
        if (!$con)
        {
            die('数据库连接失败: '.mysqli_error());
        }
        else
        {
            $name = $_SESSION['login'];
            $result = mysqli_query($con, "SELECT * FROM switch WHERE userid = '$name' ");
        }
 	?>
        
        <!--显示到列表-->
        <div class="container">
		  <h2>设备管理</h2>
		  <div>
		  	<a class="btn btn-default" href="addDevice.php">添加开关</a>
		  	<a class="btn btn-default" href="addSensor.php">添加传感器</a>
			<a class="btn btn-default" href="userdevice.php">返回</a>
		  </div>
		  <br \>&nbsp;
		  <!--<p>查看和管理您的设备！</p>-->           
		  <h4>我的开关</h4>		  
		  <table class="table table-striped  table-hover">
		    <thead>
		      <tr>
		        <th>ID</th>
		        <th>名称</th>
		        <th>状态</th>
		        <th>图片</th>
		        <th>开指令</th>
		        <th>关指令</th>
		        <th>热度</th>
		        <th>更改</th>
		        <th>删除</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<?php
		    		// $num = 0;
		    		while($row = mysqli_fetch_array($result))
		    		{
		    			// $num++;
			    		echo '<tr>';
			    		echo '<td>'.$row['id'].'</td>';
			    		echo '<td>'.$row['name'].'</td>';
			    		echo '<td>'.$row['state'].'</td>';
			    		echo '<td>'.$row['pic'].'</td>';
			    		echo '<td>'.$row['opencmd'].'</td>';
			    		echo '<td>'.$row['closecmd'].'</td>';
			    		echo '<td>'.$row['heat'].'</td>';
						echo '<td><a href="updataDevice.php?id='.$row['id'].'">更改</a></td>';
						echo '<td><a href="deleteDevice.php?id='.$row['id'].'">删除</a></td>';
						echo '</tr>';
		     	}
		     	
		     	//mysqli_close($con);
		     ?>
		    </tbody>
		  </table>
		  
		  <br>
		  <hr />
		  <h4>传感器类设备</h4>		  
		  <table class="table table-striped  table-hover">
		    <thead>
		      <tr>
		        <th>ID</th>
		        <th>名称</th>
		        <th>类型</th>
		        <th>图片</th>
		        <th>数据</th>
		        <th>更改</th>
		        <th>删除</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<?php
		    		// $num = 0;
					$result = mysqli_query($con, "SELECT * FROM sensor WHERE userid = '$name' ");

		    		while($row = mysqli_fetch_array($result))
		    		{
		    			// $num++;
			    		echo '<tr>';
			    		echo '<td>'.$row['id'].'</td>';
			    		echo '<td>'.$row['name'].'</td>';
			    		echo '<td>'.$row['type'].'</td>';
			    		echo '<td>'.$row['pic'].'</td>';
			    		echo '<td>'.$row['data'].'</td>';
						echo '<td><a href="updataSensor.php?id='.$row['id'].'">更改</a></td>';
						echo '<td><a href="deleteSensor.php?id='.$row['id'].'">删除</a></td>';
						echo '</tr>';
					}
				
		     	mysqli_close($con);
				?>
		    </tbody>
		  </table>
		</div>	
    </main>
</body>
</html>
<?php include $_SERVER ['DOCUMENT_ROOT']."/public/footer.php";?>
