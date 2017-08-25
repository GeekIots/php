<?php
 include "./public/header.php";
//phpinfo();
?>
<!DOCTYPE html>
<html>
<head>
    <title>markdown编辑器</title>
    <meta charset="utf-8">  
    <script src="markdown/marked.js"></script>
    <!-- <script src="markdown/src/highlight.js"></script> -->
    <link rel="stylesheet" href="markdown/src/styles/rainbow.css">
    <link href="http://cdn.bootcss.com/highlight.js/8.0/styles/monokai_sublime.min.css" rel="stylesheet">
	<script src="http://cdn.bootcss.com/highlight.js/8.0/highlight.min.js"></script>
	
     <!-- <script src="js/jquery.min.js"></script> -->
</head>
<body>

    <div style="padding-left: 10%;padding-right: 10%;padding-top: 2%;">
	    <textarea id="txt" style="width: 50%;height: 600px;" placeholder="请输入Markdown代码"></textarea>
	    <div style="width: 50%;float: right;border:1px solid lightgray; height:600px;word-wrap:break-word;padding: 2%;">
	    <p id="content"></p>
	    </div>
        
    </div>
</body>
</html>

<script>  
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
    
$("#txt").bind("input propertychange", function () {
    // alert($(this).text());
    $("#content").html(marked($(this).val())); 
})

</script>   

<!-- <?php include './public/footer.php';?> -->