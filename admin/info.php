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
<title>用户列表</title>
<style type="text/css">
	/*表格样式*/
table {
    border-collapse: collapse;
    width:95%;
}

table, td, th {
    border: 1px solid black;
    text-align: center;
    line-height: 120px;
    font-size: 25px;
}
/*标题颜色*/
th
{
	background-color:gray;
	color:black;
}

input{
	height: 100%;
	width: 100%;
	border-style: none;
	text-align: center;	
}

</style>
</head>
<body >
<div style="padding-left: 10%; margin-right: 10%;	padding-top: 10px;padding-bottom: 10px;"> 
<table class="table table-bordered" > 
		<tr> 
		<th style="width: 30px;">ID</th> 
		<th style="width: 30px;">名称</th> 
		<th style="width: 30px;">内容</th> 
		<th style="width: 30px;">清空</th>
		<th style="width: 30px;">更新</th>
	</tr> 
	<?php
	    if (!$con)
	    {
	        die('数据库连接失败: '.mysqli_error());
	    }
	    else
	    {
	        $name = $_SESSION['login'];
	        $result = mysqli_query($con, "SELECT * FROM info");
	    }
	    while ($row = mysqli_fetch_array($result)) {
	       ?>
				<tr> 
					<td><?php echo($row['id']); ?></td>
			  		<td><?php echo($row['name']); ?></td>
			  		<td><input id="<?php echo($row['id']); ?>" value="<?php echo($row['content']); ?>"></td>
			  		<td><button id="clear-<?php echo($row['id']); ?>"  style="width: 40px;height: 30px;"  ></button></td>
			  		<td><button id="update-<?php echo($row['id']); ?>" style="width: 40px;height: 30px;"></button></td>
				</tr> 
	       <?php
	    }
	    mysqli_close($con);
	?>
	</table> 
</div>
</body>
</html>
<script src="http://cdn.bootcss.com/pagedown/1.0/Markdown.Converter.js"></script>

<script type="text/javascript">

	function convert(str) {
	    var converter = new Markdown.Converter();  
	        html      = converter.makeHtml(str);  
	    return html;
	}
	//所有的input引起的变化
	$(":button").bind("click",function(){
		//打印引起事件的标签信息
  		console.log('click:', this);
  		var arr = $(this).attr('id').split('-');
		console.log('id:', arr[1]);
		console.log('fun:', arr[0]);
  		
  		switch(arr[0])
  		{
  			case 'clear'://清空记录
  			$("#"+arr[1]).val('');
  				break;
			case 'update'://上传记录
			console.log('开始上传');
			var str = convert($("#"+arr[1]).val());
			console.log(str);
			$.ajax({
			url: "<?php echo $_SERVER['localhost'] ?>/api/info.php?type=set&id="+arr[1],
			data:{"content":str},//数据长度太长，放到data里面传送
			success: function (argument) {
				console.log(argument);
			},
			error:function (argument) {
				console.log(argument);
			}
			});
  			break;
  		}
	});	
</script>


<!-- <?php include '../public/footer.php';?> -->

