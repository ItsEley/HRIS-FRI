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
$route['resources/forms'] = 'pages/forms';


// hr 
$route['hr/dashboard'] = 'pages/hr_home';
$route['hr/announcement'] = 'pages/hr_announcement';
$route['hr_profile'] = 'pages/hr_profile';

$route['hr/employees'] = 'pages/hr_employees';

// hr functions
$route['user_profile'] = 'pages/user_profile';
$route['leaverequestzz'] = 'admin/leaverequestzz';







// employee

$route['employee/home'] = 'pages/emp_home';



// functions

$route['edituser'] = 'admin/updateuser';
$route['adduser'] = 'admin/adduser';
$route['admin/showUserdetails'] = 'admin/showUserdetails';




