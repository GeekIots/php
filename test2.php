<!DOCTYPE html>
<html>
<head>
<!-- <meta charset="utf-8"> -->
<title>菜鸟教程(runoob.com)</title>
<!-- <script src="http://static.runoob.com/assets/vue/1.0.11/vue.min.js"></script> -->
</head>
<body>
<div id="app">
  {{ message }}
</div>
<!-- JavaScript 代码需要放在尾部（指定的HTML元素之后） -->
<script>
// new Vue({
//     el:'#app',
//     data: {
//         message:'Hello World!'
//     }
// });



	function showImg( url ) {
	        var frameid = 'frameimg' + Math.random();
	        window.img = '<img id="img" src=\''+url+'?'+Math.random()+'\' /><script>window.onload = function() { parent.document.getElementById(\''+frameid+'\').height = document.getElementById(\'img\').height+\'px\'; }<'+'/script>';
	        document.write('<iframe id="'+frameid+'" src="javascript:parent.img;" frameBorder="0" scrolling="no" width="100%"></iframe>');
	}
// 　　调用方式：

showImg('http://d.hiphotos.baidu.com/image/pic/item/d52a2834349b033b58ef816c1fce36d3d539bd24.jpg');
</script>
</body>
</html>
