<?php 
	include "../common/header.php";
	include "../common/conn.php";
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
	<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script> <!-- 腾讯地图 -->
  <meta name="description" content="极客物联网，属于每个人的DIY物联网开发平台，欢迎到小程序微信搜索“极客物联网”，更多精彩期待您的加入！"/>

  <style type="text/css">
  	.dev_border_Top{
  		border-top: 1px solid #000;
  	}
  	.dev_title_color{
  		background: lightgray;
  		padding-left: 2em;
  	}
  	.dev_border_Light_Right{
  		border-left: 1px solid #000;
  		border-right: 1px solid #000;
  	}
  	.dev_title{
	 	border:1px solid #000;
	 	border-left: 1px;
  	}
  	.first_dev_title{
	 	border:1px solid #000;
  	}
  	.dev_button{
		width: 120px;
		height: 54px; 	
		border-radius: 5px;
		margin: 54px 10px 54px 5px;
		font-size: 25px;
  	}
  	.dev_icon{
		width: 140px;
		height: 142px; 	
		border-radius: 5px;
		margin: 10px 10px 10px 10px;
  	}
  	.dev_info_list{
  		/*width: 120px;*/
  		height: 20px;
  		border-radius: 5px;
  		/*background-color: red;*/
  		margin: 10px 10px 10px 10px;
  		font-size: 16px;
  		color: #696969;
  	}
  	.dev_border_list_B{
  		border-bottom: 1px solid #000;
  	}
  	.dev_border_list_R{
  		border-right: 1px solid #000;
  	}
  	.dev_border_list_BR{
  		border-bottom: 1px solid #000;
  		border-right: 1px solid #000;
  	}
  	.dev_message{
  		text-align: center;
  		line-height: 120px;
  		font-size: 30px;
  		color: orange;
  		padding-top:20px;
  	}
  </style>
</head>
<body>
<?php
	    if (!$con)
	    {
	        die('数据库连接失败: '.mysqli_error());
	    }
	    else
	    {
	        $name = '$_SESSION['login']';
	        $result = mysqli_query($con, "SELECT * FROM switch WHERE nickname = '$name' ");
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
			         	<h4 style="float: right;margin-right: 10px;" id="msg<?php echo($row['id']); ?>"></h4> 
			      	 </div>
			         <div class="row dev_border_Top" >
			            <div class="col-md-4">
			               <button type="button" id="<?php echo($row['id']);?>" name="<?php echo($row['opencmd']);?>" class="dev_button btn btn-default">打开</button>
			            </div>
			            <div class="col-md-4 dev_border_Light_Right">
			               <button type="button" id="<?php echo($row['id']);?>" name="<?php echo($row['closecmd']);?>" class="dev_button btn btn-default">关闭</button>
			            </div>
			            <div class="col-md-4 dev_message">
			               <p id="state<?php echo($row['id']); ?>"><?php echo($row['state']); ?></p>
			            </div>
			         </div>
			      </div>
			      <div class="col-md-4 dev_title">
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
			               <p id="heat<?php echo($row['id']); ?>"><?php echo($row['heat']); ?></p>
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
			               <p id="latest<?php echo($row['id']); ?>"><?php echo($row['latest']); ?></p>
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
			               <p><?php echo($row['created']); ?></p>
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
</body>
</html>
<script type="text/javascript">
	
	
	//所有的button引起的变化
	$(":button").bind("click",function(){
		var wait;
		var stop=false;
		get_code_time = function (o) { 
			if (!stop) {
				o.text('响应:'+wait/100+'s');
		        wait++;  
		        setTimeout(function() {  
		            get_code_time(o)  
		        }, 10)  
			}
		}  
		//打印引起事件的标签信息
  		console.log('click:', this);
   		var id = $(this).attr('id');
   		var cmd = $(this).attr('name');
		console.log('id:', id);
		console.log('cmd:', cmd);
		// $("#msg"+id).text("等待响应...");
		wait = 0;
		stop=false;
		get_code_time($("#msg"+id));
  		// 发送指令并等待响应
  		$.ajax({
			url: "<?php echo $_SERVER['localhost'] ?>/api/device.php?device=switch&type=set&userid=<?php echo $userid; ?>&id="+id+"&cmd="+cmd,
			success: function (res) {
				console.log('success:',res);
				stop=true;
				$("#msg"+id).text(res.return+' '+$("#msg"+id).text());
				$("#heat"+id).text(parseInt($("#heat"+id).text())+1);
				$("#latest"+id).text(res.latest);
				$("#state"+id).text(cmd);
			},
			error:function (res) {
				console.log('fail:',res);
				$("#msg"+id).text(res.return);
				stop=true;

			}
		});
	});	
</script>


<!-- <?php include '../public/footer.php';?> -->
