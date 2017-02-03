$(document).ready(function(){
	
	$('#show').on("click", function(){
		$('#hidden').css("display", "block");
		$('#hiddenName').text($('#name').val());
		$('#hiddenEmail').text($('#email').val());
		$('#hiddenTask').text($('#task').val());
	});
	
	$('#close').on("click", function(){
		alert(1);
	});
	
});