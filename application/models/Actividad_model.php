<?php
class Actividad_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function insertar_actividad($id_centro_costo, $nombre_actividad, $descripcion_actividad, $tipo_actividad)
    {           
        // Creando array de datos
        $datos = array(
            'id_centro_costo' => $id_centro_costo, 
            'nombre_actividad' => $nombre_actividad, 
			'descripcion_actividad' => $descripcion_actividad,
			'tipo_actividad' => $tipo_actividad
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->insert('tbl_actividad', $datos);
		$id = $this->db->insert_id();
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        return $id;
    }
	
	public function obtener_lista_actividad()
	{
		$this->db->select('*');
        $this->db->from('tbl_actividad');
		$this->db->join('tbl_centro_costo', 'tbl_actividad.id_centro_costo = tbl_centro_costo.id_centro_costo');
		$this->db->order_by('tbl_actividad.id_centro_costo', 'ASC');
        $resultado = $this->db->get();
        
        return $resultado->result_array();
	}
	
	public function obtener_datos_actividad($id_actividad)
	{
		$this->db->select('*');
        $this->db->from('tbl_actividad');
		$this->db->where('id_actividad', $id_actividad);
		$resultado = $this->db->get();
		
		return $resultado->result_array()[0];
	}
	
	public function obtener_actividad_porcentrocosto($id_centro_costo)
	{
		$this->db->select('*');
        $this->db->from('tbl_actividad');
		$this->db->where('id_centro_costo', $id_centro_costo);
		$resultado = $this->db->get();
		
		return $resultado->result_array();
	}
	
	public function obtener_actividad_portipo($tipo_actividad)
	{
		$this->db->select('*');
        $this->db->from('tbl_actividad');
		$this->db->where('tipo_actividad', $tipo_actividad);
		$resultado = $this->db->get();
		
		return $resultado->result_array();
	}
    
    public function modificar_actividad($id_actividad, $id_centro_costo, $nombre_actividad, $descripcion_actividad, $tipo_actividad)
    {   
        // Creando array de datos
        $datos = array(
            'id_centro_costo' => $id_centro_costo, 
            'nombre_actividad' => $nombre_actividad, 
			'descripcion_actividad' => $descripcion_actividad,
			'tipo_actividad' => $tipo_actividad
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->where('id_actividad', $id_actividad);
        $this->db->update('tbl_actividad', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
	
	public function eliminar_actividad($id_actividad)
	{
		$this->db->delete('tbl_actividad', array('id_actividad' => $id_actividad));
	}
}