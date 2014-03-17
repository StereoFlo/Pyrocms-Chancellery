<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| 	www.your-site.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://www.codeigniter.com/user_guide/general/routing.html
*/

$route['chancellery/admin/contractors(/:any)?'] = 'admin_contractors$1';
$route['chancellery/admin/items(/:any)?'] = 'admin_items$1';
$route['chancellery/admin/users(/:any)?'] = 'admin_users$1';
$route['chancellery/admin/report(/:any)?'] = 'admin_report$1';
$route['chancellery/admin/limit(/:any)?'] = 'admin_limit$1';