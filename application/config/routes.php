<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';
// $route['hr'] = 'Hr';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// $route['(:any)'] = 'pages/view/$1';

// public routes
// $route['login'] = 'welcome/login';

$route['about'] = 'pages/public/about';

$route['logout'] = 'welcome/logout';
$route['forms'] = 'employee/forms';
// $route['forms/history'] = 'pages/forms_history';


//route['xx'] === link in browser
// pages ==== pages(controller)
//pages/xxxx === xxx(pages(controller)/function)
// ** EDIT ROUTE 
// hr 


$route['hr/importing'] = 'humanr/import_csv';
$route['hr/import'] = 'humanr/import';
$route['hr/dashboard'] = 'humanr/C_hr_dashboard';
$route['hr/announcement'] = 'humanr/C_hr_announcement';
$route['hr/profile'] = 'humanr/C_hr_profile';
$route['hr/profile/settings'] = 'humanr/C_hr_profile';
$route['hr/calendar'] = 'humanr/C_hr_calendar';


// hr/employees
$route['hr/employees'] = 'humanr/C_hr_employees';
$route['hr/employees-list'] = 'humanr/C_hr_employees_list';
$route['hr/employees/attendance'] = 'humanr/C_hr_emp_attendace';
$route['hr/employees/shifts'] = 'humanr/C_hr_emp_shifts';
$route['hr/employees/leaves'] = 'humanr/C_hr_emp_leaves';


// hr/reports
$route['hr/reports/timesheet'] = 'humanr/C_hr_report_timesheet';




$route['adduser'] = 'humanr/adduser';
$route['hr/departments'] = 'humanr/C_hr_departments';
$route['hr/settings'] = 'humanr/C_hr_settings';




$route['hr/assets'] = 'humanr/C_hr_assets';

$route['hr/pendingrequests'] = 'humanr/pending_req';
$route['hr/historyrequests'] = 'humanr/history_req';

// employee

$route['employee/dashboard'] = 'employee/emphome';
// $route['employee/profile'] = 'pages/emp_home';
// $route['employee/profile/settings'] = 'pages/emp_home';
$route['employee/pendingrequests'] = 'employee/pendingrequest';

// $route['employee/forms'] = 'pages/emp_home';
$route['forms/history'] = 'humanr/C_formshistory';


//ADMIN
$route['admin/dashboard'] = 'pages/admin_home';


// hr functions
$route['leave_request'] = 'employee/C_leave';
//
$route['ob_request'] = 'employee/C_off_buss';
$route['outgoing_request'] = 'employee/C_outgoing';
$route['undertime_request'] = 'employee/C_undertime';
$route['overtime_request'] = 'employee/C_overtime';
$route['worksched_adjust'] = 'employee/C_sched_adjust'; 




//php_ajax
$route['ajax/get_data'] = 'datatablec/ajax_get_data';

$route['report/generate'] = 'datatablec/ajax_get_data';

$route['mail/send'] = 'mailer/email_send';
//mail
$route['mail/test'] = 'mailer/test_email_send';
