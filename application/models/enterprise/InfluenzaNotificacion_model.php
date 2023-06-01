<?php

class InfluenzaNotificacion_model extends CI_Model{

    public function __construct () {
        parent::__construct() ;
        $this->load->database() ;
    }

    //MODELO QUE CONSULTA POR CEDULA
    public function getInfluenzaCaso ($cedula) {
        $sql = 'SELECT TB1.id_flureg, '
                . 'TB1.anio, '
                . 'TB1.nombre_registra, '
                . 'TB1.nombre_investigador, '
                . 'TB1.fecha_notificacion, '
                . 'TB1.per_tipo_paciente, '
                . 'TB1.semana_epi, '
                . 'TB1.per_direccion, '
				. 'TB1.per_telefono, '
                . 'TB1.id_evento, '
                . 'TB1.id_un, '
                . 'TB1.fecha_inicio_sintoma, '
				. 'TB1.tipo_identificacion, '
                . 'TB2.numero_identificacion, '
                . 'TB2.primer_nombre, '
                . 'TB2.segundo_nombre, '
                . 'TB2.primer_apellido, '
                . 'TB2.segundo_apellido, '
                . 'TB2.sexo, '
                . 'TB2.fecha_nacimiento, '
                . 'TB2.localidad, '
                . 'TB2.dir_referencia, '
                . 'TB2.correo_electronico, '
                . 'TB3.nombre_evento, '
				. 'TB4.id_corregimiento, '
                . 'TB4.nombre_corregimiento, '
				. 'TB5.id_distrito, '
                . 'TB5.nombre_distrito, '
				. 'TB6.id_region, '
                . 'TB6.nombre_region, '
                . 'TB7.nombre_un, '
                . 'TB7.cod_ref_minsa, '
				. 'TB8.id_provincia, '
                . 'TB8.nombre_provincia '
                . 'FROM flureg_form TB1 '
                . 'LEFT JOIN tbl_persona TB2 ON TRIM(TB1.numero_identificacion) = TRIM(TB2.numero_identificacion) '
                . 'LEFT JOIN cat_evento TB3 ON TB1.id_evento = TB3.id_evento '
                . 'LEFT JOIN cat_corregimiento TB4 ON TB1.id_corregimiento = TB4.id_corregimiento '
                . 'LEFT JOIN cat_distrito TB5 ON TB4.id_distrito = TB5.id_distrito '
                . 'LEFT JOIN cat_region_salud TB6 ON TB5.id_region = TB6.id_region '
                . 'LEFT JOIN cat_unidad_notificadora TB7 ON TB1.id_un = TB7.id_un '
                . 'LEFT JOIN cat_provincia TB8 ON TB6.id_provincia = TB8.id_provincia '
                . "WHERE TRIM(TB1.numero_identificacion) = '" . $cedula . "' AND TB1.anio = 2020" ;
        $query = $this->db->query($sql) ;
        if ($query->num_rows() > 0) {
            return $query->row() ;
        } else {
            return false ;
        }
    }
	
	    //CONSULTA POR CEDULA: Para tener la informacion del demográfico
    public function getInfluenzaCasoDemografico($cedula)
    {
        $sql = "SELECT CONCAT(TB2.primer_nombre, ' ', TB2.segundo_nombre, ' ', TB2.primer_apellido, ' ', TB2.segundo_apellido)  AS nombres_apellidos_paciente, "
            . "CASE WHEN TB1.tipo_identificacion = 1 THEN 'CC' "
            . "WHEN TB1.tipo_identificacion = 2 THEN 'EX' "
            . "WHEN TB1.tipo_identificacion = 3 THEN 'SC' "
            . "WHEN TB1.tipo_identificacion = 4 THEN 'PA' "
            . "WHEN TB1.tipo_identificacion = 5 THEN 'CM' "
            . "WHEN TB1.tipo_identificacion = 6 THEN 'HC' "
            . "END AS tipo_documento, "
            . "TB2.numero_identificacion AS cedula, "
            . "TB1.fecha_inicio_sintoma, "
            . "TB1.per_telefono AS telefono, "
            . "TB1.per_direccion AS direccion, "
            . "TB6.id_region, "
            . "TB6.nombre_region, "
            . "TB5.id_distrito, "
            . "TB5.nombre_distrito, "
            . "TB4.id_corregimiento, "
            . "TB4.nombre_corregimiento, "
            . "TB2.nombre_responsable AS persona_contacto, "
            . "TB1.per_telefono AS telefono_persona_contacto, "
            . "TB1.per_direccion_otra AS nota, "
            . "TB7.nombre_un AS entidad_hospitalizado, "
            . "TB1.per_hospitalizado AS detalle_hospitalizado, "
            . "TB1.fecha_hospitalizacion AS fecha_ingreso, "
            . "TB1.fecha_hospitalizacion AS fecha_egreso, "
            . "TB1.fecha_defuncion, "
            . "TB1.final_resultado AS lugar_defuncion, "
            . "TB1.final_resultado AS lugar_defuncion, "
            . "TB1.final_resultado AS servicio, "
            . "TB1.final_resultado AS estado_paciente "
            . "FROM flureg_form TB1 "
            . "LEFT JOIN tbl_persona TB2 ON TRIM(TB1.numero_identificacion) = TRIM(TB2.numero_identificacion) "
            . "LEFT JOIN cat_evento TB3 ON TB1.id_evento = TB3.id_evento "
            . "LEFT JOIN cat_corregimiento TB4 ON TB1.id_corregimiento = TB4.id_corregimiento "
            . "LEFT JOIN cat_distrito TB5 ON TB4.id_distrito = TB5.id_distrito "
            . "LEFT JOIN cat_region_salud TB6 ON TB5.id_region = TB6.id_region "
            . "LEFT JOIN cat_unidad_notificadora TB7 ON TB1.id_un = TB7.id_un "
            . "LEFT JOIN cat_provincia TB8 ON TB6.id_provincia = TB8.id_provincia "
            . "WHERE TRIM(TB1.numero_identificacion) = '" . $cedula . "'";
            #. "WHERE TRIM(TB1.numero_identificacion) = '" . $cedula . "' AND TB1.anio = 2020";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    //MODELO QUE CONSULTA POR CODIGO
    public function getMuestra ($codigo) {
        $select = "SELECT TB1.codigo_muestra, "
				. "TB1.id_cat_muestra_laboratorio, "
                . "TB1.fecha_toma, "
                . "TB1.fecha_envio, "
                . "TB1.fecha_recibo_laboratorio, "
                . "TB2.id_flureg, "
                . "TB2.anio, "
                . "TB2.nombre_registra, "
                . "TB2.nombre_investigador, "
                . "TB2.fecha_notificacion, "
                . "TB2.per_tipo_paciente, "
                . "TB2.semana_epi, "
                . "TB2.per_direccion, "
				. "TB2.per_telefono, "
                . "TB2.id_evento, "
                . "TB2.id_un, "
                . "TB2.fecha_inicio_sintoma, "
				. "TB2.tipo_identificacion, "
                . "TB3.numero_identificacion, "
                . "TB3.primer_nombre, "
                . "TB3.segundo_nombre, "
                . "TB3.primer_apellido, "
                . "TB3.segundo_apellido, "
                . "TB3.sexo, "
                . "TB3.fecha_nacimiento, "
                . "TB3.localidad, "
                . "TB3.dir_referencia, "
                . "TB3.correo_electronico, "
                . "TB4.nombre_evento, "
				. "TB5.id_corregimiento, "
                . "TB5.nombre_corregimiento, "
				. "TB6.id_distrito, "
                . "TB6.nombre_distrito, "
				. "TB7.id_region, "
                . "TB7.nombre_region, "
                . "TB8.nombre_un, "
                . "TB8.cod_ref_minsa, "
				. "TB9.id_provincia, "
                . "TB9.nombre_provincia " ;
        $from = "FROM flureg_muestra_laboratorio TB1 " ;
        $join1 = "INNER JOIN flureg_form TB2 ON TB1.id_flureg = TB2.id_flureg " ;
        $join2 = "LEFT JOIN tbl_persona TB3 ON TRIM(TB2.numero_identificacion) = TRIM(TB3.numero_identificacion) " ;
        $join3 = "LEFT JOIN cat_evento TB4 ON TB2.id_evento = TB4.id_evento " ;
        $join4 = "LEFT JOIN cat_corregimiento TB5 ON TB2.id_corregimiento = TB5.id_corregimiento " ;
        $join5 = "LEFT JOIN cat_distrito TB6 ON TB5.id_distrito = TB6.id_distrito " ;
        $join6 = "LEFT JOIN cat_region_salud TB7 ON TB6.id_region = TB7.id_region " ;
        $join7 = "LEFT JOIN cat_unidad_notificadora TB8 ON TB2.id_un = TB8.id_un " ;
        $join8 = "LEFT JOIN cat_provincia TB9 ON TB7.id_provincia = TB9.id_provincia " ;
        $where = "WHERE TB1.codigo_muestra = '" . $codigo . "'" ;

        $sql = $select . $from . $join1 . $join2 . $join3 . $join4 . $join5 . $join6 . $join7 . $join8 . $where ;
        $resultados = $this->db->query($sql) ;

        if ($resultados->num_rows() > 0) {
            return $resultados->row() ;
        } else {
            return false ;
        }
    }

}
