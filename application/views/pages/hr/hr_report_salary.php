
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

<!-- Main Wrapper -->
<div class="main-wrapper">
    <!-- Header -->
    <?php $this->load->view('templates/nav_bar'); ?>
    <!-- /Header -->
    <!-- Sidebar -->
    <?php $this->load->view('templates/sidebar') ?>
    <!-- /Sidebar -->

    <!-- Page Wrapper -->
    <div class="page-wrapper w-100">

        <!-- Page Content -->
        <div class="content container-fluid">


            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Salary Reports</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="admin-dashboard.html">Reports</a></li>
                            <li class="breadcrumb-item active">Salary</li>
                        </ul>
                    </div>
                
                </div>
            </div>
            <!-- /Page Header -->


             <!-- data table -->
             <div class="row timeline-panel">
                <table id="dt_emp_shift" class="datatable table-striped custom-table mb-0">
                    <thead>
                        <tr>
                            <th hidden>ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Role</th>
                            <th>Salary Rate</th>
                            <th>Total Hours Worked</th>
                            <th>Salary</th>
                            <th>Payslip</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = $this->db->query('
                                SELECT
                                *
                            FROM
                                vw_emp_designation
                            WHERE
                                vw_emp_designation.emp_id IS NOT NULL
                            ORDER BY
                                vw_emp_designation.emp_id ASC,
                                vw_emp_designation.full_name;
                            
                                ');

                        foreach ($query->result() as $row) {



                        ?>
                            <tr class="hoverable-row">
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" hidden>
                                    <?php echo $data['emp_id'] = $row->emp_id; ?>
                                </td>
                                <td style="max-width: 200px; max-height: 100px; overflow: hidden;">
                                    <div class="ellipsis" style="max-height: 1.2em; overflow: hidden;">
                                        <?php echo $data['emp_name'] = $row->full_name;; ?>
                                    </div>
                                </td>

                                <td name = "emp_dept_id" data-dept-id = "<?php echo $row->dept_id?>">
                                    <?php echo $row->department?></td>
                                <td name = "emp_role_id" data-role-id = "<?php echo $row->dept_roles_id?>">
                                <?php echo $row->roles; ?></td>

                                <td>
                                    <?php
                                        $salary_rate = $row->salary;
                                        echo number_format($salary_rate, 2, '.', ',') . ' PHP';
                                
                                    
                                    ?>

                                </td>

                                <td><?php

                                $hours_worked = 120;

                                if(rand(0,1) == 1){
                                    $hours_worked = $hours_worked + rand(0,10);
                                }else{
                                    $hours_worked = $hours_worked - rand(0,10);
                                }

                                echo $hours_worked ;
                                 
                                    ?> </td>

                                <td>
                                    <?php

                                    $total_salary = $salary_rate * $hours_worked;
                                    echo number_format($total_salary, 2, '.', ',') . ' PHP';

                                    ?>

                                </td>

                                <td>
                                    <?php
     if(rand(0,1) == 1){
       echo "<button class = 'btn btn-primary p-1' style ='font-size:12px'>Generate Payslip</button>";
    }else{
        echo generatePayslipId();
    }

                                                                    
                                 
                                    ?>


                                </td>


                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /data table -->

            
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
</div>
<!-- /Main Wrapper -->

<!-- jQuery -->




<script>
    document.addEventListener('DOMContentLoaded', function() {

        $("li > a[href='<?= base_url('hr/reports/salary') ?>']").addClass("active");
        $("li > a[href='<?= base_url('hr/reports/salary') ?>']").parent().parent().css("display", "block")



    })
</script>