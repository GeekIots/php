/* ----------------------------------
JS file for Discuz! x3.2 By 999test.cn
(C) 999test.cn
http://www.999test.cn
Design QQ  747983834
Design QQ  944459016
Design QQ  373372740
Design QQ  794918446
Design QQ 1029879682
update:2016-1-18 02:58
---------------------------------- */

function waterfall(v) {
	var v = typeof(v) == "undefined" ? {} : v;
	var column = 1;
	var totalwidth = typeof(v.totalwidth) == "undefined" ? 0 : v.totalwidth;
	var totalheight = typeof(v.totalheight) == "undefined" ? 0 : v.totalheight;
	var parent = typeof(v.parent) == "undefined" ? $("waterfall") : v.parent;
	var container = typeof(v.container) == "undefined" ? $("threadlist") : v.container;
	var maxcolumn = typeof(v.maxcolumn) == "undefined" ? 0 : v.maxcolumn;
	var space = typeof(v.space) == "undefined" ? 0 : v.space;
	var index = typeof(v.index) == "undefined" ? 0 : v.index;
	var tag = typeof(v.tag) == "undefined" ? "li" : v.tag;

	var columnsheight = typeof(v.columnsheight) == "undefined" ? [] : v.columnsheight;

	function waterfallMin() {
		var min = 0;
		var index = 0;
		if(columnsheight.length > 0) {
			min = Math.min.apply({}, columnsheight);
			for(var i = 0, j = columnsheight.length; i < j; i++) {
				if(columnsheight[i] == min) {
					index = i;
					break;
				}
			}
		}
		return {"value": min, "index": index};
	}
	function waterfallMax() {
		return Math.max.apply({}, columnsheight);
	}

	var mincolumn = {"value": 0, "index": 0};
	var totalelem = [];
	var singlewidth = 0;
	totalelem = parent.getElementsByTagName(tag);
	if(totalelem.length > 0) {
		column = Math.floor((container.offsetWidth + 40) / (totalelem[0].offsetWidth));
		if(maxcolumn && column > maxcolumn) {
			column = maxcolumn;
		}
		if(!column) {
			column = 1;
		}
		if(columnsheight.length != column) {
			columnsheight = [];
			for(var i = 0; i < column; i++) {
				columnsheight[i] = 0;
			}
			index = 0;
		}
		singlewidth = totalelem[0].offsetWidth + space;
		totalwidth = singlewidth * column - space - 40;
		for(var i = index, j = totalelem.length; i < j; i++) {
			mincolumn = waterfallMin();
			totalelem[i].style.position = "absolute";
			totalelem[i].style.left = singlewidth * mincolumn.index + "px";
			totalelem[i].style.top = mincolumn.value + "px";
			columnsheight[mincolumn.index] = columnsheight[mincolumn.index] + totalelem[i].offsetHeight + space;
			totalheight = Math.max(totalheight, waterfallMax());
			index++;
		}
		parent.style.height = totalheight + "px";
		parent.style.width = totalwidth + "px";
	}
	return {"index": index, "totalwidth": totalwidth, "totalheight": totalheight, "columnsheight" : columnsheight};
}
