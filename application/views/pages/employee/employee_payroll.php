<div class="main-wrapper">
  <?php $this->load->view('templates/nav_bar'); ?>
  <?php $this->load->view('templates/sidebar'); ?>
  <div class="page-wrapper w-100">
    <!-- Page Content -->
    <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="page-title">Payroll</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="admin-dashboard.html">HR</a></li>
              <li class="breadcrumb-item active">Payroll List</li>
            </ul>
          </div>

          <div class="col-auto float-end ms-auto">
            <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#payroll"><i class="fa-solid fa-plus"></i> Add Payroll</a>
          </div>
        </div>
      </div>
      <div class="row timeline-panel">
        <div class="col-md-12">
          <div class="table-responsive">
            <table id="dt_announcements" class="datatable table-striped custom-table mb-0 datatable table-sm">
              <thead>
                <tr>
                  <th>Payroll Cut-off</th>
                  <th>Date Created</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
$sql = "SELECT * FROM payroll GROUP BY cutoff_start";
$payroll_list = $this->db->query($sql)->result();
foreach ($payroll_list as $row) {
    echo "<tr>
              <td>" . date('F j, Y', strtotime($row->cutoff_start)) . " - " . date('F j, Y', strtotime($row->cutoff_end)) . "</td>
              <td>" . date('F j, Y', strtotime($row->date_created)) . "</td>
              <td>
                  <a href='" . base_url("payroll_emp/payslip?start_date=" . $row->cutoff_start . "&end_date=" . $row->cutoff_end) . "' class='btn btn-primary btn-sm generate-payslip' data-cutoff-start='" . $row->cutoff_start . "' data-cutoff-end='" . $row->cutoff_end . "'>Generate Payslip</a>
              </td>
          </tr>";
}
?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    // Click event for generating payslip
    $('.generate-payslip').click(function(e) {
        e.preventDefault();
        var start_date = $(this).data('cutoff-start');
        var end_date = $(this).data('cutoff-end');

        $.ajax({
            type: "GET",
            url: base_url + 'payroll_emp/show_emp_payslip',
            data: {
                start_date: start_date,
                end_date: end_date
            },
            dataType: 'json',
            success: function(response) {
                // Log the received data to the console
                console.log("Start Date: " + start_date);
                console.log("End Date: " + end_date);
                console.log("Response: ", response);

                // Assuming payroll_id is present in the response data
                var payroll_id = response.payroll_id;

                // Perform AJAX request to view/edit payslip
                $.ajax({
                    url: base_url + 'payroll_hr/view_payslip',
                    type: 'post',
                    data: {
                      empid: payroll_id
                    },
                    dataType: 'json',
                    success: function(res) {
                        $(".empname").html('Payslip for ' + res.name);
                        $(".payslip").html(res.output);
                        $('#mymodal').modal('show');
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log any errors to the console
            }
        });
    });
});

</script>
