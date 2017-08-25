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
</head>
<body>
    <div style="padding-left: 2%;padding-right: 2%;padding-top: 1%;">
      <div><h2 style="float: left;padding-left: 0%;color: orange;">源代码:</h2><h2 style="float: right;padding-right: 38%; color: orange;">效果预览:</h2></div>
	    <textarea class="form-control"  id="txt" style="width: 50%;height: 600px;float: left; resize: none;" placeholder="请输入Markdown代码" ></textarea>
      
	    <div class="form-control" style="width: 49%;float: right;border:1px solid lightgray; height:600px;word-wrap:break-word;padding: 2%;">
	    <div style="overflow-y:auto;overflow-x: hidden; margin:-10px; height: 104%;" id="content"></div>
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
    // var lexer = new marked.Lexer({sanitize: true});//放option信息
    // var tokens = lexer.lex($(this).val());//<p>&lt;h1&gt;hello&lt;/h1&gt;</p>
    // var str = tokens;
    var tokens = marked($(this).val());
    console.log(tokens);  
    $("#content").html(tokens); 
})

</script>   

<?php include './public/footer.php';?>


