<?php

defined('BASEPATH') or exit('No direct script access allowed') ;

class VIEW_BO_ENO_model extends CI_Model{

    

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

/*
        // SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento, eno.numero_casos, eno.sexo, eno.id_rango, eno.id_corregimiento FROM BO_ENO eno WHERE eno.id_evento_padre='INFECCIONES RESPIRATORIAS' ;
        $select = "SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento, eno.numero_casos, eno.sexo, eno.id_rango, eno.id_corregimiento ";
        $from = "FROM BO_ENO eno ";
        // el id_evento_padre necesita comillas porque es string
        $where = "WHERE eno.id_evento_padre= '" . $id_evento_padre . "'";
        // $sql = $select . $from . $where;
        //$sql = $select . $from;  
*/

        // SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento, eno.numero_casos, eno.sexo, eno.id_rango, eno.id_corregimiento FROM BO_ENO eno WHERE eno.id_evento_padre='INFECCIONES RESPIRATORIAS' ;
        $select = "SELECT view_eno.id_un, view_eno.fecha_inic, view_eno.id_evento_padre, view_eno.id_grupo, view_eno.id_evento, view_eno.numero_casos, view_eno.sexo, view_eno.id_rango, view_eno.id_corregimiento ";
        $from = "FROM VIEW_BO_ENO view_eno ";
        // el id_evento_padre necesita comillas porque es string
        $where = "WHERE view_eno.id_evento_padre= '" . $id_evento_padre . "'";
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



    public function getDataIdEventoPadreDownload($id_evento_padre) {
        /*
                echo '<pre>';
                print_r($id_evento_padre);
                echo '</pre>';
        */
        
        /*
                // SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento, eno.numero_casos, eno.sexo, eno.id_rango, eno.id_corregimiento FROM BO_ENO eno WHERE eno.id_evento_padre='INFECCIONES RESPIRATORIAS' ;
                $select = "SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento, eno.numero_casos, eno.sexo, eno.id_rango, eno.id_corregimiento ";
                $from = "FROM BO_ENO eno ";
                // el id_evento_padre necesita comillas porque es string
                $where = "WHERE eno.id_evento_padre= '" . $id_evento_padre . "'";
                // $sql = $select . $from . $where;
                //$sql = $select . $from;  
        */
        
                // SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento, eno.numero_casos, eno.sexo, eno.id_rango, eno.id_corregimiento FROM BO_ENO eno WHERE eno.id_evento_padre='INFECCIONES RESPIRATORIAS' ;
                $select = "SELECT view_eno.id_un, view_eno.fecha_inic, view_eno.id_evento_padre, view_eno.id_grupo, view_eno.id_rango, view_eno.`COUNT(numero_casos)` ";
                $from = "FROM VIEW_BO_ENO view_eno ";
                // el id_evento_padre necesita comillas porque es string
                $where = "WHERE view_eno.id_evento_padre= '" . $id_evento_padre . "'";
                // $sql = $select . $from . $where;
                //$sql = $select . $from;  
        
        
                $sql = $select . $from . $where;   
                $cadena  = '';
        
        
                $query = $this->db->query($sql);
        
                if ($query->num_rows() > 0) {
        
                foreach ($query->result() as $row) {
                    $view_bo_eno_data[] = [
                        'id_un' => $row->id_un,
                        'fecha_inic' => $row->fecha_inic,
                        'id_evento_padre' => $row->id_evento_padre,
                        'id_grupo' => $row->id_grupo,
                        'id_rango' => $row->id_rango,
                        // Es necesario utilizar la notación de llaves porque el nombre de la propiedad es compuesto y posee nombres de funcions
                        'COUNT(numero_casos)' => $row->{'COUNT(numero_casos)'}
                    ];
                }
        
                
                    // return $query->row() ;
                    // return $cadena;
                    //return 'EXITO';
                return $view_bo_eno_data;
        
                } else {
                    return false ;
                }
            }


    public function getDataVIEW_BO_ENOfechaInic($fecha_inic) {
/*
        echo '<pre>';
        print_r($fecha_inic);
        echo '</pre>';

*/

        // SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento, eno.numero_casos, eno.sexo, eno.id_rango, eno.id_corregimiento FROM BO_ENO eno WHERE eno.id_evento_padre='INFECCIONES RESPIRATORIAS' ;
        // ojo con el espacio al final en cada cadena. Como es concatenación SE NECESITAN DICHOS ESPACIOS
        // ojo con los nombres de alias que tengan el mismo nombre que la funcion COUNT, hay que usar backticks
        $select = "SELECT view_eno.id_un, view_eno.fecha_inic, view_eno.id_evento_padre, view_eno.id_grupo, view_eno.id_rango, view_eno.`COUNT(numero_casos)` ";
        $from = "FROM VIEW_BO_ENO view_eno ";
        // el id_evento_padre necesita comillas porque es string
        $where = "WHERE view_eno.fecha_inic= '" . $fecha_inic . "'";
        // $sql = $select . $from . $where;
        //$sql = $select . $from;  

        $sql = $select . $from . $where;   
        $cadena  = '';


        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {

        foreach ($query->result() as $row) {
            $view_bo_eno_data[] = [
                'id_un' => $row->id_un,
                'fecha_inic' => $row->fecha_inic,
                'id_evento_padre' => $row->id_evento_padre,
                'id_grupo' => $row->id_grupo,
                'id_rango' => $row->id_rango,
                // Es necesario utilizar la notación de llaves porque el nombre de la propiedad es compuesto y posee nombres de funcions
                'COUNT(numero_casos)' => $row->{'COUNT(numero_casos)'}

            ];
        }

        
            // return $query->row() ;
            // return $cadena;
            //return 'EXITO';
        return $view_bo_eno_data;

        } else {
            return false ;
        }
    }


    public function getData_VIEW_BO_ENO_fechaInic_anio_mes($anio, $mes) {
        /*
                echo '<pre>';
                print_r($fecha_inic);
                echo '</pre>';
        
        */

        // consulta por mes y por año
        // SELECT * FROM tabla WHERE MONTH(colfecha) = 10 AND YEAR(colfecha) = 2016
        
                // SELECT view_eno.id_un, view_eno.fecha_inic, view_eno.id_evento_padre, view_eno.id_grupo, view_eno.id_rango, view_eno.`COUNT(numero_casos)` FROM VIEW_BO_ENO view_eno WHERE MONTH(view_eno.fecha_inic)= 2 AND YEAR(view_eno.fecha_inic)= 2018;
                // ojo con el espacio al final en cada cadena. Como es concatenación SE NECESITAN DICHOS ESPACIOS
                // ojo con los nombres de alias que tengan el mismo nombre que la funcion COUNT, hay que usar backticks
                $select = "SELECT view_eno.id_un, view_eno.fecha_inic, view_eno.id_evento_padre, view_eno.id_grupo, view_eno.id_rango, view_eno.`COUNT(numero_casos)` ";
                $from = "FROM VIEW_BO_ENO view_eno ";
                // el id_evento_padre necesita comillas porque es string
                $where = "WHERE MONTH(view_eno.fecha_inic)= '" . $mes . "' AND YEAR(view_eno.fecha_inic)= '" .$anio. "' ";
                // $sql = $select . $from . $where;
                //$sql = $select . $from;  
        
                $sql = $select . $from . $where;   
                $cadena  = '';
        
        
                $query = $this->db->query($sql);
        
                if ($query->num_rows() > 0) {
        
                foreach ($query->result() as $row) {
                    $view_bo_eno_data[] = [
                        'id_un' => $row->id_un,
                        'fecha_inic' => $row->fecha_inic,
                        'id_evento_padre' => $row->id_evento_padre,
                        'id_grupo' => $row->id_grupo,
                        'id_rango' => $row->id_rango,
                        // Es necesario utilizar la notación de llaves porque el nombre de la propiedad es compuesto y posee nombres de funcions
                        'COUNT(numero_casos)' => $row->{'COUNT(numero_casos)'}
        
                    ];
                }
        
                
                    // return $query->row() ;
                    // return $cadena;
                    //return 'EXITO';
                return $view_bo_eno_data;
        
                } else {
                    return false ;
                }
            }


    public function getAllDataVIEW_BO_ENO() {
        /*
                echo '<pre>';
                print_r($fecha_inic);
                echo '</pre>';
        
        */
        
                // SELECT eno.id_un, eno.fecha_inic, eno.id_evento_padre, eno.id_grupo, eno.id_evento, eno.numero_casos, eno.sexo, eno.id_rango, eno.id_corregimiento FROM BO_ENO eno WHERE eno.id_evento_padre='INFECCIONES RESPIRATORIAS' ;
                // ojo con el espacio al final en cada cadena. Como es concatenación SE NECESITAN DICHOS ESPACIOS
                // ojo con los nombres de alias que tengan el mismo nombre que la funcion COUNT, hay que usar backticks
                $select = "SELECT view_eno.id_un, view_eno.fecha_inic, view_eno.id_evento_padre, view_eno.id_grupo, view_eno.id_rango, view_eno.`COUNT(numero_casos)` ";
                $from = "FROM VIEW_BO_ENO view_eno ";
                // el id_evento_padre necesita comillas porque es string
                // $where = "WHERE view_eno.fecha_inic= '" . $fecha_inic . "'";
                // $sql = $select . $from . $where;
                //$sql = $select . $from;  
        
                $sql = $select . $from;   
                $cadena  = '';
        
        
                $query = $this->db->query($sql);
        
                if ($query->num_rows() > 0) {
        
                foreach ($query->result() as $row) {
                    $view_bo_eno_data[] = [
                        'id_un' => $row->id_un,
                        'fecha_inic' => $row->fecha_inic,
                        'id_evento_padre' => $row->id_evento_padre,
                        'id_grupo' => $row->id_grupo,
                        'id_rango' => $row->id_rango,
                        // Es necesario utilizar la notación de llaves porque el nombre de la propiedad es compuesto y posee nombres de funcions
                        'COUNT(numero_casos)' => $row->{'COUNT(numero_casos)'}
        
                    ];
                }
        
                
                    // return $query->row() ;
                    // return $cadena;
                    //return 'EXITO';
                return $view_bo_eno_data;
        
                } else {
                    return false ;
                }
            }


}

