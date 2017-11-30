<!-- <script src="http://pv.sohu.com/cityjson?ie=utf-8"></script >  -->
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript"> 
// document.write(returnCitySN["cip"]+','+returnCitySN["cname"]) ;
$.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js', function(_result) {
             if (remote_ip_info.ret == '1') {
                 alert('国家：' + remote_ip_info.country + '<BR>省：' + remote_ip_info.province + '<BR>市：' + remote_ip_info.city + '<BR>区：' + remote_ip_info.district + '<BR>ISP：' + remote_ip_info.isp + '<BR>类型：' + remote_ip_info.type + '<BR>其他：' + remote_ip_info.desc);
             } else {
                 alert('没有找到匹配的IP地址信息！');
             }
         });
</script>