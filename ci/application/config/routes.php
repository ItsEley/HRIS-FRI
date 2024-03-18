<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// $route['default_controller'] = 'welcome';
// $route['hr'] = 'Hr';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// $route['(:any)'] = 'pages/view/$1';

// public routes
$route['login'] = 'welcome/login';

$route['about'] = 'pages/public/about';

$route['logout'] = 'welcome/logout';
$route['forms'] = 'employee/forms';
// $route['forms/history'] = 'pages/forms_history';


//route['xx'] === link in browser
// pages ==== pages(controller)
//pages/xxxx === xxx(pages(controller)/function)
// ** EDIT ROUTE 
// hr 
$route['hr/dashboard'] = 'humanr/C_hr_dashboard';
$route['hr/announcement'] = 'humanr/C_hr_announcement';
$route['hr/profile'] = 'humanr/C_hr_profile';
$route['hr/profile/settings'] = 'humanr/C_hr_profile';
$route['hr/employees'] = 'humanr/C_hr_employees';
$route['hr/employees/attendance'] = 'humanr/C_hr_emp_attendace';
$route['hr/employees/shifts'] = 'humanr/C_hr_emp_shifts';

$route['hr/departments'] = 'humanr/C_hr_departments';
$route['hr/settings'] = 'humanr/C_hr_settings';




$route['hr/assets'] = 'humanr/C_hr_assets';

$route['hr/pendingrequests'] = 'humanr/pending_req';

$route['hr/forms/history'] = 'humanr/leave_pending';


// employee

$route['employee/dashboard'] = 'employee/emphome';
// $route['employee/profile'] = 'pages/emp_home';
// $route['employee/profile/settings'] = 'pages/emp_home';


// $route['employee/forms'] = 'pages/emp_home';
$route['forms/history'] = 'humanr/C_formshistory';


// functions
// $route['edituser'] = 'admin/updateuser';
$route['adduser'] = 'humanr/adduser';
// $route['admin/showUserdetails'] = 'admin/showUserdetails';


//ADMIN

$route['admin/dashboard'] = 'pages/admin_home';


// hr functions
$route['leaverequestzz'] = 'humanr/leaverequestzz';
$route['ob_requestzz'] = 'humanr/ob_requestzz';
$route['outgoingrequestzz'] = 'human/outgoingrequestzz';
$route['undertimerequestzz'] = 'humanr/undertimerequestzz';
$route['overtimerequestzz'] = 'humanr/overtimerequestzz';
$route['workschedadjustzz'] = 'humanr/workschedadjustzz';