<?php
class ActividadAuxiliarColumna_model extends CI_Model {
	private $costo_actividad_base;
	private $total_unidades;
	private $valor_unidad;
	private $dinero_disponible;
	private $dinero_correspondiente;
	private $factor;

    public function __construct()
    {
        $this->load->database();
    }
	
	public function calcular_total_consumido()
	{
		$this->factor = $this->valor_unidad/($this->total_unidades*1.0);
		$this->dinero_correspondiente = $this->factor * $this->dinero_disponible;
	}
	
	public function set_costo_actividad_base($actividad)
	{
		$this->costo_actividad_base = $actividad;
		
		// En base a esto podemos obtener informacion util
		$this->dinero_disponible = $actividad->get_total_consumido();
	}
	
	public function get_total_consumido()
	{
		return $this->dinero_correspondiente;
	}
	
	public function get_factor_calculado()
	{
		return $this->factor;
	}
	
	public function get_costo_actividad_base()
	{
		return $this->costo_actividad_base;
	}
	
	public function set_total_unidades($total)
	{
		$this->total_unidades = $total;
	}
	
	public function get_total_unidades()
	{
		return $this->total_unidades;
	}
	
	public function set_valor_unidad($valor_unidad)
	{
		$this->valor_unidad = $valor_unidad;
	}
	
	public function get_valor_unidad()
	{
		return $this->valor_unidad;
	}
}