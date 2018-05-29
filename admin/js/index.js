/**
 * Created by 佳玉 on 2017/4/25.
 */

$(document).ready(function() {
	//navList();
	timeRun();

	$("#fun").change( function() {
		var fun = $("#fun").val();
		if (fun == 0)
		{
			$("#url").css("display", "block");
			$("#videofile").css("display", "none");
		}
		else
		{
			$("#url").css("display", "none");
			$("#videofile").css("display", "block");
		}
	});

	var tablebox=$('.tablebox').find("table").attr("id");
	if(tablebox) {
		table(tablebox);
	}

	$("#news_wrapper").bind("DOMNodeInserted",function () {
		heightAuto();
	});

	heightAuto();
	selectWidth();
	setInterval(function() {
		timeRun();
	}, 1000);
});

$(window).resize(function () {
	heightAuto();
	selectWidth();
});

 //生成静态页
function createPage(url, id) {
	$.ajax({
		type:"get",
		url:"../" + url + ".php",
		data: {"create_id":id}
	});
	alert("生成成功！");
}

function getFileUrl(sourceId) {
	var url;
	if (navigator.userAgent.indexOf("MSIE")>=1) {					// IE
		url = document.getElementById(sourceId).value;
	} else if(navigator.userAgent.indexOf("Firefox")>0) {		// Firefox
		url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0));
	} else if(navigator.userAgent.indexOf("Chrome")>0) {		// Chrome
		url = window.URL.createObjectURL(document.getElementById(sourceId).files.item(0));
	}else{
		url = document.getElementById(sourceId).value;
	}
	return url;
}

function preImg(sourceId) {
	var url = getFileUrl(sourceId);
	$("#"+sourceId).next().val(url);
}

function navList() {
	//var off=false;
	$(".nav-list .dropdown-toggle").click(function(){
		if($(this).next().css("display")=="block"){			
			$(this).next().slideUp();
		}else{
			$(this).next().slideDown();
		}
		///off=!off;
	});
}

function heightAuto() {
	var height=$(window).height();
	var rightHeight=$(".main-content").height();
	var sidebarHeight=height-$(".navbar").height();
	$(".sidebar-box").css("height",sidebarHeight);
	if(sidebarHeight<rightHeight){
		$(".sidebar-box").css("height",rightHeight);
	}
}

function selectWidth() {
	var inputWidth=$("input[type=text]").width();
	$(".select, .select-long,.select p,.select .type-ul").css('width',inputWidth+20+"px");
}

function table(id) {
	$("#"+id).DataTable();
}

function timeRun() {
	var oTime =$("#time");
	var date = new Date();
	this.year= date.getFullYear();
	this.month=date.getMonth()+1;
	this.month=this.month < 10 ? "0" + this.month : this.month;
	this.day=date.getDate() < 10 ? "0" + date.getDate() : date.getDate();
	this.hour = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
	this.minute = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
	this.second = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
	oTime.html(this.year+"-"+this.month+"-"+this.day+" "+this.hour+':'+this.minute+':'+this.second);
}

