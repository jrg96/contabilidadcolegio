<?php
class ActividadPrimariaFila_model extends CI_Model {
	private $costo_actividad_base;
	private $costos_actividades_auxiliares = array();
	private $costos_agregado;
	
	private $datos_criterio_reparto = array();

    public function __construct()
    {
        $this->load->database();
    }
	
	public function calcular_costos_agregados()
	{
		$total = 0.0;
		
		foreach($this->costos_actividades_auxiliares as $actividad)
		{
			$total += $actividad->get_total_consumido();
		}
		
		$this->costos_agregado = $total;
	}
	
	public function get_costos_agregados()
	{
		return $this->costos_agregado;
	}
	
	public function set_costo_actividad_base($actividad)
	{
		$this->costo_actividad_base = $actividad;
	}
	
	public function get_costo_actividad_base()
	{
		return $this->costo_actividad_base;
	}
	
	public function agregar_actividad_auxiliar($actividad)
	{
		array_push($this->costos_actividades_auxiliares, $actividad);
	}
	
	public function obtener_lista_actividad_auxiliar()
	{
		return $this->costos_actividades_auxiliares;
	}
	
	public function agregar_datos_criterio_reparto($datos)
	{
		array_push($this->datos_criterio_reparto, $datos);
	}
	
	public function obtener_datos_criterio_reparto()
	{
		return $this->datos_criterio_reparto;
	}
}