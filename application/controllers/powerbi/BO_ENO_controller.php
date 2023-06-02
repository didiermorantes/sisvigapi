<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class BO_ENO_controller extends REST_Controller {
    // para suprimir errores de php
    public $db;
    public $format;
    public $auth_override;
    public $BO_ENO_model;
    // para suprimir errores de php
    
    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('powerbi/BO_ENO_model');
    }



    public function id_evento_padre_get() {
        $id_evento_padre = $this->get('id');
        // quitamos los espacios en blanco codificados en la url como %20
        $id_evento_padre_con_espacio = urldecode($id_evento_padre);
        // limpiamos espacios al principio y al final
        $id_evento_padre_limpio = trim($id_evento_padre_con_espacio);
      

        if ($id_evento_padre_limpio === null) {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'Error en el URL'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

        if ($id_evento_padre_limpio === "") {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'id evento padre no ingresado'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        } else {


                    $dat = $this->BO_ENO_model->getDataIdEventoPadre($id_evento_padre_limpio);

                    if ($dat) {
                        $this->response([
                            'STATUS' => TRUE,
                            'MESSAGE' => 'datos encontrados',
                            "DATA" => $dat
                                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                    } else {
                        $this->response([
                            'STATUS' => TRUE,
                            'MESSAGE' => 'datos no encontrados por id_evento_padre',
                            'id_evento_padre' => $id_evento_padre_limpio
                                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                    }

    }

    }


    public function fecha_inic_get() {
        $fecha_inic = $this->get('fecha');
        // quitamos los espacios en blanco codificados en la url como %20
        // $fecha_inic_con_espacio = urldecode($id_evento_padre);
        // limpiamos espacios al principio y al final
        $fecha_inic_limpio = trim($fecha_inic);
      

        if ($fecha_inic_limpio === null) {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'Error en el URL'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

        if ($fecha_inic_limpio === "") {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'fecha_inic no ingresado'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        } else {


                    $dat = $this->BO_ENO_model->getDataBO_ENOfechaInic($fecha_inic_limpio);

                    if ($dat) {
                        $this->response([
                            'STATUS' => TRUE,
                            'MESSAGE' => 'datos encontrados',
                            "DATA" => $dat
                                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                    } else {
                        $this->response([
                            'STATUS' => TRUE,
                            'MESSAGE' => 'datos no encontrados por fecha_inic',
                            'id_evento_padre' => $fecha_inic_limpio
                                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                    }

    }

    }


}
