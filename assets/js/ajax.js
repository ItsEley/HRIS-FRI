/*Admin login*/
$("#login-form").submit(function(e) {
    e.preventDefault();
    var email = $("#email").val(); 
    var password = $("#password").val(); 
    
    var loginform = $(this).serialize();
    if (email !== "" && password !== "") {
        $.ajax({
            url: base_url + 'welcome/login',
            type: 'post',
            data: loginform,
            dataType: 'json',
            beforeSend: function() {
				$("#btn_login").attr('disabled', true);
                $("#login-form").attr('disabled', true).html("<div class = 'text-center'>Logging in ....<span class='fa fa-spinner fa-1x fa-spin'></span></div>");
            },
            success: function(response) {
		

				console.log("success : ",JSON.stringify(response));


                if (response.status === 0) {
                    $("#alert").html('<div class="alert alert-danger">' + response.message + '</div>');
                    $("#login-form").attr("disabled", false).html("Login");
					console.log("error");

                } else if(response.status === 1) {
                    // Check if response.user_type exists before calling toLowerCase()

					let department =  response.department.toLowerCase();

					if(department == "hr"){
						console.log('hr/dashboard')
						window.location = base_url + 'hr/dashboard';

					}else if(department == "sys-at"){
						// console.log('humanr/dashboard')

						// window.location = base_url + 'humanr/home';


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
				alert("Done");
				window.reload();
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

    var emp_id = $(this).data("emp-id"); // Use data() instead of attr() for data attributes
    console.log('Employee ID:', emp_id);

    // Use shorthand $.ajax method for cleaner code
    $.ajax({
        url: base_url + 'humanr/showUserdetails',
        type: 'POST',
        data: {'emp_id': emp_id },
        dataType: 'json', // Specify JSON data type for automatic parsing
        success: function(response) {
            console.log('Response:', response);

            if (response.status === "success") {
                var employee = response.data;

                // Populate form fields using object destructuring for cleaner code
                $("form#edit_employee input[name='emp_id']").val(employee.id);
                $("form#edit_employee input[name='fname']").val(employee.fname);
                $("form#edit_employee input[name='mname']").val(employee.mname || ''); // Handle null or undefined values
                $("form#edit_employee input[name='lname']").val(employee.lname);
                $("form#edit_employee input[name='nickn']").val(employee.nickn);
                $("form#edit_employee input[name='current_add']").val(employee.current_add);
                $("form#edit_employee input[name='perm_add']").val(employee.perm_add);
                $("form#edit_employee input[name='dob']").val(employee.dob);
                $("form#edit_employee input[name='religion']").val(employee.religion);
                $("form#edit_employee select[name='sex']").val(employee.sex);
                $("form#edit_employee select[name='civil_status']").val(employee.civil_status);

                // Handle select option for civil_status
                var civilStatusSelect = $("form#edit_employee select[name='civil_status']");
                civilStatusSelect.val(employee.civil_status);
                if (!civilStatusSelect.val()) {
                    civilStatusSelect.val('N/A');
                }

                $("form#edit_employee input[name='pob']").val(employee.pob);
                $("form#edit_employee input[name='email']").val(employee.email);
            } else {
                console.error('Error:', response.message); // Log error message
                // Handle error if necessary
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

// add announcement 
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
				location.reload();
			}else{
				alert(res.msg);
			}
		}
	})
})


//leave request
$("#leave_request").submit(function(e){
	e.preventDefault();
	var leaveRequest = $(this).serialize();
	$.ajax({
		url: base_url + 'leave_request',
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
		url: base_url + 'ob_request',
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
		url: base_url + 'outgoing_request',
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
		url: base_url + 'undertime_request',
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
		url: base_url + 'overtime_request',
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
		url: base_url + 'worksched_adjust',
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

//add roles
$("#addroles_dept").submit(function(e){
	e.preventDefault();
	var addDept = $(this).serialize();
	$.ajax({
		url: base_url + 'humanr/addroles',
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
//     $('.delete-employee-btn').on('click', function() {
//         var empId = $(this).data('emp-id');
//         $('#confirmDeleteBtn').attr('data-emp-id', empId);
//     });

//     $('#confirmDeleteBtn').on('click', function() {
//         var empId = $(this).data('emp-id');
//         // Make an AJAX call to delete employee with the empId
//         $.ajax({
//             url: base_url+'humanr/deleteEmployee', // Replace with your delete employee endpoint
//             type: 'POST',
//             data: {emp_id: empId},
//             success: function(response) {
//                 // Handle success response
//                 // For example, hide modal, refresh employee list, etc.
//                 $('#delete_employee').modal('hide');
//                 location.reload(); // Reload the page
//             },
//             error: function(xhr, status, error) {
//                 // Handle error
//             }
//         });
//     });
// });

$(document).ready(function() {
    // Handle click on initial delete confirmation button
    $('.delete-employee-btn').on('click', function() {
        var empId = $(this).data('emp-id');
        $('#confirm_delete').data('emp-id', empId).modal('show');
    });

    // Handle click on final delete confirmation button
    $('#confirmFinalDeleteBtn').on('click', function() {
        // Proceed with deletion
        var empId = $('#confirm_delete').data('emp-id');
        $.ajax({
            url: base_url+'humanr/deleteEmployee',
            type: 'POST',
            data: {emp_id: empId},
            success: function(response) {
                // Handle success response
                $('#confirm_delete').modal('hide');
                $('#delete_employee').modal('hide');
                location.reload(); // Reload the page
            },
            error: function(xhr, status, error) {
                // Handle error
            }
        });
    });
});

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

$(document).ready(function() {
	$('.hoverable-row').dblclick(function() {
		// Get the data from the clicked row
		var name = $(this).find('td:eq(0)').text();
		var dateFilled = $(this).find('td:eq(1)').text();
		var leaveType = $(this).find('td:eq(2)').text();
		var from = $(this).find('td:eq(3)').text();
		var to = $(this).find('td:eq(4)').text();
		var reason = $(this).find('td:eq(5)').text();
		var status = $(this).find('td:eq(6)').text();

		// Populate the modal fields with the retrieved data
		$('#modalName').text(name);
		$('#modalDateFilled').text(dateFilled);
		$('#modalLeaveType').text(leaveType);
		$('#modalFrom').text(from);
		$('#modalTo').text(to);
		$('#modalReason').text(reason);
		$('#modalStatus').text(status);

		// Open the modal
		$('#view_request').modal('show');
	});
});
