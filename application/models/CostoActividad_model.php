<?php
class CostoActividad_model extends CI_Model {
	private $actividad;
	private $dinero_disponible;
	private $dinero_consumido;
	private $total_unidades;
	private $factor;
	private $valor_unidad;

    public function __construct()
    {
        $this->load->database();
    }
	
	public function calcular_total_consumido()
	{
		$this->factor = ($this->valor_unidad) / ($this->total_unidades*1.0);
		$this->dinero_consumido = $this->dinero_disponible * $this->factor;
	}
	
	public function get_factor_calculado()
	{
		return $this->factor;
	}
	
	public function get_total_consumido()
	{
		return $this->dinero_consumido;
	}
    
	public function set_actividad($actividad)
	{
		$this->actividad = $actividad;
		$this->valor_unidad= $actividad['valor_unidad'];
	}
	
	public function get_actividad()
	{
		return $this->actividad;
	}
	
	public function set_dinero_disponible($dinero_disponible)
	{
		$this->dinero_disponible = $dinero_disponible;
	}
	
	public function get_dinero_disponible()
	{
		return $this->dinero_disponible;
	}
	
	public function set_total_unidades($total_unidades)
	{
		$this->total_unidades = $total_unidades;
	}
	
	public function get_total_unidades()
	{
		return $this->total_unidades;
	}
}