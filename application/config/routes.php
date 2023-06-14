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
  |	https://codeigniter.com/user_guide/general/routing.html
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
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//SERVICIO DEMO
$route['API'] = 'Rest_server';

//SERVICIO PARA ENTERPRISE
$route['enterprise/influenza/casos'] = 'enterprise/influenza/casos';
$route['enterprise/influenza/caso/([a-zA-Z0-9]+)'] = 'enterprise/influenza/caso';

//SERVICIO PARA ESRI
//$route['sisvig/influenza/casos'] = 'sisvig/influenza/casos'; // GET ALL CASES
$route['sisvig/influenza/caso/([a-zA-Z0-9]+)'] = 'sisvig/influenza/caso'; // GET BY CEDULA
//SERVICIO PARA COVID19
$route['covid19/influenza/casos'] = 'covid19/influenza/casos'; // GET ALL CASES
//SERVICIO PARA PACIENTE
$route['pasiente/individuo/caso/([a-zA-Z0-9]+)'] = 'pasiente/individuo/caso'; // GET BY CEDULA

//SERVICIO PARA BO_ENO POR EVENTO PADRE
$route['powerbi/bo_eno_controller/id_evento_padre/([a-zA-Z0-9]+)'] = 'powerbi/bo_eno_controller/id_evento_padre'; // GET BY id_evento_padre

//SERVICIO PARA BO_ENO POR EVENTO FECHA INIC
$route['powerbi/bo_eno_controller/fecha_inic/([a-zA-Z0-9]+)'] = 'powerbi/bo_eno_controller/fecha_inic'; // GET BY fecha_inic

//SERVICIO PARA BO_ENO POR EVENTO FECHA INIC
$route['powerbi/view_bo_eno_controller/fecha_inic/([a-zA-Z0-9]+)'] = 'powerbi/view_bo_eno_controller/fecha_inic'; // GET BY fecha_inic

//SERVICIO PARA BO_ENO POR EVENTO FECHA INIC
$route['powerbi/view_bo_eno_controller/fecha_inic_download/([a-zA-Z0-9]+)'] = 'powerbi/view_bo_eno_controller/fecha_inic_download'; // GET BY fecha_inic

//SERVICIO PARA BO_ENO POR EVENTO PADRE
$route['powerbi/view_bo_eno_controller/id_evento_padre_download/([a-zA-Z0-9]+)'] = 'powerbi/view_bo_eno_controller/id_evento_padre_download'; // GET BY fecha_inic

//SERVICIO PARA EL TOTAL DE LA VISTA
$route['powerbi/view_bo_eno_controller/view_bo_eno_data_download'] = 'powerbi/view_bo_eno_controller/view_bo_eno_data_download'; // GET ALL CASES