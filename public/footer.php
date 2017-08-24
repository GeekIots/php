
<style type="text/css">
	.demo{width:150px; margin:20px auto; font-size:14px}  #total{padding:6px 10px; background:#090 url(arr.png) no-repeat right top; color:#fff;  cursor:pointer; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px;  -moz-box-shadow:0 0 3px #ccc; -webkit-box-shadow:0 0 3px #ccc;box-shadow:0 0 3px #ccc;}  #onlinelist{background:#f7f7f7; border:1px solid #d3d3d3; display:none; -moz-border-radius:5px;  -webkit-border-radius:5px; border-radius:5px; -moz-box-shadow:0 0 3px #ccc;  -webkit-box-shadow:0 0 3px #ccc;box-shadow:0 0 3px #ccc;}  #onlinelist li{height:20px; line-height:20px;padding:4px 6px;border-bottom:1px dotted #d9d9d9}  #onlinelist li span{float:right}  #onlinelist li:hover{background:#fff} 
</style>
<footer class="box-shadow" style="background-color: #555;color:#fff;font-size: 28px;text-align: center;">
    更多精彩内容，正在持续开发中...
    <p style="font-size: 20px">备案信息：陕ICP备16012349号</p>
    <p style="font-size: 20px"> 友情连接：<a href="http://www.tiangk.top">糖客视频</a><a href="http://www.easyicon.net">easyicon</a></p>
     <p style="color: orange">
        当前在线人数：
        <?php 
            $num = $_SESSION['nowonline'];
            echo $num; 
        ?>
    </p> 

   <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1261859339'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1261859339%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
</footer>
