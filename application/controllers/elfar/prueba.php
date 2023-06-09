<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Prueba extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('elfar/Consulta');
    }


    public function casos_get() {

        $dat = $this->Consulta->getData();

        if ($dat) {
            $this->response([
                'STATUS' => TRUE,
                'MESSAGE' => 'datos encontrados',
                "DATA" => $dat
                    ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'datos no encontrados',
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

         

         /*
         $cedula = $this->get('id');
        if ($cedula === null) {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'Error en el URL. Falta parametro'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }


        if ($cedula === "") {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'Cedula no ingresada. No deje campo vacio'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        } else {
            $dat = $this->Consulta->getData($cedula);

            if ($dat) {
                $this->response([
                    'STATUS' => TRUE,
                    'MESSAGE' => 'datos encontrados',
                    'CEDULA' => $cedula,
                    "DATA" => $dat
                        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->response([
                    'STATUS' => TRUE,
                    'MESSAGE' => 'datos no encontrados',
                    'CEDULA' => $cedula
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }


        */

    }

    public function caso_get() {
        $id_evento = $this->get('id');
      

        if ($id_evento === null) {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'Error en el URL'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

        if ($id_evento === "") {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'Cedula no ingresada'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        } else {


                    $dat = $this->Consulta->getDataId($id_evento);

                    if ($dat) {
                        $this->response([
                            'STATUS' => TRUE,
                            'MESSAGE' => 'datos encontrados',
                            "DATA" => $dat
                                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                    } else {
                        $this->response([
                            'STATUS' => TRUE,
                            'MESSAGE' => 'datos no encontrados id_un',
                            'id_un' => $id_evento
                                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                    }

    }

         

         /*
         $cedula = $this->get('id');
        if ($cedula === null) {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'Error en el URL. Falta parametro'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }


        if ($cedula === "") {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'Cedula no ingresada. No deje campo vacio'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        } else {
            $dat = $this->Consulta->getData($cedula);

            if ($dat) {
                $this->response([
                    'STATUS' => TRUE,
                    'MESSAGE' => 'datos encontrados',
                    'CEDULA' => $cedula,
                    "DATA" => $dat
                        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->response([
                    'STATUS' => TRUE,
                    'MESSAGE' => 'datos no encontrados',
                    'CEDULA' => $cedula
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }


        */

    }










    /*
    public function casos_get() {
        $covid = $this->covid->getcasos();
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

    public function casoXXXXXXXXXXXXXXXXX_get() {
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
            $covid = $this->covid->getcasosbycedXXXXXXXXX($cedula);

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

    public function caso2_get() {
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
            $covid = $this->covid2->getNotificacion($cedula);

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

*/



}
