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
    <div class="main layui-clear">
      <script id="Tpl_1" type="text/html">
        <div class="wrap">
          <div class="content detail">
            <div class="fly-panel detail-box">
              <h1>{{d.title}}</h1>
              <div class="fly-tip fly-detail-hint">
                <!-- <span class="fly-tip-stick">置顶帖</span> -->
                <!-- <span class="fly-tip-jing">精帖</span> -->
                <!-- <span>未结贴</span> -->
                <span class="fly-tip-jie">{{d.classify}}</span>
                
                <!-- <span class="jie-admin" type="del" style="margin-left: 20px;">删除</span>
                <span class="jie-admin" type="set" field="stick" rank="1">置顶</span> 
                <span class="jie-admin" type="set" field="stick" rank="0" style="background-color:#ccc;">取消置顶</span>
                <span class="jie-admin" type="set" field="status" rank="1">加精</span> 
                <span class="jie-admin" type="set" field="status" rank="0" style="background-color:#ccc;">取消加精</span> -->
                <div class="fly-list-hint"> 
                  <i class="iconfont" title="回答">&#xe60c;</i>{{d.answernum}}
                  <i class="iconfont" title="人气">&#xe60b;</i>{{d.count}}
                </div>
              </div>
              <div class="detail-about">
                <a class="jie-user" href="">
                  <img src="{{d.avatar}}" onerror="javascript:this.src='/image/default/error.jpg';" alt="">
                  <cite>
                    {{d.nickname}}
                    <!-- 更新时间 -->
                    <em>{{ layui.util.timeAgo(d.dates) }}</em>
                  </cite>
                </a>
                <div class="detail-hits">
                  <span style="color:#FF7200">悬赏：20飞吻</span>
                  {{#if(d.userid==user.userid){}}
                  <span class="layui-btn layui-btn-mini jie-admin" type="edit"><a href="edit.php?id={{d.id}}">编辑此贴</a></span>
                  {{#}}}
                  
                    {{#  if(collect=="true"){ }}
                      <button class="layui-btn layui-btn-mini jie-admin  layui-btn-danger" id="collect-btn">取消收藏</button>
                    {{#  } else { }}
                      <button class="layui-btn layui-btn-mini jie-admin" id="collect-btn">收藏</button>
                    {{#  } }} 
                    
                 
                  <!-- <span class="layui-btn layui-btn-mini jie-admin " type="collect" data-type="add">{{d.classify}}</span> -->
                  <!--<span class="layui-btn layui-btn-mini jie-admin  layui-btn-danger" type="collect" data-type="add">取消收藏</span>-->
                </div>
              </div>
              
              <div class="detail-body photos" style="margin-bottom: 20px;">
                <p>{{d.contents}}</p>
              </div>
            </div>
            <!-- 回复 -->
            <div class="fly-panel detail-box" style="padding-top: 0;">
              <div style="padding-top: 15px;">
                  <fieldset class="layui-elem-field layui-field-title" style="text-align: center;">
                      <legend>回帖</legend>
                  </fieldset>
              </div>
              <!-- <a name="comment"></a> -->
              <ul class="jieda photos" id="jieda">
                {{#  layui.each(d.list, function(index, item){ }}
                <li data-id="12" class="jieda-daan">
                  <a name="item-121212121212"></a>
                  <div class="detail-about detail-about-reply">
                    <a class="jie-user" href="/user/home.php?userid={{item.userid}}">
                      <img src="{{item.avatar}}" onerror="javascript:this.src='/image/default/error.jpg';" alt="">
                      <cite>
                        <i>{{item.nickname}}</i>
                        <!-- <em>(楼主)</em>
                        <em style="color:#5FB878">(管理员)</em>
                        <em style="color:#FF9E3F">（活雷锋）</em>
                        <em style="color:#999">（该号已被封）</em> -->
                      </cite>
                    </a>
                    <div class="detail-hits">
                      <!-- 更新时间 -->
                      <span>{{ layui.util.timeAgo(item.dates) }}</span>
                    </div>
                    <!-- 已采纳 -->
                    <!-- <i class="iconfont icon-caina" title="最佳答案"></i> -->
                  </div>
                  <div class="detail-body jieda-body">
                    <p>{{item.contents}}</p>
                  </div>
                  <div class="jieda-reply">
                    <!-- 赞 -->
                    <!-- <span class="jieda-zan zan" type="zan"><i class="iconfont icon-zan"></i><em>{{item.zan}}</em></span> -->
                    <!-- <span type="reply"><i class="iconfont icon-svgmoban53"></i>回复</span> -->
                    <!-- <div class="jieda-admin">
                      <span type="edit">编辑</span>
                      <span type="del">删除</span>
                      <span class="jieda-accept" type="accept">采纳</span>
                    </div> -->
                  </div>
                </li>
                {{#  }); }}
                {{#  if(d.answernum==0){ }}
                  <li class='fly-none'>还没有回复！</li>
                {{#  } }}  
              </ul>
              <div class="layui-form layui-form-pane">
                  <div class="layui-form-item layui-form-text">
                    <div class="layui-input-block">
                      <textarea id="textEdit" name="content" class="layui-textarea fly-editor"></textarea>
                    </div>
                  </div>
                  <div class="layui-form-item">
                    <button class="layui-btn" id="btn_answer">提交回复</button>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </script>
      <!-- 建立视图。用于呈现模板渲染结果。 -->
      <div id="view_1"></div>  

        <!-- 右边栏 -->
      <div class="edge">
        <!-- 近一月回答榜 TOP 12-->
        <script id="Tpl_2" type="text/html">
          <div class="fly-panel leifeng-rank"> 
            <h3 class="fly-panel-title">近一月回答榜 - TOP 12</h3>
            <dl>
              {{#  layui.each(d.list, function(index, item){ }}
                <dd>
                  <a href="/user/home.php?userid={{item.userid}}">
                    <img src="{{item.avatar}}" onerror="javascript:this.src='/image/default/error.jpg';">
                     <cite>{{item.nickname}}</cite>
                     <i>{{item.count}}次回答</i>
                  </a>
                </dd>
              {{#  }); }}
            </dl>
          </div>
        </script>
        <!-- 建立视图。用于呈现模板渲染结果。 -->
        <div id="view_2"></div>  
        

        <!-- 最近热帖 -->
        <script id="Tpl_3" type="text/html">
          <dl class="fly-panel fly-list-one"> 
            <dt class="fly-panel-title">最近热帖</dt>
              {{#  layui.each(d.list, function(index, item){ }}
                <dd>
                  <a href="view.php?id={{item.id}}">{{item.title}}</a>
                  <span ><i class="iconfont">&#xe60b;</i>{{item.count}}</span>
                </dd>          
              {{#  }); }}
          </dl>      
        </script>
        <!-- 建立视图。用于呈现模板渲染结果。 -->
        <div id="view_3"></div> 
        
        <!-- 近期热议 -->
        <!-- 回复最多的帖子，暂未实现 -->
        <script id="Tpl_4" type="text/html">
          <dl class="fly-panel fly-list-one"> 
            <dt class="fly-panel-title">近期热议</dt>
            {{#  layui.each(d.list, function(index, item){ }}
              <dd>
                <a href="view.php?id={{item.id}}">{{item.title}}</a>
                <span><i class="iconfont">&#xe60c;</i>{{item.count}}</span>
              </dd>  
            {{#  }); }}
          </dl>
        </script>
        <!-- 建立视图。用于呈现模板渲染结果。 -->
        <div id="view_4"></div> 
      </div>
    </div>
  <?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
</body>
<script>
  //获取请求帖子id
  var _id = getUrlParam('id');
  var index;
  var collect;
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


  // 获取是否是否已经收藏该帖
  if (user.login=='true') {
    $.ajax({
      type:'POST',
      url: "/api/blog/blog.collect.php",
      async: false,
      data:{"type":'check',"userid":user.userid,"blogid":_id},
      success: function (res) {
        collect = res.collect;
        console.log('api/blog/blog.collect.php:',res);
      },
      error:function (res) {
          console.log('fail:',res);
      }
    });    
  }

  // 获取帖子主体
  $.ajax({
    type:'POST',
    url: "/api/blog/getblog.php",
    async: false,
    data:{"id":_id},
    success: function (res) {
      console.log('success:',res);
      //渲染数据
      var getTpl = Tpl_1.innerHTML;
      var view = document.getElementById('view_1');
      laytpl(getTpl).render(res, function(html){
        view.innerHTML = html;
      });
      layedit.set({
        uploadImage: {
        url: '/api/upload/upload.img.php' //接口url
        ,type: 'POST' //默认post
        ,async:true //异步上传
        ,data:{'type':'answer','userid':user.userid,'blogid':_id,'size':100}//回帖图像最大100kb
        }
      });

      //渲染编辑器
      index = layedit.build('textEdit', {tool: [
        'strong' //加粗
        ,'face' //表情
        ,'image' //插入图片
        // ,'link' //超链接 
        ,'code'      

        // ,'italic' //斜体
        // ,'underline' //下划线
        // ,'del' //删除线
        // ,'|' //分割线
        // ,'left' //左对齐
        // ,'center' //居中对齐
        // ,'right' //右对齐
        // ,'unlink' //清除链接
        // ,'help' //帮助
         // , 'html'
        ],height: 180
      });
      // 有些表单元素可能是动态插入的。这时 Form模块 的自动化渲染是会对其失效的,需要重新渲染
      form.render(); //更新
    },
    error:function (res) {
        console.log('fail:',res);
    }
  });

  //监听收藏按钮
  $('#collect-btn').on('click', function(){
    if (user.login=='false') {
      layer.alert("登录后才可以收藏！",{title:'提示'});
    }
    else
    if (collect=='false') {
      // 收藏帖子
      $.ajax({
        type:'POST',
        async:true,//异步
        url: "/api/blog/blog.collect.php",
        data:{"type":'set',"userid":user.userid,"blogid":_id},
        success: function (res) {
          console.log('blog.collect.php',res);
          layer.alert(res.msg,{title:'提示'});
          // 更改收藏按钮
          $('#collect-btn').text('取消收藏');
          collect='true';
        },
        error:function (res) {
            console.log('fail:',res);
        }
      });
    }
    else{
      // 取消收藏
      $.ajax({
        type:'POST',
        async:true,//异步
        url: "/api/blog/blog.collect.php",
        data:{"type":'cancel',"userid":user.userid,"blogid":_id},
        success: function (res) {
          console.log('blog.collect.php',res);
          layer.alert(res.msg,{title:'提示'});
          // 更改收藏按钮
          $('#collect-btn').text('收藏');
          collect='false';
        },
        error:function (res) {
            console.log('fail:',res);
        }
      });
    }
  });

  //监听回复按钮
  $('#btn_answer').on('click', function(){
    // 判断是否已经登陆
    if(user.login === "true")
    {
      //获取编辑器内容
      var str = layedit.getContent(index);
      if(str.length==0)
      {
        layer_msg('回复内容不能为空！');
      }
      else
      {
        // 毫米级时间戳
        var timestamp = (new Date()).valueOf();
        console.log('回复：','id:'+timestamp+'contents:'+str+'userid:'+user.userid+'toid:'+_id); 
        $.ajax({
          type:'POST',
          url: "/api/blog/answer.php",
          data:{'id':timestamp,'contents':str,'userid':user.userid,'toid':_id},
          //数据长度太长，放到data里通过post传送
          success: function (argument) {
           if (argument.resault=='success') {
              console.log(argument);
              layer.msg('回复成功！',{icon:1,time:800},function(){
                  window.location.reload();
                });
            }
            else{
              console.log(argument);
              layer_msg('回复失败:'+argument.msg,4);
            }
          },
          error:function (argument) {
            console.log(argument);
              layer_msg('回复失败！',4);
          }
        });
      }
    }
    else
    {
      layer_msg('登陆后回复！',1);
    }
  });

  // 获取回贴月榜
  $.ajax({
    type:'POST',
    async: true,
    url: "/api/blog/getsortlist.php",
    data:{"num":'12',"type":'answer'},
    success: function (res) {
      console.log('success:',res);
      //渲染数据
      var getTpl = Tpl_2.innerHTML;
      var view = document.getElementById('view_2');
      laytpl(getTpl).render(res, function(html){
        view.innerHTML = html;
      });
    },
    error:function (res) {
        console.log('fail:',res);
    }
  });

  // 获取最近热帖
  $.ajax({
    type:'POST',
    async: true,
    url: "/api/blog/getsortlist.php",
    data:{"num":'12',"type":'browse'},
    success: function (res) {
      console.log('success:',res);
      //渲染数据
      var getTpl = Tpl_3.innerHTML;
      var view = document.getElementById('view_3');
      laytpl(getTpl).render(res, function(html){
        view.innerHTML = html;
      });
    },
    error:function (res) {
        console.log('fail:',res);
    }
  });

  // 获取近期热议
  $.ajax({
    type:'POST',
    async: true,
    url: "/api/blog/getsortlist.php",
    data:{"num":'12',"type":'talk'},
    success: function (res) {
      console.log('success:',res);
      //渲染数据
      var getTpl = Tpl_4.innerHTML;
      var view = document.getElementById('view_4');
      laytpl(getTpl).render(res, function(html){
        view.innerHTML = html;
      });
    },
    error:function (res) {
        console.log('fail:',res);
    }
  });
});
</script>
</html>