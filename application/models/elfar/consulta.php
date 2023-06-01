<?php

defined('BASEPATH') or exit('No direct script access allowed') ;

class Consulta extends CI_Model{

    public function __construct () {
        parent::__construct();
        $this->load->database();
    }

    public function getData() {

        $select = "SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento FROM BO_ENO eno WHERE eno.id_un=135 ";
        // $from = "FROM BO_ENO eno ";
        // $where = "";
        // $sql = $select . $from . $where;
        //$sql = $select . $from;  

        $sql = $select;     
        $query = $this->db->query($sql) ;

        if ($query->num_rows() > 0) {
            return $query->row() ;
        } else {
            return false ;
        }
    }


    
    public function getDataId($cedula) {

        $select = "SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento ";
        $from = "FROM BO_ENO eno ";
        $where = "WHERE eno.id_un= '" . $cedula . "'";
        // $sql = $select . $from . $where;
        //$sql = $select . $from;  

        $sql = $select . $from . $where;   
        $query = $this->db->query($sql) ;

        if ($query->num_rows() > 0) {
            return $query->row() ;
        } else {
            return false ;
        }
    }

}
