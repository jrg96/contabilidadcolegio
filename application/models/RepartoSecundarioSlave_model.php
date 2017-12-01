<?php
class RepartoSecundarioSlave_model extends CI_Model {
	private $centro_costo;
	private $dinero_disponible;
	private $id_centro_costo;
	
	private $criterio_reparto_secundario;
	private $total_unidades;
	private $costos_actividades = array();

    public function __construct()
    {
        $this->load->database();
		$this->load->model('CriterioRepartoSecundario_model');
		$this->load->model('UnidadRepartoSecundario_model');
		$this->load->model('CostoActividad_model');
    }
    
	public function agregar_centro_costo($fila)
	{
		$this->centro_costo =  $fila;
	}
	
	public function calcular_reparto_secundario()
	{
		// Paso 1: obtenemos el total que consume el centro de costo y su id
		$this->id_centro_costo = $this->centro_costo->get_centro_costo()['id_centro_costo'];
		$this->dinero_disponible= $this->centro_costo->get_total_consumido();
		
		// Paso 2: con el id de centro de costo, vamos a buscar su criterio de reparto secundario y guardamos informacion util
		$criterio_reparto_secundario = $this->CriterioRepartoSecundario_model->obtener_datos_criterio_reparto_secundario_porcentrocosto($this->id_centro_costo)[0];
		$this->total_unidades = $criterio_reparto_secundario['total_unidades'];
		$this->criterio_reparto_secundario = $criterio_reparto_secundario;
		
		// Paso 3: obtenemos todas los valores de las actividades
		$actividades = $this->UnidadRepartoSecundario_model->obtener_lista_unidad_reparto_secundario($criterio_reparto_secundario['id_criterio_reparto_secundario']);
		foreach ($actividades as $actividad)
		{
			$costo_actividad = new CostoActividad_model();
			$costo_actividad->set_actividad($actividad);
			$costo_actividad->set_dinero_disponible($this->dinero_disponible);
			$costo_actividad->set_total_unidades($this->total_unidades);
			$costo_actividad->calcular_total_consumido();
			
			// Agregar al array de actividades
			array_push($this->costos_actividades, $costo_actividad);
		}
		
	}
	
	public function obtener_actividades()
	{
		return $this->costos_actividades;
	}
	
	public function obtener_actividades_portipo($tipo_actividad)
	{
		$encontrados = array();
		
		// Paso 1: recorremos todos los costos de las actividades
		foreach($this->costos_actividades as $costo)
		{
			// Paso 2 si es del tipo buscado, lo agregamos en encontrados
			if ($costo->get_actividad()['tipo_actividad'] == $tipo_actividad)
			{
				array_push($encontrados, $costo);
			}
		}
		
		return $encontrados;
	}
	
	public function obtener_centro_costo()
	{
		return $this->centro_costo;
	}
	
	public function obtener_criterio_reparto_secundario()
	{
		return $this->criterio_reparto_secundario;
	}
	
	public function obtener_dinero_disponible()
	{
		return $this->dinero_disponible;
	}
}