<?php
class CriterioPrimarioColumna_model extends CI_Model {
	private $criterio;
	private $datos_centro_criterio;
	
	private $valor_unidad;
	private $total;
	private $factor_calculado;
	private $dinero_consumido;
	private $dinero_disponible;
	
	private $nombre_cuenta_repartir;

    public function __construct()
    {
        $this->load->database();
    }
	
	public function calcular_dinero_consumido()
	{
		$this->factor_calculado = $this->valor_unidad/($this->total*1.0);
		$this->dinero_consumido = $this->factor_calculado * $this->dinero_disponible;
	}
	
	public function set_criterio($criterio)
	{
		$this->criterio = $criterio;
		$this->set_total(floatval($criterio['total_unidades']));
		$this->nombre_cuenta_repartir = $criterio['id_clase_cuenta'] . '.' . $criterio['id_grupo_cuenta'] . '.' . $criterio['id_cuenta_mayor'] . '.' . $criterio['id_cuenta'] . ' ' . $criterio['nombre_cuenta'];
	}
	
	public function set_datos_centro_criterio($datos)
	{
		$this->datos_centro_criterio = $datos;
		
		$this->set_valor_unidad(floatval($datos['valor_unidad']));
	}
    
    public function set_valor_unidad($valor_unidad)
	{
		$this->valor_unidad = $valor_unidad;
	}
	
	public function set_total($total)
	{
		$this->total = $total;
	}
	
	public function set_dinero_disponible($dinero_disponible)
	{
		$this->dinero_disponible = $dinero_disponible;
	}
	
	public function get_criterio()
	{
		return $this->criterio;
	}
	
	public function get_valor_unidad()
	{
		return $this->valor_unidad;
	}
	
	public function get_total()
	{
		return $this->total;
	}
	
	public function get_dinero_disponible()
	{
		return $this->dinero_disponible;
	}
	
	public function get_dinero_consumido()
	{
		return $this->dinero_consumido;
	}
	
	public function get_nombre_cuenta_repartir()
	{
		return $this->nombre_cuenta_repartir;
	}
	
	public function get_factor_calculado()
	{
		return $this->factor_calculado;
	}
}