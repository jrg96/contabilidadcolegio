<?php
class CriterioRepartoTerciario_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function insertar_criterio_reparto_terciario($id_actividad_auxiliar, $nombre_criterio_reparto_terciario, $desc_criterio_reparto_terciario, $unidad_reparto)
    {           
        // Creando array de datos
        $datos = array(
            'id_actividad_auxiliar' => $id_actividad_auxiliar, 
            'nombre_criterio_reparto_terciario' => $nombre_criterio_reparto_terciario, 
			'desc_criterio_reparto_terciario' => $desc_criterio_reparto_terciario,
			'unidad_reparto' => $unidad_reparto
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->insert('tbl_criterio_reparto_terciario', $datos);
		$id = $this->db->insert_id();
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        return $id;
    }
	
	public function obtener_lista_criterio_reparto_terciario()
	{
		$this->db->select('*');
        $this->db->from('tbl_criterio_reparto_terciario');
		$this->db->join('tbl_actividad', 'tbl_criterio_reparto_terciario.id_actividad_auxiliar = tbl_actividad.id_actividad');
        $resultado = $this->db->get();
        
        return $resultado->result_array();
	}
	
	public function obtener_datos_criterio_reparto_terciario($id_criterio_reparto_terciario)
	{
		$this->db->select('*');
        $this->db->from('tbl_criterio_reparto_terciario');
		$this->db->join('tbl_actividad', 'tbl_criterio_reparto_terciario.id_actividad_auxiliar = tbl_actividad.id_actividad');
		$this->db->where('id_criterio_reparto_terciario', $id_criterio_reparto_terciario);
		$resultado = $this->db->get();
		
		return $resultado->result_array()[0];
	}
	
	public function obtener_datos_criterio_reparto_terciario_poractividad($id_actividad)
	{
		$this->db->select('*');
        $this->db->from('tbl_criterio_reparto_terciario');
		$this->db->join('tbl_actividad', 'tbl_criterio_reparto_terciario.id_actividad_auxiliar = tbl_actividad.id_actividad');
		$this->db->where('tbl_criterio_reparto_terciario.id_actividad_auxiliar', $id_actividad);
		$resultado = $this->db->get();
		
		return $resultado->result_array();
	}
    
    public function modificar_criterio_reparto_terciario($id_criterio_reparto_terciario, $id_actividad_auxiliar, $nombre_criterio_reparto_terciario, $desc_criterio_reparto_terciario, $unidad_reparto)
    {   
        // Creando array de datos
        $datos = array(
            'id_actividad_auxiliar' => $id_actividad_auxiliar, 
            'nombre_criterio_reparto_terciario' => $nombre_criterio_reparto_terciario, 
			'desc_criterio_reparto_terciario' => $desc_criterio_reparto_terciario,
			'unidad_reparto' => $unidad_reparto
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->where('id_criterio_reparto_terciario', $id_criterio_reparto_terciario);
        $this->db->update('tbl_criterio_reparto_terciario', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
	
	public function modificar_total_criterio_reparto_terciario($id_criterio_reparto_terciario, $total_unidades)
	{
		// Creando array de datos
        $datos = array(
            'total_unidades' => $total_unidades
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->where('id_criterio_reparto_terciario', $id_criterio_reparto_terciario);
        $this->db->update('tbl_criterio_reparto_terciario', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
	}
	
	public function eliminar_criterio_reparto_terciario($id_criterio_reparto_terciario)
	{
		$this->db->delete('tbl_criterio_reparto_terciario', array('id_criterio_reparto_terciario' => $id_criterio_reparto_terciario));
	}
}