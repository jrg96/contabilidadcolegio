<?php
class Empleado_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function insertar_empleado($nombre_empleado, $fecha_contratacion, $salario_base_diario, $tipo_empleado)
    {           
        // Creando array de datos
        $datos = array(
            'nombre_empleado' => $nombre_empleado, 
            'fecha_contratacion' => $fecha_contratacion, 
			'salario_base_diario' => $salario_base_diario,
			'tipo_empleado' => $tipo_empleado
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->insert('tbl_empleado', $datos);
		$id = $this->db->insert_id();
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        return $id;
    }
	
	public function obtener_lista_empleado()
	{
		$this->db->select('*');
        $this->db->from('tbl_empleado');
        $resultado = $this->db->get();
        
        return $resultado->result_array();
	}
	
	public function obtener_datos_empleado($id_empleado)
	{
		$this->db->select('*');
        $this->db->from('tbl_empleado');
		$this->db->where('id_empleado', $id_empleado);
		$resultado = $this->db->get();
		
		return $resultado->result_array()[0];
	}
    
    public function modificar_empleado($id_empleado, $nombre_empleado, $fecha_contratacion, $salario_base_diario, $tipo_empleado)
    {   
        // Creando array de datos
        $datos = array(
            'nombre_empleado' => $nombre_empleado, 
            'fecha_contratacion' => $fecha_contratacion, 
			'salario_base_diario' => $salario_base_diario,
			'tipo_empleado' => $tipo_empleado
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->where('id_empleado', $id_empleado);
        $this->db->update('tbl_empleado', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
	
	public function eliminar_empelado($id_empleado)
	{
		$this->db->delete('tbl_empleado', array('id_empleado' => $id_empleado));
	}
}