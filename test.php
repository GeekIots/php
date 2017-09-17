<?php include($_SERVER['DOCUMENT_ROOT'].'/common/header.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>测试页面 </title>
</head>
<body> 
<div class="main layui-clear">
<!-- 建立视图。用于呈现渲染结果。 -->
<div id="view"></div>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'].'/common/footer.php') ?>
</body>
<script>
  layui.use(['laytpl','jquery'],function(){
    var laytpl = layui.laytpl,$ = layui.jquery;
    //第三步：渲染模版
    var data = { //数据
      "num":10
      ,"title":"Layui常用模块"
      ,"list":[{"modname":"弹层","alias":"layer","site":"layer.layui.com"},{"modname":"表单","alias":"form"}]
    }
    var getTpl = demo.innerHTML
    ,view = document.getElementById('view');
    laytpl(getTpl).render(data, function(html){
      view.innerHTML = html;
    });
  });
</script>
</html>
<!-- 模板 -->
<script id="demo" type="text/html">
  {{# var i=0;}}
  {{#  for(i=0;i<d.num;i++){ }}
    <h3>{{ d.title }}</h3>
  {{#} }}
  <h3>{{ d.title }}</h3>
  <ul>
  {{# layui.each(d.list, function(index, item){ }}
    <li>
      <span>{{ item.modname }}</span>
      <span>{{ item.alias }}：</span>
      <span>{{ item.site || '' }}</span>
    </li>
  {{#  }); }}
  {{#  if(d.list.length === 0){ }}
    无数据
  {{#  } }} 
  </ul>
</script>