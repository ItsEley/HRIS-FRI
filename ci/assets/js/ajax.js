/*Admin login*/
$("#login-form").submit(function(e) {
    e.preventDefault();
    var email = $("#email").val(); 
    var password = $("#password").val(); 
    
    var loginform = $(this).serialize();
    if (email !== "" && password !== "") {
        $.ajax({
            url: base_url + 'admin/auth_form',
            type: 'post',
            data: loginform,
            dataType: 'json',
            beforeSend: function() {
                $("#login-form").attr('disabled', true).html("Logging in ....<span class='fa fa-spinner fa-1x fa-spin'></span>");
            },
            success: function(response) {
		

				console.log("success : ",response);

                if (response.status == 'error') {
                    $("#alert").html('<div class="alert alert-danger">' + response.message + '</div>');
                    $("#login-form").attr("disabled", false).html("Login");
				console.log("error");

                } else {

					

                    // Check if response.user_type exists before calling toLowerCase()
					var userTypeLower = '';
					if (response.user_type !== null && response.user_type !== undefined) {
						userTypeLower = response.user_type.toLowerCase();
					}
					
					if(userTypeLower == '0') {
						window.location = base_url + 'admin/home';

					}else if (userTypeLower == '1') {
						window.location = base_url + 'hr/dashboard';

					}else {
						window.location = base_url + 'employee/home';

						// Handle default case if necessary
					}
					 
				console.log("success : ",userTypeLower);


                   
                }
            },
			failed: function(response) {
				console.log("failed : ");

				console.log("failed", response)
			}
        })
    } else {
        swal({
            title: 'All Field are REQUIRED !',
            type: 'warning',
            confirmButtonClass: 'btn btn-success',
        });
    }
});


/*Admin login*/
$("#adduser").submit(function(e){
	e.preventDefault();
	var adduser = $(this).serialize();
	console.log("errrp", adduser);

	$.ajax({
		url: base_url + 'adduser',
		type: 'post',
		data: adduser,
		dataType: 'json',
		success: function(res){
			if(res.status === 1){
				alert(res.msg);
			console.log("success ",adduser);

			}else{
				alert(res.msg);
			console.log("errrp", adduser);

			}
		}
		
	})
})
/*Edit user*/
$("#edituser").submit(function(e){
	e.preventDefault();
	var edituser = $(this).serialize();
	$.ajax({
		url: base_url + 'admin/updateUser',
		type: 'post',
		data: edituser,
		dataType: 'json',
		success: function(res){
			if(res.status === 1){
				alert(res.msg);
			}else{
				alert(res.msg);
			}
		}
	})
})
$(".dropdown-item.edit-employee").click(function(e) {
    // Prevent default behavior of the link
    e.preventDefault();

    // Get emp_id from the clicked link
    var emp_id = $(this).data("emp-id");

    // AJAX request to fetch employee details
    $.ajax({
        url: base_url + 'admin/showUserdetails',
        type: 'GET',
        dataType: 'json',
        data: { emp_id: emp_id },
        success: function(employee) {
            // Populate modal fields with employee data
            $('#edit_employee input[name="fname"]').val(employee.fname);
            $('#edit_employee input[name="mname"]').val(employee.mname);
            $('#edit_employee input[name="lname"]').val(employee.lname);
            $('#edit_employee input[name="nickn"]').val(employee.nickn);
            $('#edit_employee input[name="current_add"]').val(employee.current_add);
            $('#edit_employee input[name="perm_add"]').val(employee.perm_add);
            $('#edit_employee input[name="age"]').val(employee.age);
            $('#edit_employee input[name="religion"]').val(employee.religion);
            $('#edit_employee select[name="sex"]').val(employee.sex);
            $('#edit_employee select[name="civil_status"]').val(employee.civil_status);
            $('#edit_employee input[name="pob"]').val(employee.pob);
            $('#edit_employee input[name="dob"]').val(employee.dob);
            $('#edit_employee input[name="pfp"]').val(employee.pfp);
            $('#edit_employee input[name="email"]').val(employee.email);
            $('#edit_employee input[name="password"]').val(employee.password);

            // Show the modal
            $('#edit_employee').modal('show');
        },
        error: function(xhr, status, error) {
            console.error(error);
            // Handle error if necessary
        }
    });
});

$(".avatar.profile_view").click(function(e) {
    var emp_id = $(this).data("emp-id");

    // Declare a variable to store employee data
    var employeeData;

    // AJAX request to fetch employee details
    $.ajax({
        url: base_url + 'admin/showUserdetails',
        type: 'GET',
        dataType: 'json',
        data: { emp_id: emp_id },
        success: function(employee) {
            // Assign employee data to the variable
            employeeData = employee;

            // Populate profile view with employee data
            populateProfileView(employeeData);
        },
        error: function(xhr, status, error) {
            console.error(error);
            // Handle error if necessary
        }
    });

    // Function to populate profile view with employee data
    function populateProfileView(employee) {
        $('.profile-img img').attr('src', employee.pfp);
        $('.user-name').text(employee.fullname);
        // $('.text-muted.department').text(employee.department);
        // $('.text-muted.role').text(employee.role);
        $('.staff-id').text('Employee ID: ' + employee.id);
        $('.personal-info .phone .text a').text(employee.contact_no);
        $('.personal-info .email .text a').text(employee.email);
        $('.personal-info .birthday .text').text(employee.dob);
        $('.personal-info .address .text').text(employee.current_add);
        $('.personal-info .sex .text').text(employee.sex);
    }
});


$("#add_announcement").submit(function(e){
	e.preventDefault();
	var addAnnounce = $(this).serialize();
	$.ajax({
		url: base_url + 'admin/add_announce',
		type: 'post',
		data: addAnnounce,
		dataType: 'json',
		success: function(res){
			if(res.status === 1){
				alert(res.msg);
			}else{
				alert(res.msg);
			}
		}
	})
})

$("#leave_request").submit(function(e){
	e.preventDefault();
	var leaveRequest = $(this).serialize();
	$.ajax({
		url: base_url + 'leaverequestzz',
		type: 'post',
		data: leaveRequest,
		dataType: 'json',
		success: function(response){
			if(response.status === 1){
				alert(response.msg);
				
			}else{
				alert(response.msg);
			}
		}
	})
})


$("#ob_request").submit(function(e){
	e.preventDefault();
	var obRequest = $(this).serialize();
	$.ajax({
		url: base_url + 'ob_requestzz',
		type: 'post',
		data: obRequest,
		dataType: 'json',
		success: function(response){
			if(response.status === 1){
				alert(response.msg);
			}else{
				alert(response.msg);
			}
		}
	})
})



$("#outgoing_request").submit(function(e){
	e.preventDefault();
	var outgoingRequest = $(this).serialize();
	$.ajax({
		url: base_url + 'outgoingrequestzz',
		type: 'post',
		data: outgoingRequest,
		dataType: 'json',
		success: function(response){
			if(response.status === 1){
				alert(response.msg);
			}else{
				alert(response.msg);
			}
		}
	})
})

$("#undertime_request").submit(function(e){
	e.preventDefault();
	var udtRequest = $(this).serialize();
	$.ajax({
		url: base_url + 'undertimerequestzz',
		type: 'post',
		data: udtRequest,
		dataType: 'json',
		success: function(response){
			if(response.status === 1){
				alert(response.msg);
			}else{
				alert(response.msg);
			}
		}
	})
})


$("#ot_request").submit(function(e){
	e.preventDefault();
	var overtimeRequest = $(this).serialize();
	$.ajax({
		url: base_url + 'overtimerequestzz',
		type: 'post',
		data: overtimeRequest,
		dataType: 'json',
		success: function(response){
			if(response.status === 1){
				alert(response.msg);
			}else{
				alert(response.msg);
			}
		}
	})
})


$("#ws_adjustment").submit(function(e){
	e.preventDefault();
	var worksched = $(this).serialize();
	$.ajax({
		url: base_url + 'workschedadjustzz',
		type: 'post',
		data: worksched,
		dataType: 'json',
		success: function(response){
			if(response.status === 1){
				alert(response.msg);
			}else{
				alert(response.msg);
			}
		}
	})
})



$("#adddepartment").submit(function(e){
	e.preventDefault();
	var addDept = $(this).serialize();
	$.ajax({
		url: base_url + 'admin/add_dept',
		type: 'post',
		data: addDept,
		dataType: 'json',
		success: function(res){
			if(res.status === 1){
				alert(res.msg);
			}else{
				alert(res.msg);
			}
		}
	})
})

$("#addassets").submit(function(e){
	e.preventDefault();
	var addAssets = $(this).serialize();
	$.ajax({
		url: base_url + 'add_assets',
		type: 'post',
		data: addAssets,
		dataType: 'json',
		success: function(res){
			if(res.status === 1){
				alert(res.msg);
			}else{
				alert(res.msg);
			}
		}
	})
})

