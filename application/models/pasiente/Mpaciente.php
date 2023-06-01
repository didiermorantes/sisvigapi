<?php

class Mpaciente extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getPaciente($cedula) {
        $sql = "SELECT TB2.nombre_tipo AS Tipo_identificación, "
                . "TB1.numero_identificacion AS Cédula, "
                . 'TB1.primer_nombre AS Nombre_1, '
                . 'TB1.segundo_nombre AS Nombre_2, '
                . 'TB1.primer_apellido AS Apellido_1, '
                . 'TB1.segundo_apellido AS Apellido_2, '
                . 'TB1.fecha_nacimiento AS Fecha_nacimiento, '
                . 'TB1.sexo AS Sexo, '
                . 'TB1.tel_residencial AS Teléfono, '
                . 'TB1.localidad AS Dirección, '
                . 'TB3.nombre_corregimiento AS Corregimiento, '
                . 'TB4.nombre_distrito AS Distrito, '
                . 'TB5.nombre_region AS Region, '
                . 'TB6.nombre_provincia AS Provincia '
                . 'FROM tbl_persona TB1 '
                . 'LEFT JOIN cat_tipo_identidad TB2 ON TB1.tipo_identificacion = TB2.id_tipo_identidad '
                . 'LEFT JOIN cat_corregimiento TB3 ON TB1.id_corregimiento = TB3.id_corregimiento '
                . 'LEFT JOIN cat_distrito TB4 ON TB3.id_distrito = TB4.id_distrito '
                . 'LEFT JOIN cat_region_salud TB5 ON TB4.id_region = TB5.id_region '
                . 'LEFT JOIN cat_provincia TB6 ON TB5.id_provincia = TB6.id_provincia '
                . "WHERE TB1.numero_identificacion = '" . $cedula . "'";
        $resultados = $this->db->query($sql);
        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }
    }

}
