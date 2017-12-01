<?php
class CentroCosto_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function insertar_centro_costo($nombre_centro_costo, $descripcion_centro_costo)
    {           
        // Creando array de datos
        $datos = array(
            'nombre_centro_costo' => $nombre_centro_costo, 
            'descripcion_centro_costo' => $descripcion_centro_costo, 
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->insert('tbl_centro_costo', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
	
	public function obtener_lista_centro_costo()
	{
		$this->db->select('*');
        $this->db->from('tbl_centro_costo');
        $resultado = $this->db->get();
        
        return $resultado->result_array();
	}
	
	public function obtener_datos_centro_costo($id_centro_costo)
	{
		$this->db->select('*');
        $this->db->from('tbl_centro_costo');
		$this->db->where('id_centro_costo', $id_centro_costo);
		$resultado = $this->db->get();
		
		return $resultado->result_array()[0];
	}
    
    public function modificar_centro_costo($id_centro_costo, $nombre_centro_costo, $descripcion_centro_costo)
    {   
        // Creando array de datos
        $datos = array(
            'nombre_centro_costo' => $nombre_centro_costo, 
            'descripcion_centro_costo' => $descripcion_centro_costo 
		);
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->where('id_centro_costo', $id_centro_costo);
        $this->db->update('tbl_centro_costo', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
	
	public function eliminar_centro_costo($id_centro_costo)
	{
		$this->db->delete('tbl_centro_costo', array('id_centro_costo' => $id_centro_costo));
	}
}