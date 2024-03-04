/*Admin login*/
$("#login-form").submit(function(e){
	e.preventDefault();
	var loginform = $(this).serialize();
	if (email !="" & password !="") {
		$.ajax({
			url: base_url + 'admin/auth_form',
			type: 'post',
			data: loginform,
			dataType: 'json',
			beforeSend: function() {
				$("#login-form").attr('disabled', true).html("Logging in ....<span class='fa fa-spinner fa-1x fa-spin'></span>");
			},
			success: function(res) {
				if (res.status === 'error') {						
					$("#alert").html('<div class="alert alert-danger">'+res.message+'</div>');
					$("#login-form").attr("disabled", false).html("Login");
				}else{	
					
					window.location = base_url + 'hr/dashboard';


					// if(res.role === 'HR'){
					// 	window.location = base_url + 'hr/dashboard';
					// }else{
					// 	window.location = base_url + 'hr/dashboardss';
					// }


					
				}
			}
		})
	}	else {			
		swal(
		{
			title: 'All Field are REQUIRED !',	                    
			type: 'warning',	                    
			confirmButtonClass: 'btn btn-success',	                    
		}
	);
	}	
})
/*Admin login*/