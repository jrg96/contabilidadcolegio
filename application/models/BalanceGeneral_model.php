<?php
date_default_timezone_set('America/El_Salvador');

class BalanceGeneral_model extends CI_Model {
    private $ids_activo_pasivo;
	private $ids_capital;
	
	private $cuentas_activo_pasivo = array();
	private $cuentas_capital = array();
	
	private $cuenta_capital_empresa;
	private $cuenta_utilidad_retenida;
	
	private $total_a_capital;
	private $total_resultado;
	private $periodo_contable;
	
	private $total_a_retener = -1;
	
	private $total_balance_general = array(-1, -1);
    
    public function __construct()
    {
        $this->load->database();
        $this->load->model('Cuenta_model');
        $this->load->model('CuentaEncapsulada_model');
		$this->load->model('Transaccion_model');
    }
    
    public function cargar_informacion($id_periodo_contable = NULL)
    {
        //Paso 1: obtener cuentas activo y pasivo
        $this->ids_activo_pasivo = $this->Cuenta_model->obtener_cuentas_por_tipo('activo_pasivo');
		
		//Paso 2: cargarlas y saldarlas normalmente
		foreach ($this->ids_activo_pasivo as $id)
		{
			$cuenta = new CuentaEncapsulada_model();
			if ($id_periodo_contable == NULL)
			{
				$cuenta->cargar_cuenta($id['id_cuenta_interno']);
			}
			else
			{
				$cuenta->cargar_cuenta_periodo($id['id_cuenta_interno'], $id_periodo_contable);
			}
			$cuenta->saldar_cuenta('todo');
			
			array_push($this->cuentas_activo_pasivo, $cuenta);
		}
		
		// Paso 4: obtener las cuentas de capital
		$this->ids_capital = $this->Cuenta_model->obtener_cuentas_por_tipo('capital');
		
		// Paso 5: cargar y agregar la cuenta que sea de capital de la empresa y utilidad retenida
		foreach ($this->ids_capital as $id)
		{
			$cuenta = new CuentaEncapsulada_model();
			$cuenta->cargar_cuenta($id['id_cuenta_interno']);
			$cuenta->saldar_cuenta('todo');
				
			if ($this->es_capital_empresa($id))
			{
				$this->cuenta_capital_empresa = $cuenta;
				continue;
			}
			
			if ($this->es_utilidad_retenida($id))
			{
				$this->cuenta_utilidad_retenida = $cuenta;
			}
			
			array_push($this->cuentas_capital, $cuenta);
		}
    }
	
	public function saldar_balance_general()
	{
		$debe = 0.0;
		$haber = 0.0;
		
		// Paso 1: Utilizar todas las cuentas activo y pasivo
		foreach ($this->cuentas_activo_pasivo as $cuenta)
        {
            $saldo = $cuenta->obtener_saldo();
            if ($saldo[0] > -1)
            {
                $debe += $saldo[0];
            }
            else
            {
                $haber += $saldo[1];
            }
        }
		
		// Paso 2: Agregar la cuenta capital de la empresa al juego
		if ($this->total_a_capital[0] > -1)
		{
			$debe += $this->total_a_capital[0];
		}
		else
		{
			$haber += $this->total_a_capital[1];
		}
		
		// Paso 3: Agregar las demas cuentas de capital que no sean la de la empresa
		foreach ($this->cuentas_capital as $cuenta)
        {
            $saldo = $cuenta->obtener_saldo();
            if ($saldo[0] > -1)
            {
                $debe += $saldo[0];
            }
            else
            {
                $haber += $saldo[1];
            }
        }
		
		// Paso 4: agregar la utilidad retenida al juego en caso de haberla
		// Solo si quedo en el haber, hay una ganancia y por ende una utilidad retenida
		if ($this->total_resultado[0] == -1)
		{
			$perc_utilidad_reinvertida = 1.0 - $this->periodo_contable['perc_utilidad_retenida'];
			$valor_reinvertido = $this->total_resultado[1] * $perc_utilidad_reinvertida;
			$valor_retenido = $this->total_resultado[1] - $valor_reinvertido;
			
			// Las retenidas van siempre en el haber
			$haber += $valor_retenido;
			$this->total_a_retener = $valor_retenido;
		}
		
		// Paso 4: guardarlo al total
		$this->total_balance_general[0] = $debe;
		$this->total_balance_general[1] = $haber;
	}
	
	public function obtener_saldo()
	{
		return $this->total_balance_general;
	}
	
	public function obtener_info_a_desplegar()
	{
		$cuentas = array();
		
		// Mostrar las cuentas basicas
		foreach ($this->cuentas_activo_pasivo as $cuenta)
		{
			$datos = $cuenta->obtener_datos_cuenta();
            $nombre = $datos['id_clase_cuenta'] . '.' . $datos['id_grupo_cuenta'] . '.' . $datos['id_cuenta_mayor'] . '.' . $datos['id_cuenta'];
            $nombre = $nombre . ' ' . $datos['nombre_cuenta'] . ' ' . $datos['abreviatura_clase_cuenta'];
            
            $saldo = $cuenta->obtener_saldo();
            
            $debe = '-';
            $haber = '-';
            
            if ($saldo[0] > -1)
            {
                $debe = $saldo[0];
            }
            
            if ($saldo[1] > -1)
            {
                $haber = $saldo[1];
            }
            
            $fila = array(
                'nombre' => $nombre,
                'debe' => $debe,
                'haber' => $haber
            );
            
            array_push($cuentas, $fila);
		}
		
		// Agregar la cuenta de capital
		$datos = $this->cuenta_capital_empresa->obtener_datos_cuenta();
        $nombre = $datos['id_clase_cuenta'] . '.' . $datos['id_grupo_cuenta'] . '.' . $datos['id_cuenta_mayor'] . '.' . $datos['id_cuenta'];
        $nombre = $nombre . ' ' . $datos['nombre_cuenta'] . ' ' . $datos['abreviatura_clase_cuenta'];
		
		$debe = '-';
		$haber = '-';
		
		if ($this->total_a_capital[0] > -1)
		{
			$debe = $this->total_a_capital[0];
		}
		else
		{
			$haber = $this->total_a_capital[1];
		}
		
		$fila = array(
			'nombre' => $nombre,
			'debe' => $debe,
			'haber' => $haber
		);
		array_push($cuentas, $fila);
		
		// Agregar las demas cuentas de capital
		foreach ($this->cuentas_capital as $cuenta)
		{
			$datos = $cuenta->obtener_datos_cuenta();
            $nombre = $datos['id_clase_cuenta'] . '.' . $datos['id_grupo_cuenta'] . '.' . $datos['id_cuenta_mayor'] . '.' . $datos['id_cuenta'];
            $nombre = $nombre . ' ' . $datos['nombre_cuenta'] . ' ' . $datos['abreviatura_clase_cuenta'];
            
            $saldo = $cuenta->obtener_saldo();
            
            $debe = '-';
            $haber = '-';
            
            if ($saldo[0] > -1)
            {
                $debe = $saldo[0];
            }
            
            if ($saldo[1] > -1)
            {
                $haber = $saldo[1];
            }
            
            $fila = array(
                'nombre' => $nombre,
                'debe' => $debe,
                'haber' => $haber
            );
            
            array_push($cuentas, $fila);
		}
		
		// Agregar la cuenta de utilidad retenida del periodo
		if ($this->total_a_retener > -1)
		{
			$nombre = 'Utilidad retenida periodo (' . $this->periodo_contable['perc_utilidad_retenida'] . ')';
			$debe = '-';
			$haber = $this->total_a_retener;
			
			$fila = array(
				'nombre' => $nombre,
				'debe' => $debe,
				'haber' => $haber
			);
			array_push($cuentas, $fila);
		}
		
		return $cuentas;
	}
	
	public function enviar_a_db($id_periodo_contable)
	{
		// Paso 1: enviar todas las cuentas activos y pasivos a db
		foreach ($this->cuentas_activo_pasivo as $cuenta)
		{
			// Obtener los datos de la cuenta
			$datos_cuenta = $cuenta->obtener_datos_cuenta();
			$saldo = $cuenta->obtener_saldo();
			
			// preparar transaccion
			$id_periodo_contable = $id_periodo_contable;
			$id_cuenta_interno = $datos_cuenta['id_cuenta_interno'];
			$monto = 0.0;
			$esta_en_debe = '';
			$es_transaccion_ajuste = 'F';
			$fecha_realizacion = date('Y-m-d H:i:s');
			
			if ($saldo[0] > -1)
            {
                $monto = $saldo[0];
				$esta_en_debe = 'V';
            }
            
            if ($saldo[1] > -1)
            {
                $monto = $saldo[1];
				$esta_en_debe = 'F';
            }
			
			$this->Transaccion_model->insertar_transaccion($id_periodo_contable, $id_cuenta_interno, $monto, $esta_en_debe, $es_transaccion_ajuste, $fecha_realizacion);
		}
		
		// Paso 2: enviar todas las cuentas de capital que no sean capital empresa
		foreach ($this->cuentas_capital as $cuenta)
		{
			// Obtener los datos de la cuenta
			$datos_cuenta = $cuenta->obtener_datos_cuenta();
			$saldo = $cuenta->obtener_saldo();
			
			// preparar transaccion
			$id_periodo_contable = $id_periodo_contable;
			$id_cuenta_interno = $datos_cuenta['id_cuenta_interno'];
			$monto = 0.0;
			$esta_en_debe = '';
			$es_transaccion_ajuste = 'F';
			$fecha_realizacion = date('Y-m-d H:i:s');
			
			if ($saldo[0] > -1)
            {
                $monto = $saldo[0];
				$esta_en_debe = 'V';
            }
            if ($saldo[1] > -1)
            {
                $monto = $saldo[1];
				$esta_en_debe = 'F';
            }
			
			// Si es cuenta utilidad retenida, agregarle el monto a retener del periodo
			if ($this->es_utilidad_retenida($datos_cuenta) && ($this->total_a_retener > -1))
			{
				$monto += $this->total_a_retener;
			}
			
			$this->Transaccion_model->insertar_transaccion($id_periodo_contable, $id_cuenta_interno, $monto, $esta_en_debe, $es_transaccion_ajuste, $fecha_realizacion);
		}
		
		// Paso 3: enviar la cuenta de capital de empresa a la db
		$datos_cuenta = $this->cuenta_capital_empresa->obtener_datos_cuenta();
		
        // preparar transaccion
		$id_periodo_contable = $id_periodo_contable;
		$id_cuenta_interno = $datos_cuenta['id_cuenta_interno'];
		$monto = 0.0;
		$esta_en_debe = '';
		$es_transaccion_ajuste = 'F';
		$fecha_realizacion = date('Y-m-d H:i:s');
		
		if ($this->total_a_capital[0] > -1)
		{
			$monto = $this->total_a_capital[0];
			$esta_en_debe = 'V';
		}
		else
		{
			$monto = $this->total_a_capital[1];
			$esta_en_debe = 'F';
		}
		
		
			$this->Transaccion_model->insertar_transaccion($id_periodo_contable, $id_cuenta_interno, $monto, $esta_en_debe, $es_transaccion_ajuste, $fecha_realizacion);
	}
	
	public function cargar_estado_capital($total)
	{
		if ($total[0] == '-')
		{
			$total[0] = -1;
		}
		else
		{
			$total[1] = -1;
		}
		
		$this->total_a_capital = $total;
	}
	
	public function cargar_estado_resultado($total)
	{
		if ($total[0] == '-')
		{
			$total[0] = -1;
		}
		else
		{
			$total[1] = -1;
		}
		
		$this->total_resultado = $total;
	}
	
	public function cargar_periodo_contable($periodo)
	{
		$this->periodo_contable = $periodo;
	}
	
	private function es_capital_empresa($cuenta)
    {
        if (strpos($cuenta['atributo_cuenta'], 'KE') !== false)
        {
            return true;
        }
        return false;
    }
	
	private function es_utilidad_retenida($cuenta)
    {
        if (strpos($cuenta['atributo_cuenta'], 'UR') !== false)
        {
            return true;
        }
        return false;
    }
}