<?php
class UnidadRepartoPrimario_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function insertar_unidad_reparto_primario($id_criterio_reparto_primario, $id_centro_costo, $valor_unidad)
    {           
        // Creando array de datos
        $datos = array(
            'id_criterio_reparto_primario' => $id_criterio_reparto_primario, 
            'id_centro_costo' => $id_centro_costo, 
			'valor_unidad' => $valor_unidad
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->insert('tbl_unidad_reparto_primario', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
	
	public function obtener_lista_unidad_reparto_primario($id_criterio_reparto_primario)
	{
		$this->db->select('*');
        $this->db->from('tbl_unidad_reparto_primario');
		$this->db->join('tbl_centro_costo', 'tbl_unidad_reparto_primario.id_centro_costo = tbl_centro_costo.id_centro_costo');
		$this->db->where('id_criterio_reparto_primario', $id_criterio_reparto_primario);
        $resultado = $this->db->get();
        
        return $resultado->result_array();
	}
	
	public function obtener_datos_unidad_reparto_primario($id_unidad_reparto_primario)
	{
		$this->db->select('*');
        $this->db->from('tbl_unidad_reparto_primario');
		$this->db->where('id_unidad_reparto_primario', $id_unidad_reparto_primario);
		$resultado = $this->db->get();
		
		return $resultado->result_array()[0];
	}
    
    public function modificar_unidad_reparto_primario($id_unidad_reparto_primario, $valor_unidad)
    {   
        // Creando array de datos
        $datos = array(
            'valor_unidad' => $valor_unidad
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->where('id_unidad_reparto_primario', $id_unidad_reparto_primario);
        $this->db->update('tbl_unidad_reparto_primario', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
	
	public function obtener_id_reparto_primario_porcentrocosto($id_centro_costo)
	{
		$lista_id = array();
		
		$this->db->select('*');
        $this->db->from('tbl_unidad_reparto_primario');
		$this->db->where('id_centro_costo', $id_centro_costo);
		$resultado = $this->db->get()->result_array();
		
		foreach ($resultado as $fila)
		{
			if ($this->no_esta_en_lista($lista_id, $fila['id_criterio_reparto_primario']))
			{
				array_push($lista_id, $fila['id_criterio_reparto_primario']);
			}
		}
		
		return $lista_id;
	}
	
	public function obtener_datos_centro_criterio($id_criterio_reparto_primario, $id_centro_costo)
	{
		$condicion = array(
			'id_criterio_reparto_primario' => $id_criterio_reparto_primario,
			'id_centro_costo' => $id_centro_costo
		);
		
		$this->db->select('*');
        $this->db->from('tbl_unidad_reparto_primario');
		$this->db->where($condicion);
		$resultado = $this->db->get()->result_array()[0];
		
		return $resultado;
	}
	
	private function no_esta_en_lista($lista, $valor)
	{
		$no_esta = true;
		
		foreach ($lista as $elemento)
		{
			if ($elemento == $valor)
			{
				$no_esta == false;
			}
		}
		
		return $no_esta;
	}
}