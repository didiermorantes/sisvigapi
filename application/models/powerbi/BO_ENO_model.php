<?php

defined('BASEPATH') or exit('No direct script access allowed') ;

class BO_ENO_model extends CI_Model{

    

    public function __construct () {
        parent::__construct();
        $this->load->database();
    }

    
    public function getDataIdEventoPadre($id_evento_padre) {
/*
        echo '<pre>';
        print_r($id_evento_padre);
        echo '</pre>';
*/


        // SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento, eno.numero_casos, eno.sexo, eno.id_rango, eno.id_corregimiento FROM BO_ENO eno WHERE eno.id_evento_padre='INFECCIONES RESPIRATORIAS' ;
        $select = "SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento, eno.numero_casos, eno.sexo, eno.id_rango, eno.id_corregimiento ";
        $from = "FROM BO_ENO eno ";
        // el id_evento_padre necesita comillas porque es string
        $where = "WHERE eno.id_evento_padre= '" . $id_evento_padre . "'";
        // $sql = $select . $from . $where;
        //$sql = $select . $from;  

        $sql = $select . $from . $where;   
        $cadena  = '';


        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {

        foreach ($query->result() as $row) {
            $bo_eno_data[] = [
                'id_un' => $row->id_un,
                'fecha_inic' => $row->fecha_inic,
                'id_grupo' => $row->id_grupo,
                'id_evento' => $row->id_evento,
                'numero_casos' => $row->numero_casos,
                'sexo' => $row->sexo,
                'id_rango' => $row->id_rango,
                'id_corregimiento' => $row->id_corregimiento,
            ];
        }

        
            // return $query->row() ;
            // return $cadena;
            //return 'EXITO';
        return $bo_eno_data;

        } else {
            return false ;
        }
    }


    public function getDataBO_ENOfechaInic($fecha_inic) {
/*
        echo '<pre>';
        print_r($fecha_inic);
        echo '</pre>';

*/

        // SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento, eno.numero_casos, eno.sexo, eno.id_rango, eno.id_corregimiento FROM BO_ENO eno WHERE eno.id_evento_padre='INFECCIONES RESPIRATORIAS' ;
        $select = "SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento, eno.numero_casos, eno.sexo, eno.id_rango, eno.id_corregimiento ";
        $from = "FROM BO_ENO eno ";
        // el id_evento_padre necesita comillas porque es string
        $where = "WHERE eno.fecha_inic= '" . $fecha_inic . "'";
        // $sql = $select . $from . $where;
        //$sql = $select . $from;  

        $sql = $select . $from . $where;   
        $cadena  = '';


        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {

        foreach ($query->result() as $row) {
            $bo_eno_data[] = [
                'id_un' => $row->id_un,
                'fecha_inic' => $row->fecha_inic,
                'id_grupo' => $row->id_grupo,
                'id_evento' => $row->id_evento,
                'numero_casos' => $row->numero_casos,
                'sexo' => $row->sexo,
                'id_rango' => $row->id_rango,
                'id_corregimiento' => $row->id_corregimiento,
            ];
        }

        
            // return $query->row() ;
            // return $cadena;
            //return 'EXITO';
        return $bo_eno_data;

        } else {
            return false ;
        }
    }
}

