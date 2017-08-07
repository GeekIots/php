<?php
include "../../public/header.php";
//phpinfo();
?>
<!DOCTYPE html>
<html>
<head>
	<title>遥控器设置</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
<main class="contain">
	<table>
	  <tr>
	    <th>编号</th>
	    <th>名称</th>
	    <th>按下指令</th>
	    <th>抬起指令</th>
	    <th>按下图片</th>
	    <th>抬起图片</th>
	  </tr>

	  <?php 
	  for ($i=0; $i < 12; $i++) { 
	  	echo "<tr>
			    <td>$i</td>
			    <td><input type='text' id='a$i'></td>
			    <td><input type='text' id='b$i'></td>
			    <td><input type='text' id='c$i'></td>
			    <td><input type='text' id='d$i'></td>
			    <td><input type='text' id='e$i'></td>
			  </tr>";
	  }
	  ?>
	</table>
</main>
	
</body>
</html>

<script type="text/javascript">
	//监控输入值变化并打印到控制台 
	$("#a0").bind("change", function(){ console.log("msg:%s", $("#a0").val()); });

	$("#b0").bind("change", function(){ console.log("msg:%s", $("#b0").val()); });

	// 上传到服务器
	// 选择遥控器，上面三个大按钮，是遥控器的缩略图，底下部分能自动切换


    // $("input:button").click(function() {

    //     str = $(this).val()=="编辑"?"确定":"编辑";  

    //     $(this).val(str);   // 按钮被点击后，在“编辑”和“确定”之间切换

    //     $(this).parent().siblings("td").each(function() {  // 获取当前行的其他单元格

    //         obj_text = $(this).find("input:text");    // 判断单元格下是否有文本框

    //         if(!obj_text.length)   // 如果没有文本框，则添加文本框使之可以编辑

    //             $(this).html("<input type='text' value='"+$(this).text()+"'>");

    //         else   // 如果已经存在文本框，则将其显示为文本框修改的值

    //             $(this).html(obj_text.val()); 

    //     });

    // });

// }); 
</script>
