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

  <!-- 富文本编辑器 -->
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
  <!-- END -->
</head>
<body>
  <?php require($_SERVER['DOCUMENT_ROOT'].'/common/header.php'); ?>
  <form action="">
    <div class="main layui-clear">
      <div class="fly-panel" pad20>
        <h2 class="page-title">发表新帖</h2>
        <div class="layui-form layui-form-pane">
            <div class="layui-form-item">
              <label for="L_title" class="layui-form-label">标题</label>
              <div class="layui-input-block">
                <input type="text" id="L_title" name="title" required lay-verify="required" autocomplete="off" class="layui-input">
              </div>
            </div>
            <div class="layui-form-item layui-form-text">
              <div class="layui-input-block">
                <!-- <textarea id="demo" name="content"  placeholder="请输入内容" class="layui-textarea fly-editor" style="height: 260px;"></textarea> -->
                <div id="summernote"><p placeholder="请输入内容！"></p></div>
              </div>
              <label for="L_content" class="layui-form-label" style="top: -2px;">描述</label>
            </div>
            <div class="layui-form-item">
              <div class="layui-inline">
                <label class="layui-form-label">所在类别</label>
                <div class="layui-input-block">
                  <select lay-verify="required" id="select_id" name="class">
                    <option></option>
                    <option value="Stm32" >Stm32</option> 
                    <option value="Arduino" >Arduino</option> 
                    <option value="Raspberry Pi" >Raspberry Pi</option> 
                    <option value="Other" >Other</option> 
                  </select>
                </div>
              </div>
              <div class="layui-inline">
                <label for="L_vercode" class="layui-form-label">人类验证</label>
                <div class="layui-input-inline">
                  <input type="text" id="L_vercode" name="vercode" required lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid">
                  <span style="color: #c00;">1+1=?</span>
                </div>
              </div>
            </div>
           <!--   -->
            <div class="layui-form-item">
              <button class="layui-btn" lay-filter="publish-btn" lay-submit>立即发布</button>
            </div>
        </div>
      </div>
    </div>
  </form>
  <?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
</body>
<script>
  // 毫米级时间戳
  var timestamp = (new Date()).valueOf(); 
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

    // 有些表单元素可能是动态插入的。这时 Form模块 的自动化渲染是会对其失效的,需要重新渲染
    // form.render(); //更新
  
    // 富文本编辑器
    $('#summernote').summernote({  
        height: "200px",  
        callbacks: {  
          onImageUpload: function(files) { //the onImageUpload API  
          img = sendFile(files[0]);  
        }  
      }  
    });  

    // 上传图片到后台
    function sendFile(file) {  
      data = new FormData();  
      data.append("file", file);
      data.append("type", 'blog');
      data.append("userid", user.userid);
      data.append("blogid", timestamp);
      console.log('data:',data);  
      $.ajax({  
          data: data,  
          type: "POST",  
          url: "/api/upload/upload.img.php",
          async: true,   
          cache: false,  
          contentType: false,  
          processData: false,  
          success: function(url) {
            if (url.code==0) {
              $("#summernote").summernote('insertImage', url.data.src, url.data.title);
            }  
            else
            {
              layer_msg(url.msg);
              console.log(url.msg);
            }
            layer_msg(url.msg);
            console.log('url:',url);
          }  
      });  
    }

    //监听发布
    form.on('submit(publish-btn)', function(data){
      // layer.msg(JSON.stringify(data.field));
      // console.log(data.field);
      // console.log(layedit.getContent(index));
      // var content = layedit.getContent(index);
      var content = $('#summernote').summernote('code');
      //判断帖子内容
      if(!content)
      {
        layer_msg('帖子内容不能为空！');
      }
      //判断验证码
      else if(data.field.vercode!='2')
      {
        layer_msg('验证信息不正确！');
      }
      else
      {
        $.ajax({
          type:'POST',
          url: "/api/blog/new.php",
          async: true, 
          data:{'id':timestamp,'title':data.field.title,'contents':content,'classify':data.field.class,'userid':user.userid},
           success: function (argument) {
            if (argument.resault=='success') {
              layer.msg('发布成功！');
              window.location.href='/blog/view.php?id='+timestamp;
            }
            else{
              console.log("错误：",argument);
              layer_msg('发布失败：'+argument.msg,4);
            }
          },
          error:function (argument) {
            console.log(argument);
            layer_msg('发布失败!',4);
          }
        });
      }    
      return false;
    });
  });
</script>
</html>