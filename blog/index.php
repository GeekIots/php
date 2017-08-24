<?php include("../public/header.php");?>
<!DOCTYPE HTML>
<html>
<head>
  <script src="ueditor/ueditor.parse.js" type="text/javascript"></script>
</head>
<body>
  <main>
	<div style="margin-left: 10%;margin-right: 10%;margin-top: 1%">
		<form action="" method="get">
			<?php 
				if($_SESSION['login'])
				{
					echo '<a href="add.php" class="btn btn-default">发表博客</a>';	
				}
			?>
			<input type="text" name="keys" />
			<input type="submit" name="subs" value="搜索"/>
		</form>
	  <table class="table box-shadow" style="border-radius:0px;overflow:hidden;box-shadow:2px,3px,0,0 rgba(255,0,0,1);">
	   
	    <tr style="background-color: #555;color:#fff">
	      <h4>
	      	<th style="width:40%;">
		        标题
	      	</th>
			<th style="width:10%;">
			  	作者
			</th>
			<th style="width:10%;">
			  	发表时间
			</th>
			<th style="width:10%;">
			  	热度
			</th>
			<th style="width:10%;">
			  	回复
			</th>
	      </h4>
	      
	    </tr>
		<!-- 读取数据 -->
		<?php
		    include("conn.php");
			if(!empty($_GET['keys'])){
				$w="title like '%".$_GET['keys']."%' or contents like '%".$_GET['keys']."%'";
			}else{
				$w=1;
			}

			$sql="select * from blog where $w order by id desc limit 30";
			// echo $sql;
			$query=mysql_query($sql);

			while($rs=mysql_fetch_array($query))
			{
		?>

			<?php
				//读取回复数量
				$sqlanswer="select count(*) from bloganswer where toid='".$rs['id']."'";
				$queryanswer=mysql_query($sqlanswer);
				$answernum=mysql_fetch_array($queryanswer);
				// print_r($answernum);
			?>
				<tr>
				  <!-- 文章标题 -->
			      <td style="background-color: #E0EEEE;font-size: 1.5em ">
			      	<a href="view.php?id=<?php echo $rs['id'] ?>">
				        <!-- 用户头像 -->
				        <?php 
			           //用户头像
			              $file = "http://www.smtvoice.com/public/upload-head/userheadimg/".$rs['userid'].".jpg";
			              if(my_file_exists($file))
			              {
			                  //存在
			                  $avatar = $file;
			              }
			              else
			              {
			                  //不存在
			                  $avatar = "http://www.smtvoice.com/public/upload-head/default.jpg";
			              }           
			          ?>
				        <img src="<?php echo $avatar?>" width="30px" height="30px" style="border-radius: 5px;">
				        <!-- 文章标题 -->
				        <?php echo $rs['title'];?>
			        </a>
			      </td>
			      <!-- 作者 -->
			      <td style="background-color:#E0EEEE">
			        <?php echo $rs['userid'];?>
			      </td>
			      <!-- 发表时间 -->
			      <td style="background-color:#E0EEEE">
			        <?php echo $rs['dates'];?>
			      </td>
			      <!-- 热度（浏览量） -->
			      <td style="background-color:#E0EEEE">
			        <?php echo $rs['hits'];?>
			      </td>
			      <!-- 回复量 -->
			      <td style="background-color:#E0EEEE">
			        <?php echo $answernum[0];?>
			      </td>
			    </tr>
		<?php
			}
		?>
   
   </table>
  </div>
 </main>
</body>
</html>
<?php include '../public/footer.php';?>
	

	
		