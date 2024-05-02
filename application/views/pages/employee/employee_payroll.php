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
            <h3 class="page-title">My Payslip</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="admin-dashboard.html">Employee</a></li>
              <li class="breadcrumb-item active">Payslips List</li>
            </ul>
          </div>

          
        </div>
      </div>
      <div class="row timeline-panel">
        <div class="col-md-12">
          <div class="table-responsive">
            <table id="dt_payslips" class="datatable table-striped custom-table mb-0 datatable table-sm">
              <thead align="center">
                <tr>
                  <th>Employee Name</th>
                  <!-- <th>Payroll ID</th> -->
                  <th>Cutoff Period</th>
                  <th>Date Created</th>
                  <th>Gross Pay</th>
                  <th>Total Deductions</th>
                  <th>Net Pay</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                <?php
                // Assuming the session ID is stored in $_SESSION['id2']
                $session_id = $_SESSION['id2'];

                // Prepare the combined SQL query
                $sql = "SELECT 
                p.*,
                e.employee_id AS employeeID,
                e.fname,
                e.lname,
                e.id AS empID,
                (p.cutoff_salary + p.allowance + p.ot_pay + p.night_differential + p.special_holiday) AS gross_pay,
                (p.pagibig + COALESCE(ca.amount, 0) + p.sss + p.philhealth + p.late_amount + p.unworked_amount + p.undertime_amt + p.tax + p.sss_loans + p.den_deduction + p.warehouse_sale) AS total_deductions,
                ((p.cutoff_salary + p.allowance + p.ot_pay + p.night_differential + p.special_holiday) - (p.pagibig + COALESCE(ca.amount, 0) + p.sss + p.philhealth + p.late_amount + p.unworked_amount + p.undertime_amt + p.tax + p.sss_loans + p.den_deduction + p.warehouse_sale)) AS net_pay
            FROM 
                payroll p
            INNER JOIN 
                employee e ON p.employee_id = e.id
            LEFT JOIN 
                cash_advance ca ON p.employee_id = ca.employee_id
            WHERE 
                e.employee_id = ?";

                // Execute the combined query with the session ID
                $payroll_list = $this->db->query($sql, array($session_id))->result();
                ?>



                <?php foreach ($payroll_list as $row) : ?>
                  <tr style="text-align: center;">
                    <td><?php echo $row->fname . " " . $row->lname; ?></td>
                    <!-- <td><?php echo $row->payroll_id; ?></td> -->
                    <td><?php echo date('F j, Y', strtotime($row->cutoff_start)) . " - " . date('F j, Y', strtotime($row->cutoff_end)); ?></td>
                    <td><?php echo date('F j, Y', strtotime($row->date_created)); ?></td>
                    <td><?php echo '₱' . number_format($row->gross_pay, 2); ?></td>
                    <td><?php echo '₱' . number_format($row->total_deductions, 2); ?></td>
                    <td><strong><?php echo '₱' . number_format($row->net_pay, 2); ?></strong></td>

                    <td>
                      <a class='btn btn-primary btn-sm view' data-cutoff-start='<?php echo $row->cutoff_start; ?>' data-cutoff-end='<?php echo $row->cutoff_end; ?>' data-emp='<?php echo $row->payroll_id; ?>'>Generate Payslip</a>
                    </td>
                  </tr>

                <?php endforeach; ?>


              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <style>
    .table-sm {
      padding: 0.3rem;
      /* Adjust as needed */
    }

    .table-sm th,
    .table-sm td {
      padding: 0.3rem;
      /* Adjust as needed */

      .form-control-sm {
        border: solid 1px black;
        width: 150px;
        /* Adjust width as needed */
        height: 10px;
        /* Adjust height as needed */
        font-size: 12px;
        /* Adjust font size as needed */
        padding: 5px;
        /* Adjust padding as needed */
        box-sizing: border-box;
        /* Include padding and border in total width */
        text-align: center;
        color: black;
      }
    }
  </style>
  <div id="mymodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title empname"></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" id="updatepayslip">
          <div class="modal-body payslip">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
           

        </form>
      </div>
    </div>
  </div>
</div>
<!-- <script>
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
</script> -->
<script>
  $(document).ready(function() {
    $('#dt_payslips').DataTable();
  });
  $(document).ready(function() {
    $('.view').click(function() {
      var empid = $(this).data('emp');
      $.ajax({
        url: base_url + 'payroll_hr/view_payslip_emp',
        type: 'post',
        data: {
          empid: empid
        },
        dataType: 'json',
        success: function(res) {
          $(".empname").html('Payslip for ' + res.name);
          $(".payslip").html(res.output);
          $('#mymodal').modal('show');
        }
      })

    })


  })
</script>

<script src="<?= base_url('assets/js/jquery-3.7.1.min.js') ?>"></script>