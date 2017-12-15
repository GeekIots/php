<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>设备控制台 | 极客物联网</title>
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
  <!-- 引入 Bootstrap -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <style type="text/css">
      .dev_border_Top{
        border-top: 1px solid #000;
      }
      .dev_title_color{
        background: lightgray;
        padding-left: 2em;
      }
      .dev_border_Light_Right{
        border-left: 1px solid #000;
        border-right: 1px solid #000;
      }
      .dev_title{
      border:1px solid #000;
      border-left: 1px;
      }
      .first_dev_title{
      border:1px solid #000;
      }
      .dev_button{
      width: 120px;
      height: 55px;   
      border-radius: 5px;
      margin: 54px 10px 54px 5px;
      font-size: 25px;
      }
      .dev_icon{
      width: 140px;
      height: 143px;  
      border-radius: 5px;
      margin: 10px 10px 10px 10px;
      }
      .dev_info_list{
        /*width: 120px;*/
        height: 20px;
        border-radius: 5px;
        /*background-color: red;*/
        margin: 10px 10px 10px 10px;
        font-size: 16px;
        color: #696969;
      }
      .dev_border_list_B{
        border-bottom: 1px solid #000;
      }
      .dev_border_list_R{
        border-right: 1px solid #000;
      }
      .dev_border_list_BR{
        border-bottom: 1px solid #000;
        border-right: 1px solid #000;
      }
      .dev_message{
        text-align: center;
        line-height: 120px;
        font-size: 30px;
        color: orange;
        padding-top:20px;
      }
  </style>
</head>
<body>
  <?php require($_SERVER['DOCUMENT_ROOT'].'/common/header.php'); ?>
  <script id="moduel" type="text/html">
    {{#  layui.each(switchlist.list, function(index, item){ }}
      <div class="container" style="margin-left: 8%;padding-top: 10px;padding-bottom: 10px;">
         <div class="row">
            <div class="col-md-2 first_dev_title">
               <div class="row dev_title_color">
                <h4>{{item.name}}</h4>
               </div>
               <div class="row dev_border_Top" style="text-align: center;">
            <img src="{{item.pic}}" class="dev_icon" onerror="javascript:this.src='/image/default/error.jpg';">
               </div>
            </div>

            <div class="col-md-5 dev_title">
               <div class="row dev_title_color" style="">
                <h4 style="float: left;">控制设备</h4> 
                <h4 style="float: right;margin-right: 10px;" id="msg{{item.id}}"></h4> 
               </div>
               <div class="row dev_border_Top" >
                  <div class="col-md-4">
                     <button type="button" id="{{item.id}}" name="{{item.opencmd}}" class="dev_button btn btn-default">打开</button>
                  </div>
                  <div class="col-md-4 dev_border_Light_Right">
                     <button type="button" id="{{item.id}}" name="{{item.closecmd}}" class="dev_button btn btn-default">关闭</button>
                  </div>
                  <div class="col-md-4 dev_message">
                     <p id="state{{item.id}}">{{item.state}}</p>
                  </div>
               </div>
            </div>
            <div class="col-md-4 dev_title">
               <div class="row dev_title_color">
                <h4>设备信息</h4>
               </div>
               <div class="row dev_border_Top">
                  <div class="col-md-5 dev_border_list_BR">
                     <div class="dev_info_list">
                     <p>设备ID:</p>
                     </div>
                  </div>
                  <div class="col-md-7 dev_border_list_B">
                     <div class="dev_info_list">
                     <p>{{item.id}}</p>
                     </div>
                  </div>
               </div>
                <div class="row">
                  <div class="col-md-5 dev_border_list_BR">
                     <div class="dev_info_list">
                     <p>控制次数:</p>
                     </div>
                  </div>
                  <div class="col-md-7 dev_border_list_B" >
                     <div class="dev_info_list">
                     <p id="heat{{item.id}}">{{item.heat}}</p>
                     </div>
                  </div>
               </div>
             
           <div class="row">
                  <div class="col-md-5 dev_border_list_BR">
                     <div class="dev_info_list">
                     <p>最近操作:</p>
                     </div>
                  </div>
                  <div class="col-md-7 dev_border_list_B">
                     <div class="dev_info_list">
                     <p id="latest{{item.id}}">{{item.latest}}</p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-5 dev_border_list_R">
                     <div class="dev_info_list">
                     <p>创建时间:</p>
                     </div>
                  </div>
                  <div class="col-md-7 ">
                     <div class="dev_info_list">
                     <p>{{item.created}}</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        </div>
    {{#  }); }}
  </script>
  <!-- 建立视图。用于呈现模板渲染结果。 -->
  <div id="view"></div>
  <?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
</body>
</html> 
<script>
  // 开关列表
  var switchlist;
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
      if (user.login=='false') {
     //公告层
      layer.open({
        type: 1
        ,title: false //不显示标题栏
        ,closeBtn: false
        ,area: '300px;'
        ,shade: 0.8
        ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
        ,btn: ['前去登陆', '看看再说']
        ,btnAlign: 'c'
        ,moveType: 1 //拖拽模式，0或者1
        ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 400;">亲,进入设备控制需要登陆哦！</div>'
        ,success: function(layero){
          var btn = layero.find('.layui-layer-btn');
          btn.find('.layui-layer-btn0').attr({
            href: '/user/login.php'
            ,target: '_blank'
          });
          btn.find('.layui-layer-btn1').attr({
            href: '/index.php'
          });
        }
      });
    }
    else
    {
      // 获取列表
      $.ajax({
        type:'GET',
        async: false, //同步
        url: "/api/device/device.php",
        data:{"device":'switch',"type":'getlist',"userid":user.userid},
        success: function (res) {
          switchlist  = res;
          console.log('switchlist:',res);

        },
        error:function (res) {
          console.log('fail:',res);
        }
      });

      //渲染数据
      var getTpl = moduel.innerHTML;
      var view = document.getElementById('view');
      laytpl(getTpl).render(switchlist, function(html){
        view.innerHTML = html;
      });

      //所有的button引起的变化
      $(":button").bind("click",function(){
        var wait;
        var stop=false;
        get_code_time = function (o) { 
          if (!stop) {
            // o.text('响应:'+wait/100+'s');
            o.text(wait/100+'s');
                wait++;  
                setTimeout(function() {  
                    get_code_time(o)  
                }, 10)  
          }
        }  
        //打印引起事件的标签信息
        console.log('click:', this);
        var id = $(this).attr('id');
        var cmd = $(this).attr('name');
        console.log('id:', id);
        console.log('cmd:', cmd);
        // $("#msg"+id).text("等待响应...");
        wait = 0;
        stop=false;
        get_code_time($("#msg"+id));
          // 发送指令并等待响应
          $.ajax({
          async: true,
          url: "/api/device/device.php?device=switch&type=set&userid="+user.userid+"&id="+id+"&cmd="+cmd,
          success: function (res) {
            console.log('success:',res);
            stop=true;
            $("#msg"+id).text(res.return+' '+$("#msg"+id).text());
            $("#heat"+id).text(parseInt($("#heat"+id).text())+1);
            $("#latest"+id).text(res.latest);
            $("#state"+id).text(cmd);
          },
          error:function (res) {
            console.log('fail:',res);
            $("#msg"+id).text(res.return);
            stop=true;
          }
        });
      }); 
    } 
  }); 
</script>