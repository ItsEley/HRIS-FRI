<?php defined('BASEPATH') or exit('No direct script access allowed');

class Payroll_hr extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->zone = date_default_timezone_set('Asia/Manila');;
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Payroll | List';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_payroll');
			$this->load->view('templates/modals/payroll_modal');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function payslip()
	{
		if ($this->session->userdata('logged_in')) {
			$data['title'] = 'HR | Payslip | List';
			$this->load->view('templates/header', $data);
			$this->load->view('pages/hr/hr_payslip');
			$this->load->view('templates/modals/payslip_view_modal');
			$this->load->view('templates/footer');
		} else {
			redirect('');
		}
	}

	public function view_payslip()
	{
		$response = array();
		$empid = $this->input->post('empid');
		$output = '';

		$sql = "SELECT *, e.employee_id as empID, d.department as deptname FROM payroll p inner join employee e on p.employee_id = e.id inner join department d on e.department = d.id inner join department_roles dr on e.role = dr.id WHERE p.payroll_id = '$empid' ";
		$payroll_list = $this->db->query($sql)->result();

		$cashadvancesql = "SELECT * FROM cash_advance WHERE employee_id = '$empid'";
		$cashresult = $this->db->query($cashadvancesql);

		$caamt = '';

		if ($cashresult->num_rows() > 0) {
			$ca = $cashresult->row();
			$caamt = $ca->amount;
		} else {
			$caamt = "0.00";
		}

		$total_deduction = 0;
		$net_pay = 0;
		$gross_pay = 0;
		$take_home_pay = 0;
		$holidaypay = '';
		$otpay = '';
		$nightdif = '';
		$specialholiday = '';
		$specialholidayot = '';
		$legalholidayot = '';
		$undertimeamount = '';
		$tax = '';
		$sss_loan = '';
		$dendeduction = '';
		$warehousesale = '';

		foreach ($payroll_list as $row) {
			$response['name'] = $row->fname;
			$total_deduction = $row->pagibig + $row->sss + $row->philhealth + $row->late_amount + $row->unworked_amount + $row->undertime_amt + $caamt + $row->tax + $row->sss_loans + $row->den_deduction + $row->warehouse_sale;
			$net_pay = ($row->cutoff_salary + $row->allowance + $row->ot_pay + $row->night_differential + $row->special_holiday) - $total_deduction;
			$fullname = $row->fname . ' ' . $row->lname;
			$gross_pay = $row->cutoff_salary + $row->allowance + $row->ot_pay + $row->night_differential + $row->special_holiday_ot + $row->legal_holiday_ot + $row->special_holiday + $row->holiday_pay;

			// for holiday pay
			if ($row->holiday_pay != 0.00) {
				$holidaypay = $row->holiday_pay;
			} else {
				$holidaypay = "0.00";
			}

			// for allowance
			if ($row->allowance != 0.00) {
				$allowance = $row->allowance;
			} else {
				$allowance = "0.00";
			}

			// for holiday pay
			if ($row->ot_pay != 0.00) {
				$otpay = $row->ot_pay;
			} else {
				$otpay =  "0.00";
			}

			// for night differential
			if ($row->night_differential != 0.00) {
				$nightdif = $row->night_differential;
			} else {
				$nightdif = "0.00";
			}

			// for special holiday
			if ($row->special_holiday != 0.00) {
				$specialholiday = $row->special_holiday;
			} else {
				$specialholiday = "0.00";
			}

			// for special holiday ot
			if ($row->special_holiday_ot != 0.00) {
				$specialholidayot = $row->special_holiday_ot;
			} else {
				$specialholidayot = "0.00";
			}


			// for legal holiday
			if ($row->legal_holiday_ot != 0.00) {
				$legalholidayot = $row->legal_holiday_ot;
			} else {
				$legalholidayot = "0.00";
			}

			// for undertime amount
			if ($row->undertime_amt != 0.00) {
				$undertimeamount = $row->undertime_amt;
			} else {
				$undertimeamount = "0.00";
			}

			// for taxt amount
			if ($row->tax != 0.00) {
				$tax = $row->tax;
			} else {
				$tax = "0.00";
			}

			// for sss loan amount
			if ($row->sss_loans != 0.00) {
				$sss_loan = $row->sss_loans;
			} else {
				$sss_loan = "0.00";
			}

			// for den deductions amount
			if ($row->den_deduction != 0.00) {
				$dendeduction = $row->den_deduction;
			} else {
				$dendeduction = "0.00";
			}

			// for warehouse sale amount
			if ($row->warehouse_sale != 0.00) {
				$warehousesale = $row->warehouse_sale;
			} else {
				$warehousesale = "0.00";
			}

			$response['output'] = '
			<div class="row p-2">
				<div class="col-2 text-center">
			<img src= ' . base_url('assets/img/famco_logo_clear.png') . ' alt="Famco Retail Incorporated" style="width: auto">
				
				</div>
				<div class="col">
				<h3 class="text-center">
			FAMCO RETAIL INCORPORATED<center><small style="line-height: 0.5; font-size: 12px">Apacible Blvrd, Brgy Bucana Nasugbu Batangas</small></center></h3>
				</div>
				<div class="col-2"></div>
			</div>
			
    												<input type="hidden" value="' . $row->payroll_id . '" name="payroll_id">
    												<table class="table table-bordered table-sm table-responsive">
															<thead>
																<tr>
																	<th style="background-color: #070e4c; color: white">Company Name:</th>
																	<td>FAMCO RETAIL INCORPORATED</td>
																	<th style="background-color: #070e4c; color: white">Payslip No: </th>
																	
																	<td>' . substr(date("Ymd", strtotime($row->cutoff_start)), 2) . '-' . $row->payroll_id . '</td>
																</tr>
																<tr>
																	<th style="background-color: #070e4c; color: white">Employee Name:</th>
																	<td>' . $fullname . '</td>
																	<th style="background-color: #070e4c; color: white">Payroll Period:</th>
																	<td>
																		' . date("F j Y", strtotime($row->cutoff_start)) . ' - ' . date("F j Y", strtotime($row->cutoff_end)) . '
																	</td>
																</tr>
																<tr>
																	<th style="background-color: #070e4c; color: white">Position:</th>
																	<td>' . $row->roles . '</th>
																	<th style="background-color: #070e4c; color: white">Department:</td>
																	<td>' . $row->deptname . '</td>
																</tr>
																<tr class="text-center">
																	<th style="background-color: #070e4c; color: white">EARNINGS AND ALLOWANCES</th>
																	<th style="background-color: #070e4c; color: white">AMOUNT (PHP)</th>
																	<th style="background-color: #070e4c; color: white">DEDUCTIONS</th>
																	<th style="background-color: #070e4c; color: white">AMOUNT (PHP)</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>Standard Pay:</td>
																	<td class="text-center">' . number_format($row->cutoff_salary, 2) . '</td>
																	<td>Unworked Amount:</td>
																	<td class="text-center">' . number_format($row->unworked_amount, 2) . '</td>
																</tr>
																<tr>
																	<td>Allowance:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $allowance . ' name="allowance"></td>
																	<td>Late Amount:</td>
																	<td class="text-center">' . number_format($row->late_amount, 2) . '</td>
																</tr>
																<tr>
																	<td>Overtime Pay:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $otpay . ' name="otpay"></td>
																	<td>Undertime Amount:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $undertimeamount . ' name="undertimeamout"></td>
																</tr>
																<tr>
																	<td>Night Differential:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $nightdif . ' name="nightdiff"></td>
																	<td>Cash Advanced:</td>
																	<td class="text-center">' . $caamt . '</td>
																</tr>
																<tr>
																	<td>Holiday Pay:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $row->holiday_pay . ' name="holiday_pay"></td>
																	<td>TAX:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $tax . ' name="tax"></td>
																</tr>
																<tr>
																	<th colspan="2" class="text-center" style="background-color: #070e4c; color: white">ADJUSTMENT</th>
																	<td>SSS:</td>
																	<td class="text-center">' . number_format($row->sss, 2) . '</td>
																</tr>
																<tr>
																	<td>Special Holiday:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $specialholiday . ' name="specialholiday"></td>
																	<td>PhilHealth:</td>
																	<td class="text-center">' . number_format($row->philhealth, 2) . '</td>
																</tr>
																<tr>
																	<td>Special Holiday OT AMT:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $specialholidayot . ' name="specialholidayot"></td>
																	<td>PAG-IBIG:</td>
																	<td class="text-center">' . number_format($row->pagibig, 2) . '</td>
																</tr>
																<tr>
																	<td>Legal Holiday OT:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $legalholidayot . ' name="legalholidayot"></td>
																	<td>SSS Loans:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $sss_loan . ' name="sssloans"></td>
																</tr>
																<tr>
																	<td><b>Total</b>:</td>
																	<td class="text-center">₱ ' . number_format($gross_pay, 2) . '</td>
																	<td>DEN:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $dendeduction . ' name="den"></td>
																</tr>
																<tr>
																	<td>Days Worked:<br>Hours Worked:<br>Rate Per Hour<br>Rate Per day:</td>
																	<td class="text-center">' . $row->days_worked . '<br>' . $row->total_hrs . '<br>' . $row->rate_per_hour . '<br>' . number_format($row->rate_per_day, 2) . '</td>
																	<td>Warehouse Sale:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $warehousesale . ' name="warehousesale"></td>
																</tr>
																<tr>
																	<td></td>
																	<td></td>
																	<th>Total:</th>
																	<td class="text-center">₱ ' . number_format($total_deduction, 2) . '</td>
																</tr>
															</tbody>
															<thead>
																<tr>
																	<th style="background-color: #070e4c; color: white" colspan="12" class="text-center">SUMMARY</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td colspan="2" style="text-align:right">Total Gross</td>
																	<td>PHP</td>
																	<td colspan="2">₱ ' . number_format($gross_pay, 2) . '</td>
																</tr>
																<tr>
																	<td colspan="2" style="text-align:right">Total Deductions</td>
																	<td>PHP</td>
																	<td>₱ ' . number_format($total_deduction, 2) . '</td>
																</tr>
																<tr>
																	<td colspan="2"></td>
																	<td style="text-align:right"><b>Net Pay:</b></td>
																	<td><b>₱ ' . number_format($net_pay, 2) . '</b></td>
																</tr>
																<tr>
																	<td colspan="12" class="text-center" style="letter-spacing: 3px;">
																		<i>****** This is computer generated payslip ******</i>
																	</td>
																</tr>
															</tbody>
														</table>';

			echo json_encode($response);
		}
	}
	public function view_payslip_emp()
	{
		$response = array();
		$empid = $this->input->post('empid');
		$output = '';

		$sql = "SELECT *, e.employee_id as empID, d.department as deptname FROM payroll p inner join employee e on p.employee_id = e.id inner join department d on e.department = d.id inner join department_roles dr on e.role = dr.id WHERE p.payroll_id = '$empid' ";
		$payroll_list = $this->db->query($sql)->result();

		$cashadvancesql = "SELECT * FROM cash_advance WHERE employee_id = '$empid'";
		$cashresult = $this->db->query($cashadvancesql);

		$caamt = '';

		if ($cashresult->num_rows() > 0) {
			$ca = $cashresult->row();
			$caamt = $ca->amount;
		} else {
			$caamt = "0.00";
		}

		$total_deduction = 0;
		$net_pay = 0;
		$gross_pay = 0;
		$take_home_pay = 0;
		$holidaypay = '';
		$otpay = '';
		$nightdif = '';
		$specialholiday = '';
		$specialholidayot = '';
		$legalholidayot = '';
		$undertimeamount = '';
		$tax = '';
		$sss_loan = '';
		$dendeduction = '';
		$warehousesale = '';

		foreach ($payroll_list as $row) {
			$response['name'] = $row->fname;
			$total_deduction = $row->pagibig + $row->sss + $row->philhealth + $row->late_amount + $row->unworked_amount + $row->undertime_amt + $caamt + $row->tax + $row->sss_loans + $row->den_deduction + $row->warehouse_sale;
			$net_pay = ($row->cutoff_salary + $row->allowance + $row->ot_pay + $row->night_differential + $row->special_holiday) - $total_deduction;
			$fullname = $row->fname . ' ' . $row->lname;
			$gross_pay = $row->cutoff_salary + $row->allowance + $row->ot_pay + $row->night_differential + $row->special_holiday_ot + $row->legal_holiday_ot + $row->special_holiday + $row->holiday_pay;

			// for holiday pay
			if ($row->holiday_pay != 0.00) {
				$holidaypay = $row->holiday_pay;
			} else {
				$holidaypay = "0.00";
			}

			// for allowance
			if ($row->allowance != 0.00) {
				$allowance = $row->allowance;
			} else {
				$allowance = "0.00";
			}

			// for holiday pay
			if ($row->ot_pay != 0.00) {
				$otpay = $row->ot_pay;
			} else {
				$otpay =  "0.00";
			}

			// for night differential
			if ($row->night_differential != 0.00) {
				$nightdif = $row->night_differential;
			} else {
				$nightdif = "0.00";
			}

			// for special holiday
			if ($row->special_holiday != 0.00) {
				$specialholiday = $row->special_holiday;
			} else {
				$specialholiday = "0.00";
			}

			// for special holiday ot
			if ($row->special_holiday_ot != 0.00) {
				$specialholidayot = $row->special_holiday_ot;
			} else {
				$specialholidayot = "0.00";
			}


			// for legal holiday
			if ($row->legal_holiday_ot != 0.00) {
				$legalholidayot = $row->legal_holiday_ot;
			} else {
				$legalholidayot = "0.00";
			}

			// for undertime amount
			if ($row->undertime_amt != 0.00) {
				$undertimeamount = $row->undertime_amt;
			} else {
				$undertimeamount = "0.00";
			}

			// for taxt amount
			if ($row->tax != 0.00) {
				$tax = $row->tax;
			} else {
				$tax = "0.00";
			}

			// for sss loan amount
			if ($row->sss_loans != 0.00) {
				$sss_loan = $row->sss_loans;
			} else {
				$sss_loan = "0.00";
			}

			// for den deductions amount
			if ($row->den_deduction != 0.00) {
				$dendeduction = $row->den_deduction;
			} else {
				$dendeduction = "0.00";
			}

			// for warehouse sale amount
			if ($row->warehouse_sale != 0.00) {
				$warehousesale = $row->warehouse_sale;
			} else {
				$warehousesale = "0.00";
			}

			$response['output'] = '<h3 class="text-center">FAMCO RETAIL INCORPORATED<center><small style="line-height: 0.5; font-size: 12px">Apacible Blvrd, Brgy Bucana Nasugbu Batangas</small></center></h3>
    												<input type="hidden" value="' . $row->payroll_id . '" name="payroll_id">
    												<table class="table table-bordered table-sm table-responsive">
															<thead>
																<tr>
																	<th style="background-color: #070e4c; color: white">Company Name:</th>
																	<td>FAMCO RETAIL INCORPORATED</td>
																	<th style="background-color: #070e4c; color: white">Payslip No: </th>
																	<td>' . substr(date("Ymd", strtotime($row->cutoff_start)), 2) . '-' . $row->payroll_id . '</td>
																</tr>
																<tr>
																	<th style="background-color: #070e4c; color: white">Employee Name:</th>
																	<td>' . $fullname . '</td>
																	<th style="background-color: #070e4c; color: white">Payroll Period:</th>
																	<td>
																		' . date("F j Y", strtotime($row->cutoff_start)) . ' - ' . date("F j Y", strtotime($row->cutoff_end)) . '
																	</td >
																</tr>
																<tr>
																	<th style="background-color: #070e4c; color: white">Position:</th>
																	<td>' . $row->roles . '</th>
																	<th style="background-color: #070e4c; color: white">Department:</td>
																	<td>' . $row->deptname . '</td>
																</tr>
																<tr class="text-center">
																	<th style="background-color: #070e4c; color: white">EARNINGS AND ALLOWANCES</th>
																	<th style="background-color: #070e4c; color: white">AMOUNT (PHP)</th>
																	<th style="background-color: #070e4c; color: white">DEDUCTIONS</th>
																	<th style="background-color: #070e4c; color: white">AMOUNT (PHP)</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>Standard Pay:</td>
																	<td class="text-center">' . number_format($row->cutoff_salary, 2) . '</td>
																	<td>Unworked Amount:</td>
																	<td class="text-center">' . number_format($row->unworked_amount, 2) . '</td>
																</tr>
																<tr>
																	<td>Allowance:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $allowance . ' name="allowance" readonly></td>
																	<td>Late Amount:</td>
																	<td class="text-center">' . number_format($row->late_amount, 2) . '</td>
																</tr>
																<tr>
																	<td>Overtime Pay:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $otpay . ' name="otpay" readonly></td>
																	<td>Undertime Amount:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $undertimeamount . ' name="undertimeamout" readonly></td>
																</tr>
																<tr>
																	<td>Night Differential:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $nightdif . ' name="nightdiff" readonly></td>
																	<td>Cash Advanced:</td>
																	<td class="text-center">' . $caamt . '</td>
																</tr>
																<tr>
																	<td>Holiday Pay:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $row->holiday_pay . ' name="holiday_pay" readonly></td>
																	<td>TAX:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $tax . ' name="tax" readonly></td>
																</tr>
																<tr>
																	<th colspan="2" class="text-center" style="background-color: #070e4c; color: white">ADJUSTMENT</th>
																	<td>SSS:</td>
																	<td class="text-center">' . number_format($row->sss, 2) . '</td>
																</tr>
																<tr>
																	<td>Special Holiday:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $specialholiday . ' name="specialholiday" readonly></td>
																	<td>PhilHealth:</td>
																	<td class="text-center">' . number_format($row->philhealth, 2) . '</td>
																</tr>
																<tr>
																	<td>Special Holiday OT AMT:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $specialholidayot . ' name="specialholidayot" readonly></td>
																	<td>PAG-IBIG:</td>
																	<td class="text-center">' . number_format($row->pagibig, 2) . '</td>
																</tr>
																<tr>
																	<td>Legal Holiday OT:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $legalholidayot . ' name="legalholidayot" readonly></td>
																	<td>SSS Loans:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $sss_loan . ' name="sssloans" readonly></td>
																</tr>
																<tr>
																	<td><b>Total</b>:</td>
																	<td class="text-center">₱ ' . number_format($gross_pay, 2) . '</td>
																	<td>DEN:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $dendeduction . ' name="den" readonly></td>
																</tr>
																<tr>
																	<td>Days Worked:<br>Hours Worked:<br>Rate Per Hour<br>Rate Per day:</td>
																	<td class="text-center">' . $row->days_worked . '<br>' . $row->total_hrs . '<br>' . $row->rate_per_hour . '<br>' . number_format($row->rate_per_day, 2) . '</td>
																	<td>Warehouse Sale:</td>
																	<td class="text-center"><input type="number" class="form-control-sm" placeholder="0.00" value=' . $warehousesale . ' name="warehousesale" readonly></td>
																</tr>
																<tr>
																	<td></td>
																	<td></td>
																	<th>Total:</th>
																	<td class="text-center">₱ ' . number_format($total_deduction, 2) . '</td>
																</tr>
															</tbody>
															<thead>
																<tr>
																	<th style="background-color: #070e4c; color: white" colspan="12" class="text-center">SUMMARY</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td colspan="2" style="text-align:right">Total Gross</td>
																	<td>PHP</td>
																	<td colspan="2">₱ ' . number_format($gross_pay, 2) . '</td>
																</tr>
																<tr>
																	<td colspan="2" style="text-align:right">Total Deductions</td>
																	<td>PHP</td>
																	<td>₱ ' . number_format($total_deduction, 2) . '</td>
																</tr>
																<tr>
																	<td colspan="2"></td>
																	<td style="text-align:right"><b>Net Pay:</b></td>
																	<td><b>₱ ' . number_format($net_pay, 2) . '</b></td>
																</tr>
																<tr>
																	<td colspan="12" class="text-center" style="letter-spacing: 3px;">
																		<i>****** This is computer generated payslip ******</i>
																	</td>
																</tr>
															</tbody>
														</table>';

			echo json_encode($response);
		}
	}


	public function update_payslip()
	{
		$response = array();
		$payroll_id = $this->input->post('payroll_id');
		$data = array(
			'allowance' => $this->input->post('allowance'),
			'ot_pay' => $this->input->post('otpay'),
			'night_differential' => $this->input->post('nightdiff'),
			'special_holiday_ot' => $this->input->post('specialholidayot'),
			'legal_holiday_ot' => $this->input->post('legalholidayot'),
			'pagibig_loans' => $this->input->post('sssloans'),
			'den_deduction' => $this->input->post('den'),
			'warehouse_sale' => $this->input->post('warehousesale'),
			'holiday_pay' => $this->input->post('holiday_pay'),
			'special_holiday' => $this->input->post('specialholiday'),
			'undertime_amt' => $this->input->post('undertimeamout'),
			'tax' => $this->input->post('tax'),
			'sss_loans' => $this->input->post('sssloans'),
			'den_deduction' => $this->input->post('den'),
			'warehouse_sale' => $this->input->post('warehousesale')
		);

		$sql = $this->db->where('payroll_id', $payroll_id)
			->update('payroll', $data);
		if ($sql) {
			$response['status'] = 1;
			$response['msg'] = 'Payslip Updated Successfully!';
		} else {
			$response['status'] = 0;
			$response['msg'] = 'Error!';
		}
		echo json_encode($response);
	}








	public function generatePayroll()
{
    $response = array();
    
    $start_date = $this->input->post('startdate');
    $end_date = $this->input->post('enddate');
    $mandatories = $this->input->post('mandatory');

    // Input validation
    if (!$start_date || !$end_date || !$mandatories || count($mandatories) < 1) {
        $response['error'] = "Start date, end date, and at least one mandatory deduction are required.";
        echo json_encode($response);
        return;
    }

    // calculate SSS deductions
    function calculateDeduction($tableName, $employeeSalary)
    {
        $ci = &get_instance();
        $sql = $ci->db->query("SELECT * FROM sss_metrics")->result();
        $deduction = 0; // Default deduction
        foreach ($sql as $row) {
            $pattern = '/\s*-\s*/';
            $salary_rate = preg_split($pattern, $row->rate_range);
            $ded = $row->deduct_amt;
            if ($employeeSalary >= $salary_rate[0] && $employeeSalary <= $salary_rate[1]) {
                $deduction = $ded;
                break; // Exit the loop once we find the correct range
            }
        }
        return $deduction;
    }

    $sql = "SELECT *, e.id as empID, SUM(at.num_hr) as total_hours_rendered, COUNT(at.date) as total_working_days 
            FROM employee e 
            INNER JOIN attendance at ON e.id = at.emp_id 
            INNER JOIN department d ON e.department = d.id 
            INNER JOIN department_roles dr ON e.role = dr.id 
            INNER JOIN sys_shifts sf ON e.shift = sf.id 
            INNER JOIN deductions dd ON e.deduction = dd.deduction_id 
            WHERE at.date BETWEEN '$start_date' and '$end_date' 
            GROUP BY e.id";
    $query = $this->db->query($sql);

    if (!$query) {
        $response['error'] = "Failed to execute query: " . $this->db->error();
        echo json_encode($response);
        return;
    }

    $result = $query->result();
    if (empty($result)) {
        $response['error'] = "No records found for the given date range.";
        echo json_encode($response);
        return;
    }

    $empsalary = 0;
    $working_days = 13;
    $rate = 0;
    $rate_per_hr = 0;
    $salary_wout_deduction = 0;
    $philhealthded = 0;
    $philhealth = 0;
    $total_deduction = 0;
    $late_fee_rate = 0.50;
    $late_fee = 0;
    $actual_unworked_amt = 0;
    $pagibig = 0;

    foreach ($result as $row) {
        $expectedArrival = $row->time_from;
        $actualArrival = $row->time_in;
        $expectedTimestamp = strtotime($expectedArrival);
        $actualTimestamp = strtotime($actualArrival);
        $lateSeconds = $actualTimestamp - $expectedTimestamp;
        $lateMinutes = round($lateSeconds / 60);

        $hours = floor($lateMinutes / 60);
        $minutes = $lateMinutes % 60;
        $late_time_format = sprintf("%02d:%02d", $hours, $minutes);

        $late_fee_rate = array(
            13300 => 1.07,
            15000 => 1.20,
            12454 => 1.00,
            16300 => 1.31,
            18000 => 1.44,
            22500 => 1.80,
            25000 => 2.00,
            30000 => 2.40,
            35000 => 2.80
        );

        $late_fee = isset($late_fee_rate[$row->salary]) ? $lateMinutes * $late_fee_rate[$row->salary] : 0;

        $employeeSalary = $row->salary;
        $sssDeduction = 0;
        $pagibig = 0;
        $philhealth = 0;

        foreach ($mandatories as $mandatory) {
            if ($mandatory == "sss") {
                $sssDeduction = calculateDeduction('sss_ranges', $employeeSalary);
            } else if ($mandatory == 'pagibig') {
                $pagibig = $row->amount;
            } else if ($mandatory == 'philhealth') {
                $philhealth = (5 / 100) * (int)$employeeSalary / 2;
            }
        }

        $empsalary = $row->salary / 2;
        $rate = $empsalary / 13;
        $rate_per_hr = $rate / 8;
        $salary_wout_deduction = $rate_per_hr * $row->total_hours_rendered;

        $total_deduction = $row->amount + $sssDeduction + $philhealth;
        $total_salary = $salary_wout_deduction - $total_deduction;
        $actual_unworked_amt = ($working_days - $row->total_working_days) * $rate;

        $worked_days = $row->total_hours_rendered / 8;

        echo "<br>";
        echo "<center>" . $row->fname . "<br>";
        echo "Total salary per Cutoff: " . number_format($empsalary, 2) . "<br>";
        echo "Hours Rendered: " . $row->total_hours_rendered . "<br>";
        echo "Working Days: " . $worked_days . "<br>";
        echo "Rate Per Day: " . round($rate, 2) . "<br>";
        echo "Rate Per Hr: " . number_format($rate_per_hr, 2) . "<br>";
        echo "Cut off Salary: " . number_format($salary_wout_deduction, 2) . "<br>";
        echo "PAGIBIG Deduction: " . number_format($pagibig, 2) . "<br>";
        echo "SSS Deduction: " . number_format($sssDeduction, 2) . "<br>";
        echo "PhilHealth Deduction: " . number_format($philhealth, 2) . "<br>";
        echo "Total Mandatory Deduction: " . number_format($total_deduction, 2) . "<br>";
        echo "Net Pay: " . number_format($total_salary, 2) . "<br>";
        echo "Late Minutes: " . $late_time_format . "<br>";
        echo "Late Amount: " . $late_fee . "<br>";
        echo "<br>";
        echo "-----------------------------------------------------------------<br>";
        echo "</center>";

        $data = array(
            'employee_id' => $row->empID,
            'cutoff_salary' => $empsalary,
            'days_worked' => $worked_days,
            'rate_per_day' => $rate,
            'rate_per_hour' => $rate_per_hr,
            'late_amount' => $late_fee,
            'pagibig' => $pagibig,
            'sss' => $sssDeduction,
            'philhealth' => $philhealth,
            'cutoff_start' => $start_date,
            'cutoff_end' => $end_date,
            'net_pay' => $total_salary,
            'total_hrs' => $row->total_hours_rendered,
            'unworked_amount' => $actual_unworked_amt,
            'date_created' => date('Y-m-d')
        );
        $insert = $this->db->insert('payroll', $data);

        if (!$insert) {
            $response['error'][] = "Failed to insert payroll for employee ID: " . $row->empID . ". Error: " . $this->db->error();
        } else {
            $response['success'][] = "Payroll for " . $row->fname . " successfully created.";
        }
    }

    echo json_encode($response);
}

}
