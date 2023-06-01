<?php

class Casosget extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getInfluenza() {
        $fecha = '2020-03-15';
        $sql = 'SELECT TB1.id_flureg, '
                . 'TB1.anio, '
                . 'TB1.nombre_registra, '
                . 'TB1.nombre_investigador, '
                . 'TB1.fecha_notificacion, '
                . 'TB1.per_tipo_paciente, '
                . 'TB1.semana_epi, '
                . 'TB1.per_direccion, '
                . 'TB1.id_evento, '
                . 'TB1.id_un, '
                . 'TB1.fecha_inicio_sintoma, '
                . 'TB2.primer_nombre, '
                . 'TB2.segundo_nombre, '
                . 'TB2.primer_apellido, '
                . 'TB2.segundo_apellido, '
                . 'TB2.sexo, '
                . 'TB2.fecha_nacimiento, '
                . 'TB2.localidad, '
                . 'TB2.dir_referencia, '
                . 'TB2.numero_identificacion, '
                . 'TB2.correo_electronico, '
                . 'TB3.nombre_evento, '
                . 'TB4.nombre_corregimiento, '
                . 'TB5.nombre_distrito, '
                . 'TB6.nombre_region, '
                . 'TB7.nombre_un, '
                . 'TB7.cod_ref_minsa, '
                . 'TB8.nombre_provincia '
                . 'FROM flureg_form TB1 '
                . 'LEFT JOIN tbl_persona TB2 ON TB1.numero_identificacion = TB2.numero_identificacion '
                . 'LEFT JOIN cat_evento TB3 ON TB1.id_evento = TB3.id_evento '
                . 'LEFT JOIN cat_corregimiento TB4 ON TB1.id_corregimiento = TB4.id_corregimiento '
                . 'LEFT JOIN cat_distrito TB5 ON TB4.id_distrito = TB5.id_distrito '
                . 'LEFT JOIN cat_region_salud TB6 ON TB5.id_region = TB6.id_region '
                . 'LEFT JOIN cat_unidad_notificadora TB7 ON TB1.id_un = TB7.id_un '
                . 'LEFT JOIN cat_provincia TB8 ON TB6.id_provincia = TB8.id_provincia '
                . 'WHERE TB1.anio = 2020 AND TB1.fecha_inicio_sintoma >= ' . $fecha;
        $query = $this->db->query($sql);

        foreach ($query->result() as $row) {
            $user_data[] = [
                'Cedula' => $row->numero_identificacion,
                'Nombre 1 y 2' => $row->primer_nombre . ' ' . $row->segundo_nombre,
                'Apellido 1 y 2' => $row->primer_apellido . ' ' . $row->segundo_apellido,
                'Sexo' => $row->sexo,
                'Fecha de nacimiento' => $row->fecha_nacimiento,
                'Provincia' => $row->nombre_provincia,
                'Distrito' => $row->nombre_distrito,
                'Corregimiento' => $row->nombre_corregimiento,
                'Direccion' => $row->per_direccion,
                'Email' => $row->correo_electronico,
                'Codigo formulario' => $row->id_flureg,
                'Codigo evento' => $row->id_evento,
                'Nombre evento' => $row->nombre_evento,
                'Codigo instalacion' => $row->cod_ref_minsa,
                'Region toma muestra' => $row->nombre_region,
                'Nombre notificador' => $row->nombre_investigador,
                'Semana epidemiologica' => $row->semana_epi,
                'Fecha inicio sintomas' => $row->fecha_inicio_sintoma,
                'Fecha toma de muestra' => null,
                'Codigo de muestra' => null,
                'Codigo de muestra' => null,
            ];
        }
        return $user_data;
    }

    public function getInfluenzaCaso($cedula) {
        $fecha = '2020-03-15';
        $sql = 'SELECT TB1.id_flureg, '
                . 'TB1.anio, '
                . 'TB1.nombre_registra, '
                . 'TB1.nombre_investigador, '
                . 'TB1.fecha_notificacion, '
                . 'TB1.per_tipo_paciente, '
                . 'TB1.semana_epi, '
                . 'TB1.per_direccion, '
                . 'TB1.id_evento, '
                . 'TB1.id_un, '
                . 'TB1.fecha_inicio_sintoma, '
                . 'TB2.primer_nombre, '
                . 'TB2.segundo_nombre, '
                . 'TB2.primer_apellido, '
                . 'TB2.segundo_apellido, '
                . 'TB2.sexo, '
                . 'TB2.fecha_nacimiento, '
                . 'TB2.localidad, '
                . 'TB2.dir_referencia, '
                . 'TRIM(TB2.numero_identificacion), '
                . 'TB2.correo_electronico, '
                . 'TB3.nombre_evento, '
                . 'TB4.nombre_corregimiento, '
                . 'TB5.nombre_distrito, '
                . 'TB6.nombre_region, '
                . 'TB7.nombre_un, '
                . 'TB7.cod_ref_minsa, '
                . 'TB8.nombre_provincia '
                . 'FROM flureg_form TB1 '
                . 'LEFT JOIN tbl_persona TB2 ON TRIM(TB1.numero_identificacion) = TRIM(TB2.numero_identificacion) '
                . 'LEFT JOIN cat_evento TB3 ON TB1.id_evento = TB3.id_evento '
                . 'LEFT JOIN cat_corregimiento TB4 ON TB1.id_corregimiento = TB4.id_corregimiento '
                . 'LEFT JOIN cat_distrito TB5 ON TB4.id_distrito = TB5.id_distrito '
                . 'LEFT JOIN cat_region_salud TB6 ON TB5.id_region = TB6.id_region '
                . 'LEFT JOIN cat_unidad_notificadora TB7 ON TB1.id_un = TB7.id_un '
                . 'LEFT JOIN cat_provincia TB8 ON TB6.id_provincia = TB8.id_provincia '
                . 'WHERE TRIM(TB1.numero_identificacion) = ' . $cedula . ' AND TB1.anio = 2020 AND TB1.fecha_inicio_sintoma >= ' . $fecha;
        $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function getInfluenzaCasos($cedula) {
        $select = "SELECT ff.id_flureg, TRIM(ff.numero_identificacion) AS numero_identificacion, ff.id_evento, fmps.nombre_prueba, fmps.resultado_prueba, fmps.fecha_prueba ";
        $from = "FROM flureg_form ff ";
        $join = "INNER JOIN flureg_muestra_prueba_silab fmps ON ff.id_flureg = fmps.id_flureg ";
        $where = "WHERE ff.anio = 2020 AND fmps.nombre_prueba LIKE '%coronavirus%' AND fmps.resultado_prueba = 'NO DETECTADO' AND TRIM(ff.numero_identificacion) = '" . $cedula . "'";

        $sql = $select . $from . $join . $where;
        $resultados = $this->db->query($sql);

        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }
    }

}
