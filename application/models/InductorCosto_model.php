<?php
class InductorCosto_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function insertar_inductor_costo($id_actividad, $nombre_inductor_costo)
    {           
        // Creando array de datos
        $datos = array(
            'id_actividad' => $id_actividad, 
            'nombre_inductor_costo' => $nombre_inductor_costo
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->insert('tbl_inductor_costo', $datos);
		$id = $this->db->insert_id();
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        return $id;
    }
	
	public function obtener_lista_inductor_costo()
	{
		$this->db->select('*');
        $this->db->from('tbl_inductor_costo');
		$this->db->join('tbl_actividad', 'tbl_inductor_costo.id_actividad = tbl_actividad.id_actividad');
        $resultado = $this->db->get();
        
        return $resultado->result_array();
	}
	
	public function obtener_inductor_costo_poractividad($id_actividad)
	{
		$this->db->select('*');
        $this->db->from('tbl_inductor_costo');
		$this->db->where('id_actividad', $id_actividad);
		$resultado = $this->db->get();
		
		return $resultado->result_array();
	}
	
	public function modificar_inductor_costo($id_inductor_costo, $nombre_inductor_costo)
	{
		 // Creando array de datos
        $datos = array(
            'nombre_inductor_costo' => $nombre_inductor_costo, 
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->where('id_inductor_costo', $id_inductor_costo);
        $this->db->update('tbl_inductor_costo', $datos);
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