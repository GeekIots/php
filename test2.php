
<!DOCTYPE html>
<html>
<head>
  <title>cookie测试</title>
  <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
</head>
<body>

</body>
</html>
<script type="text/javascript">
  $.cookie('the_cookie', 'the_value'); 
  console.log($.cookie('the_cookie'));

</script>