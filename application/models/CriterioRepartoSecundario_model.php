<?php
class CriterioRepartoSecundario_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function insertar_criterio_reparto_secundario($id_centro_costo, $nombre_criterio_reparto_secundario, $desc_criterio_reparto_secundario, $unidad_reparto)
    {           
        // Creando array de datos
        $datos = array(
            'id_centro_costo' => $id_centro_costo, 
            'nombre_criterio_reparto_secundario' => $nombre_criterio_reparto_secundario, 
			'desc_criterio_reparto_secundario' => $desc_criterio_reparto_secundario,
			'unidad_reparto' => $unidad_reparto
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->insert('tbl_criterio_reparto_secundario', $datos);
		$id = $this->db->insert_id();
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        return $id;
    }
	
	public function obtener_lista_criterio_reparto_secundario()
	{
		$this->db->select('*');
        $this->db->from('tbl_criterio_reparto_secundario');
		$this->db->join('tbl_centro_costo', 'tbl_criterio_reparto_secundario.id_centro_costo = tbl_centro_costo.id_centro_costo');
        $resultado = $this->db->get();
        
        return $resultado->result_array();
	}
	
	public function obtener_datos_criterio_reparto_secundario($id_criterio_reparto_secundario)
	{
		$this->db->select('*');
        $this->db->from('tbl_criterio_reparto_secundario');
		$this->db->join('tbl_centro_costo', 'tbl_criterio_reparto_secundario.id_centro_costo = tbl_centro_costo.id_centro_costo');
		$this->db->where('id_criterio_reparto_secundario', $id_criterio_reparto_secundario);
		$resultado = $this->db->get();
		
		return $resultado->result_array()[0];
	}
	
	public function obtener_datos_criterio_reparto_secundario_porcentrocosto($id_centro_costo)
	{
		$this->db->select('*');
        $this->db->from('tbl_criterio_reparto_secundario');
		$this->db->join('tbl_centro_costo', 'tbl_criterio_reparto_secundario.id_centro_costo = tbl_centro_costo.id_centro_costo');
		$this->db->where('tbl_criterio_reparto_secundario.id_centro_costo', $id_centro_costo);
		$resultado = $this->db->get();
		
		return $resultado->result_array();
	}
    
    public function modificar_criterio_reparto_secundario($id_criterio_reparto_secundario, $id_centro_costo, $nombre_criterio_reparto_secundario, $desc_criterio_reparto_secundario, $unidad_reparto)
    {   
        // Creando array de datos
        $datos = array(
            'id_centro_costo' => $id_centro_costo, 
            'nombre_criterio_reparto_secundario' => $nombre_criterio_reparto_secundario, 
			'desc_criterio_reparto_secundario' => $desc_criterio_reparto_secundario,
			'unidad_reparto' => $unidad_reparto
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->where('id_criterio_reparto_secundario', $id_criterio_reparto_secundario);
        $this->db->update('tbl_criterio_reparto_secundario', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
	
	public function modificar_total_criterio_reparto_secundario($id_criterio_reparto_secundario, $total_unidades)
	{
		// Creando array de datos
        $datos = array(
            'total_unidades' => $total_unidades
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->where('id_criterio_reparto_secundario', $id_criterio_reparto_secundario);
        $this->db->update('tbl_criterio_reparto_secundario', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
	}
	
	public function eliminar_criterio_reparto_secundario($id_criterio_reparto_secundario)
	{
		$this->db->delete('tbl_criterio_reparto_secundario', array('id_criterio_reparto_secundario' => $id_criterio_reparto_secundario));
	}
}