

<div class="main-wrapper">
	<?php $this->load->view('templates/nav_bar'); ?>
	<?php $this->load->view('templates/sidebar') ?>
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
         			<table id="dt_payroll_overview" class="datatable table-striped custom-table mb-0 datatable table-sm">
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
                              <td>".date('F j Y', strtotime($row->cutoff_start))." - ".date('F j Y', strtotime($row->cutoff_end))."</td>
                              <td>".date('F j, Y', strtotime($row->date_created))."</td>
                              <td><a href=".base_url('payroll_hr/payslip?start_date='.$row->cutoff_start.'&end_date='.$row->cutoff_end)." class='btn btn-primary btn-sm'>Generate Payslip</a></td>
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

$(document).ready(function(){
        $('#dt_payroll_overview').DataTable({});
        
        })
</script>