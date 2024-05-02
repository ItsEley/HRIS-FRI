<div id="viewpayroll" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-class="summary-p-1"="true">
	<div class="modal-dialog modal-fullscreen">
		<div class="modal-content">
			<div class="modal-header">
			
			<h4 id="report_title" class="modal-title summary-p-1">
    Payroll list ( <?= date("F j Y", strtotime($_GET['start_date'])) ?> - <?= date("F j Y", strtotime($_GET['end_date'])) ?> )
	
</h4>

				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
			</div>

			<div class="modal-body print-area">
				<div id="pdf-content">
					<style>
						/* Adjust cell padding and margin */
						table td {
							padding: 5px;
							margin: 0;
						}

						/* Set fixed width for certain columns */
						.fixed-width-column {
							width: 100px;
							/* Adjust width as needed */
						}

						table {
							width: auto;
							table-layout: auto;
							/* Allow table to expand beyond container */
							overflow-x: auto;
							/* Enable horizontal scrolling */
						}

						table tr td {
							width: auto;
							word-wrap: break-word;
						}

						table tr td {
							display: flexbox;
							margin-top: 2px;
						}



						/* } */
					</style>
					<table class="table table-bordered table-sm text-center table-responsive" id="report_table">
						<thead>
							<tr>
								<th style="background-color: #070e4c; color: white">Name</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-1">Position</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-1">Department</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-1">Standard Pay</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-1">Allowance</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-1">OT Pay</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-2">Night Diffrential</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-2">Holiday Pay</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-2">Special Holiday</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-2">Special Holiday OT</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-2">Legal Holiday</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-2">Unworked Amount</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-2">Late Amount</th>

								<th style="background-color: #070e4c; color: white" class="summary-p-1">Undertime Amount</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-2">Cash Advance</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-2">TAX</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-2">SSS</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-2">PhilHealth</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-2">PAG-IBIG</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-2">SSS Loans</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-2">DEN</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-2">Warehouse Sale</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-1">Days Worked</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-1">Total Gross</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-1">Total Deductions</th>
								<th style="background-color: #070e4c; color: white" class="summary-p-1">Net Pay</th>
								<!-- <th style="background-color: #070e4c; color: white">Payroll Period</th> -->
							</tr>
						</thead>
						<tbody>
							<?php
							$startdate = $_GET['start_date'];
							$enddate = $_GET['end_date'];

							$total_pay = 0;
							$total_allowance = 0;
							$total_otpay = 0;
							$total_nightdif = 0;
							$total_holiday_pay = 0;
							$total_spec_holiday = 0;
							$total_spec_holiday_ot = 0;
							$total_legal_holiday = 0;
							$total_unworked_amt = 0;
							$total_late_amt = 0;
							$total_undertime_amt = 0;
							$total_cashadvance = 0;
							$total_tax = 0;
							$total_sss = 0;
							$total_philhealth = 0;
							$total_pagibig = 0;
							$total_sss_loan = 0;
							$total_dendeduction = 0;
							$total_ws = 0;
							$total_dw = 0;
							$total_gp = 0;
							$total_ded = 0;
							$total_netpay = 0;

							$total_deduction = 0;


							$sql = "SELECT *,dr.roles as position, e.employee_id as empID, e.id as emid, d.department as deptname FROM payroll p inner join employee e on p.employee_id = e.id inner join department d on e.department = d.id inner join department_roles dr on e.role = dr.id WHERE p.cutoff_start = '$startdate' and p.cutoff_end = '$enddate' order by e.lname ASC";
							$payroll_view = $this->db->query($sql)->result();

							foreach ($payroll_view as $row) {
								$cashadvancesql = "SELECT * FROM cash_advance WHERE employee_id = '$row->emid'";
								$cashresult = $this->db->query($cashadvancesql);

								$caamt = 0;
								if ($cashresult->num_rows() > 0) {
									$ca = $cashresult->row();
									$caamt = $ca->amount;
									$total_cashadvance += $ca->amount;
								} else {
									$caamt = "0.00";
								}

								$gross_pay = $row->cutoff_salary + $row->allowance + $row->ot_pay + $row->night_differential + $row->special_holiday_ot + $row->legal_holiday_ot + $row->special_holiday + $row->holiday_pay;

								$total_deduction = $row->pagibig + $row->sss + $row->philhealth + $row->late_amount + $row->unworked_amount + $row->undertime_amt + $caamt + $row->tax + $row->sss_loans + $row->den_deduction + $row->warehouse_sale;

								$netpay = ($row->cutoff_salary + $row->allowance + $row->ot_pay + $row->night_differential + $row->special_holiday) - $total_deduction;

								$total_pay += $row->cutoff_salary;
								$total_allowance += $row->allowance;
								$total_otpay += $row->ot_pay;
								$total_nightdif += $row->night_differential;
								$total_holiday_pay += $row->holiday_pay;
								$total_spec_holiday += $row->special_holiday;
								$total_spec_holiday_ot += $row->special_holiday_ot;
								$total_legal_holiday += $row->legal_holiday_ot;
								$total_unworked_amt += $row->unworked_amount;
								$total_undertime_amt += $row->undertime_amt;
								$total_late_amt += $row->late_amount;
								$total_tax += $row->tax;
								$total_sss += $row->sss;
								$total_philhealth += $row->philhealth;
								$total_pagibig += $row->pagibig;
								$total_sss_loan += $row->sss_loans;
								$total_dendeduction += $row->den_deduction;
								$total_ws += $row->warehouse_sale;
								$total_dw += $row->days_worked;
								$total_gp += $gross_pay;
								$total_ded += $total_deduction;
								$total_netpay += $netpay;
								echo '<tr>
											<td>' . $row->lname . ' ' . $row->fname . '</td>
											<td class="summary-p-1">' . $row->position . '</td>
											<td class="summary-p-1">' . $row->deptname . '</td>
											<td class = "summary-p-1">' . number_format($row->cutoff_salary, 2) . '</td>
											<td class = "summary-p-1">' . number_format($row->allowance, 2) . '</td>
											<td class = "summary-p-1">' . number_format($row->ot_pay, 2) . '</td>
											<td class = "summary-p-2">' . number_format($row->night_differential, 2) . '</td>
											<td class = "summary-p-2">' . number_format($row->holiday_pay, 2) . '</td>
											<td class = "summary-p-2">' . number_format($row->special_holiday, 2) . '</td>
											<td class = "summary-p-2">' . number_format($row->special_holiday_ot, 2) . '</td>
											<td class = "summary-p-2">' . number_format($row->legal_holiday_ot, 2) . '</td>
											<td class = "summary-p-2">' . number_format($row->unworked_amount, 2) . '</td>
											<td class = "summary-p-2">' . number_format($row->late_amount, 2) . '</td>
											<td class = "summary-p-1">' . number_format($row->undertime_amt, 2) . '</td>
											<td class = "summary-p-2">' . number_format($caamt, 2) . '</td>
											<td class = "summary-p-2">' . number_format($row->tax, 2) . '</td>
											<td class = "summary-p-2">' . number_format($row->sss, 2) . '</td>
											<td class = "summary-p-2">' . number_format($row->philhealth, 2) . '</td>
											<td class = "summary-p-2">' . number_format($row->pagibig, 2) . '</td>
											<td class = "summary-p-2">' . number_format($row->sss_loans, 2) . '</td>
											<td class = "summary-p-2">' . number_format($row->den_deduction, 2) . '</td>
											<td class = "summary-p-2">' . number_format($row->warehouse_sale, 2) . '</td>
											<td class = "summary-p-1">' . $row->days_worked . '</td>
											<td class = "summary-p-1">' . number_format($gross_pay, 2) . '</td>
											<td class = "summary-p-1">' . number_format($total_deduction, 2) . '</td>
											<td class = "summary-p-1">' . number_format($netpay, 2) . '</td>';
								//<td>' . date("F j Y", strtotime($row->cutoff_start)) . ' - ' . date("F j Y", strtotime($row->cutoff_end)) . '</td>';
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<td style="background-color: #070e4c; color: white" colspan="3" id="total_label"><b style="float: right;">Total: </b></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-1"><?= number_format($total_pay, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-1"><?= number_format($total_allowance, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-1"><?= number_format($total_otpay, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-2"><?= number_format($total_nightdif, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-2"><?= number_format($total_holiday_pay, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-2"><?= number_format($total_spec_holiday, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-2"><?= number_format($total_spec_holiday_ot, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-2"><?= number_format($total_legal_holiday, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-2"><?= number_format($total_unworked_amt, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-2"><?= number_format($total_late_amt, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-1"><?= number_format($total_undertime_amt, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-2"><?= number_format($total_cashadvance, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-2"><?= number_format($total_tax, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-2"><?= number_format($total_sss, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-2"><?= number_format($total_philhealth, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-2"><?= number_format($total_pagibig, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-2"><?= number_format($total_sss_loan, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-2"><?= number_format($total_dendeduction, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-2"><?= number_format($total_ws, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-1"><?= number_format($total_dw, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-1"><?= number_format($total_gp, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-1"><?= number_format($total_ded, 2) ?></td>
								<td style="background-color: #070e4c; color: white" class="summary-p-1"><?= number_format($total_netpay, 2) ?></td>
								<!-- <td style="background-color: #070e4c; color: white"><? //date("F j Y", strtotime($row->cutoff_start)) . ' - ' . date("F j Y", strtotime($row->cutoff_end)) 
																							?></td> -->
							</tr>
						</tfoot>
					</table>

				</div>

				<div class="row" style="margin-top: 50px;" id="report_signature">
					<div class="col-md-3">
						<h5>Jashmin Tancailles<br>
							<p style="font-size: 12px;">HR Assistant</p>
						</h5>
					</div>
					<div class="col-md-3">
						<h5>Jaffar Alvarez<br>
							<p style="font-size: 12px;">HR Supervisor</p>
						</h5>
					</div>
					<div class="col-md-3">

						<h5>Lorry Mirando<br>
							<p style="font-size: 12px;">HR Manager</p>
						</h5>
					</div>
					<div class="col-md-3">
						<h5>Ma. Leonora De Roxas<br>
							<p style="font-size: 12px;">Finance Manager</p>
						</h5>
					</div>
				</div>
			</div>


			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary btn-sm" id="btn-download-pdf"><i class="fa fa-print"></i> Print</button>
				<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-file-pdf-o"></i> Download PDF</button>
			</div>
		</div>
	</div>
</div>
</div>




<script>

document.addEventListener("DOMContentLoaded", function() {
    // Event handler for the "Download PDF" button
    document.getElementById('btn-download-pdf').addEventListener('click', function() {
        // Call the function to generate PDF
        generatePDF();
    });

    // Function to generate PDF
    
// Function to generate PDF
function generatePDF() {
    // Get the HTML content of the "pdf-content" element
    var pdfContentHTML = document.getElementById('pdf-content').innerHTML;
    var report_signature = document.getElementById('report_signature').innerHTML;
    var report_title = document.getElementById('report_title').innerHTML;

    // Create a new window for printing
    var printWindow = window.open('', '_blank');

    // Append the content to the new window
    printWindow.document.write('<html><head><title>Print</title>' +
        '  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">' +
        ' </head><body>');

    printWindow.document.write('<style> #table_1 .summary-p-2 {display:none} #report_signature{ display: inline-flex;' +
        'width: 100%; padding-top: 50px;padding-bottom: 50px;justify-content: space-around; body{width:100%} table th, table td{text-align:center;margin:auto;text-align:middle}' +
        ' }</style>');
    printWindow.document.write('<h1 id="report_title" class = "text-center p-4" >' + report_title + '</h1>');

    printWindow.document.write('<div id="table_1">' + pdfContentHTML + '</div>');
    printWindow.document.write('<style> #table_2 .summary-p-1 {display:none}</style>');

    printWindow.document.write('<div id="table_2" style = "page-break-before: auto;">' + pdfContentHTML + '</div>');
    printWindow.document.write('<div id = "report_signature" style = "bottom: 0 ;" class = "text-center">' + report_signature + '</div>');

    // Modify the colspan attribute directly
    var totalLabelElement = printWindow.document.querySelector("#table_2 #total_label");
    if (totalLabelElement) {
        totalLabelElement.colSpan = 1;
    }

    printWindow.document.write('</body></html>');

    // Print the content
    printWindow.print();

    // Close the new window after printing
    // printWindow.close();
}




});

</script>