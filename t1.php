<?php
include "./public/header.php";
//phpinfo();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"> 
    <title>markdown</title>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <!-- <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">  -->
    <script src="//cdn.bootcss.com/codemirror/5.2.0/codemirror.min.js"></script>
	<link rel="stylesheet" href="//cdn.bootcss.com/codemirror/5.2.0/codemirror.min.css">
	<!-- <script src="//cdn.bootcss.com/codemirror/5.2.0/mode/htmlmixed/htmlmixed.min.js"></script> -->
	<!-- <script src="//cdn.bootcss.com/codemirror/5.2.0/mode/css/css.min.js"></script> -->
	<!-- <script src="//cdn.bootcss.com/codemirror/5.2.0/mode/javascript/javascript.min.js"></script> -->
	<!-- <script src="//cdn.bootcss.com/codemirror/5.2.0/mode/xml/xml.min.js"></script> -->
	<!-- <script src="//cdn.bootcss.com/codemirror/5.2.0/addon/edit/closetag.min.js"></script> -->
	<!-- <script src="//cdn.bootcss.com/codemirror/5.2.0/addon/edit/closebrackets.min.js"></script> -->

        <!-- <script src="js/jquery.min.js"></script> -->

 <script src="markdown/marked.js"></script>
    <!-- <script src="markdown/src/highlight.js"></script> -->
    <link rel="stylesheet" href="markdown/src/styles/rainbow.css">
    <link href="http://cdn.bootcss.com/highlight.js/8.0/styles/monokai_sublime.min.css" rel="stylesheet">
  <script src="http://cdn.bootcss.com/highlight.js/8.0/highlight.min.js"></script>

</head>
<body>

<style>
body{min-height:300px;padding-top:25px;background: #f6f6f6;}.container{width:98%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}.CodeMirror{min-height:300px}
#textareaCode{min-height:300px}
#iframeResult{display: block;overflow: hidden;border:0!important;min-width:100px;width:100%;min-height:300px;background-color:#fff}@media screen and (max-width:768px){#textareaCode{height:300px}.CodeMirror{height:300px}#iframeResult{height:300px}.form-inline{padding:6px 0 2px 0}}

  /*background-repeat:no-repeat;text-indent:-9999px;width:160px;height:39px;margin-top:10px;display:block}*/
</style>
<nav class="navbar navbar-default navbar-fixed-top" style="background: darkgray;">
  <div class="container">
    <div class="navbar-header">
      <a href="www.geek-iot.com" style="color: white;font-size: 30px;font-family:Verdana;">Geek-iot.com</a>
    </div>
  </div>
</nav>
<div class="container" >
    <div class="row">
      <div class="col-sm-6">
      	<div class="panel panel-default"> 
      		<div class="panel-heading">
      			<form class="form-inline">
              <div class="row">
                  <div class="col-xs-6">
                       <button type="button" class="btn btn-default">源代码：</button>
                    </div>
                    <div class="col-xs-6 text-right">
                      <button type="button" class="btn btn-success" onclick="submitTryit()"><span class="glyphicon glyphicon-send"></span> 点击运行</button>
                  </div>
              </div>
      			</form>
      		</div>
      		<div class="panel-body">
      			<!-- <textarea  class="form-control"  id="textareaCode" name="textareaCode"># 输入框1</textarea> -->
            <textarea id="textareaCode" class="form-control"></textarea>
      		</div>
      	</div>
  	</div>

  	<div class="col-sm-6">
    	<div class="panel panel-default"> 
    		<div class="panel-heading"><form class="form-inline"> <button type="button" class="btn btn-default">效果预览</button></form></div>
    		<div class="panel-body"><div id="iframewrapper"></div></div>
    	</div>
    	</div>
  	
  	</div>

	<footer>
		<div class="row">
			<div class="col-sm-12">
      <div style="text-align: center;">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- 移动版 自动调整 -->
        <ins class="adsbygoogle"
             style="display:inline-block;min-width:300px;max-width:970px;width:100%;height:90px"
             data-ad-client="ca-pub-5751451760833794"
             data-ad-slot="1691338467"
             data-ad-format="horizontal"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
        </div>
                <hr>

				<p>Copyright © 2017-2027<a target="_blank" href="//geek-iot.com/">极客物联网</a></p>
			</div>
		</div>
	</footer>
</div>
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


var mixedMode = {
name: "htmlmixed",
scriptTypes: [{matches: /\/x-handlebars-template|\/x-mustache/i,
               mode: null},
              {matches: /(text|application)\/(x-)?vb(a|script)/i,
               mode: "vbscript"}]
};
// var editor = CodeMirror.fromTextArea(document.getElementById("textareaCode"), {
// 	mode: mixedMode,
// 	selectionPointer: true,
// 	lineNumbers: false,
// 	matchBrackets: true,
// 	indentUnit: 4,
// 	indentWithTabs: true
// });

window.addEventListener("resize", autodivheight);

var x = 0;
function autodivheight(){
    var winHeight=0;
    if (window.innerHeight) {
        winHeight = window.innerHeight;
    } else if ((document.body) && (document.body.clientHeight)) {
        winHeight = document.body.clientHeight;
    }
    //通过深入Document内部对body进行检测，获取浏览器窗口高度
    if (document.documentElement && document.documentElement.clientHeight) {
        winHeight = document.documentElement.clientHeight;
    }
    height = winHeight*0.68
    // editor.setSize('100%', height);
    document.getElementById("iframeResult").style.height= height +"px";
}

function submitTryit() {
console.log($("#textareaCode").val());
  // editor.getValue();
  var text = marked($("#textareaCode").val());
  var patternHtml = /<html[^>]*>((.|[\n\r])*)<\/html>/im
  var patternHead = /<head[^>]*>((.|[\n\r])*)<\/head>/im
  var array_matches_head = patternHead.exec(text);
  var patternBody = /<body[^>]*>((.|[\n\r])*)<\/body>/im;
  
  var array_matches_body = patternBody.exec(text);
  var basepath_flag = 1;
  var basepath = '';
  if(basepath_flag) {
    basepath = '<base href="//www.runoob.com/try/demo_source/" target="_blank">';
  }
  if(array_matches_head) {
    text = text.replace('<head>', '<head>' + basepath );
  } else if (patternHtml) {
    text = text.replace('<html>', '<head>' + basepath + '</head>');
  } else if (array_matches_body) {
    text = text.replace('<body>', '<body>' + basepath );
  } else {
    text = basepath + text;
  }
  var ifr = document.createElement("iframe");
  ifr.setAttribute("frameborder", "0");
  ifr.setAttribute("id", "iframeResult");  
  document.getElementById("iframewrapper").innerHTML = "";
  document.getElementById("iframewrapper").appendChild(ifr);
 
  var ifrw = (ifr.contentWindow) ? ifr.contentWindow : (ifr.contentDocument.document) ? ifr.contentDocument.document : ifr.contentDocument;
  ifrw.document.open();
  ifrw.document.write(text);  
  ifrw.document.close();
  autodivheight();
}
$("#textareaCode").bind("input propertychange", function () {
    // alert($(this).text());
    // $("#iframewrapper").html(marked($(this).val())); 
    // console.log($("#textareaCode").val());
    submitTryit();
})



submitTryit();
autodivheight();
</script>
<div style="display:none;">
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?8e2a116daf0104a78d601f40a45c75b4";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</div></body>
</html>

<script>  

    


</script>   








