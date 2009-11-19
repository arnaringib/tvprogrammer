// JavaScript Document
var last = "0";
$(document).ready(function(){
	$.ajax({
		method: "get",
		url: "calender.php",
		beforeSend: function(){$("#calLoading").show("fast"); cleanOld();},
		complete: function(){ $("#calLoading").hide("fast");}, 
		success: function(html){
		$("#userCalender").show("slow");
		$("#userCalender").html(html);}
	});
	$.ajax({
		method: "get",
		url: "channels.php",
		data: "channel=0",
		beforeSend: function(){$("#loading").show("fast");},
		complete: function(){ $("#loading").hide("fast");}, 
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
						beforeSend: function(){$("#loading").show("fast");},
						complete: function(){ $("#loading").hide("fast");}, 
						success: function(html){
						$("#showCal").show("slow");
						$("#showCal").html(html);}
				    });
					last = $(this).val();
				}
           });
	});
});

function skjarEinn(){
	$('input:checked').each(function(){
		$.ajax({
			method: "get",
			url: "updateCalander.php",
			data: ($(this).attr("name") + "=" + $(this).val() + "&cal=2")
		});
	});
	alert('done');
}

function ruv(){
	$('input:checked').each(function(){
		$.ajax({
			method: "get",
			url: "updateCalander.php",
			data: ($(this).attr("name") + "=" + $(this).val() + "&cal=0&date=1")
		});
	});
	alert('done');
}

function stodTvo(){
	$('input:checked').each(function(){
		$.ajax({
			method: "get",
			url: "updateCalander.php",
			data: ($(this).attr("name") + "=" + $(this).val() + "&cal=1")
		});
	});
	alert('done');
}

function eyda(){
	$('input:checked').each(function(){
		var val = $(this).val();
		$("#userCalender").hide("slow");
	   	$.ajax({
			method: "get",
			url: "deleteFromCalender.php",
			data: ("id=" + $(this).val()),
			beforeSend: function(){$("#calLoading").show("fast");},
			complete: function(){ $("#calLoading").hide("fast");}, 
			success: function(html){
				$.ajax({
					method: "get",
					url: "calender.php"
				});
				$("#row"+val).hide(0);
				$("#row"+val+"2").hide(0);
				$("#userCalender").show("slow");}
	    });
	});

}
function getNext(){
		$.ajax({
			method:"get",
			url: "calender.php",
			data: "date=1",
			beforeSend: function(){$("#calLoading").show("fast");},
			complete: function(){ $("#calLoading").hide("fast");}, 
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
		beforeSend: function(){$("#calLoading").show("fast");},
		complete: function(){ $("#calLoading").hide("fast");}, 
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
		beforeSend: function(){$("#loading").show("fast");},
		complete: function(){ $("#loading").hide("fast");}, 
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
		beforeSend: function(){$("#loading").show("fast");},
		complete: function(){ $("#loading").hide("fast");}, 
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
		beforeSend: function(){$("#loading").show("fast");},
		complete: function(){ $("#loading").hide("fast");}, 
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
		beforeSend: function(){$("#loading").show("fast");},
		complete: function(){ $("#loading").hide("fast");}, 
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
		data: "date=1",
		beforeSend: function(){$("#loading").show("fast");},
		complete: function(){ $("#loading").hide("fast");}, 
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
		data: "date=2",
		beforeSend: function(){$("#loading").show("fast");},
		complete: function(){ $("#loading").hide("fast");}, 
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