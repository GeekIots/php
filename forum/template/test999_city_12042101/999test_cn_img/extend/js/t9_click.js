/* ----------------------------------
JS file for Discuz! x3.2 By 999test.cn
(C) 999test.cn
http://www.999test.cn
Design QQ  747983834
Design QQ  944459016
Design QQ  373372740
Design QQ  794918446
Design QQ 1029879682
---------------------------------- */

jQuery(document).ready(function(){
	jQuery("#t9_um_btn").click(function(e){
		e.preventDefault();
		jQuery("#t9_um_btn").toggleClass("t9_um_btn_click");
		jQuery(".t9_um_area").toggleClass("t9_um_area_block")
	});
	jQuery("div#t9_um_btn").mouseup(function(){
		return false
	})
});
