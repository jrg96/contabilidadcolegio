<?php
class RepartoTerciario_model extends CI_Model {
	private $costos_actividades_primarias;
	private $costos_actividades_auxiliares;
	private $filas_actividades_priamrias = array();

    public function __construct()
    {
        $this->load->database();
		$this->load->model('ActividadPrimariaFila_model');
		$this->load->model('ActividadAuxiliarColumna_model');
		$this->load->model('CriterioRepartoTerciario_model');
		$this->load->model('UnidadRepartoTerciario_model');
    }
	
	public function calcular_reparto_terciario()
	{
		// Paso 1: repartiremos los costos terciarios en base a 
		// que las actividades auxiliares, seran asignadas a las primarias
		// Calculamos primero el valor de las filas (actividades primarias)
		foreach($this->costos_actividades_primarias as $actividad_primaria)
		{
			// Paso 2: creamos la fila en la que asignaremos costos auxiliares
			$fila_actividad_primaria  = new ActividadPrimariaFila_model();
			$fila_actividad_primaria->set_costo_actividad_base($actividad_primaria);
			
			foreach($this->costos_actividades_auxiliares as $actividad_auxiliar)
			{
				// Paso 3: creamos la columna (actividad auxiliar para ese primario)
				$columna_actividad_auxiliar = new ActividadAuxiliarColumna_model();
				$columna_actividad_auxiliar->set_costo_actividad_base($actividad_auxiliar);
				
				// Paso 4: obtenemos informacion acerca del criterio a aplicar y la enviamos a la columna
				$id_actividad_auxiliar = $actividad_auxiliar->get_actividad()['id_actividad'];
				$criterio_reparto_terciario = $this->CriterioRepartoTerciario_model->obtener_datos_criterio_reparto_terciario_poractividad($id_actividad_auxiliar);
				$total_unidades = $criterio_reparto_terciario[0]['total_unidades'];
				$columna_actividad_auxiliar->set_total_unidades($total_unidades);
				
				$fila_actividad_primaria->agregar_datos_criterio_reparto($criterio_reparto_terciario[0]);
				
				// Paso 5: obtenemos el valor que toma la actividad primaria respecto la auxiliar
				$id_criterio_reparto_terciario = $criterio_reparto_terciario[0]['id_criterio_reparto_terciario'];
				$id_actividad_primaria = $actividad_primaria->get_actividad()['id_actividad'];
				$unidad_reparto_terciario = $this->UnidadRepartoTerciario_model->obtener_datos_actividad_criterio($id_criterio_reparto_terciario, $id_actividad_primaria);
				
				// Paso 6: asignamos los valores a la columna y calculamos lo consumido
				$columna_actividad_auxiliar->set_valor_unidad($unidad_reparto_terciario['valor_unidad']);
				$columna_actividad_auxiliar->calcular_total_consumido();
				
				// Agreamos el importe calculado a la fila
				$fila_actividad_primaria->agregar_actividad_auxiliar($columna_actividad_auxiliar);
			}
			
			// POr ultimo calculamos el total agregado al original
			$fila_actividad_primaria->calcular_costos_agregados();
			
			// Agregamos al array de filas
			array_push($this->filas_actividades_priamrias, $fila_actividad_primaria);
		}
	}
	
	public function obtener_info_a_desplegar()
	{
		$filas = array();
		
		foreach($this->filas_actividades_priamrias as $actividad_primaria)
		{
			$nombre_actividad = $actividad_primaria->get_costo_actividad_base()->get_actividad()['nombre_actividad'];
			$saldo_inicial = $actividad_primaria->get_costo_actividad_base()->get_total_consumido();
			$saldo_agregado = $actividad_primaria->get_costos_agregados();
			
			$arr_criterios_aplicados = array();
			
			foreach($actividad_primaria->obtener_lista_actividad_auxiliar() as $costo_actividad_aux)
			{
				$valor_unidad = $costo_actividad_aux->get_valor_unidad();
				$factor = $costo_actividad_aux->get_factor_calculado();
				$dinero_correspondiente = $costo_actividad_aux->get_total_consumido();
				
				$costo_auxiliar = array(
					'valor_unidad' => $valor_unidad,
					'factor' => $factor,
					'dinero_correspondiente' => $dinero_correspondiente
				);
				
				array_push($arr_criterios_aplicados, $costo_auxiliar);
			}
			
			$fila = array(
				'nombre_actividad' => $nombre_actividad,
				'saldo_inicial' => $saldo_inicial,
				'saldo_agregado' => $saldo_agregado,
				'saldo_total' => ($saldo_inicial + $saldo_agregado),
				'criterios_aplicados' => $arr_criterios_aplicados
			);
			
			array_push($filas, $fila);
		}
		
		return $filas;
	}
	
	public function obtener_encabezados_tabla()
	{
		$encabezados = array();
		
		// Obtener la primera fila para saber los encabezados
		$datos_criterio_reparto = $this->filas_actividades_priamrias[0]->obtener_datos_criterio_reparto();
		
		foreach($datos_criterio_reparto as $dato)
		{
			$nombre_criterio = $dato['nombre_criterio_reparto_terciario'];
			$actividad_repartida = $dato['nombre_actividad'];
			$total_unidades = $dato['total_unidades'];
			
			$encabezado = array(
				'nombre_criterio' => $nombre_criterio,
				'actividad_repartida' => $actividad_repartida,
				'total_unidades' => $total_unidades
			);
			
			array_push($encabezados, $encabezado);
		}
		
		return $encabezados;
	}
	
	public function obtener_totales_finales()
	{
		$len_criterios = count($this->obtener_encabezados_tabla());
		$total_saldo_base = 0.0;
		$total_saldo_aplicado = 0.0;
		$total_saldo_final = 0.0;
		
		$arr_criterios = array();
		
		for ($i=0; $i<$len_criterios; $i++)
		{
			$valor_unidad = 0.0;
			$factor = 0.0;
			$total_correspondiente = 0.0;
			
			foreach($this->filas_actividades_priamrias as $actividad_primaria)
			{
				$actividad_auxiliar = $actividad_primaria->obtener_lista_actividad_auxiliar()[$i];
				
				$valor_unidad += $actividad_auxiliar->get_valor_unidad();
				$factor += $actividad_auxiliar->get_factor_calculado();
				$total_correspondiente += $actividad_auxiliar->get_total_consumido();
			}
			
			$dato_criterio = array(
				'valor_unidad' => $valor_unidad,
				'factor' => $factor,
				'total_correspondiente' => $total_correspondiente
			);
			
			array_push($arr_criterios, $dato_criterio);
		}
		
		foreach($this->filas_actividades_priamrias as $actividad_primaria)
		{
			$t1 = $actividad_primaria->get_costo_actividad_base()->get_total_consumido();
			$t2 = $actividad_primaria->get_costos_agregados();
				
			$total_saldo_base += $t1;
			$total_saldo_aplicado += $t2;
			$total_saldo_final += ($t1 + $t2);
		}
		
		$totales_finales = array(
			'total_saldo_base' => $total_saldo_base,
			'total_saldo_aplicado' => $total_saldo_aplicado,
			'total_saldo_final' => $total_saldo_final,
			'totales_criterios' => $arr_criterios
		);
		
		return $totales_finales;
	}
    
    public function set_costos_actividades_primarias($actividades)
	{	
		$this->costos_actividades_primarias = $actividades;
	}
	
	public function set_costos_actividades_auxiliares($actividades)
	{
		$this->costos_actividades_auxiliares = $actividades;
	}
	
	public function obtener_actividades_finales()
	{
		return $this->filas_actividades_priamrias;
	}
}