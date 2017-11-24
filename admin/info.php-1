<?php
include "../public/header.php";
//phpinfo();
date_default_timezone_set("Asia/Shanghai");
?>
<?php 
	include "../common/conn.php";
	// if(!$_SESSION['login'])
	// {
	// 	//跳转到登录界面
	// 	echo '<script>window.location = "../accut/login.php";</script>'; 
	// 	exit;
	// }
	// else
	// {
	// 	$userid = $_SESSION['login'];
	// }
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

textarea{
	resize: none;
	border: 0px;

}
</style>

    <script src="../frame/markdown/marked.js"></script>
    <link rel="stylesheet" href="../frame/markdown/src/styles/github.css">
	<script src="../frame/markdown/highlight.min.js"></script>
	<!-- <script src="http://cdn.bootcss.com/highlight.js/8.0/highlight.min.js"></script> -->
</head>
<body >
<div style="width: 100%;align-items: center;padding: 2%;padding-top: 10px;"> 
<table class="table table-bordered" > 
		<tr> 
		<th>ID</th> 
		<th>名称</th> 
		<th>描述</th> 
		<th>内容</th>
		<th>更新时间</th>
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
			<!-- name 名称-->
	  		<td><textarea id="name-<?php echo($row['id']); ?>" onclick=edit('name-<?php echo($row['id']); ?>') rows="1" cols="20" readonly="readonly" style="overflow-y:hidden" ><?php echo($row['name']);?></textarea></td>
	  		<!-- des 功能描述-->
	  		<td><textarea id="des-<?php echo($row['id']); ?>" onclick=edit('des-<?php echo($row['id']); ?>') rows="1" cols="20" readonly="readonly"  style="overflow-y:hidden"><?php echo($row['des']);?></textarea></td>
	  		<!-- content_md 原格式内容-->
	  		<td><textarea id="content_md-<?php echo($row['id']); ?>" onclick=edit('content_md-<?php echo($row['id']); ?>') rows="1" cols="20" readonly="readonly" id="<?php echo($row['id']); ?>" style="overflow-y:hidden"><?php echo($row['content_md']);?></textarea></td>
	  		<!-- latest 更新 时间-->
	  		<td><textarea rows="1" cols="20" readonly="readonly" id="latest-<?php echo($row['id']); ?>" style="overflow-y:hidden"><?php echo($row['latest']);?></textarea></td>
		</tr> 
	<?php
	    }
	    mysqli_close($con);
	?>
	</table> 

	<!-- content 模态框（Modal） -->
	<div class="modal fade" id="content_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="width: 90%;" >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" 
							aria-hidden="true">×
					</button>
					<h4 class="modal-title" id="myModalLabel">
						<!-- 标题 -->
						<p id="content_title"></p>
					</h4>	
				</div>
				<!-- modal-body -->
				<div class="modal-body" >
					<!-- 源码内容 -->
				    <textarea class="form-control"  id="edit_content_md" style="width:50%; margin-bottom: 15px; height: 500px;float: left;resize: none;" placeholder="请输入Markdown代码" ></textarea>
			      
				    <div class="form-control" style="width: 49%;float: right;border:1px solid lightgray; height:500px;word-wrap:break-word;">
				    <!-- 预览效果 -->
				    <div style="overflow-y:auto;overflow-x: hidden;height: 100%;" id="edit_content_html"></div>
				    </div>
				</div>
				<div class="modal-footer" style="clear: both;">
					<button type="button" class="btn btn-default" 
							data-dismiss="modal">取消
					</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="fun_update_content()">
						提交更改
					</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- name和des 模态框（Modal） -->
	<div class="modal fade" id="name_des_Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog"  >
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" 
							aria-hidden="true">×
					</button>
					<h4 class="modal-title" id="myModalLabel">
						<!-- 标题 -->
						<p id="name_des_title"></p>
					</h4>	
				</div>
				<!-- modal-body -->
				<div class="modal-body" >
					<!-- 源码内容 -->
				    <textarea class="form-control"  id="name_des_edit" style="width:100%; margin-bottom: 15px; height: 100px;float: left;resize: none;" placeholder="请输入内容！" ></textarea>
				</div>
				<div class="modal-footer" style="clear: both;">
					<button type="button" class="btn btn-default" 
							data-dismiss="modal">取消
					</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="fun_update_name_des()">
						提交更改
					</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>
</body>
</html>
<script type="text/javascript">
	hljs.initHighlightingOnLoad(); 

	var rendererMD = new marked.Renderer();
    marked.setOptions({
      renderer: rendererMD,
      gfm: true,
      tables: true,
      breaks: true,
      pedantic: true,
      sanitize: true,
      smartLists: true,
      smartypants: true
    });
    marked.setOptions({
        highlight: function (code) {
        return hljs.highlightAuto(code).value;
      }
    });
    //监听输入变化事件
    $("#edit_content_md").bind("input propertychange", function () {
    	var tokens = marked($(this).val());
    	// 显示到预览
    	$("#edit_content_html").html(tokens); 
	})
</script>
<httpRuntime maxRequestLength="2097151" executionTimeout="120"/>
<script type="text/javascript">
	var id_now;

	//所有的textarea引起的变化
	function edit(id){
		//打印引起事件的标签信息
		console.log('click:', this);
		var arr = id.split('-');
		console.log('id:', arr[1]);
		console.log('fun:', arr[0]);
		//当前id
		id_now = id;
  		switch(arr[0])
  		{
  			case 'name'://名称
  				$('#name_des_title').text('更新名称:');
				$('#name_des_Modal').modal({keyboard: true});
				// 显示到预览
				var strr=$("#"+id).val();
				$('#name_des_edit').val(strr);
  				break;
			case 'des'://描述
				$('#name_des_title').text('更新描述:');
				$('#name_des_Modal').modal({keyboard: true});
				// 显示到预览
				var strr=$("#"+id).val();
				$('#name_des_edit').val(strr);
  			break;
  			case 'content_md'://内容
  				$('#content_title').text('更新内容:');
				$('#content_Modal').modal({keyboard: true});
				// 显示到预览
				var strr=$("#"+id).val();
				$('#edit_content_md').val(strr);
		    	$("#edit_content_html").html(marked(strr)); 
  				break;
  		}
	}
	//更改内容完成，上传服务器
	function fun_update_content() {
		//模态中的内容
		var _content_md = $('#edit_content_md').val();
		var _content_html = $('#edit_content_html').html();

		console.log('当前id:',id_now);

		console.log('_content_md:',_content_md);
		console.log('_content_html:',_content_html);
		
		var arr = id_now.split('-');
		// console.log('id:', arr[1]);
		// console.log('filed:', arr[0]);
		var id = arr[1];//id
		// var filed = arr[0];//字段
		//存储md源码格式
		$.ajax({
			type:'POST',
			url: "<?php echo $_SERVER['localhost'] ?>/api/info.php?type=set&id="+id+"&filed=content_md",
			data:{'content':_content_md},
			//数据长度太长，放到data里通过post传送
			success: function (argument) {
				console.log(argument);
			},
			error:function (argument) {
				console.log(argument);
				// alert('更新失败！');
			}
		});
		// 存储html格式
		$.ajax({
			type:'POST',
			url: "<?php echo $_SERVER['localhost'] ?>/api/info.php?type=set&id="+id+"&filed=content_html",
			data:{'content':_content_html},
			//数据长度太长，放到data里通过post传送
			success: function (argument) {
				console.log(argument);
				//更新页面
				$('#'+id_now).text(_content_md);
				$('#latest-'+id).text('<?php echo date("Y-m-d H:i:s",time()); ?>');
				alert('更新成功！');
			},
			error:function (argument) {
				console.log(argument);
				alert('更新失败！');
			}
		});
	}

	//更改名称或描述完成，上传服务器
	function fun_update_name_des() {
		//模态中的内容
		var editstr = $('#name_des_edit').val();

		console.log('当前id:',id_now);
		console.log('editstr:',editstr);
		var arr = id_now.split('-');
		var id = arr[1];//id
		var filed = arr[0];//字段
		console.log('filed:',filed);
		//存储数据
		$.ajax({
			type:'POST',
			url: "<?php echo $_SERVER['localhost'] ?>/api/info.php?type=set&id="+id+"&filed="+filed,
			data:{'content':editstr},
			//数据长度太长，放到data里通过post传送
			success: function (argument) {
				console.log(argument);
				//更新页面
				$('#'+id_now).text(editstr);
				$('#latest-'+id).text('<?php echo date("Y-m-d H:i:s",time()); ?>');
				alert('更新成功！');
			},
			error:function (argument) {
				console.log(argument);
				alert('更新失败！');
			}
		});
	}
</script>


<?php include '../public/footer.php';?>

