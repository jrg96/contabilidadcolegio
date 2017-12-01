<?php
class CentroCostoPrimarioFila_model extends CI_Model {
	private $criterios_aplicados = array();
	private $centro_costo;
	private $total_consumido;

    public function __construct()
    {
        $this->load->database();
    }
	
	public function calcular_total_consumido()
	{
		$total = 0.0;
		
		foreach ($this->criterios_aplicados as $criterio)
		{
			$total += $criterio->get_dinero_consumido();
		}
		
		$this->total_consumido = $total;
	}
    
    public function agregar_criterio_aplicado($criterio)
	{
		array_push($this->criterios_aplicados, $criterio);
	}
	
	public function get_lista_criterio_aplicado()
	{	
		return $this->criterios_aplicados;
	}
	
	public function set_centro_costo($centro)
	{
		$this->centro_costo = $centro;
	}
	
	public function get_centro_costo()
	{
		return $this->centro_costo;
	}
	
	public function get_total_consumido()
	{
		return $this->total_consumido;
	}
}