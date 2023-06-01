<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Covid19 extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getcasos()
    {
        $select = "SELECT ff.id_flureg, TRIM(ff.numero_identificacion) AS numero_identificacion, ff.per_telefono, tp.primer_nombre, tp.segundo_nombre, tp.primer_apellido, tp.segundo_apellido, ff.id_evento, fmps.nombre_prueba, fmps.resultado_prueba, ff.fecha_inicio_sintoma, fmps.fecha_prueba ";
        $from = "FROM flureg_form ff ";
        $join = "INNER JOIN tbl_persona tp ON ff.numero_identificacion = tp.numero_identificacion ";
        $join2 = "INNER JOIN flureg_muestra_prueba_silab fmps ON ff.id_flureg = fmps.id_flureg ";
        $where = "WHERE ff.fecha_inicio_sintoma >= 2020-03-15 AND fmps.nombre_prueba LIKE '%coronavirus%'";

        $sql = $select . $from . $join . $join2 . $where;
        $resultados = $this->db->query($sql);

        if ($resultados->num_rows() > 0) {
            return $resultados->result();
        } else {
            return false;
        }
    }

    public function getcasosbyced($cedula)
    {
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
