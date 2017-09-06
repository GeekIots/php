<?php
 include $_SERVER['DOCUMENT_ROOT']."/common/header.php";
//phpinfo();
?>
<!DOCTYPE html>
<html>
<head>
    <title>markdown编辑器</title>
    <meta charset="utf-8">  
    <script src="../../frame/markdown/marked.js"></script>
    <link rel="stylesheet" href="../../frame/markdown/src/styles/github.css">
    <script src="../../frame/markdown/highlight.min.js"></script>
</head>
<body>
    <div style="padding-left: 2%;padding-right: 2%;padding-top: 1%;">
      <div><h2 style="float: left;padding-left: 0%;color: orange;">源代码:</h2><h2 style="float: right;padding-right: 38%; color: orange;">效果预览:</h2></div>
	    <textarea class="form-control"  id="txt" style="width: 50%;height: 600px;float: left; resize: none;font-size: 20px;" placeholder="请输入Markdown代码" onscroll="Fun_scroll_md()"></textarea>
      
	    <div class="form-control" style="width: 49%;float: right;border:1px solid lightgray; height:600px;word-wrap:break-word;padding: 2%;" >
	    <div style="overflow-y:auto;overflow-x: hidden; margin:-10px; height: 104%;" id="content" onscroll="Fun_scroll_html()"></div>
	    </div>
    </div>
</body>
</html>
<script> 
layui.use(['layedit','jquery'],function(){
  var layedit = layui.layedit,$ = layui.jquery;

  //在文本框内鼠标滚动时也没不动
  document.getElementById('txt').onmousewheel = function(event) { 
          if (!event) event = window.event; 
          this.scrollTop = this.scrollTop - (event.wheelDelta ? event.wheelDelta : -event.detail * 10); 
          return false; 
      } 
  document.getElementById('content').onmousewheel = function(event) { 
      if (!event) event = window.event; 
      this.scrollTop = this.scrollTop - (event.wheelDelta ? event.wheelDelta : -event.detail * 10); 
      return false; 
  } 
  // ----------------------------
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
          var tokens = marked($(this).val());
          console.log(tokens);  
          $("#content").html(tokens); 
      })

      
  //同步滚动
      var scroll=true;//避免两个文本框相互控制滚动时冲突
      function Fun_scroll_md()  
      {  
        // if (scroll) {
        //   scroll = false;
        //   var obj1 = document.getElementById("txt");  
        //   var obj2 = document.getElementById("content");
        //   // console.log('obj1:',obj1.scrollHeight);
        //   // console.log('obj2:',obj2.scrollHeight);
        //   // 同比例计算，计算比例时要减去默认高度
        //   obj2.scrollTop = obj1.scrollTop*((obj2.scrollHeight-$('#content').get(0).offsetHeight)/(obj1.scrollHeight-$('#txt').get(0).offsetHeight));
        // }
        // else
        // {
        //   scroll=true;
        // }
      }  
      function Fun_scroll_html()  
      {  
        if (scroll) {
          scroll = false;
          var obj1 = document.getElementById("txt");  
          var obj2 = document.getElementById("content");
          // console.log('obj1:',obj1.scrollTop);
          // console.log('obj2:',obj2.scrollTop);
          // 同比例计算，计算比例时要减去默认高度
          obj1.scrollTop = obj2.scrollTop*((obj1.scrollHeight-$('#txt').get(0).offsetHeight)/(obj2.scrollHeight-$('#content').get(0).offsetHeight));
        }
        else
        {
          scroll=true;
        }
      } 
  
  });


//-----------------------------------------------
</script>   

<?php include  $_SERVER['DOCUMENT_ROOT']."/common/footer.php";?>


