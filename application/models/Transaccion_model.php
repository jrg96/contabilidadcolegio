<?php
class Transaccion_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function insertar_transaccion($id_periodo_contable, $id_cuenta_interno, $monto, $esta_en_debe, $es_transaccion_ajuste, $fecha_realizacion)
    {
        $datos = array(
                    'id_periodo_contable' => $id_periodo_contable,
                    'id_cuenta_interno' => $id_cuenta_interno,
                    'monto' => $monto,
                    'esta_en_debe' => $esta_en_debe,
                    'es_transaccion_ajuste' => $es_transaccion_ajuste,
                    'fecha_realizacion' => $fecha_realizacion);
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->insert('tbl_transaccion', $datos);
		$id = $this->db->insert_id();
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        return $id;
    }
    
    public function obtener_transacciones_cuenta($id_cuenta_interno, $id_periodo_contable)
    {
        return $this->db->get_where('tbl_transaccion', array('id_periodo_contable' => $id_periodo_contable, 'id_cuenta_interno' => $id_cuenta_interno))->result_array();
    }
}