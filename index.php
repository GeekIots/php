<?php
include "./public/header.php";
//phpinfo();
?>

<!doctype html>  
<head>  
    <meta charset="utf-8">  
    <script src="http://cdn.bootcss.com/pagedown/1.0/Markdown.Converter.js"></script>
    <script>  
    function convert(str) {
        var converter = new Markdown.Converter();  
            html      = converter.makeHtml(str);  
        return html;
    }

    $(document).ready(function(){
      console.log('开始加载');  
    $.ajax({
        url: "<?php echo $_SERVER['localhost'] ?>/api/info.php?type=geekiot_index",
        success: function (res) {
            console.log('success:',res);
            var str = convert(res.list["0"].content);
           str = str.replace(/<img/g,'<img style="width:60%;margin-left: 10%;"');
            $("#md").html(str);
        },
        error:function (res) {
            console.log('fail:',res);
        }
    });
    });
    </script>  
    <style>
      /*  img{
            width:80%;
            margin-left: 5%;
        }  */ 
    </style>
</head>
<body>
  <div style="padding-left: 10%;padding-right: 10%;padding-top: 2%;">
      <p id="md">2</p>
  </div>
</body>  
</html>  
<?php include './public/footer.php';?>