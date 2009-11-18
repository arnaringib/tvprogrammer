// JavaScript Document
var last = "0";
$(document).ready(function(){
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
			data: ($(this).attr("name") + "=" + $(this).val() + "&cal=0")
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
		$.ajax({
			method: "get",
			url: "deleteFromCalender.php",
			data: ("id=" + $(this).val())
	   });								 
		alert('done');
	});
}