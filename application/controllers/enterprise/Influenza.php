<?php

use Restserver\Libraries\REST_Controller ;

defined('BASEPATH') or exit('No direct script access allowed') ;

require APPPATH . 'libraries/REST_Controller.php' ;
require APPPATH . 'libraries/Format.php' ;

class Influenza extends REST_Controller{

    function __construct () {
        parent::__construct() ;
        $this->load->model('enterprise/InfluenzaNotificacion_model') ;
    }

    //CONTROLADOR QUE MUESTRA LA INFORMACION POR CONSULTAS DE CEDULAS
    public function caso_get () {
        $cedula = $this->get('id') ;

        if ($cedula === null) {
            $this->response([
                'STATUS' => FALSE,
                'MENSAJE' => 'Error en el URL'
                    ], REST_Controller::HTTP_NOT_FOUND) ; // NOT_FOUND (404) being the HTTP response code
        }

        if ($cedula === "") {
            $this->response([
                'STATUS' => FALSE,
                'MENSAJE' => 'Cedula no ingresada'
                    ], REST_Controller::HTTP_NOT_FOUND) ; // NOT_FOUND (404) being the HTTP response code
        } else {
            $numero_identificacion = $this->InfluenzaNotificacion_model->getInfluenzaCaso($cedula) ;

            if ($numero_identificacion) {
                $this->response([
                    'STATUS' => TRUE,
                    'MENSAJE' => 'Cedula encontrada',
                    'CEDULA' => $cedula,
                    "DETALLE" => $numero_identificacion
                        ], REST_Controller::HTTP_OK) ; // OK (200) being the HTTP response code
            } else {
                $this->response([
                    'STATUS' => TRUE,
                    'MENSAJE' => 'Cedula no encontrada',
                    'CEDULA' => $cedula
                        ], REST_Controller::HTTP_NOT_FOUND) ; // NOT_FOUND (404) being the HTTP response code
            }
        }
    }

    //CONTROLADOR QUE MUESTRA LA INFORMACION POR CONSULTAS DE CODIGOS DE MUESTRAS
    public function muestra_get () {
        $codigo = $this->get('id') ;

        if ($codigo === null) {
            $this->response([
                'STATUS' => FALSE,
                'MENSAJE' => 'Error en el URL'
                    ], REST_Controller::HTTP_NOT_FOUND) ; // NOT_FOUND (404) being the HTTP response code
        }

        if ($codigo === "") {
            $this->response([
                'STATUS' => FALSE,
                'MENSAJE' => 'Muestra no ingresada'
                    ], REST_Controller::HTTP_NOT_FOUND) ; // NOT_FOUND (404) being the HTTP response code
        } else {
            $codigo_muestra = $this->InfluenzaNotificacion_model->getMuestra($codigo) ;

            if ($codigo_muestra) {
                $this->response([
                    'STATUS' => TRUE,
                    'MENSAJE' => 'Muestra encontrada',
                    'CODIGO' => $codigo,
                    "DETALLE" => $codigo_muestra
                        ], REST_Controller::HTTP_OK) ; // OK (200) being the HTTP response code
            } else {
                $this->response([
                    'STATUS' => TRUE,
                    'MENSAJE' => 'Muestra no encontrada',
                    'CEDULA' => $codigo
                        ], REST_Controller::HTTP_NOT_FOUND) ; // NOT_FOUND (404) being the HTTP response code
            }
        }
    }
	
	
    //CONTROLADOR QUE MUESTRA LA INFORMACION POR CONSULTAS DE CEDULAS
    public function demografico_get()
    {
        $cedula = $this->get('id');

        if ($cedula === null) {
            $this->response([
                'STATUS' => FALSE,
                'MENSAJE' => 'Error en el URL'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

        if ($cedula === "") {
            $this->response([
                'STATUS' => FALSE,
                'MENSAJE' => 'Cedula no ingresada'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        } else {
            $numero_identificacion = $this->InfluenzaNotificacion_model->getInfluenzaCasoDemografico($cedula);

            if ($numero_identificacion) {
                $this->response([
                    'STATUS' => TRUE,
                    'MENSAJE' => 'Cedula encontrada',
                    'CEDULA' => $cedula,
                    "DETALLE" => $numero_identificacion
                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->response([
                    'STATUS' => TRUE,
                    'MENSAJE' => 'Cedula no encontrada',
                    'CEDULA' => $cedula
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }

}
