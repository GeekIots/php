<?php 
	include "../public/header.php";
	include "../public/conn.php";
	if(!$_SESSION['login'])
	{
		//跳转到登录界面
		echo '<script>window.location = "../accut/login.php";</script>'; 
		exit;
	}
	$data;
?>
<!DOCTYPE html>
<html>
<head>
	<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script> <!-- 腾讯地图 -->
  <meta name="description" content="极客物联网，属于每个人的DIY物联网开发平台，欢迎到小程序微信搜索“极客物联网”，更多精彩期待您的加入！"/>

</head>
<body>
	<main style="margin-left: 10%;margin-right: 10%;margin-top: 1% ">
		    <div class="btn btn-default" >
		    <a href="deviceManagement.php">设备管理</a>
		    </div>
		    </br><p></p>
		    <h4>开关：</h4>
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
		        //显示为按钮
		        while ($row = mysqli_fetch_array($result)) {
		            $opencmd = $row['opencmd'];
		            $closecmd = $row['closecmd'];
		            $pic = $row['pic'];
		           ?>
		           <!-- 名称 -->
		           <?php  echo($row['name']);?>
		           <!-- 图片 -->
		           <img style="width: 50px;height: 50px; border-radius: 20px;" src="<?php echo $pic ?>">
				   <!-- 打开 -->
				   <button class="btn btn-default">打开</button>
				   <!-- 关闭 -->
				   <button class="btn btn-default">关闭</button>
				   <!-- 状态 -->
				   
		           <?php
		            echo '<button type="button" class="btn btn-default" style="height: 50px;"onclick="btnclick(\''.$row['deviceType'].'\',\''.$row['id'].'\',\''.$row['deviceid'].'\',\''.$row['opencmd'].'\')">'.$row['name'].'</button>';
		            echo '<label id="'.$row['id'].'"></label>';
		            echo '</br><p></p>';
		        }
		        
		        mysqli_close($con);
		    ?>
		    <script src='js/jquery.js'></script>
			<script>
			    function btnclick(type,userid,deviceid,state) {
			        document.getElementById(deviceid).innerText = "";
			        $.ajax({
			            type: "POST",
			            url: "upd.php",
			            data: "type="+type+"&userid="+userid+"&deviceid="+deviceid+"&state="+state,
			            success: function(msg){
			                document.getElementById(deviceid).innerHTML = msg;
			            }
			        });
			
			    } 
			</script>
			<script>
				var init = function(x,y,id) {
				    var center = new qq.maps.LatLng(x,y);
		            var map = new qq.maps.Map(document.getElementById(id), {
		                center: center,
		                zoom: 17
		            });
		            var marker = new qq.maps.Marker({
		                //设置Marker的位置坐标
		                position: center,
		                //设置显示Marker的地图
		                map: map,
		                //设置Marker被添加到Map上时的动画效果为反复弹跳
		                animation: qq.maps.MarkerAnimation.BOUNCE
		                //设置Marker被添加到Map上时的动画效果为从天而降
		                //animation:qq.maps.MarkerAnimation.DROP
		                //设置Marker被添加到Map上时的动画效果为落下
		                //animation:qq.maps.MarkerAnimation.DOWN
		                //设置Marker被添加到Map上时的动画效果为升起
		                //animation:qq.maps.MarkerAnimation.UP
		            });
				}
			</script>
  
			<?php
				require("../public/conn.php");
		        if (!$con)
		        {
		            die('数据库连接失败: '.mysqli_error());
		        }
		        else
		        {
		            $name = $_SESSION['login'];
		            $result = mysqli_query($con, "SELECT * FROM sensor WHERE userid = '$name' ");
		        }
		         
		        while ($row = mysqli_fetch_array($result)) {
		        		if($row['type']=="gps")
		        		{
		        			echo '<h4>'.$row['name'].':</h4>';
		        			echo '<h4>'.$row['data'].'</h4>';
		        			// 显示静态图
							// echo '<img src="http://apis.map.qq.com/ws/staticmap/v2/?key=A6OBZ-QSMWU-2X3VP-BISKT-DB2N3-R6FBD&size=400*265&center='.$row['data'].'&zoom=15&scale=2&markers=color:blue|label:1|'.$row['data'].'">';

							// 显示动态位置调用腾讯API
							echo '<div style="width:900px;height:265px" id="id'.$row[id].'"></div>';
							echo "<script>init(".$row['data'].",'id".$row[id]."');</script>";

		        		}
		        		else
		        		if($row['type']=="temperature")
		        		{
		        			echo '<h4>'.$row['name'].':'.$row['data'].'</h4>';
		        		}
		        		else
		        		if($row['type']=="humanity")
		        		{
		        			echo '<h4>'.$row['name'].':'.$row['data'].'</h4>';
		        		}
		        		else
		        		if($row['type']=="pm2.5")
		        		{
		        			echo '<h4>'.$row['name'].':'.$row['data'].'</h4>';
		        		}

		        		
		            echo '</br><p></p>';

		        }
		       
		        mysqli_close($con);
		    ?>
			<!--分享接口 JiaThis Button BEGIN -->
          <div class="jiathis_style_32x32" >
            <a class="jiathis_button_tsina"></a>
            <a class="jiathis_button_qzone"></a>
            <a class="jiathis_button_tqq"></a>
            <a class="jiathis_button_weixin"></a>
            <a class="jiathis_button_renren"></a>
            <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
            <a class="jiathis_counter_style"></a>
          </div>
          <script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
          <!-- JiaThis Button END -->
          <!-- UJian Button BEGIN -->
            <div class="ujian-hook"></div>
            <script type="text/javascript" src="http://v1.ujian.cc/code/ujian.js"></script>
          <!-- UJian Button END -->
	</main>
  </body>
</html>
<?php include '../public/footer.php';?>




<!--  -->







