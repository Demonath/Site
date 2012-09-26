$(document).ready(function(){
	$("#auth_login, #auth_password").live("keyup",function(event){
		if(event.keyCode==13)$("#send_auth").click();
	});
	
	$("#send_auth").live("click", function(){
		var error=false;
		if($("#auth_login").val()==''){
			$("#auth_login").parent(".control-group").removeClass("error");
			$("#auth_login").parent(".control-group").addClass("error");
			error=true;
		}
		if($("#auth_password").val()==''){
			$("#auth_password").parent(".control-group").removeClass("error");
			$("#auth_password").parent(".control-group").addClass("error");
			error=true;
		}
		if(error)return false;
		$.ajax({
			  url: "/admin/auth/login",
			  type: "POST",
			  data: ({"login":$("#auth_login").val(),"password":$("#auth_password").val()}),
			  async: true,
			  success: function(json) {
						if(json!=''){
							if(json.success=='true'){
								document.location.href="/admin/";
							}else{
								$("#auth_login, #auth_password").parent(".control-group").removeClass("error");
								$("#auth_login, #auth_password").parent(".control-group").addClass("error");
							}	
						}
			  }
		});		
		return false;
	});	
	
	$("#user_logout").live("click", function(){

		$.ajax({
			  url: "admin/auth/logout",
			  type: "POST",
			  data: ({}),
			  async: true,
			  success: function(json) {
						if(json!=''){
							if(json.success='true')document.location.href='/';
						}
			  }
		});		
		return false;
	});








});