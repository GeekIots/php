<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Vue 测试实例 - 菜鸟教程(runoob.com)</title>
<script src="https://cdn.bootcss.com/vue/2.2.2/vue.min.js"></script>
</head>
<body>
<div id="app">
  {{alert('a')}}
  {{5+5}}<br>
  {{ ok ? 'YES' : 'NO' }}<br>
  {{ message.split('').reverse().join('') }}
  <div v-bind:id="'list-' + id">菜鸟教程</div>
</div>
  
<script>
new Vue({
  el: '#app',
  data: {
  ok: true,
    message: 'RUNOOB',
  id : 1
  }
})
</script>
</body>
</html>