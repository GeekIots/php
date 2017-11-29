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
  <div class="main layui-clear" style="text-align: center;">
	  <div class="layui-carousel" id="test4">
		<div carousel-item>
		<div><img src="http://s2.mogucdn.com/mlcdn/c45406/170714_2f9k4a3lgdfb80cie2g7aaba8l4ag_778x440.jpg_900x9999.v1c7E.70.webp"></div>
		<div><img src="http://s10.mogucdn.com/mlcdn/c45406/170710_3a6jf5f0j24bgcc3i3f36el2a2ckj_778x440.jpg_900x9999.v1c7E.70.webp"></div>
		<div><img src="http://s10.mogucdn.com/mlcdn/c45406/170714_5e8867724c4bfae8ka6l3a5274h0h_778x440.jpg_900x9999.v1c7E.70.webp"></div>
		<div><img src="http://s3.mogucdn.com/mlcdn/c45406/170609_83i077ikhb3023kch5gah5b2il9k3_778x440.jpg_900x9999.v1c7E.70.webp"></div>
		<div><img src="http://s10.mogucdn.com/mlcdn/c45406/170714_8d301bj507l9la1cjccbabg433beh_778x440.jpg_900x9999.v1c7E.70.webp"></div>
		<div><img src="http://s10.mogucdn.com/mlcdn/c45406/170710_4kaiaee4j39899b08abc685j2ehk1_778x440.jpg_900x9999.v1c7E.70.webp"></div>
		<div><img src="http://s10.mogucdn.com/mlcdn/c45406/170710_31a9gb225bga4agf4c9b25a8c8924_778x440.jpg_900x9999.v1c7E.70.webp"></div>
		</div>
	  </div>
	  <!-- 视频 -->
	  <iframe height=498 width=510 src='http://player.youku.com/embed/XMzE5MjUxNjk5Ng==' frameborder=0 'allowfullscreen'></iframe>
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
  
  //建造实例
  carousel.render({
    elem: '#test1'
    ,index: 2
    //,full: true
    ,arrow: 'always'
    //,autoplay: false
    //,indicator: 'outside'
    //,trigger: 'hover'
  });

  //事件
  carousel.on('change(test1)', function(res){
    console.log(res)
  });

  carousel.render({
    elem: '#test2'
    ,interval: 1800
    //,full: true
    ,anim: 'fade'
    ,height: '120px'
  });
  
  carousel.render({
    elem: '#test3'
    //,full: true
    ,arrow: 'always'
    //,autoplay: false
    //,indicator: 'outside'
    //,trigger: 'hover'
    ,anim: 'updown'
    //,full: true
  });
  
  carousel.render({
    elem: '#test4'
    ,width: '778px'
    ,height: '440px'
    ,interval: 5000
  });
});
</script>
</html>