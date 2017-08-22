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
		height: 55px; 	
		border-radius: 5px;
		margin: 54px 10px 54px 5px;
		font-size: 25px;
  	}
  	.dev_icon{
		width: 140px;
		height: 143px; 	
		border-radius: 5px;
		margin: 10px 10px 10px 10px;
  	}
  	.dev_info_list{
  		width: 120px;
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
<div id="testdiv">

</div>
   	<div id="test" class="container" style="margin-left: 12%;padding-top: 10px;padding-bottom: 10px;">
	   <div class="row">
	      <div class="col-md-2 first_dev_title">
	      	 <div class="row dev_title_color">
	      	 	<!-- 开关名称 -->
	         	<h4 id="1"></h4>
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
  </body>
</html>
<script type="text/javascript">

window.onload = function() {
  var testdiv = document.getElementById("testdiv");
  testdiv.innerHTML='<div class="col-md-7 "><div class="dev_info_list"><p>yui</p></div></div>';
}


	var switchlist;//用户开关
	$(document).ready(function(){
	    //获取用户开关信息
		$.ajax({
		url: "<?php echo $_SERVER['localhost'] ?>/api/device.php?device=switch&type=getlist&userid=<?php echo $userid; ?>",
		success: function (argument) {
			console.log('success:',argument);
			switchlist = argument;
			console.log('name:',argument.list[0].name);
			// 将拉取的数据显示到页面
			// for (var i = 12 - 1; i >= 0; i--) {
			// 	$("#1-1-"+i.toString()).val(switchlist[i].name);
			// 	$("#1-2-"+i.toString()).val(switchlist[i].down);
			// 	$("#1-3-"+i.toString()).val(switchlist[i].up);
			// 	$("#1-5-"+i.toString()).val(switchlist[i].icon);
			// 	$("#1-6-"+i.toString()).attr("checked",switchlist[i].show);
			// 	$("#1-4-"+i.toString()).attr("src",switchlist[i].icon);
			// }
		},
		error:function (argument) {
			console.log('fail:',argument);
		}
		});
	})
</script>


<!-- <?php include '../public/footer.php';?> -->
