/*Admin login*/
$("#login-form").submit(function(e) {
    e.preventDefault();
    var email = $("#email").val(); 
    var password = $("#password").val(); 
    
    var loginform = $(this).serialize();
    if (email !== "" && password !== "") {
        $.ajax({
            url: base_url + 'welcome/auth_form',
            type: 'post',
            data: loginform,
            dataType: 'json',
            beforeSend: function() {
                $("#login-form").attr('disabled', true).html("Logging in ....<span class='fa fa-spinner fa-1x fa-spin'></span>");
            },
            success: function(response) {
		

				console.log("success : ",JSON.stringify(response));


                if (response.status == 'error') {
                    $("#alert").html('<div class="alert alert-danger">' + response.message + '</div>');
                    $("#login-form").attr("disabled", false).html("Login");
				console.log("error");

                } else {
                    // Check if response.user_type exists before calling toLowerCase()

					let department =  response.department.toLowerCase();

					if(department == "hr"){
						console.log('hr/dashboard')
						window.location = base_url + 'hr/dashboard';

					}else if(department == "sys-at"){
						console.log('humanr/dashboard')

						window.location = base_url + 'humanr/home';


					}else{
						console.log('employee/dashboard')

						window.location = base_url + 'employee/dashboard';	
					}
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

$(document).ready(function() {
    $('#openSecondModalBtn').on('click', function() {
        var formData = $('#adduser').serializeArray();

        $.each(formData, function(index, field) {
            switch (field.name) {
                case 'fname':
                case 'mname':
                case 'lname':
                case 'email':
                case 'password':
                    $('#exampleModalToggle2').find('[name="' + field.name + '"]').val(field.value);
                    break;
                default:
                    break;
            }
        });

        $('#add_employee').modal('hide');
        $('#exampleModalToggle2').modal('show');
    });

    $('#add_employee_submit').on('click', function() {
        var capturedImageSrc = $('#capturedImageContainer img').attr('src');
        var byteString = atob(capturedImageSrc.split(',')[1]);
        var mimeString = capturedImageSrc.split(',')[0].split(':')[1].split(';')[0];
        var ab = new ArrayBuffer(byteString.length);
        var ia = new Uint8Array(ab);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }
        var blob = new Blob([ab], { type: mimeString });

        var formData = new FormData($('#adduser')[0]);
        formData.append('capturedImage', blob, 'capturedImage.png');

        $.ajax({
            url: base_url + 'adduser',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle success if needed
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Handle errors more effectively, e.g., show an error message to the user
            }
        });
    });
});


// Use delegated event handler for form submission
$(document).on("submit", "#edit_employee", function(e) {
    e.preventDefault();

    // Serialize form data
    var editemployee = $(this).serialize();

    // Log serialized form data
    console.log("Serialized Form Data:", editemployee);

    // Send AJAX request
    $.ajax({
        url: base_url + 'humanr/updateUser',
        type: 'post',
        data: editemployee,
        dataType: 'json',
        success: function(res) {
            if (res.status === 1) {
                alert(res.msg);
            } else {
                alert(res.msg);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
});

$(document).on("click", ".dropdown-item.edit-employee", function(e) {
    e.preventDefault();

    var emp_id = $(this).attr("data-emp-id");
    // Log emp_id to ensure it's correctly retrieved
    console.log('Employee ID:', emp_id);

    $.ajax({
        url: base_url + 'humanr/showUserdetails',
        type: 'POST',
        data: {'emp_id': emp_id },
        success: function(employee) {
            console.log('Response:', employee);
            employee = JSON.parse(employee);

            if (employee.status == "success") {
                console.log(employee.data)

                // Populate form fields
                $("form#edit_employee input[name='emp_id']").val(employee.data.id);
                $("form#edit_employee input[name='fname']").val(employee.data.fname);
                if (employee.data.mname != null || employee.data.mname != undefined) {
                    $("form#edit_employee input[name='mname']").val(employee.data.mname);
                }
                $("form#edit_employee input[name='lname']").val(employee.data.lname);
                $("form#edit_employee input[name='nickn']").val(employee.data.nickn);
                $("form#edit_employee input[name='current_add']").val(employee.data.current_add);
                $("form#edit_employee input[name='perm_add']").val(employee.data.perm_add);
                $("form#edit_employee input[name='dob']").val(employee.data.dob);
                $("form#edit_employee input[name='religion']").val(employee.data.religion);
                $("form#edit_employee select[name='sex']").val(employee.data.sex);
                $("form#edit_employee select[name='civil_status']").val(employee.data.civil_status);
                // Handle select option for civil_status

                $("form#edit_employee select[name='civil_status'] > option").each(function() {
                    if (employee.data.civil_status == $(this).val()) {
                        $("form#edit_employee select[name='civil_status']").val(employee.data.civil_status);
                        return false;
                    }
                });

                if ($("form#edit_employee select[name='civil_status']").val() === null) {
                    $("form#edit_employee select[name='civil_status']").val('N/A');
                }

                $("form#edit_employee input[name='pob']").val(employee.data.pob);
                $("form#edit_employee input[name='email']").val(employee.data.email);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
            // Handle AJAX error if necessary
        }
    });
});



// $(".avatar.profile_view").click(function(e) {
//     var emp_id = $(this).data("emp-id");

//     // Declare a variable to store employee data
//     var employeeData;

//     // AJAX request to fetch employee details
//     $.ajax({
//         url: base_url + 'humanr/showUserdetails',
//         type: 'GET',
//         dataType: 'json',
//         data: { emp_id: emp_id },
//         success: function(employee) {
//             // Assign employee data to the variable
//             employeeData = employee;

//             // Populate profile view with employee data
//             populateProfileView(employeeData);
//         },
//         error: function(xhr, status, error) {
//             console.error(error);
//             // Handle error if necessary
//         }
//     });

//     // Function to populate profile view with employee data
//     function populateProfileView(employee) {
//         $('.profile-img img').attr('src', employee.pfp);
//         $('.user-name').text(employee.fullname);
//         // $('.text-muted.department').text(employee.department);
//         // $('.text-muted.role').text(employee.role);
//         $('.staff-id').text('Employee ID: ' + employee.id);
//         $('.personal-info .phone .text a').text(employee.contact_no);
//         $('.personal-info .email .text a').text(employee.email);
//         $('.personal-info .birthday .text').text(employee.dob);
//         $('.personal-info .address .text').text(employee.current_add);
//         $('.personal-info .sex .text').text(employee.sex);
//     }
// });


$("#add_announcement").submit(function(e){
	e.preventDefault();
	var addAnnounce = $(this).serialize();
	$.ajax({
		url: base_url + 'humanr/add_announce',
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
		url: base_url + 'humanr/add_dept',
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

// $(document).ready(function() {
//     // Function to save the captured image
//     function saveCapturedImage() {
//         // Get the source of the captured image
//         var imageSource = $("#capturedImage")[0].src;

//         // Create a dummy anchor element to trigger download
//         var link = document.createElement('a');
//         link.href = imageSource;
//         link.download = 'captured_image.png'; // Set the download filename

//         // Trigger the download
//         link.click();
//     }

//     // Event listener for the capture button
//     $('#captureButton').on('click', function() {
//         // Check if the captured image is available
//         if ($("#capturedImage").attr('src')) {
//             // Save the captured image
//             saveCapturedImage();
//         } else {
//             console.error('No captured image available.');
//             // Handle case where no image is captured
//         }
//     });

//     // Event listener for the submit button
//     $('#add_employee_submit').on('click', function() {
//         // Check if the captured image is available
//         if ($("#capturedImage").attr('src')) {
//             // Save the captured image
//             saveCapturedImage();
//         } else {
//             console.error('No captured image available.');
//             // Handle case where no image is captured
//         }
//     });
// });
