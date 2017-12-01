<?php
class UnidadRepartoTerciario_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function insertar_unidad_reparto_terciario($id_criterio_reparto_terciario, $id_actividad, $valor_unidad)
    {           
        // Creando array de datos
        $datos = array(
            'id_criterio_reparto_terciario' => $id_criterio_reparto_terciario, 
            'id_actividad' => $id_actividad, 
			'valor_unidad' => $valor_unidad
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->insert('tbl_unidad_reparto_terciario', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
	
	public function obtener_lista_unidad_reparto_terciario($id_criterio_reparto_terciario)
	{
		$this->db->select('*');
        $this->db->from('tbl_unidad_reparto_terciario');
		$this->db->join('tbl_actividad', 'tbl_unidad_reparto_terciario.id_actividad = tbl_actividad.id_actividad');
		$this->db->where('id_criterio_reparto_terciario', $id_criterio_reparto_terciario);
        $resultado = $this->db->get();
        
        return $resultado->result_array();
	}
	
	public function obtener_datos_unidad_reparto_terciario($id_unidad_reparto_terciario)
	{
		$this->db->select('*');
        $this->db->from('tbl_unidad_reparto_terciario');
		$this->db->where('id_unidad_reparto_terciario', $id_unidad_reparto_terciario);
		$resultado = $this->db->get();
		
		return $resultado->result_array()[0];
	}
    
    public function modificar_unidad_reparto_terciario($id_unidad_reparto_terciario, $valor_unidad)
    {   
        // Creando array de datos
        $datos = array(
            'valor_unidad' => $valor_unidad
        );
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->where('id_unidad_reparto_terciario', $id_unidad_reparto_terciario);
        $this->db->update('tbl_unidad_reparto_terciario', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
	
	public function obtener_id_reparto_terciario_poractividad($id_actividad)
	{
		$lista_id = array();
		
		$this->db->select('*');
        $this->db->from('tbl_unidad_reparto_terciario');
		$this->db->where('id_actividad', $id_actividad);
		$resultado = $this->db->get()->result_array();
		
		foreach ($resultado as $fila)
		{
			if ($this->no_esta_en_lista($lista_id, $fila['id_criterio_reparto_terciario']))
			{
				array_push($lista_id, $fila['id_criterio_reparto_terciario']);
			}
		}
		
		return $lista_id;
	}
	
	public function obtener_datos_actividad_criterio($id_criterio_reparto_terciario, $id_actividad)
	{
		$condicion = array(
			'id_criterio_reparto_terciario' => $id_criterio_reparto_terciario,
			'id_actividad' => $id_actividad
		);
		
		$this->db->select('*');
        $this->db->from('tbl_unidad_reparto_terciario');
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