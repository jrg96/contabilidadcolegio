<?php
class InductorConsumido_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function insertar_inductor_consumido($id_consumidor_costo, $id_inductor_costo, $valor_inductor)
    {           
        // Creando array de datos
        $datos = array(
            'id_consumidor_costo' => $id_consumidor_costo,
			'id_inductor_costo' => $id_inductor_costo,
			'valor_inductor' => $valor_inductor
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->insert('tbl_inductor_consumido', $datos);
		$id = $this->db->insert_id();
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        return $id;
    }
	
	public function obtener_lista_inductor_consumido($id_consumidor_costo)
	{
		$this->db->select('*');
        $this->db->from('tbl_inductor_consumido');
		$this->db->join('tbl_inductor_costo', 'tbl_inductor_consumido.id_inductor_costo = tbl_inductor_costo.id_inductor_costo');
		$this->db->where('id_consumidor_costo', $id_consumidor_costo);
        $resultado = $this->db->get();
        
        return $resultado->result_array();
	}
	
	public function obtener_lista_inductor_consumido_porinductor($id_inductor_costo)
	{
		$this->db->select('*');
        $this->db->from('tbl_inductor_consumido');
		$this->db->join('tbl_inductor_costo', 'tbl_inductor_consumido.id_inductor_costo = tbl_inductor_costo.id_inductor_costo');
		$this->db->where('tbl_inductor_consumido.id_inductor_costo', $id_inductor_costo);
        $resultado = $this->db->get();
        
        return $resultado->result_array();
	}
	
	public function modificar_inductor_consumido($id_inductor_consumido, $valor_inductor)
    {   
        // Creando array de datos
        $datos = array(
            'valor_inductor' => $valor_inductor
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->where('id_inductor_consumido', $id_inductor_consumido);
        $this->db->update('tbl_inductor_consumido', $datos);
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