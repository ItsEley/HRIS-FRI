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
                $("#login-form").attr('disabled', true).html("<div class='text-center'>Logging in ....<span class='fa fa-spinner fa-1x fa-spin'></span></div>");
            },
            success: function(response) {
                console.log("success : ", response);

                if (response.status === 1) {
                    let department = response.department;

                    if (response.acro_dept === 'HR') {
                        console.log('Redirecting to HR dashboard');
                        window.location.href = base_url + 'hr/dashboard';
                    } else if (response.acro_dept === 'SALES') {
                        console.log('Redirecting to Employee dashboard');
                        window.location.href = base_url + 'employee/dashboard';
                    } else {
                        console.log('No matching department found for redirection');
                    }
                
                } else if (response.status === 0 ) {
                    $("#alert").html('<div class="alert alert-danger">' + response.message + '</div>');
                    $("#login-form").attr("disabled", false).html("Login");
                    console.log("error");
                }
            },
            error: function(response) {
                console.log("failed : ");
                console.log("failed", response);
            }
        })
    } else {
        swal({
            title: 'All Fields are REQUIRED !',
            type: 'warning',
            confirmButtonClass: 'btn btn-success',
        });
    }
});

function fetchNotifications() {
    $.ajax({
        url: base_url + "humanr/fetch_notifications",
        type: 'GET',
        dataType: 'json', // Specify that the response should be treated as JSON
        success: function(response) {
            // Update the notification list HTML
            $('#notification-list').html(response.html);
            // Update the notification count badge with the total rows count
            $('#notification-count').text(response.total_rows);
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText); // Log any errors to the console for debugging
        }
    });
}



// Call fetchNotifications function every 2 seconds
setInterval(fetchNotifications, 2000); 

// $(document).ready(function () {
//     fetchNotificationsCount();

//     function fetchNotificationsCount() {
//         $.ajax({
//             url: '/get-notifications-count',
//             type: 'GET',
//             success: function (response) {
//                 var unreadCount = response.unreadCount;
//                 $('.badge').text(unreadCount);
//             },
//             error: function (xhr, status, error) {
//                 console.error(xhr.responseText);
//             }
//         });
//     }
// });

// $(document).ready(function () {
//     function handleApproveButtonClick(buttonId, rowIdFieldId, empIdFieldId, approvalEndpoint) {
//         $(buttonId).click(function (event) {
//             event.preventDefault();
//             var rowId = $(rowIdFieldId).val();
//             $('#approveModalRowId').text(rowId);
//             $('#approveModalRowIdTable').text(rowId); 
//             $('#approveModal').modal('show'); 
//             $('#confirmApproveHr').data('row-id', rowId); 
//             $('#confirmApproveHr').data('approval-endpoint', approvalEndpoint);
//         });
//     }
//     function handleConfirmationClick(confirmButtonId, modalId) {
//         $(confirmButtonId).click(function () {
//             var rowId = $('#confirmApproveHr').data('row-id');
//             var approvalEndpoint = $('#confirmApproveHr').data('approval-endpoint');
//             $.ajax({
//                 type: "POST",
//                 url: base_url + approvalEndpoint,
//                 data: {
//                     row_id: rowId
//                 },
//                 success: function (response) {
//                     alert(response);
//                 }
//             });

//             $(modalId).modal('hide');
//         });
//     }
//     handleApproveButtonClick('#og_approveButtonHr', '#og_id', '#employee_id', 'humanr/hrapprove');
//     handleApproveButtonClick('#ot_approveButtonHr', '#ot_id', '#employee_id', 'humanr/hrapprove');
//     handleConfirmationClick('#confirmApproveHr', '#approveModal');

//     handleConfirmationClick('#confirmDenyHr', '#denyModal');
// });

$(document).ready(function () {
    // Function to handle approve button clicks
    function handleApproveButtonClick(buttonId, rowIdFieldId, empIdFieldId) {
        $(buttonId).click(function (event) {
            event.preventDefault();
            $('#approveModal').modal('show');
            var rowId = $(rowIdFieldId).val();
            $('#approveModalRowId').val(rowId); // Update the input value with rowId
            $('#confirmApproveHr').attr('data-source', buttonId.substring(1));
            $('#confirmApproveHr').attr('data-row-id', rowId); // Assign rowId to data attribute
        });
    }
    

    handleApproveButtonClick('#og_approveButtonHr', '#og_id', '#employee_id');
    handleApproveButtonClick('#leave_approveButtonHr', '#leave_id', '#leave_employee_id');
    handleApproveButtonClick('#ot_approveButtonHr', '#ot_id', '#ot_employee_id');
    handleApproveButtonClick('#ut_approveButtonHr', '#ut_id', '#ut_employee_id');
    handleApproveButtonClick('#ob_approveButtonHr', '#ob_id', '#ob_employee_id');

    function handleDenyButtonClick(buttonId, rowIdFieldId, empIdFieldId) {
        $(buttonId).click(function (event) {
            event.preventDefault();
            console.log("Deny button clicked"); // Check if the button click is registered
            $('#denyModal').modal('show');
            var rowId = $(rowIdFieldId).val();
            console.log('Row ID:', rowId); // Check if rowId is correctly fetched
            $('#denyModalRowId').val(rowId); // Update the value of the input with rowId
            $('#confirmDenyHr').attr('data-source', buttonId.substring(1));
            $('#confirmDenyHr').attr('data-row-id', rowId); // Assign rowId to data attribute
        });
    }
    
    
    // Handle deny button clicks for different actions
    handleDenyButtonClick('#og_denyButtonHr', '#og_id', '#employee_id');
    handleDenyButtonClick('#leave_denyButtonHr', '#leave_id', '#leave_employee_id');
    handleDenyButtonClick('#ot_denyButtonHr', '#ot_id', '#ot_employee_id');
    handleDenyButtonClick('#ut_denyButtonHr', '#ut_id', '#ut_employee_id');
    handleDenyButtonClick('#ob_denyButtonHr', '#ob_id', '#ob_employee_id');

    // Function to handle confirmation of approve or deny action
    function handleConfirmationClick(confirmButtonId, modalId) {
        $(confirmButtonId).click(function () {
            var rowId;
            var empId;
            var source = $(this).attr('data-source'); // Get the source value
            rowId = $(this).attr('data-row-id'); // Get the rowId from the data attribute
    
            // Determine empId based on the source
            if (source.includes('approveButton')) {
                empId = $(modalId).find('.employee-id').val();
            } else if (source.includes('denyButton')) {
                empId = $(modalId).find('.employee-id').val();
            }
    
            console.log('Row ID:', rowId);
            console.log('Source:', source);
    
            // Perform AJAX request
            $.ajax({
                type: "POST",
                url: base_url + 'humanr/hrapprove',
                data: {
                    row_id: rowId,
                    emp_id: empId,
                    source: source
                },
                success: function (response) {
                    console.log('Response:', response); // Log the response
                    alert(response);
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error); // Log any errors
                }
            });
    
            $(modalId).modal('hide');
        });
    }
    
    
    // Handle confirmation of approve action
    handleConfirmationClick('#confirmApproveHr', '#approveModal');
    // Handle confirmation of deny action
    handleConfirmationClick('#confirmDenyHr', '#denyModal');
});
/// HEAD APPROVAL START

$(document).ready(function () {
    // Function to handle approve button clicks
    function handleApproveButtonClick(buttonId, rowIdFieldId, empIdFieldId) {
        $(buttonId).click(function (event) {
            event.preventDefault();
            $('#approveModal').modal('show');
            var rowId = $(rowIdFieldId).val();
            $('#approveModalRowId').text(rowId); // Update the content of the span with rowId
            $('#confirmApprove').attr('data-source', buttonId.substring(1));
            $('#confirmApprove').attr('data-row-id', rowId); // Assign rowId to data attribute
        });
    }
    

    handleApproveButtonClick('#og_approveButton', '#og_id', '#employee_id');
    handleApproveButtonClick('#leave_approveButton', '#leave_id', '#leave_employee_id');
    handleApproveButtonClick('#ot_approveButton', '#ot_id', '#ot_employee_id');
    handleApproveButtonClick('#ut_approveButton', '#ut_id', '#ut_employee_id');
    handleApproveButtonClick('#ob_approveButton', '#ob_id', '#ob_employee_id');

    function handleDenyButtonClick(buttonId, rowIdFieldId, empIdFieldId) {
        $(buttonId).click(function (event) {
            event.preventDefault();
            $('#denyModal').modal('show');
        
           
            var rowId = $(rowIdFieldId).val();
            $('#denyModalRowId').text(rowId); // Update the content of the span with rowId
            $('#confirmDeny').attr('data-source', buttonId.substring(1));
            $('#confirmDeny').attr('data-row-id', rowId); // Assign rowId to data attribute
        });
    }

    // Handle deny button clicks for different actions
    handleDenyButtonClick('#og_denyButton', '#og_id', '#employee_id');
    handleDenyButtonClick('#leave_denyButton', '#leave_id', '#leave_employee_id');
    handleDenyButtonClick('#ot_denyButton', '#ot_id', '#ot_employee_id');
    handleDenyButtonClick('#ut_denyButton', '#ut_id', '#ut_employee_id');
    handleDenyButtonClick('#ob_denyButton', '#ob_id', '#ob_employee_id');

    // Function to handle confirmation of approve or deny action
    function handleConfirmationClick(confirmButtonId, modalId) {
        $(confirmButtonId).click(function () {
            var rowId;
            var empId;
            var source = $(this).attr('data-source'); // Get the source value
            rowId = $(this).attr('data-row-id'); // Get the rowId from the data attribute
    
            // Determine empId based on the source
            if (source.includes('approveButton')) {
                empId = $(modalId).find('.employee-id').val();
            } else if (source.includes('denyButton')) {
                empId = $(modalId).find('.employee-id').val();
            }
    
            console.log('Row ID:', rowId);
            console.log('Source:', source);
    
            // Perform AJAX request
            $.ajax({
                type: "POST",
                url: base_url + 'humanr/headapprove',
                data: {
                    row_id: rowId,
                    emp_id: empId,
                    source: source
                },
                success: function (response) {
                    alert(response);
                }
            });
    
            $(modalId).modal('hide');
        });
    }
    
    // Handle confirmation of approve action
    handleConfirmationClick('#confirmApprove', '#approveModal');
    // Handle confirmation of deny action
    handleConfirmationClick('#confirmDeny', '#denyModal');
});
/// HEAD APPROVAL END


$("#import_csv").submit(function(e) {
    e.preventDefault();

        var form_data = new FormData($('#import_csv')[0]);

        $.ajax({
            type: 'POST',
            url: base_url+'humanr/import', // Assuming your controller's method is named import()
            data: form_data,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response);
                // window.location.reload(); // Reload the page after successful import
            },
            error: function(xhr, status, error) {
                alert('An error occurred while processing the request.');
                console.error(xhr.responseText);
            }
        });
    });

	$(document).ready(function() {
    $('#exportBtn').click(function(e) {
        e.preventDefault(); // Prevent default anchor behavior

        // Make AJAX request to export CSV
        $.ajax({
            type: 'GET',
            url: base_url + 'humanr/export_csv',
            success: function(response) {
                // Create a Blob object from the CSV data
                var blob = new Blob([response], { type: 'text/csv' });

                // Create a temporary anchor element to trigger the download
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'employee_data.csv'; // Set the file name

                // Append the anchor element to the document body and trigger the download
                document.body.appendChild(link);
                link.click();

                // Clean up resources after download
                window.URL.revokeObjectURL(link.href);
                document.body.removeChild(link);
            },
            error: function(xhr, status, error) {
                alert('An error occurred while processing the request.');
                console.error(xhr.responseText);
            }
        });
    });
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
$(document).on("submit", "#leave_req_det", function(e) {
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
                $("form#edit_employee input[name='contact_no']").val(employee.contact_no);

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




//leave request
$("#leave_request1").submit(function(e){
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

$("#ob_request1").submit(function(e){
	e.preventDefault();
	var obRequest = $(this).serialize();
	$.ajax({
		url: base_url + 'employee/C_off_buss1',
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

$("#outgoing_request1").submit(function(e){
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

$("#ot_request1").submit(function(e){
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


