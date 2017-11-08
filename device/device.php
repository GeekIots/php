<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>设备控制台 | 极客物联网</title>
  <!-- 腾讯地图 -->
  <script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script> 
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
                     <p>是否在线:</p>
                     </div>
                  </div>
                  <div class="col-md-7 dev_border_list_B">
                     <div class="dev_info_list">
                     <p>{{item.online}}</p>
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
  // 获取列表
  $.ajax({
    type:'GET',
    url: "/api/device/device.php",
    data:{"device":'switch',"type":'getlist',"userid":user_d.userid},
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
      url: "/api/device/device.php?device=switch&type=set&userid="+user_d.userid+"&id="+id+"&cmd="+cmd,
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
</script>