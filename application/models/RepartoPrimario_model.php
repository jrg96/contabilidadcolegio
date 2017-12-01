<?php
class RepartoPrimario_model extends CI_Model {
	private $centro_costo_filas = array();

    public function __construct()
    {
        $this->load->database();
		$this->load->model('CentroCosto_model');
		$this->load->model('CentroCostoEncapsulado_model');
		$this->load->model('CentroCostoPrimarioFila_model');
		$this->load->model('UnidadRepartoPrimario_model');
		$this->load->model('CriterioRepartoPrimario_model');
		$this->load->model('CriterioPrimarioColumna_model');
		$this->load->model('CuentaEncapsulada_model');
    }
    
    public function cargar_datos()
	{
		// Estrategia, obtener todos los centros de costos, para asi llenarlos con cada uno de los criterios
		$id_centros_costo = $this->CentroCosto_model->obtener_lista_centro_costo();
		
		foreach($id_centros_costo as $id)
		{
			// Paso 1: creamos el objeto fila del que estaremos advertidos
			$fila = new CentroCostoPrimarioFila_model();
			$fila->set_centro_costo($id);
			
			// Paso 2: obtener los id de los criterios primarios en donde se encuentra este centro de costo
			$id_criterios_primarios = $this->UnidadRepartoPrimario_model->obtener_id_reparto_primario_porcentrocosto($fila->get_centro_costo()['id_centro_costo']);
			
			// Paso 4: por cada id de criterio primario, obtener la informacion del criterio y su reparticion
			foreach ($id_criterios_primarios as $id_criterio)
			{
				$criterio_primario = $this->CriterioRepartoPrimario_model->obtener_datos_criterio_reparto_primario($id_criterio);
				$datos_centro_criterio = $this->UnidadRepartoPrimario_model->obtener_datos_centro_criterio($criterio_primario['id_criterio_reparto_primario'], $fila->get_centro_costo()['id_centro_costo']);
				$dinero_disponible = $this->obtener_saldo_cuenta($criterio_primario['id_cuenta_interno']);
				
				
				$columna = new CriterioPrimarioColumna_model();
				$columna->set_criterio($criterio_primario);
				$columna->set_datos_centro_criterio($datos_centro_criterio);
				$columna->set_dinero_disponible($dinero_disponible);
				$columna->calcular_dinero_consumido();
				
				// Paso 5: añadir columna de criterio aplicado a la fila del centro de costo
				$fila->agregar_criterio_aplicado($columna);
				
				
			}
			
			// Paso 6: agregamos al array de las filas y calculamos su total consumido por todos los criterios
			$fila->calcular_total_consumido();
			array_push($this->centro_costo_filas, $fila);
		}
	}
	
	public function obtener_criterios()
	{
		$criterios = array();
		$lista_criterios = $this->centro_costo_filas[0]->get_lista_criterio_aplicado();
		
		foreach($lista_criterios as $criterio)
		{
			$nombre_criterio = $criterio->get_criterio()['nombre_criterio_reparto_primario'];
			$cuenta_repartida = $criterio->get_nombre_cuenta_repartir();
			$total_unidades = $criterio->get_criterio()['total_unidades'];
			$dinero_disponible = $criterio->get_dinero_disponible();
			
			$encabezado = array(
				'nombre_criterio' => $nombre_criterio,
				'cuenta_repartir' => $cuenta_repartida,
				'total_unidades' => $total_unidades,
				'dinero_disponible' => $dinero_disponible
			);
			
			array_push($criterios, $encabezado);
		}
		
		return $criterios;
	}
	
	public function obtener_filas()
	{
		return $this->centro_costo_filas;
	}
	
	public function obtener_totales_finales()
	{
		$len_criterios = count($this->obtener_criterios());
		$totales_finales = array();
		$totales_criterios = array();
		$total_aplicado = 0.0;
		
		for ($i = 0; $i < $len_criterios; $i++)
		{
			$valor_unidad = 0.0;
			$factor = 0.0;
			$total_correspondiente = 0.0;
			
			// Recorriendo cada centro de costo
			foreach($this->centro_costo_filas as $centro_costo)
			{
				// Obtener el criterio que nos interesa
				$criterio = $centro_costo->get_lista_criterio_aplicado()[$i];
				
				// Sumamos las cantidades
				$valor_unidad += $criterio->get_valor_unidad();
				$factor += $criterio->get_factor_calculado();
				$total_correspondiente += $criterio->get_dinero_consumido();
			}
			
			// Agregar resultado a la lista de totales finales
			$datos_total = array(
				'valor_unidad' => $valor_unidad,
				'factor' => $factor,
				'total_correspondiente' => $total_correspondiente
			);
			
			array_push($totales_criterios, $datos_total);
		}
		
		// Calculando el total consumido por todos los centros de costos
		foreach($this->centro_costo_filas as $centro_costo)
		{
			$total_aplicado += $centro_costo->get_total_consumido();
		}
		
		$totales_finales['total_centro_criterio'] = $total_aplicado;
		$totales_finales['totales_criterios'] = $totales_criterios;
		
		return $totales_finales;
	}
	
	public function obtener_info_a_desplegar()
	{
		$filas = array();
		
		foreach ($this->centro_costo_filas as $centro_costo)
		{
			$nombre_centro_costo = $centro_costo->get_centro_costo()['nombre_centro_costo'];
			$columnas_internas = array();
			$total_consumido = $centro_costo->get_total_consumido();
			
			foreach ($centro_costo->get_lista_criterio_aplicado() as $criterio)
			{
				$valor_unidad = $criterio->get_valor_unidad();
				$factor = $criterio->get_factor_calculado();
				$total_correspondiente = $criterio->get_dinero_consumido();
				
				$datos_criterio = array(
					'valor_unidad' => $valor_unidad,
					'factor' => $factor,
					'total_correspondiente' => $total_correspondiente
				);
				
				array_push($columnas_internas, $datos_criterio);
			}
			
			$datos_fila = array(
				'nombre_centro_costo' => $nombre_centro_costo,
				'criterios' => $columnas_internas,
				'total_consumido' => $total_consumido
			);
			array_push($filas, $datos_fila);
		}
		
		return $filas;
	}
	
	private function obtener_saldo_cuenta($id_cuenta_interno)
	{
		$cuenta_encapsulada = new CuentaEncapsulada_model();
		$cuenta_encapsulada->cargar_cuenta($id_cuenta_interno);
		$cuenta_encapsulada->saldar_cuenta('todo');
		
		$saldo = $cuenta_encapsulada->obtener_saldo();
		$dinero_disponible = 0.0;
		
		if ($saldo[0] > -1)
		{
			$dinero_disponible = $saldo[0];
		}
		else
		{
			$dinero_disponible = $saldo[1];
		}
		
		return $dinero_disponible;
	}
}