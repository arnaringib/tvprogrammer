// JavaScript Document
var last = "0";
var popupStatus = 0;
var popupLoading = 0
var popupCalLoading = 0;
var popupChannelLoading = 0;
$(document).ready(function(){
	$("showInfo").hide(0);
	$("showChannelInfo").hide(0);
	$("#last").hide("slow");
	$("#next").hide("slow");
	$.ajax({
		method: "get",
		url: "calender.php",
		beforeSend: function(){calLoading(); cleanOld();},
		complete: function(){ calLoadingExit();}, 
		success: function(html){
		$("#last").show("slow");
		$("#next").show("slow");
		$("#userCalender").show("slow");
		$("#userCalender").html(html);}
	});
	$.ajax({
		method: "get",
		url: "channels.php",
		data: "channel=0",
		beforeSend: function(){ loading();},
		complete: function(){ loadingExit();}, 
		success: function(html){
		$("#showCal").show("slow");
		$("#showCal").html(html);}
    });
	$("#channel").change(function(){
		  $("select option:selected").each(function(){
				if(last != $(this).val()){
					$("#showCal").hide("slow");
	            	$.ajax({
						method: "get",
						url: "channels.php",
						data: "channel=" + $(this).val(),
						beforeSend: function(){loading();},
						complete: function(){ loadingExit();}, 
						success: function(html){
						$("#showCal").show("slow");
						$("#showCal").html(html);}
				    });
					last = $(this).val();
				}
           });
	});
	$(document).keypress(function(e){  
		if(e.keyCode==27 && popupStatus==1){  
			showInfoExit(); 
		} 
		if(e.keyCode==27 && popupShowChannelInfo==1){  
			showInfoChannelExit(); 
		} 
	});
});

function skjarEinn(){
	$('input:checked').each(function(){
		$.ajax({
			method: "get",
			url: "updateCalander.php",
			data: ("id=" + $(this).val() + "&date="+ $(this).attr("name") +  "&cal=2"),
			beforeSend: function(){uploading();},
			complete: function(){ uploadingExit();}
		});
	});
}

function ruv(){
	$('input:checked').each(function(){
		$.ajax({
			method: "get",
			url: "updateCalander.php",
			data: ("id=" + $(this).val() + "&date="+ $(this).attr("name") + "&cal=0"),
			beforeSend: function(){uploading();},
			complete: function(){ uploadingExit();}
		});
	});
}

function stodTvo(){
	$('input:checked').each(function(){
		$.ajax({
			method: "get",
			url: "updateCalander.php",
			data: ("id=" + $(this).val() + "&date="+ $(this).attr("name") +  "&cal=1"),
			beforeSend: function(){uploading();},
			complete: function(){ uploadingExit();}
		});
	});
}

function eyda(){
	$('input:checked').each(function(){
		var val = $(this).val();
		$("#userCalender").hide("slow");
	   	$.ajax({
			method: "get",
			url: "deleteFromCalender.php",
			data: ("id=" + $(this).val()),
			beforeSend: function(){calLoading();},
			complete: function(){ calLoadingExit();}, 
			success: function(html){
				$.ajax({
					method: "get",
					url: "calender.php"
				});
				$("#row"+val).hide(0);
				$("#row2"+val).hide(0);
				$("#userCalender").show("slow");}
	    });
	});

}
function getNext(){
		$.ajax({
			method:"get",
			url: "calender.php",
			data: "date=1",
			beforeSend: function(){calLoading();},
			complete: function(){ calLoadingExit();}, 
			success: function(html){
				$("#userCalender").hide("slow");
				$("#userCalender").show("slow");
				$("#userCalender").html(html);
			}
			
		});
        
   }
function getLast(){
	$.ajax({
		method:"get",
		url: "calender.php",
		data: "date=2",
		beforeSend: function(){calLoading();},
		complete: function(){ calLoadingExit();}, 
		success: function(html){
			$("#userCalender").hide("slow");
			$("#userCalender").show("slow");
			$("#userCalender").html(html);
		}
	});
    
}
function getNextRuv(){
	$("#showCal").hide("slow");
	$.ajax({
		method:"get",
		url: "sRuv.php",
		data: "date=1",
		beforeSend: function(){loading();},
		complete: function(){ loadingExit();}, 
		success: function(html){
			$("#showCal").show("slow");
			$("#showCal").html(html);
		}
		
	});
    
}
function getLastRuv(){
	$("#showCal").hide("slow");
	$.ajax({
		method:"get",
		url: "sRuv.php",
		data: "date=2",
		beforeSend: function(){loading();},
		complete: function(){ loadingExit();}, 
		success: function(html){
			$("#showCal").show("slow");
			$("#showCal").html(html);
		}
		
	});
    
}
function getNextSkjarEinn(){
	$("#showCal").hide("slow");
	$.ajax({
		method:"get",
		url: "sSkjarEinn.php",
		data: "date=1",
		beforeSend: function(){loading();},
		complete: function(){ loadingExit();}, 
		success: function(html){
			$("#showCal").show("slow");
			$("#showCal").html(html);
		}
		
	});
    
}
function getLastSkjarEinn(){
	$("#showCal").hide("slow");
	$.ajax({
		method:"get",
		url: "sSkjarEinn.php",
		data: "date=2",
		beforeSend: function(){loading();},
		complete: function(){loadingExit();}, 
		success: function(html){
			$("#showCal").show("slow");
			$("#showCal").html(html);
		}
		
	});
    
}
function getNextStod2(){
	$("#showCal").hide("slow");
	$.ajax({
		method:"get",
		url: "sStod2.php",
		data: "date=1&" + $("index").val(),
		beforeSend: function(){loading();},
		complete: function(){ loadingExit();}, 
		success: function(html){
			$("#showCal").show("slow");
			$("#showCal").html(html);
		}
		
	});
    
}
function getLastStod2(){
	$("#showCal").hide("slow");
	$.ajax({
		method:"get",
		url: "sStod2.php",
		data: "date=2&" + $("index").val()*-1,
		beforeSend: function(){loading();},
		complete: function(){loadingExit();}, 
		success: function(html){
			$("#showCal").show("slow");
			$("#showCal").html(html);
		}
	});
    
}
function cleanOld(){
		$.ajax({
			method: "get",
			url: "cleanCalender.php"
		});
}

function showInfoOpen(){  
	//loads popup only if it is disabled  
	if(popupStatus==0){  
		$("#showInfo").fadeIn("slow");
		popupStatus = 1;
	}
}

function showInfoExit(){  
	if(popupStatus==1){  
		$("#showInfo").fadeOut("slow");  
		popupStatus = 0;
	}  
}

function centerShowInfo(){  
	var windowWidth = document.documentElement.clientWidth;  
	var windowHeight = document.documentElement.clientHeight;  
	var popupHeight = $("#showInfo").height();  
	var popupWidth = $("#showInfo").width();  
	
	$("#showInfo").css({  
		"position": "fixed",  
		"top": windowHeight/2-popupHeight/2,  
		"left": windowWidth/2-popupWidth/2  
	}); 
}  

function showInfo(id){
	$("#showInfo").hide("slow");
	$.ajax({
		method: "get",
		url: "getShowInfo.php",
		data: "id="+id,
		success: function(html){
			$("#showInfo").show("slow");
			$("#showInfo").html(html);}
		});
	showInfoOpen();
	centerShowInfo();
}

function showInfoChannels(date, id, cal){
	$("#showChannelInfo").hide("slow");
	$.ajax({
		method: "get",
		url: "getShowInfoChannels.php",
		data: ("id="+id+"&date=" + date + "&cal=" + cal),
		success: function(html){
			$("#showChannelInfo").show("slow");
			$("#showChannelInfo").html(html);}
		});
	showChannelInfoOpen();
	centerShowChannelInfo();
}

function showChannelInfoOpen(){  
	//loads popup only if it is disabled  
	if(popupChannelLoading==0){  
		$("#showChannelInfo").fadeIn("slow");
		popupChannelLoading = 1;
	}
}

function showChannelInfoExit(){ 
	if(popupChannelLoading==1){  
		$("#showChannelInfo").fadeOut("slow");  
		popupChannelLoading = 0;
	}  
}

function centerShowChannelInfo(){  
	var windowWidth = document.documentElement.clientWidth;  
	var windowHeight = document.documentElement.clientHeight;  
	var popupHeight = $("#showChannelInfo").height();  
	var popupWidth = $("#showChannelInfo").width();  
	
	$("#showChannelInfo").css({  
		"position": "fixed",  
		"top": windowHeight/2-popupHeight/2,  
		"left": windowWidth/2-popupWidth/2  
	}); 
}  

function loadingOpen(){  
	if(popupLoading==0){  
		$("#loading").fadeIn("slow");
		popupLoading = 1;
	}
}

function loadingExit(){  
	if(popupLoading==1){  
		$("#loading").fadeOut("slow");  
		popupLoading = 0;
	}  
}

function uploadingOpen(){  
	if(popupLoading==0){  
		$("#uploading").fadeIn("slow");
		popupLoading = 1;
	}
}

function uploadingExit(){  
	if(popupLoading==1){  
		$("#uploading").fadeOut("slow");  
		popupLoading = 0;
	}  
}

function centerLoading(){  
	var windowWidth = document.documentElement.clientWidth;  
	var windowHeight = document.documentElement.clientHeight;  
	var popupHeight = $("#loading").height();  
	var popupWidth = $("#loading").width();  
	$("#loading").css({  
		"position": "fixed",  
		"top": windowHeight/2-popupHeight/2,  
		"left": windowWidth/2-popupWidth/2  
	}); 
}  

function centerUploading(){  
	var windowWidth = document.documentElement.clientWidth;  
	var windowHeight = document.documentElement.clientHeight;  
	var popupHeight = $("#uploading").height();  
	var popupWidth = $("#uploading").width();  
	$("#uploading").css({  
		"position": "fixed",  
		"top": windowHeight/2-popupHeight/2,  
		"left": windowWidth/2-popupWidth/2  
	}); 
} 

function loading(){
	loadingOpen();
	centerLoading();
}

function uploading(){
	uploadingOpen();
	centerUploading();
}

function calLoadingOpen(){  
	if(popupCalLoading==0){  
		$("#calLoading").fadeIn("slow");
		popupCalLoading = 1;
	}
}

function calLoadingExit(){  
	if(popupCalLoading==1){  
		$("#calLoading").fadeOut("slow");  
		popupCalLoading = 0;
	}  
}

function centerCalLoading(){  
	var windowWidth = document.documentElement.clientWidth;  
	var windowHeight = document.documentElement.clientHeight;  
	var popupHeight = $("#calLoading").height();  
	var popupWidth = $("#calLoading").width();  
	
	$("#calLoading").css({  
		"position": "fixed",  
		"top": windowHeight/2-popupHeight/2,  
		"left": windowWidth/2-popupWidth/2  
	}); 
}  

function calLoading(){
	calLoadingOpen();
	centerCalLoading();
}