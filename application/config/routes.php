<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = 'welcome/pageNotFound';
$route['translate_uri_dashes'] = FALSE;

//Route arriver
$route['arriver']['GET'] = 'arrivers/ArriverController/index';
$route['arriver/add']['GET'] = 'arrivers/ArriverController/create';
$route['arriver/add']['POST'] = 'arrivers/ArriverController/store';
$route['arriver/edit/(:any)']['GET'] = 'arrivers/ArriverController/edit/$1';
$route['arriver/show/(:any)']['GET'] = 'arrivers/ArriverController/show/$1';
$route['arriver/update/(:any)']['POST'] = 'arrivers/ArriverController/update/$1';
$route['arriver/delete/(:any)']['GET'] = 'arrivers/ArriverController/delete/$1';
//Route for download
$route['arriver/download/(:any)']['GET'] = 'arrivers/ArriverController/download/$1';
//Route for preview
$route['arriver/preview/(:any)']['GET'] = 'arrivers/ArriverController/preview/$1';

// Route pour le dashbord
$route['dashboard']['GET'] = 'DashboardController/index';

// Route pour le contact
$route['contact']['GET'] = 'ContactController/index';
$route['contact/add']['GET'] = 'ContactController/create';
$route['contact/add']['POST'] = 'ContactController/store';
$route['contact/show/(:any)']['GET'] = 'ContactController/show/$i';
$route['contact/delete/(:any)']['GET'] = 'ContactController/delete/$1';

// Route pour le profil
$route['profil']['GET'] = 'auth/ProfilController/index';
$route['profil/show/(:any)']['GET'] = 'auth/ProfilController/show/$1';
$route['profil/update/(:any)']['POST'] = 'auth/ProfilController/update/$1';
$route['profil/delete_image/(:any)']['GET'] = 'auth/ProfilController/delete_image/$1';
$route['profil/changePassword/(:any)']['POST'] = 'auth/ProfilController/changePassword/$1';

//Register et login route
$route['register']['GET'] = 'auth/RegisterController/index';
$route['register/add']['GET'] = 'auth/RegisterController/create';
$route['register/add']['POST'] = 'auth/RegisterController/register';
$route['register/edit/(:any)']['GET'] = 'auth/RegisterController/edit/$1';
$route['register/show/(:any)']['GET'] = 'auth/RegisterController/show/$1';
$route['register/update/(:any)']['POST'] = 'auth/RegisterController/update/$1';
$route['register/delete/(:any)']['GET'] = 'auth/RegisterController/delete/$1';

//Login
$route['connexion']['GET'] = 'auth/LoginController/index';
$route['connexion']['POST'] = 'auth/LoginController/login';

$route['logout']['GET'] = 'auth/LogoutController/logout';

$route['userpage']['GET'] = 'UserController/index';
$route['adminpage']['GET'] = 'AdminController/index';

//Route depart
$route['depart']['GET'] = 'departs/DepartController/index';
$route['depart/add']['GET'] = 'departs/DepartController/create';
$route['depart/add']['POST'] = 'departs/DepartController/store';
$route['depart/edit/(:any)']['GET'] = 'departs/DepartController/edit/$1';
$route['depart/show/(:any)']['GET'] = 'departs/DepartController/show/$1';
$route['depart/update/(:any)']['POST'] = 'departs/DepartController/update/$1';
$route['depart/delete/(:any)']['GET'] = 'departs/DepartController/delete/$1';

//Route for download
$route['depart/download/(:any)']['GET'] = 'departs/DepartController/download/$1';
//Route for preview
$route['depart/preview/(:any)']['GET'] = 'departs/DepartController/preview/$1';

//Route depart
$route['comite']['GET'] = 'comites/ComiteController/index';
$route['comite/add']['GET'] = 'comites/ComiteController/create';
$route['comite/add']['POST'] = 'comites/ComiteController/store';
$route['comite/edit/(:any)']['GET'] = 'comites/ComiteController/edit/$1';
$route['comite/show/(:any)']['GET'] = 'comites/ComiteController/show/$1';
$route['comite/update/(:any)']['POST'] = 'comites/ComiteController/update/$1';
$route['comite/delete/(:any)']['GET'] = 'comites/ComiteController/delete/$1';
$route['comite/deleteArchive/(:any)']['GET'] = 'comites/ComiteController/deleteArchives/$1';

//Route for download
$route['comite/download/(:any)']['GET'] = 'comites/ComiteController/download/$1';
//Route for preview
$route['comite/preview/(:any)']['GET'] = 'comites/ComiteController/preview/$1';

//Route depart
$route['depart']['GET'] = 'departs/DepartController/index';
$route['depart/add']['GET'] = 'departs/DepartController/create';
$route['depart/add']['POST'] = 'departs/DepartController/store';
$route['depart/edit/(:any)']['GET'] = 'departs/DepartController/edit/$1';
$route['depart/show/(:any)']['GET'] = 'departs/DepartController/show/$1';
$route['depart/update/(:any)']['POST'] = 'departs/DepartController/update/$1';
$route['depart/delete/(:any)']['GET'] = 'departs/DepartController/delete/$1';

//Route personne
$route['personne']['GET'] = 'personnes/PersonneController/index';
$route['personne/add']['GET'] = 'personnes/PersonneController/create';
$route['personne/add']['POST'] = 'personnes/PersonneController/store';
$route['personne/edit/(:any)']['GET'] = 'personnes/PersonneController/edit/$1';
$route['personne/show/(:any)']['GET'] = 'personnes/PersonneController/show/$1';
$route['personne/update/(:any)']['POST'] = 'personnes/PersonneController/update/$1';
$route['personne/delete/(:any)']['GET'] = 'personnes/PersonneController/delete/$1';

//Route activite
$route['activite']['GET'] = 'activites/ActiviteController/index';
$route['activite/add']['GET'] = 'activites/ActiviteController/create';
$route['activite/add']['POST'] = 'activites/ActiviteController/store';
$route['activite/edit/(:any)']['GET'] = 'activites/ActiviteController/edit/$1';
$route['activite/show/(:any)']['GET'] = 'activites/ActiviteController/show/$1';
$route['activite/update/(:any)']['POST'] = 'activites/ActiviteController/update/$1';
$route['activite/delete/(:any)']['GET'] = 'activites/ActiviteController/delete/$1';

