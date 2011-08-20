<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';

$route['ajax'] = 'ajax';
$route['api'] = 'api';
$route['home'] = 'home';
$route['login'] = 'login';
$route['logout'] = 'logout';
$route['profile'] = 'profile';
$route['saved_links'] = 'saved_links';
$route['signup'] = 'signup';
$route['spool'] = 'spool';
$route['test'] = 'test';

$route['ajax/(:any)'] = 'ajax/$1';
$route['api/(:any)'] = 'api/$1';
$route['home/(:any)'] = 'home/$1';
$route['login/(:any)'] = 'login/$1';
$route['logout/(:any)'] = 'logout/$1';
$route['profile/(:any)'] = 'profile/$1';
$route['saved_links/(:any)'] = 'saved_links/$1';
$route['signup/(:any)'] = 'signup/$1';
$route['spool/(:any)'] = 'spool/$1';
$route['test/(:any)'] = 'test/$1';

$route[''] = '';

//$route['(:any)'] = 'profile/display_by_username/$1';


/* End of file routes.php */
/* Location: ./application/config/routes.php */