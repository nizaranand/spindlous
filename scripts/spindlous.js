home_vars = {
	url : "http://localhost/spindlous/" 
};

function positionPopup(e) {
	
	
	var xoffset = ( $(window).width() / 2 ) - ( e.width() / 2);
	
	xoffset = xoffset + 'px';
	
	e.css({'right': xoffset});
	
}

function refresh_page() {}

function username_check() {
	
	var username = $("#username").val().trim();
	var regexp = /^[a-zA-Z0-9-_]{4,32}$/;		
	
	if (username.search(regexp) == -1) {
	
		inputError($(".username"), "The username entered is invalid.  Usernames must be between 4 and 32 characters, with no spaces");
		return false;
	
	} else {
		
		for(i = 0; i < invalid_usernames.length(); i++) {
			if (username == invalid_usernames[i]) {
				inputError($(".username"), "The username entered is already in use");
				return false;
			}
		}

		var postData = { "username" : username };
		
		$.ajax({
			type: "POST",
			url: "http://localhost/spindlous/ajax/username_check",
			data: postData,
			success: function(data) {
				if (data == "exists") {
					inputError($(".username"), "That username is already in use");
					return false;
				}
			}
		});
			
	}
	
	return true;
	
}



function email_check() {
	
	var email = $("#email").val().trim();
	var regexp = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
	
	if(email.search(regexp) == -1) {
		
		inputError($(".email"), "The email entered is invalid.");
		return false;
		
	} else {
		
		var postData = { "email" : email };
		
		$.ajax({
			type: "POST",
			url: "http://localhost/spindlous/ajax/email_check",
			data: postData,
			success: function(data) {
				if (data == "exists") {
					inputError($(".email"), "That email is already in use");
					return false;
				}
			}
		});
	}
	
	return true;
}

function password_check() {
	
	var password = $("#password").val();
		
	for(i = 0; i < invalid_passwords.length(); i++) {
		if (password == invalid_usernames[i]) {
			inputError($(".password"), "Too easy.");
			return false;
		}
	}
	return true;
}

function inputError(element, error_msg) {
	
	element.html(error_msg);
	element.show();
	
}

function hideError(element) {

	element.hide();
	element.html(" ");

}

function tab_change(event, _this) {

	$("#tabs li").removeClass("menu-item");
	$("#tabs li").removeClass("active-menu-item");
	$("#tabs li").addClass("menu-item");
	$("#comments-tab").html("<a href='/' >Comments</a>");
	$("#shares-tab").html("<a href='/' >Shares</a>");
	$("#tags-tab").html("<a href='/' >Tags</a>");
	
	if ($(_this).attr("id") === "comments-tab") {
	
		$("#comments-tab").html("Comments");
		$("#comment-container").show();
		$("#shares-container").hide();
		$("#tags-container").hide();
	
	} else if ($(_this).attr("id") === "shares-tab") {
	
		$("#shares-tab").html("Shares");
		$("#comment-container").hide();
		$("#shares-container").show();
		$("#tags-container").hide();
	
	} else if ($(_this).attr("id") === "tags-tab") {
		
		$("#tags-tab").html("Tags");
		$("#comment-container").hide();
		$("#shares-container").hide();
		$("#tags-container").show();
	
	}
	
	$(_this).removeClass("menu-item");
	$(_this).addClass("active-menu-item");
	
	event.preventDefault();

}

var invalid_usernames = new Array( "admin", "administrator", "ajax", "api", "home", "login", "logout", "profile", "saved_links", "signup", "spool", "test", "iphone", "android" );

var invalid_passwords = new Array( "password", "test", "testing", "stupid", "spindlous", "123456", "secret" );

$(document).ready(function() {

	$(".active-menu-item").click(function(event) {
	
		tab_change(event, this);
		
	});

	$(".menu-item").click(function(event) {
		
		tab_change(event, this);
	
	});
	
	$(".upvote").click(function() {
		$(this).addClass("clicked_upvote");
		$(this).removeClass("upvote");
		$(this).next(".clicked_downvote").addClass("downvote");
		$(this).next(".clicked_downvote").removeClass("clicked_downvote");
		var sid = $(this).closest(".outer-comment-container").attr("id");
		$.ajax({
			type: "POST",
			url: "http://localhost/spindlous/ajax/upvote",
			data: { "sid" : sid },
			success: function(data) {
				
			}
		});
	});
	
	$(".downvote").click(function() {
		$(this).addClass("clicked_downvote");
		$(this).removeClass("downvote");
		$(this).prev(".clicked_upvote").addClass("upvote");
		$(this).prev(".clicked_upvote").removeClass("clicked_upvote");
		var sid = $(this).closest(".outer-comment-container").attr("id");
		$.ajax({
			type: "POST",
			url: "http://localhost/spindlous/ajax/downvote",
			data: { "sid" : sid },
			success: function(data) {
				
			}
		});
	});

	$('.new_comment').click(function() {
	
		$('.input_container').hide();	
		$(this).parent(".add_comment").prev('.input_container').show();
		
		if ( $(this).val() === "Save" ) {
		
			var body = $(this).closest(".add_comment_container").children('.input_container').children(".new_comment_input").val();
			
			if (body != "") {
				
				var postData = {
					
					"body"      : body,
					"published" : "true",
					"type"      : "comment",
					"parent"    : $("#parent_comment").val(),
					"root"      : $("#root_comment").val()
				
				}
			
				$.ajax({
					type: "POST",
					url: "http://localhost/spindlous/ajax/add_comment",
					data: postData,
					success: function(data) {
						$(this).closest('.new-comment-container').hide();
						
					}
				});

			}
		
		} else {
			$(this).val("Save");
		}
	
	});
	
	$('.reply').click(function(event) {
		$("#first_new_comment").val("New Comment");
		$('.input_container').hide();	
		$(this).prev('.input_container').show();
		event.preventDefault();
		$("#parent_comment").val($(this).closest(".outer-comment-container").attr("id"));
	});
	
	$('#body').focus(function() {
	
		$(this).attr("rows", "8");
	
	});
	
	$('.post-container').mouseover(function() {
	
		$(this).find(".comments").show();	
	});
	
	$('.post-container').mouseout(function() {
		
		$(this).find(".comments").hide();
		
	});
	
	$('.little-post-container').mouseover(function() {
	
		$(this).find(".little-comments").show();	
	});
	
	$('.little-post-container').mouseout(function() {
		
		$(this).find(".little-comments").hide();
		
	});

	$('.new').click(function(e) {
		positionPopup($('#post-form-container'));
		$('#post-form-container').show();
		e.preventDefault();
	});
	
	$('#close').click(function(e) {
		$('#post-form-container').hide();
		e.preventDefault();
	});
	
	$('#post-submit').click(function() {
		var published;
		
		if ($("#publish").attr('checked')) {
			published = "true";
		} else {
			published = "false";
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
			success: function(data) {
				$('#post-form-container').hide();
				refresh_page();
			}
		});
	});

	$('#username').change(function() {
		
		
		
	});
	
	$('#email').change(function() {
	
		
		
	});
	
	$('.image-preview').hide();
	
	
	$('#url').change(function() {
		
		var postData = { "url": $('#url').val() };
		
		var i = 0;
		
		$.ajax({
			type: "POST",
			url: "http://localhost/spindlous/ajax/website_scrape",
			data: postData,
			success: function(json) {
				var images = JSON.parse(json);
				
				$('.image-preview').show();
				$('#link-image').attr('src', images[i].src);
				$('#next-image').bind('click', function(event) {
					event.preventDefault();
					i++;
					
					if ( i > images.length) { 
						i = 0; 
					}
					
					$('#link-image').attr('src', images[i].src);
					
				});
				
				$('#prev-image').bind('click', function(event) {
					event.preventDefault();
					i--;
					
					if ( i < 0) { 
						i = images.length;
					}
					
					$('#link-image').attr('src', images[i].src);
					
				});
				
				
				
			}
		});
		
	});

	/******************* Users page ********************/

	$(".user-search-input").bind('keypress', function(event) {
		var code = (event.keyCode ? event.keyCode : event.which);
		var query = $(".user-search-input").val();
		if(code == 13 && query != "") {
			var rgx = /[^\w\.@-]/;
			query = query.replace(rgx, "");
			var url = document.URL;
			rgx = /page=[0-9]+&*/;
			url = url.replace(rgx, "");
			rgx = /&*search=[a-zA-Z0-9]+/;
			url = url.replace(rgx, "");
			rgx = /users\?/;
			if (url.match(rgx)) {
				rgx = /users\?./
				if (url.match(rgx)) {
					url = url + "&search=" + query;	
				} else {
					url = url + "search=" + query;
				}
			} else {
				url = url + "?search=" + query;
			}
			window.location = url;
		}
	});
	
});