<?php 
	include "../common/header.php";
	include "../api/conn.php";
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<!-- 引入 Bootstrap -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>  
<body>
	<main class="contain">
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
		  <h2>设备管理</h2>
		  <div>
		  	<a class="btn btn-default" href="addDevice.php">添加开关</a>
		  	<a class="btn btn-default" href="addSensor.php">添加传感器</a>
			<a class="btn btn-default" href="userdevice.php">返回</a>
		  </div>
		  <br \>&nbsp;
		  <!--<p>查看和管理您的设备！</p>-->           
		  <h4>我的开关</h4>	
		  <div>
		  	<table class="table table-striped  table-hover">
		      <tr>
		        <th style="width: 30px">ID1</th>
		        <th style="width: 30px">名称</th>
		        <th style="width: 30px">状态</th>
		        <th style="width: 30px">图片</th>
		        <th style="width: 30px">开指令</th>
		        <th style="width: 30px">关指令</th>
		        <th style="width: 30px">热度</th>
		        <th style="width: 30px">更改</th>
		        <th style="width: 30px">删除</th>
		      </tr>
		    	<?php
		    		// $num = 0;
		    		while($row = mysqli_fetch_array($result))
		    		{
		    			// $num++;
				    	echo "<tr>
				    		<td>".$row['id']."</td>
				    		<td>".$row['name']."</td>
				    		<td>".$row['state']."</td>
				    		<td><img src='".$row['pic']."' style='width: 50px;width: 50px;border-radius:5px; '></td>
				    		<td>".$row['opencmd']."</td>
				    		<td>".$row['closecmd']."</td>
				    		<td>".$row['heat']."</td>
				    		<td><a href='updataDevice.php?id=".$row['id']."'>更改</a></td>
				    		<td><a href='deleteDevice.php?id=".$row['id']."'>删除</a></td>
				    		</tr>";
		     	}
		     	
		     	//mysqli_close($con);
		     ?>
		  </table>
		  </div>	  
		  
		  
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
    </main>
</body>
</html>
<?php include $_SERVER ['DOCUMENT_ROOT']."/common/footer.php";?>
