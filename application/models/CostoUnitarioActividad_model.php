<?php
class CostoUnitarioActividad_model extends CI_Model {
	private $actividades_finales;
	private $costos_unitarios = array();
	
    public function __construct()
    {
        $this->load->database();
		$this->load->model('CostoUnitarioActividadFila_model');
    }
    
	public function calcular_costos_unitarios()
	{
		// Por cada actividad final
		foreach($this->actividades_finales as $actividad)
		{
			// Crear una fila de costo unitario
			$costo_unitario = new CostoUnitarioActividadFila_model();
			$costo_unitario->set_actividad_final($actividad);
			$costo_unitario->calcular_costo_unitario();
			
			array_push($this->costos_unitarios, $costo_unitario);
		}
		
		$this->actividades_finales = null;
	}
	
	public function set_actividades_finales($actividades)
	{
		$this->actividades_finales = $actividades;
	}
	
	public function obtener_info_a_desplegar()
	{
		$filas = array();
		
		foreach($this->costos_unitarios as $costo)
		{
			$nombre_actividad = $costo->get_nombre_actividad();
			$costo_total = $costo->get_costo_total();
			$total_inductores = $costo->get_total_inductores();
			$costo_unitario = $costo->get_costo_unitario_inductor();
			
			$datos_actividad = array(
				'nombre_actividad' => $nombre_actividad,
				'costo_total' => $costo_total,
				'total_inductores' => $total_inductores,
				'costo_unitario' => $costo_unitario
			);
			
			array_push($filas, $datos_actividad);
		}
		
		return $filas;
	}
}