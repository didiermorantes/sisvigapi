<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class VIEW_BO_ENO_controller extends REST_Controller {
    // para suprimir errores de php
    public $db;
    public $format;
    public $auth_override;
    public $VIEW_BO_ENO_model;
    // para suprimir errores de php


    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('powerbi/VIEW_BO_ENO_model');
    }


    public function index_get(){
        $this->response([
            'STATUS' => FALSE,
            'MESSAGE' => 'Proporcione un endpoint completo '
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
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


                    $dat = $this->VIEW_BO_ENO_model->getDataIdEventoPadre($id_evento_padre_limpio);

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


    public function id_evento_padre_download_get() {
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


                    $dat = $this->VIEW_BO_ENO_model->getDataIdEventoPadreDownload($id_evento_padre_limpio);

                    if ($dat) {

                        try{
                            $fileName = 'view_bo_eno_evento_padre.txt';
                            // convertimos arreglo a json
                            $arrayToJson = json_encode($dat);
                            // formateamos el json a utf-8
                            $file = mb_convert_encoding($arrayToJson, "UTF-8");
                            // abrimos el archivo en modo escritura
                            $fp = fopen($fileName, "w");
                            // escribimos en el archvo abierto los datos utf-8
                            fwrite($fp, $file);
                            // cerramos el archivo
                            fclose($fp);
                            //preparamos cabeceras para descarga
                            header("Content-Transfer-Encoding: binary");
                            header("Content-Type: application/octet-stream");
                            header("Content-Disposition: attachment; filename= $fileName");
                            readfile($fileName);
                            unlink($fileName);


                        }
                        catch(Exception $e){
                            echo 'Excepción creando archivo capturada: ',  $e->getMessage(), "\n";
                        }




                    } else {
                        $this->response([
                            'STATUS' => TRUE,
                            'MESSAGE' => 'datos no encontrados por id_evento_padre',
                            'id_evento_padre' => $id_evento_padre_limpio
                                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                    }

    }

    }





    public function fecha_inic_download_get() {

        $fecha_inic = $this->get('fecha');
        // quitamos los espacios en blanco codificados en la url como %20
        // $fecha_inic_con_espacio = urldecode($id_evento_padre);
        // limpiamos espacios al principio y al final

    

        if ($fecha_inic === "") {

                // LA fecha estaba vacia
                $this->response([
                    'STATUS' => FALSE,
                    'MESSAGE' => 'fecha_inic no ingresado'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            


        } else {
                    // si hay fecha valida la limpiamos y consultamos. Hacemos segunda validacion porque a veces no toma bien la primera validacion
                    if($fecha_inic != '' || $fecha_inic != null ){



                        $fecha_inic_limpio = trim($fecha_inic);


                        $dat = $this->VIEW_BO_ENO_model->getDataVIEW_BO_ENOfechaInic($fecha_inic_limpio);
                        

                        if ($dat) {

                            try{
                                $fileName = 'view_bo_eno_fecha_inic.txt';
                                // convertimos arreglo a json
                                $arrayToJson = json_encode($dat);
                                // formateamos el json a utf-8
                                $file = mb_convert_encoding($arrayToJson, "UTF-8");
                                // abrimos el archivo en modo escritura
                                $fp = fopen($fileName, "w");
                                // escribimos en el archvo abierto los datos utf-8
                                fwrite($fp, $file);
                                // cerramos el archivo
                                fclose($fp);
                                //preparamos cabeceras para descarga
                                header("Content-Transfer-Encoding: binary");
                                header("Content-Type: application/octet-stream");
                                header("Content-Disposition: attachment; filename= $fileName");
                                readfile($fileName);
                                unlink($fileName);


                            }
                            catch(Exception $e){
                                echo 'Excepción creando archivo capturada: ',  $e->getMessage(), "\n";
                            }




                        } else {
                            $this->response([
                                'STATUS' => TRUE,
                                'MESSAGE' => 'datos no encontrados por fecha_inic',
                                'fecha_inic' => $fecha_inic_limpio
                                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                        }


                    }
                    else{
                        $this->response([
                            'STATUS' => FALSE,
                            'MESSAGE' => 'fecha_inic no ingresado'
                                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code 
                    }



    }

    }

    public function view_bo_eno_data_download_get() {



                    $dat = $this->VIEW_BO_ENO_model->getAllDataVIEW_BO_ENO();

                    if ($dat) {

                        try{
                            $fileName = 'view_bo_eno_all_data.txt';
                            // convertimos arreglo a json
                            $arrayToJson = json_encode($dat);
                            // formateamos el json a utf-8
                            $file = mb_convert_encoding($arrayToJson, "UTF-8");
                            // abrimos el archivo en modo escritura
                            $fp = fopen($fileName, "w");
                            // escribimos en el archvo abierto los datos utf-8
                            fwrite($fp, $file);
                            // cerramos el archivo
                            fclose($fp);
                            //preparamos cabeceras para descarga
                            header("Content-Transfer-Encoding: binary");
                            header("Content-Type: application/octet-stream");
                            header("Content-Disposition: attachment; filename= $fileName");
                            readfile($fileName);
                            unlink($fileName);


                        }
                        catch(Exception $e){
                            echo 'Excepción creando archivo capturada: ',  $e->getMessage(), "\n";
                        }




                    } else {
                        $this->response([
                            'STATUS' => TRUE,
                            'MESSAGE' => 'datos no encontrados por id_evento_padre',
                            'id_evento_padre' => $id_evento_padre_limpio
                                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                    }

    

    }




    public function fecha_inic_get() {

        $fecha_inic = $this->get('fecha');
        // quitamos los espacios en blanco codificados en la url como %20
        // $fecha_inic_con_espacio = urldecode($id_evento_padre);
        // limpiamos espacios al principio y al final

      

        if ($fecha_inic === null) {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'Error en el URL'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

        if ($fecha_inic === "") {
            $this->response([
                'STATUS' => FALSE,
                'MESSAGE' => 'fecha_inic no ingresado'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        } else {
                    // si hay fecha valida la limpiamos y consultamos. Hacemos segunda validacion porque a veces no toma bien la primera validacion
                    if($fecha_inic != '' || $fecha_inic != null ){
                        $fecha_inic_limpio = trim($fecha_inic);


                        $dat = $this->VIEW_BO_ENO_model->getDataVIEW_BO_ENOfechaInic($fecha_inic_limpio);
                        

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
                                'fecha_inic' => $fecha_inic_limpio
                                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                        }


                    }
                    else{
                        $this->response([
                            'STATUS' => FALSE,
                            'MESSAGE' => 'fecha_inic no ingresado'
                                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code 
                    }



    }

    }


}
