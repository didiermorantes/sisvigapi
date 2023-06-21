<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

// class Usuarios2 extends CI_Controller{
class Usuarios2 extends REST_Controller{

    // evitar errores de php
    public $db;
    public $format;
    public $auth_override;
    public $UM;
    
    public function index_get(){
        $this->response([
            'STATUS' => FALSE,
            'MESSAGE' => 'Proporcione un endpoint completo '
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
    }
    
    
    public function saludar_get(){
        $elDato = $this->get('dato');
        $this->load->model('prueba/Usuarios_Model2','UM',true);
        $datos['Usuarios2']=$this->UM->getAll();
        $this->response([
                        'STATUS' => TRUE,
                        'MESSAGE' => 'datos encontrados',
                        'datoInsertado' => $elDato,
                        "DATA" => $datos
                        ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        // $this->load->view('prueba/usuarioSaludo2.php',$datos);
    }   
}
?>