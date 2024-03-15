<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// $route['(:any)'] = 'pages/view/$1';

// public routes
$route['login'] = 'admin/loginUI';
$route['about'] = 'pages/about';
$route['logout'] = 'admin/logout';
$route['forms'] = 'pages/forms';
$route['forms/history'] = 'pages/forms_history';



//route['xx'] === link in browser
// pages ==== pages(controller)
//pages/xxxx === xxx(pages(controller)/function)
// ** EDIT ROUTE 
// hr 
$route['dashboard'] = 'pages/C_hr_home';
$route['announcements'] = 'pages/C_hr_announcement';
$route['profile'] = 'pages/hr_profile';
$route['view_employees'] = 'pages/hr_employees';
$route['viewAttendance'] = 'pages/hr_attendance';
$route['viewpending'] = 'pages/forms_pending';
$route['viewrequests'] = 'pages/leave_pending';
$route['viewdepartments'] = 'pages/departments';

// hr functions
$route['user'] = 'pages/user_profile';
$route['leaverequestzz'] = 'admin/leaverequestzz';
$route['ob_requestzz'] = 'admin/ob_requestzz';
$route['outgoingrequestzz'] = 'admin/outgoingrequestzz';
$route['undertimerequestzz'] = 'admin/undertimerequestzz';
$route['overtimerequestzz'] = 'admin/overtimerequestzz';
$route['workschedadjustzz'] = 'admin/workschedadjustzz';

// employee

$route['employee/home'] = 'pages/emp_home';


// functions
$route['edituser'] = 'admin/updateuser';
$route['adduser'] = 'admin/adduser';
$route['admin/showUserdetails'] = 'admin/showUserdetails';


//ADMIN

$route['admin/home'] = 'pages/adm_home';




