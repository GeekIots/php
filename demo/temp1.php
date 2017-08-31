<?php
 include "./public/header.php";
//phpinfo();
?>
<!-- <?php
	
	//  $wikiMenu = "./"; //错误日志所在目录 
	//  function indexAction(){ 
	// $markdown = file_get_contents($this->wikiMenu."README.md"); #读取指定目录下的README.md文件 
	// $markdown = json_encode($markdown,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT); #将获取到的内容转化成JSON 
	// $this->assign("html",$markdown); #传到前台 
	// $this->display(); } 

	//  function _empty(){ 
	// 	$markdown = file_get_contents($this->wikiMenu.ACTION_NAME.".md"); 
	// 	$markdown = json_encode($markdown,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT); 
	// 	$this->assign("html",$markdown); 
	// 	$this->display("Doc/index"); 
	// }

?> -->
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
	    <textarea id="txt" style="width: 50%;height: 600px;"></textarea>
	    <div style="width: 50%;float: right;border:1px solid lightgray; height:600px;word-wrap:break-word;padding: 2%;">
	    	<p id="content" >还未更新！</p>
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
      breaks: false,
      pedantic: false,
      sanitize: false,
      smartLists: true,
      smartypants: false
    });
//     var markdownString = '```js\n console.log("hello"); \n```';
    marked.setOptions({
        highlight: function (code) {
        return hljs.highlightAuto(code).value;
      }
    });
//     document.getElementById('content').innerHTML = marked(markdownString);

$("#txt").bind("input propertychange", function () {
    // alert($(this).text());
    $("#content").html(marked($(this).val())); 
})

</script>   

<!-- <?php include './public/footer.php';?> -->