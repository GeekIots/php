// 预定义全局变量
var layer,laydate,laypage,laytpl,layim,layedit,form,upload,tree,table,element,util,flow,carousel,code,$,mobile;
// 加载需要的模块
// layui.use(['layer','laydate','laypage','laytpl','layim','layedit','form','upload','tree','table','element','util','flow','carousel','code','jquery','mobile'], function(){
//     layer = layui.layer;
//     laydate = layui.laydate;
//     laypage = layui.laypage;
//     laytpl = layui.laytpl;
//     layim = layui.layim;
//     layedit = layui.layedit;
//     form = layui.form;
//     upload = layui.upload;
//     tree = layui.tree;
//     table = layui.table;
//     element = layui.element;
//     util = layui.util;
//     flow = layui.flow;
//     carousel = layui.carousel;
//     code = layui.code;
//     $  = layui.jquery;
//     mobile = layui.mobile;
// });
;!function(){
  layer = layui.layer;
  laydate = layui.laydate;
  laypage = layui.laypage;
  laytpl = layui.laytpl;
  // layim = layui.layim;
  layedit = layui.layedit;
  form = layui.form;
  upload = layui.upload;
  // tree = layui.tree;
  table = layui.table;
  element = layui.element;
  util = layui.util;
  // flow = layui.flow;
  // carousel = layui.carousel;
  // code = layui.code;
  $  = layui.jquery;
  // mobile = layui.mobile;
}();

//获取url中的参数
function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r != null) return unescape(r[2]); return null; //返回参数值
}

//全局ajax设置为同步方式
$.ajaxSetup({
  async: false //同步
});

