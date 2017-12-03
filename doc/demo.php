    <div class="layui-header header header-doc">
            <div class="layui-main">
              <div class="layui-form component">
                
              </div>
            </div>
          </div>
          <ul class="site-dir">
            <li><a href="#get"><cite>获得 layui</cite></a></li>
            <li><a href="#quickstart"><cite>快速上手</cite></a></li>
            <li><a href="#classical"><cite>经典，因返璞归真</cite></a></li>
            <li><a href="#modules"><cite>模块化用法</cite></a></li>
            <li><a href="#nonmodules"><cite>非模块化用法</cite></a></li>
          </ul>


              

          <div style="margin: 15px 0; text-align: center; background-color: #F2F2F2;">
            <ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-6111334333458862" data-ad-slot="9841027833"></ins>
          </div>


              
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
                </pre>
                <p>如果你想采用非模块化方式（即所有模块一次性加载，尽管我们并不推荐你这么做），你也可以按照下面的方式使用：</p>
                <pre class="layui-code">
          &lt;!DOCTYPE html&gt;
          &lt;html&gt;
          &lt;head&gt;
            &lt;meta charset="utf-8"&gt;
            &lt;meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"&gt;
            &lt;title>非模块化方式使用layui&lt;/title&gt;
            &lt;link rel="stylesheet" href="../layui/css/layui.css"&gt;
          &lt;/head&gt;
          &lt;body&gt;
           
          &lt;!-- 你的HTML代码 --&gt;
           
          &lt;script src="../layui/layui.all.js">&lt;/script&gt;
          &lt;script&gt;
          //由于模块都一次性加载，因此不用执行 layui.use() 来加载对应模块，直接使用即可：
          ;!function(){
            var layer = layui.layer
            ,form = layui.form;
            
            layer.msg('Hello World');
          }();
          &lt;/script&gt; 
          &lt;/body&gt;
          &lt;/html&gt;
                </pre>
              </div>
              
              <fieldset class="layui-elem-field layui-field-title site-title">
                <legend><a name="classical">经典，因返璞归真</a></legend>
              </fieldset>
              <div class="site-text">
                <p>layui 定义为“经典模块化”，并非是自吹她自身有多优秀，而是有意避开当下JS社区的主流方案，试图以最简单的方式去诠释高效！<em>她的所谓经典，是在于对返璞归真的执念</em>，她以当前浏览器普通认可的方式去组织模块！我们认为，这恰是符合当下国内绝大多数程序员从旧时代过渡到未来新标准的最佳指引。所以 layui 本身也并不是完全遵循于AMD时代，准确地说，她试图建立自己的模式，所以你会看到：</p>
                
                <pre class="layui-code">
          //layui模块的定义
          layui.define([mods], function(exports){
            
            //……
            
            exports('mod', api);
          });  
           
          //layui模块的使用
          layui.use(['mod1', 'mod2'], function(args){
            var mod = layui.mod1;
            
            //……
            
          });    
                </pre>
                <p>没错，她具备AMD的影子，又并非受限于 CommonJS 的那些条条框框，layui认为这种轻量的组织方式，比WebPack更符合绝大多数场景。所以她坚持采用经典模块化，也正是能让人避开工具的复杂配置，回归简单，安静高效地编织原生态的HTML、CSS和JavaScript。</p>
                
                <p>但是 layui 又并非是 Requirejs 那样的模块加载器，而是一款UI解决方案，她与Bootstrap最大的不同恰恰在于她糅合了自身对经典模块化的理解。</p>
              </div>
                
              <fieldset class="layui-elem-field layui-field-title site-title">
                <legend><a name="modules">模块化的用法（推荐）</a></legend>
              </fieldset>
              <div class="site-text">  
                <p>我们推荐你遵循 layui 的模块规范建立一个入口文件，并通过 layui.use() 方式来加载该入口文件，如下所示：</p>
                <pre class="layui-code">
          &lt;script&gt;
          layui.config({
            base: '/res/js/modules/' //你存放新模块的目录，注意，不是layui的模块目录
          }).use('index'); //加载入口
          &lt;/script&gt;    
              </pre>
              上述的 index 即为你 /res/js/modules/ 目录下的 index.js，它的内容应该如下：
              <pre class="layui-code">
          /**
            项目JS主入口
            以依赖layui的layer和form模块为例
          **/    
          layui.define(['layer', 'form'], function(exports){
            var layer = layui.layer
            ,form = layui.form;
            
            layer.msg('Hello World');
            
            exports('index', {}); //注意，这里是模块输出的核心，模块名必须和use时的模块名一致
          });    
                </pre>
              </div>
              
              <fieldset class="layui-elem-field layui-field-title site-title">
                <legend><a name="nonmodules">非模块化用法</a></legend>
              </fieldset> 
              <div class="site-text">  
                <p>如果你并不喜欢 layui 的模块化组织方式，你完全可以毅然采用“一次性加载”的方式，我们将 layui.js 及所有模块单独打包合并成了一个完整的js文件，用的时候直接引入这一个文件即可。当你采用这样的方式时，<span style="color: #FF5722;">你无需再通过 layui.use() 方法加载模块</span>，直接使用即可，如：</p>
                <pre class="layui-code">
          &lt;script src="../layui/layui.all.js">&lt;/script>  
          &lt;script>
          ;!function(){
            //无需再执行layui.use()方法加载模块，直接使用即可
            var form = layui.form
            ,layer = layui.layer;
            
            //…
          }();
          &lt;/script> 
                </pre>
                <p>但你必须知道，采用该方式，意味着 layui 的模块化已经失去了它的意义。但不可否认，它使用起来会更简单直接。</p>
                
                <blockquote class="layui-elem-quote layui-quote-nm">
                  也许通过上面的阅读，你已经大致了解如何使用 layui 了，但真正用于项目远不止如此，你需要继续阅读后面的文档，尤其是【基础说明】
                  <br>那么，从现在开始，尽情地拥抱 layui 吧！但愿她能成为你长远的开发伴侣，化作你方寸屏幕前的亿万字节！
                </blockquote>
              </div>
              
              <div class="layui-elem-quote">
            <p>Layui - 用心与你沟通</p>
          </div>
            </div>
          </div>
            
          <div class="site-tree-mobile layui-hide">
            <i class="layui-icon">&#xe602;</i>
          </div>
          <div class="site-mobile-shade"></div>