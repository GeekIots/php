<?php
include "./public/header.php";
//phpinfo();
?>

<!DOCTYPE html>
<html>
<head>
    <title>极客物联网 一个开源的物联网开发平台！</title>
    <meta charset="utf-8">  
    <script src="js/Markdown.Converter.js"></script>
</head>
<body>
<img src="http://a4.qpic.cn/psb?/V132Fiv00gblPA/Kcl8uE4ZnmQdJ11QRoDa2vGDeuOG6TEyF3AobuLGLq4!/m/dPcAAAAAAAAA&bo=rgGuAQAAAAARBzA!&rf=photolist" width="200">
    <div style="padding-left: 15%;padding-right: 15%;padding-top: 2%;">
        <p id="md">还未更新！</p>
    </div>
</body>
</html>

<script>  
function convert(str) {
    var converter = new Markdown.Converter();  
        html      = converter.makeHtml(str);  
    return html;
}

$(document).ready(function(){
  console.log('开始加载');  
$.ajax({
    url: "<?php echo $_SERVER['localhost'] ?>/api/info.php?type=get&&name=geekiot_index",
    success: function (res) {
        console.log('success:',res);
        var str = convert(res.list["0"].content_html);
       // str = str.replace(/<img/g,'<img style="width:60%;margin-left: 10%;"');
        $("#md").html(str);
    },
    error:function (res) {
        console.log('fail:',res);
    }
});
});
</script>   
<?php include './public/footer.php';?>
