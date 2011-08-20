function positionPopup(e) {
	
	var yoffset = ( $(window).height() / 2 ) - ( e.height() / 2);
	var xoffset = ( $(window).width() / 2 ) - ( e.width() / 2);
	
	yoffset = yoffset + 'px';
	xoffset = xoffset + 'px';
	
	e.css({'top' : yoffset, 'right': xoffset});
	
}


$(document).ready(function(){

	$('.new').click(function(e){
		positionPopup($('#post-form-container'));
		$('#post-form-container').show();
		e.preventDefault();
	});
	
	$('#close').click(function(e){
		$('#post-form-container').hide();
		e.preventDefault();
	});
	
	$('#post-submit').click(function(){
		var published
		
		if ($("#publish").attr('checked')) {
			published = "true"
		} else {
			published = "false"
		}
		
		var postData = {
			            "url"       : $("#url").val(),
		                "title"     : $("#title").val(),
		                "body"      : $("#body").val(),
		                "tags"      : $("#tags").val(),
		                "published" : published,
		                "type"      : $("#type").val(),
		                "parent"    : $("#parent").val(),
		                "root"      : $("#root").val()
		               };
		
		
		$.ajax({
			type: "POST",
			url: "http://localhost/spindlous/ajax/add_post",
			data: postData,
			success: function(data){
				$('#post-form-container').hide();
				alert(data);
			}
		});
	});	
});