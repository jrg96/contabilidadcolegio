<?php
class RepartoSecundarioMaster_model extends CI_Model {
	private $centro_costo_filas = array();
	private $repartos_secundarios = array();

    public function __construct()
    {
        $this->load->database();
		$this->load->model('RepartoSecundarioSlave_model');
    }
    
	public function agregar_fila_centro_costo($fila)
	{
		array_push($this->centro_costo_filas, $fila);
	}
	
	public function calcular_reparto_secundario()
	{
		foreach ($this->centro_costo_filas as $fila)
		{
			$reparto_secundario_especifico = new RepartoSecundarioSlave_model();
			$reparto_secundario_especifico->agregar_centro_costo($fila);
			$reparto_secundario_especifico->calcular_reparto_secundario();
			
			// Agregar al aray de repartos secundarios
			array_push($this->repartos_secundarios, $reparto_secundario_especifico);
		}
	}
	
	public function obtener_info_a_desplegar()
	{
		$arr_centros_costo = array();
		
		// Sera un cuadro por cada centro de costo
		foreach($this->repartos_secundarios as $reparto)
		{
			$arr_actividades_internas = array();
			$unidades_contado = 0.0;
			$factor_contado = 0.0;
			$dinero_contado = 0.0;
			
			foreach($reparto->obtener_actividades() as $actividad)
			{
				$nombre_actividad = $actividad->get_actividad()['nombre_actividad'];
				$factor = $actividad->get_factor_calculado();
				$dinero_correspondiente = $actividad->get_total_consumido();
				$valor_unidad = $actividad->get_actividad()['valor_unidad'];
				
				$unidades_contado += $valor_unidad;
				$factor_contado += $factor;
				$dinero_contado += $dinero_correspondiente;
				
				$datos_actividad = array(
					'nombre_actividad' => $nombre_actividad,
					'valor_unidad' => $valor_unidad,
					'factor' => $factor,
					'dinero_correspondiente' => $dinero_correspondiente
				);
				
				// Agregar al array de actividades de ese centro de costo
				array_push($arr_actividades_internas, $datos_actividad);
			}
			
			$centro_costo = array(
				'nombre_centro_costo' => $reparto->obtener_centro_costo()->get_centro_costo()['nombre_centro_costo'],
				'nombre_criterio_reparto' => $reparto->obtener_criterio_reparto_secundario()['nombre_criterio_reparto_secundario'],
				'dinero_disponible' => $reparto->obtener_dinero_disponible(),
				'total_unidades' => $reparto->obtener_criterio_reparto_secundario()['total_unidades'],
				'actividades' => $arr_actividades_internas,
				'unidades_contado' => $unidades_contado,
				'factor_contado' => $factor_contado,
				'dinero_contado' => $dinero_contado
			);
			
			array_push($arr_centros_costo, $centro_costo);
		}
		
		return $arr_centros_costo;
	}
	
	public function obtener_costo_actividades($tipo_actividad)
	{
		$actividades_encontradas = array();
		
		// Paso 1: recorremos cada centro de costo
		foreach($this->repartos_secundarios as $reparto)
		{
			$encontrados = $reparto->obtener_actividades_portipo($tipo_actividad);
			
			foreach($encontrados as $acierto)
			{
				array_push($actividades_encontradas, $acierto);
			}
		}
		
		return $actividades_encontradas;
	}
}