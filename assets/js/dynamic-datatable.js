$(document).ready(function() {
    // // Define columns for DataTable
    // var columns = [
    //     { "data": "id", "visible": false }, // Hidden column
    //     { "data": "group_" }, // Group column
    //     { "data": "description" }, // Description column
    //     { "data": "time_from" }, // Time from column
    //     { "data": "time_to" }, // Time to column
    //     {
    //         "data": null, // Action column
    //         "render": function(data, type, row) {
    //             return '<button type="button" class="edit-shift modal-trigger btn btn-rounded btn-primary p-1 px-2" style="margin-right:10px; font-size:10px" data-bs-toggle="modal" data-bs-target="#modal_edit_shift" data-shift-id="' + data.id + '"><i class="fas fa-pencil m-r-5"></i>Edit</button><button type="button" class="delete-shift modal-trigger btn btn-rounded btn-danger p-1 px-2" style="margin-right:10px; font-size:10px" data-bs-toggle="modal" data-bs-target="#modal_delete_shift" data-shift-id="' + data.id + '" data-shift-label="' + data.group_ + '"><i class="fas fa-trash m-r-5"></i>Delete</button>';
    //         }
    //     }
    // ];

    // // Function to fetch data and initialize the DataTable
    // function initializeDataTable() {
    //     $("#dt_shifts").DataTable({
    //         "ajax": {
    //             "url": "fetch_shifts.php",
    //             "dataSrc": ""
    //         },
    //         "columns": columns
    //     });
    // }

    // // Function to fetch data from server
    // function fetchData() {
    //     $.ajax({
    //         url: "fetch_shifts.php",
    //         success: function(response) {
    //             // Handle success
    //             console.log("Data fetched successfully:", response);
    //             // Reinitialize DataTable with fetched data
    //             $("#dt_shifts").DataTable().ajax.reload();
    //         },
    //         error: function(xhr, status, error) {
    //             // Handle error
    //             console.error("Error fetching data:", error);
    //         }
    //     });
    // }

    // // Function to poll for updates
    // function pollForUpdates() {
    //     // Set the interval for polling in milliseconds (e.g., every 5 seconds)
    //     console.log("Polling for updates...");
    //     setInterval(function() {
    //         // Fetch data periodically
    //         fetchData();
    //     }, 5000); // Adjust the interval as needed
    // }

    // // Initialize DataTable when the document is ready
    // initializeDataTable();

    // // Start polling for updates
    // pollForUpdates();
});
