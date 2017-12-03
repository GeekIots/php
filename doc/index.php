<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta name="keywords" content="物联网">
  <title>文档中心 | 极客物联网</title>
  <!-- vue -->
  <!-- <script src="https://cdn.bootcss.com/vue/2.5.3/vue.js"></script> -->
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
		    <div style="width: 30%;height: 100%;float: left;padding-top: 1%;">
				<div class="site-tree">
					<ul class="layui-tree">
					<li><h2>基础说明</h2></li>
					<li class="site-tree-noicon layui-this">
					  <a href="/doc/">
					    <cite>开始使用</cite>
					    <em>Getting Started</em>
					  </a>
					</li>
					<li class="site-tree-noicon ">
					  <a href="/doc/base/infrastructure.html">
					    <cite>底层方法</cite>
					    <em>基础支撑</em>
					  </a>
					</li>
					<li><h2>页面元素</h2></li>
					<li class="site-tree-noicon ">
					  <a href="/doc/element/layout.html">
					    <cite>布局</cite>
					    <em>栅格 / 后台布局</em>
					  </a>
					</li>
					<li class="site-tree-noicon ">
					  <a href="/doc/element/color.html">
					    <cite>颜色</cite>
					    <em>主题色设计感 / 内置背景色</em>
					  </a>
					</li>
					</ul>
				</div>	
		    </div>
		    <div style="width: 70%;padding-top: 1%;height: 100%;float: right;  border-left:1px solid #000"  >
				  <fieldset class="layui-elem-field layui-field-title site-title">
                <legend><a name="get">获得 layui</a></legend>
              </fieldset>
              <div class="site-text">
                <p>1. 官网首页下载</p>
                <blockquote class="layui-elem-quote layui-quote-nm">
                  你可以在我们的 <a href="http://www.layui.com/">官网首页</a> 下载到 layui 的最新版，它经过了自动化构建，更适合用于生产环境。目录结构如下：
                </blockquote>
                <pre class="layui-code">
            ├─css //css目录
            │  │─modules //模块css目录（一般如果模块相对较大，我们会单独提取，比如下面三个：）
            │  │  ├─laydate
            │  │  ├─layer
            │  │  └─layim
            │  └─layui.css //核心样式文件
            ├─font  //字体图标目录
            ├─images //图片资源目录（目前只有layim和编辑器用到的GIF表情）
            │─lay //模块核心目录
            │  └─modules //各模块组件
            │─layui.js //基础核心库
            └─layui.all.js //包含layui.js和所有模块的合并文件
               </pre>
                <p>2. Git 仓库下载</p>
                <blockquote class="layui-elem-quote layui-quote-nm">
                  你也可以通过 <a href="https://github.com/sentsin/layui/" target="_blank">GitHub</a> 或 <a href="https://gitee.com/sentsin/layui" target="_blank">码云</a> 得到 layui 的完整开发包，以便于你进行二次开发，或者 Fork layui 为我们贡献方案
                  <br><br>
                  <iframe src="http://ghbtns.com/github-btn.html?user=sentsin&amp;repo=layui&amp;type=watch&amp;count=true&amp;size=large" allowtransparency="true" frameborder="0" scrolling="0" width="156px" height="30px"></iframe>
                  <iframe src="http://ghbtns.com/github-btn.html?user=sentsin&amp;repo=layui&amp;type=fork&amp;count=true&amp;size=large" allowtransparency="true" frameborder="0" scrolling="0" width="156px" height="30px"></iframe>
                </blockquote>
                <p>3. npm 安装</p>
                <pre class="layui-code" lay-skin="notepad">
           
          npm install layui-src    
                </pre>
                <p>一般用于 WebPack 管理</p>
              </div>
              
              <fieldset class="layui-elem-field layui-field-title site-title">
                <legend><a name="quickstart">快速上手</a></legend>
              </fieldset>
              <div class="site-text">
                <p>获得 layui 后，将其完整地部署到你的项目目录（或静态资源服务器），你只需要引入下述两个文件：</p>
                <pre class="layui-code">
          ./layui/css/layui.css
          ./layui/layui.js //提示：如果是采用非模块化方式（最下面有讲解），此处可换成：./layui/layui.all.js
                </pre>
                <p>没错，不用去管其它任何文件。因为他们（比如各模块）都是在最终使用的时候才会自动加载。这是一个基本的入门页面：</p>
                <pre class="layui-code">
          &lt;!DOCTYPE html&gt;
          &lt;html&gt;
          &lt;head&gt;
            &lt;meta charset="utf-8"&gt;
            &lt;meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"&gt;
            &lt;title>开始使用layui&lt;/title&gt;
            &lt;link rel="stylesheet" href="../layui/css/layui.css"&gt;
          &lt;/head&gt;
          &lt;body&gt;
           
          &lt;!-- 你的HTML代码 --&gt;
           
          &lt;script src="../layui/layui.js">&lt;/script&gt;
          &lt;script&gt;
          //一般直接写在一个js文件中
          layui.use(['layer', 'form'], function(){
            var layer = layui.layer
            ,form = layui.form;
            
            layer.msg('Hello World');
          });
          &lt;/script&gt; 
          &lt;/body&gt;
          &lt;/html&gt;
		    </div>
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

