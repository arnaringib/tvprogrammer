// JavaScript Document
$(document).ready(function(){
	var last = "0";
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
				}
           });
	});
});
				
									