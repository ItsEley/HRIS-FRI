<div class="main-wrapper">
	<?php $this->load->view('templates/nav_bar'); ?>
	<?php $this->load->view('templates/sidebar') ?>
	<div class="page-wrapper w-100">
		<div class="content container-fluid">
			<div class="page-header">
				<div class="row align-items-center">
					<div class="col">
						<h3 class="page-title">Payslip</h3>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="admin-dashboard.html">Employee</a></li>
							<li class="breadcrumb-item active">Payslip List</li>
						</ul>
					</div>

					<div class="col-auto float-end ms-auto">
						<a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#viewpayroll"><i class="fa-solid fa-eye"></i> View Payroll</a>
					</div>
				</div>
			</div>
			<div class="row timeline-panel">
				<div class="col-md-12">
					<div class="table-responsive">
						<table id="dt_announcements" class="datatable table-striped custom-table mb-0 datatable">
							<thead>
								<tr>
									<th>Employee Name</th>
									<th>Employee ID</th>
									<th>Net Pay</th>
									<th>Total Deduction</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								
							<?php
							$start_date = $_GET['start_date'];
							$end_date = $_GET['end_date'];
							$total_deductions = 0;
							
							// Assuming the session ID is stored in $_SESSION['id2']
							$session_id = $_SESSION['id2'];
							
							// Prepare the SQL query with a placeholder for the session ID
							$sql = "SELECT *, p.employee_id AS empID, e.employee_id AS employeeID 
									FROM payroll p 
									INNER JOIN employee e ON p.employee_id = e.id 
									WHERE cutoff_start = ? AND e.employee_id = ?";
							
							// Execute the query with the session ID
							$payroll_list = $this->db->query($sql, array($start_date, $session_id))->result();
							$caamt = '';
							
							$n = 1;
							foreach ($payroll_list as $row) {
								$cashadvancesql = "SELECT * FROM cash_advance WHERE employee_id = ?";
								$cashresult = $this->db->query($cashadvancesql, array($row->empID));
							
								if ($cashresult->num_rows() > 0) {
									$ca = $cashresult->row();
									$caamt = $ca->amount;
								} else {
									$caamt = 0;
								}
							
								$fullname = $row->fname . ' ' . $row->lname;
								$total_deductions = $row->pagibig + $caamt + $row->sss + $row->philhealth + $row->late_amount + $row->unworked_amount + $row->undertime_amt + $row->tax + $row->sss_loans + $row->den_deduction + $row->warehouse_sale;
							
								$netpay = ($row->cutoff_salary + $row->allowance + $row->ot_pay + $row->night_differential + $row->special_holiday) - $total_deductions;
								// Further processing or display logic here
							
							?>
							
							
									<tr>
										<td><?= $fullname ?></td>
										<td><?= $row->employeeID ?></td>
										<td>₱ <?= number_format($netpay, 2) ?></td>
										<td>₱ <?= number_format($total_deductions, 2) ?></td>
										<td><button type='button' class='btn btn-primary btn-sm view' data-emp="<?= $row->payroll_id ?>">View/Edit Payslip</button></td>
									</tr>
								<?php
									$n++;
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
					<button type="submit" class="btn btn-primary btn-sm btn-block" style="float: right">Save Changes</button>

			</form>
		</div>
	</div>
</div>
</div>

<script src="<?= base_url('assets/js/jquery-3.7.1.min.js') ?>"></script>
<script>
	$(document).ready(function() {
		$('.view').click(function() {
			var empid = $(this).data('emp');
			$.ajax({
				url: base_url + 'payroll_hr/view_payslip',
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

		$("#updatepayslip").submit(function(e) {
			e.preventDefault();
			var payslipdata = $(this).serialize();
			$.ajax({
				url: base_url + 'payroll_hr/update_payslip',
				type: 'post',
				data: payslipdata,
				dataType: 'json',
				success: function(res) {
					if (res.status === 1) {
						alert(res.msg);
					} else {
						alert(res.msg)
					}
				}
			})
		})
	})
</script>