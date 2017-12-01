<?php
class ConsumidorCosto_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function insertar_consumidor_costo($nombre_consumidor_costo)
    {           
        // Creando array de datos
        $datos = array(
            'nombre_consumidor_costo' => $nombre_consumidor_costo
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->insert('tbl_consumidor_costo', $datos);
		$id = $this->db->insert_id();
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        return $id;
    }
	
	public function obtener_lista_consumidor_costo()
	{
		$this->db->select('*');
        $this->db->from('tbl_consumidor_costo');
        $resultado = $this->db->get();
        
        return $resultado->result_array();
	}
	
	public function obtener_datos_consumidor_costo($id_consumidor_costo)
	{
		$this->db->select('*');
        $this->db->from('tbl_consumidor_costo');
		$this->db->where('id_consumidor_costo', $id_consumidor_costo);
		$resultado = $this->db->get();
		
		return $resultado->result_array()[0];
	}
    
    public function modificar_consumidor_costo($id_consumidor_costo, $nombre_consumidor_costo)
    {   
        // Creando array de datos
        $datos = array(
            'nombre_consumidor_costo' => $nombre_consumidor_costo
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->where('id_consumidor_costo', $id_consumidor_costo);
        $this->db->update('tbl_consumidor_costo', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
}