<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// $route['(:any)'] = 'pages/view/$1';
$route['hr/dashboard'] = 'pages/hr_home';
$route['employee/home'] = 'pages/employee_home';
$route['login'] = 'admin/loginUI';
$route['about'] = 'pages/about';



