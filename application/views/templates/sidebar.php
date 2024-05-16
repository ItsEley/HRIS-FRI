<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">


            <!--//! change this to print if session department type is appropriate 
   //! instead of hiding -->

            <ul class="sidebar-vertical"> <!-- desktop size -->

                <li class="menu-title">
                    <?php
                    if (strtolower($this->session->userdata('role')) == 'head') {
                        echo "<span>Main | " . $this->session->userdata('acro') . " - <span class = 'badge bg-primary'>HEAD</span> " . "</span>";
                    } else {
                        echo "<span>Main | " . $this->session->userdata('acro') . " </span>";
                    }
                    ?>
                </li>

                <?php

                if (strtolower($this->session->userdata('acro')) == 'hr') {

                    echo " 
                        <li><a href='" . base_url('hr/dashboard') . "'><i class='la la-dashboard'></i><span>Dashboard</span></a></li> 
                        <li><a href='" . base_url('hr/calendar') . "'><i class='fa-regular fa-calendar'></i><span>Calendar</span></a></li> 
                        <li><a href='" . base_url('hr/announcement') . "'><i class='la la-bullhorn'></i><span>Announcements</span></a></li> 
                        <li><a href='" . base_url('hr/departments') . "'><img src = '" . base_url('assets/img/icons/department-2.png') . "' class = 'my-img-icon'> 
                                            <span>Departments</span></a></li> 
                                            <li><a href='" . base_url('hr/department_roles') . "'>
                                            <img width='30' height='30' class = 'my-img-icon' src='https://img.icons8.com/ios/50/collaborator-male.png' alt='collaborator-male'/>
                                            <span>Roles</span></a></li> 
                        <li><a href='" . base_url('hr/shifts') . "'><i class='fa-regular fa-clock'></i><span>Shifts</span></a></li> 
                        <li><a href='" . base_url('hr/leaves') . "'><i class='la la-bullhorn'></i><span>Leaves</span></a></li> 
 
                        <li class='submenu reports'> 
                            <a href='#' class=''><i class='la la-file-text'></i><span>Reports</span><span class='menu-arrow'></span></a> 
                            <ul> 
                            <li><a href='" . base_url('hr/reports/employee_performance') . "'>Employee Performance</a></li> 
 
                            <li><a href='" . base_url('hr/reports/timesheet') . "'>Timesheet</a></li> 
 
                                <li><a href='" . base_url('hr/employees/attendance') . "'>Attendance</a></li> 
                             
                            </ul> 
                        </li> 
                        <li class='submenu employees'> 
                            <a href='#'><i class='la la-user'></i><span>Employees</span><span class='menu-arrow'></span></a> 
                            <ul> 
                                <li><a href='" . base_url('hr/employees') . "'>Manage</a></li> 
                                <li><a href='" . base_url('hr/employees/shifts') . "'>Shifts & Schedules</a></li> 
                                <li><a href='" . base_url('hr/employees/evaluation') . "'>Performance Evaluation</a></li> 
 
                            </ul> 
                        </li> 
                        <li class='submenu payroll'> 
                            <a href='#' class=''><i class='la la-money'></i><span>Payroll</span><span class='menu-arrow'></span></a> 
                            <ul>
                                <li><a href='" . base_url('hr/payroll/hr') . "'>Payroll</a></li> 
                                <li><a href='" . base_url('hr/payroll/salary_rate') . "'>Salary Rate </a></li> 
                                <li><a href='" . base_url('hr/payroll/deduction') . "'>Deductions</a></li> 
                            </ul> 
                        </li> 
                        <li class='submenu forms'>
                        <a href='#' class=''><i class='la la-object-group'></i><span>Forms</span><span class='menu-arrow'></span></a>
                        <ul> 
                             <li><a href='" . base_url('forms') . "'>Apply</a></li> 
                             <li><a href='" . base_url('hr/pendingrequests') . "'>Pending</a></li> 
                             <li><a href='" . base_url('hr/historyrequests') . "'>History</a></li> 
                         </ul> 
                     </li> 

                     <li class='submenu forms'>
                        <a href='#' class=''><i class='la la-object-group'></i><span>Personal </span><span class='menu-arrow'></span></a>
                        <ul> 
                             <li><a href='" . base_url('forms/history') . "'>Request History</a></li> 
                             <li><a href='" . base_url('hr/pendingrequests') . "'>Attendance</a></li> 
                             <li><a href='" . base_url('hr/historyrequests') . "'>Payroll</a></li> 
                             <li><a href='" . base_url('hr/historyrequests') . "'>Leave Balance</a></li> 

                         </ul> 
                     </li>
                 ";

                    //  <li><a href='" . base_url('hr/reports/salary') . "'>Salary Report</a></li> 
                    // <li><a href='" . base_url('hr/employees/designation') . "'>Designations</a></li> 


                } else if (strtolower($this->session->userdata('acro')) == 'sys-at') {

                    // ** SYSTEM ADMIN


                } else {

                    echo " 
                 <li><a href='" . base_url('employee/dashboard') . "'><i class='la la-dashboard'></i><span>Dashboard (Employee)</span></a></li> 
                 <li><a href='" . base_url('employee/dashboard') . "'><i class='la la-dashboard'></i><span>My Leave Balance</span></a></li> 
                  
                 <li class='submenu forms'> 
                 <a href='#' class=''><i class='la la-object-group'></i><span>Reports</span><span class='menu-arrow'></span></a> 
                 <ul> 
                     <li><a href='" . base_url('forms') . "'>My Attendance</a></li> 
                     <li><a href='" . base_url('employee/pendingrequests') . "'>My Payslips</a></li> 
                     <li><a href='" . base_url('forms/history') . "'>My Leaves</a></li> 
                 </ul> 
                 </li> 
                 <li class='submenu forms'> 
                       <a href='#' class=''><i class='la la-object-group'></i><span>Forms</span><span class='menu-arrow'></span></a> 
                       <ul> 
                           <li><a href='" . base_url('forms') . "'>Apply</a></li> 
                           <li><a href='" . base_url('employee/pendingrequests') . "'>Pending</a></li> 
                           <li><a href='" . base_url('forms/history') . "'>History</a></li> 
                       </ul> 
                </li> 
                <li class='submenu payroll'> 
                <a href='#' class=''><i class='la la-money'></i><span>Payroll</span><span class='menu-arrow'></span></a> 
                <ul>
                    <li><a href='" . base_url('employee/payroll/emp') . "'>Payroll</a></li> 
                    <li><a href='" . base_url('hr/payroll/salary_rate') . "'>Salary Rate </a></li> 
                    <li><a href='" . base_url('hr/payroll/bonus') . "'>Bonuses & Commissions</a></li> 
                    <li><a href='" . base_url('hr/payroll/deduction') . "'>Deductions</a></li> 
                </ul> 
            </li> 
                  
                  
                  
                 ";
                    if (strtolower($this->session->userdata('role')) == 'head') {

                        echo "<li><a href='" . base_url('hr/announcement') . "'><i class='la la-bullhorn'></i><span>Announcements</span></a></li>";
                        echo " 
                         <li class='submenu forms'> 
                         <a href='#' class=''><i class='la la-object-group'></i><span>Requests for Approval</span><span class='menu-arrow'></span></a> 
                         <ul> 
                          
                             <li><a href='" . base_url('employee/approval') . "'>Pending Requests</a></li> 
                             <li><a href='" . base_url('employee/history') . "'>History</a></li> 
                         </ul> 
                          
                     </li> ";
                    }
                }

                ?>

            </ul>
        </div>
    </div>
</div>