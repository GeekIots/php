<?php include("../public/header.php");?>
<script type="text/javascript">
// document.domain = "http://www.smtvoice.com";
	
</script>
<!DOCTYPE HTML>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title></title>
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="ueditor/_examples/editor_api.js"></script>
	<script src="ueditor/ueditor.parse.js" type="text/javascript"></script>
</head>

<body>
<main>
 <div style="margin-left: 18%;margin-right: 18%;margin-top: 1%;">
	<div class="panel panel-primary box-shadow">
		<div class="panel-heading" >
			<h3 class="panel-title" >更新文章</h3>
		</div>
		<div class="panel-body">
			<?php
				include("conn.php");
				if(!empty($_GET['id']))
				{ 
					$sql="select * from blog where id='".$_GET['id']."'";
					$query=mysql_query($sql);
					$rs=mysql_fetch_array($query);
				}
				
				if(!empty($_POST['sub']))
				{ 
					//标题
					$title = $_POST['title'];
					//博文id
					$hid = $_POST['hid'];
					//获取博文正文
					error_reporting(E_ERROR|E_WARNING);
					$content =  htmlspecialchars(stripslashes($_POST['myEditor']));

					$sql="update blog set title='$title',contents='$content',dates=now() where id=$hid";
					mysql_query($sql);
					echo '更新成功！';
					echo '<a class="btn btn-default" href="view.php?id='.$hid.'">返回</a>';
					exit();
					// echo "<script>location.href='index.php';</script>";
				}
			?>
		    <!-- target="_blank",打开一个新标签 -->
		    <form action="edit.php" method="post">
		    	<!-- 隐藏字段，用于传递id -->
		    	<input type="hidden" name="hid" value="<?php echo $rs['id']?>" />

				标题：
				<input type="text" name="title" value="<?php echo $rs['title']?>"/>

				<br><br>
				<!-- 编辑框和内容 -->
				<div style="text-align: left;">
			        <script type="text/plain" id="myEditor" name="myEditor"><?php
						echo  htmlspecialchars_decode($rs['contents']); 
						?></script>
		       
		       		<br>
		       		<span style="float:right;">
			        	<input class="btn btn-default" type="submit" value="更新" name="sub">
			        	<a class="btn btn-default" href="view.php?id=<?php echo $_GET['id']; ?>">返回</a>
		        	</span>
		        </div>
		    </form>
		</div>
	</div>
  </div>
 </main>
</body>
</html>

<script type="text/javascript">
   //初始化编辑框长度和宽度
    var editor_a = UE.getEditor('myEditor',
      {
        toolbars:[[
        // 'FullScreen',"fontfamily", "fontsize", "bold", "italic", "underline", "forecolor", "backcolor", "insertorderedlist", "insertunorderedlist"

		'fullscreen', 'source', '|', 'undo', 'redo', '|',
		'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
		'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
		'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
		'directionalityltr', 'directionalityrtl', 'indent', '|',
		'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
		'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
		'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
		'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
		'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
		'print', 'preview', 'searchreplace', 'drafts', 'help'
        ]],
        //focus时自动清空初始化时的内容  
        autoClearinitialContent:false,
        //开启字数统计  
        wordCount:true,
        //允许的最大字符数
        maximumWords:8000,     
        //关闭元素路径
        elementPathEnabled:false,
        //默认的编辑区域高度  
        //initialFrameWidth:800,
        //initialFrameHeight:200
        //更多其他参数，请参考ueditor.config.js中的配置项  
      });
</script>

<?php include '../public/footer.php';?>


