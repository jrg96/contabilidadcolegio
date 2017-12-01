<?php
class EstadoCapital_model extends CI_Model {
    private $cuentas_a_cargar;
    private $cuentas_capital = array();
    private $periodo_contable;
    private $valor_utilidad;
    private $tipo_utilidad;
    private $valor_reinvertido;
    private $saldo_final;
    private $estado_empresa;
    
    public function __construct()
    {
        $this->load->database();
        $this->load->model('Cuenta_model');
        $this->load->model('CuentaEncapsulada_model');
        $this->load->model('PeriodoContable_model');
    }
    
    public function cargar_informacion($id_periodo_contable = NULL)
    {
        // Paso 0: cargar la info sobre el periodo contable
        $this->periodo_contable = $this->PeriodoContable_model->obtener_periodo_abierto()[0];
        $this->periodo_contable['perc_utilidad_retenida'] = floatval($this->periodo_contable['perc_utilidad_retenida']) / 100.0;
        
        
        // Paso 1: cargar la cuenta de capital que es el capital de la empresa
        $this->cuentas_a_cargar = $this->Cuenta_model->obtener_cuentas_por_tipo('capital');
        foreach ($this->cuentas_a_cargar as $cuenta)
        {
			if ($this->es_capital_empresa($cuenta))
			{
				$cuenta_encapsulada = new CuentaEncapsulada_model();
				if ($id_periodo_contable == NULL)
				{
					$cuenta_encapsulada->cargar_cuenta($cuenta['id_cuenta_interno']);
				}
				else
				{
					$cuenta_encapsulada->cargar_cuenta_periodo($cuenta['id_cuenta_interno'], $id_periodo_contable);
				}
				$cuenta_encapsulada->saldar_cuenta('todo');
				
				array_push($this->cuentas_capital, $cuenta_encapsulada);
				break;
			}
        }
        
        // Paso 2: obtener ids de cuentas que solo son resultado
        $this->cuentas_a_cargar = $this->Cuenta_model->obtener_cuentas_por_tipo('resultado');
        
        // Paso 3: cargar toda la informacion respectiva a esa cuenta que sea desinversion
        foreach ($this->cuentas_a_cargar as $cuenta)
        {
            if ($this->es_cuenta_desinversion($cuenta))
            {
                $cuenta_encapsulada = new CuentaEncapsulada_model();
                $cuenta_encapsulada->cargar_cuenta($cuenta['id_cuenta_interno']);
                $cuenta_encapsulada->saldar_cuenta('todo');
            
                array_push($this->cuentas_capital, $cuenta_encapsulada);
            }
        }
    }
    
    public function obtener_datos_cuentas()
    {
        return $this->cuentas_a_cargar;
    }
    
    private function es_cuenta_desinversion($cuenta)
    {
        if (strpos($cuenta['atributo_cuenta'], 'DI') !== false)
        {
            return true;
        }
        return false;
    }
    
    public function agregar_info_utilidades($valor, $tipo)
    {
        $this->valor_utilidad = $valor;
        $this->tipo_utilidad = $tipo;
    }
    
    public function saldar_estado_capital()
    {
        //  Paso 1: saldar normalmente las cuentas involucradas
        $debe = 0.0;
        $haber = 0.0;
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
        
        // Paso 2: agregar las utilidades reinvertidas al juego
        if ($this->tipo_utilidad == 'ganancia')
        {
            $perc_utilidad_reinvertida = 1.0 - $this->periodo_contable['perc_utilidad_retenida'];
            $this->valor_reinvertido = $this->valor_utilidad * $perc_utilidad_reinvertida;
            
            // se agrega al haber
            $haber += $this->valor_reinvertido;
        }
        else
        {
            // Absorbemos toda la perdida de capital
            $debe += $this->valor_utilidad;
        }
        
        // Paso 3: generar el saldo final
        // Si es cierto, la empresa ha entrado en numeros rojos en capital
        if ($debe > $haber)
        {
            $total = $debe - $haber;
            $this->saldo_final = array($total, '-');
            $this->estado_empresa = 'perdida';
        }
        else
        {
            $total = $haber - $debe;
            $this->saldo_final = array('-', $total);
            $this->estado_empresa = 'ganancia';
        }
    }
    
    public function obtener_info_a_desplegar()
    {
        $cuentas = array();
        
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
        
        // Agregamos la cuenta de utilidad reinvertida
        if ($this->tipo_utilidad == 'ganancia')
        {
            $fila = array(
                'nombre' => 'Utilidad reinvertida (' . (1.0 - $this->periodo_contable['perc_utilidad_retenida']) . ')',
                'debe' => '-',
                'haber' => $this->valor_reinvertido
            );
            array_push($cuentas, $fila);
        }
        else
        {
            $fila = array(
                'nombre' => 'Utilidad perdidas',
                'debe' => $this->valor_utilidad,
                'haber' => '-'
            );
            array_push($cuentas, $fila);
        }
        
        return $cuentas;
    }
    
    public function obtener_saldo()
    {
        return $this->saldo_final;
    }
	
	public function obtener_periodo_contable()
	{
		return $this->periodo_contable;
	}
	
	private function es_capital_empresa($cuenta)
    {
        if (strpos($cuenta['atributo_cuenta'], 'KE') !== false)
        {
            return true;
        }
        return false;
    }
}