<?php
class CriterioRepartoPrimario_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function insertar_criterio_reparto_primario($id_cuenta_interno, $nombre_criterio_reparto_primario, $desc_criterio_reparto_primario, $unidad_reparto)
    {           
        // Creando array de datos
        $datos = array(
            'id_cuenta_interno' => $id_cuenta_interno, 
            'nombre_criterio_reparto_primario' => $nombre_criterio_reparto_primario, 
			'desc_criterio_reparto_primario' => $desc_criterio_reparto_primario,
			'unidad_reparto' => $unidad_reparto
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->insert('tbl_criterio_reparto_primario', $datos);
		$id = $this->db->insert_id();
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        return $id;
    }
	
	public function obtener_lista_criterio_reparto_primario()
	{
		$this->db->select('*');
        $this->db->from('tbl_criterio_reparto_primario');
        $resultado = $this->db->get();
        
        return $resultado->result_array();
	}
	
	public function obtener_datos_criterio_reparto_primario($id_criterio_reparto_primario)
	{
		$this->db->select('*');
        $this->db->from('tbl_criterio_reparto_primario');
		$this->db->join('tbl_cuenta', 'tbl_criterio_reparto_primario.id_cuenta_interno = tbl_cuenta.id_cuenta_interno');
		$this->db->where('id_criterio_reparto_primario', $id_criterio_reparto_primario);
		$resultado = $this->db->get();
		
		return $resultado->result_array()[0];
	}
    
    public function modificar_criterio_reparto_primario($id_criterio_reparto_primario, $id_cuenta_interno, $nombre_criterio_reparto_primario, $desc_criterio_reparto_primario, $unidad_reparto)
    {   
        // Creando array de datos
        $datos = array(
            'id_cuenta_interno' => $id_cuenta_interno, 
            'nombre_criterio_reparto_primario' => $nombre_criterio_reparto_primario, 
			'desc_criterio_reparto_primario' => $desc_criterio_reparto_primario,
			'unidad_reparto' => $unidad_reparto
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->where('id_criterio_reparto_primario', $id_criterio_reparto_primario);
        $this->db->update('tbl_criterio_reparto_primario', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
	
	public function modificar_total_criterio_reparto_primario($id_criterio_reparto_primario, $total_unidades)
	{
		// Creando array de datos
        $datos = array(
            'total_unidades' => $total_unidades
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->where('id_criterio_reparto_primario', $id_criterio_reparto_primario);
        $this->db->update('tbl_criterio_reparto_primario', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
	}
	
	public function eliminar_criterio_reparto_primario($id_criterio_reparto_primario)
	{
		$this->db->delete('tbl_criterio_reparto_primario', array('id_criterio_reparto_primario' => $id_criterio_reparto_primario));
	}
}