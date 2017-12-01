<?php
class CostoUnitarioActividadFila_model extends CI_Model {
	private $actividad_final;
	private $nombre_actividad;
	private $saldo_total;
	private $id_actividad;
	private $total_inductores_costo;
	private $costo_unitario_conductor;

    public function __construct()
    {
        $this->load->database();
		$this->load->model('CriterioRepartoSecundario_model');
		$this->load->model('UnidadRepartoSecundario_model');
		$this->load->model('CostoActividad_model');
		$this->load->model('InductorCosto_model');
		$this->load->model('InductorConsumido_model');
    }
	
	public function calcular_costo_unitario()
	{
		// Obtener el nombre de la actividad
		$nombre_actividad = $this->actividad_final->get_costo_actividad_base()->get_actividad()['nombre_actividad'];
		$id_actividad = $this->actividad_final->get_costo_actividad_base()->get_actividad()['id_actividad'];
		$saldo_inicial = $this->actividad_final->get_costo_actividad_base()->get_total_consumido();
		$saldo_agregado = $this->actividad_final->get_costos_agregados();
		$saldo_total = $saldo_inicial + $saldo_agregado;
		
		// Paso 2: guardar la informacion
		$this->nombre_actividad = $nombre_actividad;
		$this->saldo_total = $saldo_total;
		$this->id_actividad = $id_actividad;
		
		// Paso 3: obtener la cuenta de los inductores de costo
		$inductor_costo = $this->InductorCosto_model->obtener_inductor_costo_poractividad($id_actividad)[0];
		
		// Paso 4: obtener inductores consumidos por los consumidores de costos
		$inductores_consumidos = $this->InductorConsumido_model->obtener_lista_inductor_consumido_porinductor($inductor_costo['id_inductor_costo']);
		
		// Paso 5: calcular total consumido bajo ese inductor de costo
		$total = 0.0;
		foreach($inductores_consumidos as $inductor_consumido)
		{
			$total += floatval($inductor_consumido['valor_inductor']);
		}
		$this->total_inductores_costo = $total;
		
		// Paso 6: calcular costo unitario por inductor
		$this->costo_unitario_conductor = $this->saldo_total / $this->total_inductores_costo;
		
		// Paso final: ya no se necista la informacion del proceso, asi que se elimina
		$this->actividad_final = null;
	}
	
	public function set_actividad_final($actividad)
	{
		$this->actividad_final = $actividad;
	}
	
	public function get_nombre_actividad()
	{
		return $this->nombre_actividad;
	}
	
	public function get_costo_total()
	{
		return $this->saldo_total;
	}
	
	public function get_total_inductores()
	{
		return $this->total_inductores_costo;
	}
	
	public function get_costo_unitario_inductor()
	{
		return $this->costo_unitario_conductor;
	}
}