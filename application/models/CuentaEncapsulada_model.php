<?php
class CuentaEncapsulada_model extends CI_Model {
    private $cuenta = null;
    private $periodo_contable = null;
    private $transacciones = null;
    private $saldo = array(-1, -1);
    
    public function __construct()
    {
        $this->load->database();
        $this->load->model('Cuenta_model');
        $this->load->model('PeriodoContable_model');
        $this->load->model('Transaccion_model');
    }
    
    public function cargar_cuenta($id_cuenta_interno)
    {
        // Paso 1, cargamos la informacion de la cuenta
        $this->cuenta = $this->Cuenta_model->obtener_cuentas($id_cuenta_interno)[0];
        
        // Paso 2: cargamos la info del periodo contable abierto
        $this->periodo_contable = $this->PeriodoContable_model->obtener_periodo_abierto()[0];
        
        // Paso 3: obtener todas las transacciones bajo ese periodo contable y id de cuenta
        $id_cuenta_interno = $this->cuenta['id_cuenta_interno'];
        $id_periodo_contable = $this->periodo_contable['id_periodo_contable'];
        $this->transacciones = $this->Transaccion_model->obtener_transacciones_cuenta($id_cuenta_interno, $id_periodo_contable);
        
        // Convertir a decimal todos los montos
        $this->convertir_a_decimal();
    }
	
	public function cargar_cuenta_periodo($id_cuenta_interno, $id_periodo_contable)
    {
        // Paso 1, cargamos la informacion de la cuenta
        $this->cuenta = $this->Cuenta_model->obtener_cuentas($id_cuenta_interno)[0];
        
        
        // Paso 3: obtener todas las transacciones bajo ese periodo contable y id de cuenta
        $id_cuenta_interno = $this->cuenta['id_cuenta_interno'];
        $this->transacciones = $this->Transaccion_model->obtener_transacciones_cuenta($id_cuenta_interno, $id_periodo_contable);
        
        // Convertir a decimal todos los montos
        $this->convertir_a_decimal();
    }
    
    public function obtener_datos_cuenta()
    {
        return $this->cuenta;
    }
    
    public function obtener_datos_periodo()
    {
        return $this->periodo_contable;
    }
    
    public function obtener_datos_transacciones()
    {
        return $this->transacciones;
    }
    
    private function convertir_a_decimal()
    {
        $len = count($this->transacciones);
        
        for ($i = 0; $i < $len; $i++)
        {
            $this->transacciones[$i]['monto'] = floatval($this->transacciones[$i]['monto']);
        }
    }
    
    public function filtrar_transacciones($tipo_transaccion = 'todo')
    {
        $resultado = array();
        
        if ($tipo_transaccion == 'todo')
        {
            $resultado = $this->transacciones;
        }
        
        if ($tipo_transaccion == 'ajuste')
        {
            foreach ($this->transacciones as $transaccion)
            {
                if ($transaccion['es_transaccion_ajuste'] == 'V')
                {
                    array_push($resultado, $transaccion);
                }
            }
        }
        
        if ($tipo_transaccion == 'no_ajuste')
        {
            foreach ($this->transacciones as $transaccion)
            {
                if ($transaccion['es_transaccion_ajuste'] == 'F')
                {
                    array_push($resultado, $transaccion);
                }
            }
        }
        
        return $resultado;
    }
    
    public function saldar_cuenta($tipo_transaccion = 'todo')
    {
        $debe = 0.0;
        $haber = 0.0;
        $total = 0.0;
        $len = count($this->transacciones);
        $transac_filtradas = $this->filtrar_transacciones($tipo_transaccion);
        
        foreach ($transac_filtradas as $transaccion)
        {
            if ($transaccion['esta_en_debe'] == 'V')
            {
                $debe += $transaccion['monto'];
            }
            else
            {
                $haber += $transaccion['monto'];
            }
        }
        
        if ($debe > $haber)
        {
            $total = $debe - $haber;
            $this->saldo[0] = $total;
            $this->saldo[1] = -1;
        }
        else
        {
            $total = $haber - $debe;
            $this->saldo[0] = -1;
            $this->saldo[1] = $total;
        }
        
        return $this->saldo;
    }
    
    public function obtener_saldo()
    {
        return $this->saldo;
    }
}