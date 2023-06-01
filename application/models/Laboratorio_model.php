<?php

defined('BASEPATH') or exit('No direct script access allowed') ;

class Laboratorio_model extends CI_Model{

    public function __construct () {
        $this->load->database() ;
    }

    public function getcasoEnterprise ($cedula) {
        $sisvig = $this->load->database('enterprise', TRUE) ;
        $select = "SELECT t1.Tab38C2 AS CEDULA, t2.tab36c8 AS NOMBRE, t1.Tab38C4 AS RESULTADO, t1.Tab38C3 AS FECHA_RESULTADO " ;
        $from = "FROM Tab38 t1 " ;
        $join = "INNER JOIN Tab36 t2 ON t1.Tab38C2 = t2.tab36c7 " ;
        $where = "WHERE t1.Tab38C2 = '" . $cedula . "' " ;
        $order = "ORDER BY t1.Tab38C3 ASC" ;
        $sql = $select . $from . $join . $where . $order ;
        $resultados = $sisvig->query($sql) ;
        if ($resultados->num_rows() > 0) {
            return $resultados->result() ;
        } else {
            return false ;
        }
    }

}
