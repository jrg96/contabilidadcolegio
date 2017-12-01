<?php
class PagoEmpleado_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function insertar_pago_empleado($id_empleado, $monto_pago, $fecha_pago, $id_transaccion_1, $id_transaccion_2)
    {           
        // Creando array de datos
        $datos = array(
            'id_empleado' => $id_empleado, 
            'monto_pago' => $monto_pago, 
			'fecha_pago' => $fecha_pago,
			'id_transaccion_1' => $id_transaccion_1,
			'id_transaccion_2' => $id_transaccion_2
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->insert('tbl_pago_empleado', $datos);
		$id = $this->db->insert_id();
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        return $id;
    }
	
	public function obtener_lista_pago_empleado($id_empleado)
	{
		$this->db->select('*');
        $this->db->from('tbl_pago_empleado');
		$this->db->order_by('fecha_pago', 'DESC');
		$this->db->where('id_empleado', $id_empleado);
        $resultado = $this->db->get();
        
        return $resultado->result_array();
	}
}