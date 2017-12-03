<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta name="keywords" content="物联网">
  <!-- vue -->
  <script src="https://cdn.bootcss.com/vue/2.5.3/vue.js"></script>
  <!-- layui -->
  <link rel="stylesheet" href="/frame/layui-master/src/css/layui.css">
  <link rel="stylesheet" href="/frame/layui-master/src/css/gloabal/global.css">
  <script src="/frame/layui-master/src/layui.js"></script>
  <!-- QQ登录 -->
  <script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js"></script>
  <!-- 自定义函数 -->
  <script src="/common/fun.js"></script>
</head>
<body>
  <?php require($_SERVER['DOCUMENT_ROOT'].'/common/header.php'); ?>
    <div class="main fly-user-main layui-clear">
      <ul class="layui-timeline">

        <li class="layui-timeline-item">
          <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
            <div class="layui-timeline-content layui-text">
              <h3 class="layui-timeline-title">2017年12月2日</h3>
              <p>
                    开通QQ登录功能，方便用户快速登录
                <br>增加开关设备页面控制
                <br>增加页面查看温湿度传感器
                <br>增加微信小程序控制和查看设备（微信搜索‘极客物联网’）
                <br>修复若干bug，优化界面
              </p>
            </div>
          </i>
        </li>

        <li class="layui-timeline-item">
          <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
            <div class="layui-timeline-content layui-text">
              <h3 class="layui-timeline-title">2017年11月5日</h3>
              <p>
                社区框架2.0完工，具备基本讨论功能
                <br>开关及部分传感器设备具备增删改查基本操作功能
                <br>www.geek-iot.com 签发SSL安全证书
              </p>
            </div>
          </i>
        </li>


        <li class="layui-timeline-item">
          <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
          <div class="layui-timeline-content layui-text">
            <h3 class="layui-timeline-title">2017年9月13日</h3>
            <p>
              重新建设社区
              <br>只要有目标，就一定要实现，坚持就是捷径！<i class="layui-icon"></i>
            </p>
          </div>
        </li>
        
        <li class="layui-timeline-item">
          <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
          <div class="layui-timeline-content layui-text">
            <h3 class="layui-timeline-title">2016年7月27日</h3>
            <div class="layui-timeline-title">开始构思极客物联网，购买服务器！</div>
          </div>
        </li>
      </ul>
    </div>
  <?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
</body>
<script>
 // 加载需要的模块
 layui.use(['layer','laydate','laypage','laytpl','layedit','form','upload','tree','table','element','util','flow','carousel','code','jquery'], function(){
  var layer,laydate,laypage,laytpl,layim,layedit,form,upload,tree,table,element,util,flow,carousel,code,$,mobile;
  layer = layui.layer;
  laydate = layui.laydate;
  laypage = layui.laypage;
  laytpl = layui.laytpl;
  layedit = layui.layedit;
  form = layui.form;
  upload = layui.upload;
  tree = layui.tree;
  table = layui.table;
  element = layui.element;
  util = layui.util;
  flow = layui.flow;
  carousel = layui.carousel;
  code = layui.code;
  $  = layui.jquery;
 
});
</script>
</html>

