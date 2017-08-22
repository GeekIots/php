
设备查看页面临时存放，
<main style="margin-left: 10%;margin-right: 10%;margin-top: 1% ">
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
		           <img class="img-thumbnail" style="width: 200px;height: 200px; border-radius: 5px;" src="<?php echo $pic ?>">
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
	    while ($row = mysqli_fetch_array($result)) {
	        $opencmd = $row['opencmd'];
	        $closecmd = $row['closecmd'];
	        $pic = $row['pic'];
	       ?>
	      
	       	<div class="container" style="margin-left: 12%;padding-top: 10px;padding-bottom: 10px;">
			   <div class="row">
			      <div class="col-md-2 first_dev_title">
			      	 <div class="row dev_title_color">
			         	<h4><?php echo($row['name']); ?></h4>
			      	 </div>
			         <div class="row dev_border_Top" style="text-align: center;">
						<img src="<?php echo($row['pic']); ?>" class="dev_icon">
			         </div>
			      </div>

			      <div class="col-md-5 dev_title">
			      	 <div class="row dev_title_color" style="">
			         	<h4 style="float: left;">控制设备</h4> 
			         	<h4 style="float: right;margin-right: 10px;color: #CC33CC;">message</h4> 
			      	 </div>
			         <div class="row dev_border_Top" >
			            <div class="col-md-4">
			               <button type="button" class="dev_button btn btn-default">打开</button>
			            </div>
			            <div class="col-md-4 dev_border_Light_Right">
			               <button type="button" class="dev_button btn btn-default">关闭</button>
			            </div>
			            <div class="col-md-4 dev_message">
			               <p><?php echo($row['state']); ?></p>
			            </div>
			         </div>
			      </div>
			      <div class="col-md-3 dev_title">
			         <div class="row dev_title_color">
			         	<h4>设备信息</h4>
			      	 </div>

			          <div class="row dev_border_Top">
			            <div class="col-md-5 dev_border_list_BR">
			               <div class="dev_info_list">
			               <p>控制次数:</p>
			               </div>
			            </div>
			            <div class="col-md-7 dev_border_list_B" >
			               <div class="dev_info_list">
			               <p><?php echo($row['heat']); ?></p>
			               </div>
			            </div>
			         </div>
			         <div class="row">
			            <div class="col-md-5 dev_border_list_BR">
			               <div class="dev_info_list">
			               <p>是否在线:</p>
			               </div>
			            </div>
			            <div class="col-md-7 dev_border_list_B">
			               <div class="dev_info_list">
			               <p><?php echo($row['online']); ?></p>
			               </div>
			            </div>
			         </div>
					 <div class="row">
			            <div class="col-md-5 dev_border_list_BR">
			               <div class="dev_info_list">
			               <p>最近操作:</p>
			               </div>
			            </div>
			            <div class="col-md-7 dev_border_list_B">
			               <div class="dev_info_list">
			               <p><?php echo($row['latest']); ?></p>
			               </div>
			            </div>
			         </div>
			         <div class="row">
			            <div class="col-md-5 dev_border_list_R">
			               <div class="dev_info_list">
			               <p>创建时间:</p>
			               </div>
			            </div>
			            <div class="col-md-7 ">
			               <div class="dev_info_list">
			               <p><?php echo($row['create']); ?></p>
			               </div>
			            </div>
			         </div>
			      </div>
			   </div>
			</div>
	       <?php
	    }
	    mysqli_close($con);
	?>