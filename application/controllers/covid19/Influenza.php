<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Influenza extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('covid19');
    }

    public function casos_get() {
        $covid = $this->covid19->getcasos();
        $detected = null;
        $nodetected = null;

        foreach ($covid as $item) {
            if ($item->resultado_prueba == "DETECTADO") {
                $detected = $detected + 1;
            } else if ($item->resultado_prueba == "NO DETECTADO") {
                $nodetected = $nodetected + 1;
            }
        }

        if ($covid) {
            // Set the response and exit
            $this->response([
                'STATUS' => TRUE,
                'REGISTROSX' => count($covid),
                'DETECTADOS' => $detected,
                'NO DETECTADOS' => $nodetected,
                'COVID' => $covid
                    ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'Error'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function caso_get() {
        $cedula = $this->get('id');

        if ($cedula === null) {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'Error en el URL'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

        if ($cedula === "") {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'Cedula no ingresada'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        } else {
            $covid = $this->covid19->getcasosbyced($cedula);

            if ($covid) {
                $this->response([
                    'STATUS' => TRUE,
                    'MESSAGE' => 'Cedula encontrada',
                    'CEDULA' => $cedula,
                    "COVID" => $covid
                        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->response([
                    'STATUS' => TRUE,
                    'MESSAGE' => 'Cedula no encontrada',
                    'CEDULA' => $cedula
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }

}
