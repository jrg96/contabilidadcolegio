<?php
class BalanceComprobacion_model extends CI_Model {
    private $cuentas_a_cargar;
    private $cuentas_transaccion_no_ajuste = array();
    private $cuentas_transaccion_ajuste = array();
    private $cuentas_transaccion_todo = array();
    
    private $saldo_no_ajuste = array(-1, -1);
    private $saldo_ajuste = array(-1, -1);
    private $saldo_todo = array(-1, -1);
    
    public function __construct()
    {
        $this->load->database();
        $this->load->model('Cuenta_model');
        $this->load->model('CuentaEncapsulada_model');
    }
    
    public function cargar_informacion($id_periodo_contable = NULL)
    {
        //Paso 1: obtener todas las cuentas
        $this->cuentas_a_cargar = $this->Cuenta_model->obtener_cuentas();
        
        // Paso 2: crear 2 objetos, uno que mantendra en vista las transacciones sin ajuste, las otras con ajuste
        foreach ($this->cuentas_a_cargar as $cuenta)
        {
            $transaccion_no_ajuste = new CuentaEncapsulada_model();
            $transaccion_ajuste = new CuentaEncapsulada_model();
            $transaccion_todo = new CuentaEncapsulada_model();
            
			if ($id_periodo_contable == NULL)
			{
				$transaccion_no_ajuste->cargar_cuenta($cuenta['id_cuenta_interno']);
				$transaccion_ajuste->cargar_cuenta($cuenta['id_cuenta_interno']);
				$transaccion_todo->cargar_cuenta($cuenta['id_cuenta_interno']);
			}
			else
			{
				$transaccion_no_ajuste->cargar_cuenta_periodo($cuenta['id_cuenta_interno'], $id_periodo_contable);
				$transaccion_ajuste->cargar_cuenta_periodo($cuenta['id_cuenta_interno'], $id_periodo_contable);
				$transaccion_todo->cargar_cuenta_periodo($cuenta['id_cuenta_interno'], $id_periodo_contable);
			}
            
            $transaccion_no_ajuste->saldar_cuenta('no_ajuste');
            $transaccion_ajuste->saldar_cuenta('ajuste');
            $transaccion_todo->saldar_cuenta('todo');
            
            array_push($this->cuentas_transaccion_no_ajuste, $transaccion_no_ajuste);
            array_push($this->cuentas_transaccion_ajuste, $transaccion_ajuste);
            array_push($this->cuentas_transaccion_todo, $transaccion_todo);
        }
    }
    
    public function saldar_balance_comprobacion()
    {
        // Paso 1: saldar las no ajustadas
        $debe = 0.0;
        $haber = 0.0;
        foreach ($this->cuentas_transaccion_no_ajuste as $cuenta)
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
        $this->saldo_no_ajuste = array($debe, $haber);
        
        // Paso 2: saldar los ajustes
        $debe = 0.0;
        $haber = 0.0;
        foreach ($this->cuentas_transaccion_ajuste as $cuenta)
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
        $this->saldo_ajuste = array($debe, $haber);
        
        // Paso 3: saldar el todo
        $debe = 0.0;
        $haber = 0.0;
        foreach ($this->cuentas_transaccion_todo as $cuenta)
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
        $this->saldo_todo = array($debe, $haber);
    }
    
    public function obtener_info_a_desplegar()
    {
        $cuentas = array();
        $len = count($this->cuentas_transaccion_todo);
        
        for ($i = 0; $i < $len; $i++)
        {
            // Paso 0: armar los datos de la cuenta
            $datos = $this->cuentas_transaccion_no_ajuste[$i]->obtener_datos_cuenta();
            $nombre = $datos['id_clase_cuenta'] . '.' . $datos['id_grupo_cuenta'] . '.' . $datos['id_cuenta_mayor'] . '.' . $datos['id_cuenta'];
            $nombre = $nombre . ' ' . $datos['nombre_cuenta'] . ' ' . $datos['abreviatura_clase_cuenta'];
            
            // Paso 1: armar el no ajustado
            $debe_no_ajuste = '-';
            $haber_no_ajuste = '-';
            $saldo_no_ajuste = $this->cuentas_transaccion_no_ajuste[$i]->obtener_saldo();
            if ($saldo_no_ajuste[0] > -1)
            {
                $debe_no_ajuste = $saldo_no_ajuste[0];
            }
            if ($saldo_no_ajuste[1] > -1)
            {
                $haber_no_ajuste = $saldo_no_ajuste[1];
            }
            
            // Paso 2: armar la parte de ajustes
            $debe_ajuste = '-';
            $haber_ajuste = '-';
            $saldo_ajuste = $this->cuentas_transaccion_ajuste[$i]->obtener_saldo();
            if ($saldo_ajuste[0] > -1)
            {
                $debe_ajuste = $saldo_ajuste[0];
            }
            if ($saldo_ajuste[1] > -1)
            {
                $haber_ajuste = $saldo_ajuste[1];
            }
            
            // Paso 3: armar el todo
            $debe_todo = '-';
            $haber_todo = '-';
            $saldo_todo = $this->cuentas_transaccion_todo[$i]->obtener_saldo();
            if ($saldo_todo[0] > -1)
            {
                $debe_todo = $saldo_todo[0];
            }
            if ($saldo_todo[1] > -1)
            {
                $haber_todo = $saldo_todo[1];
            }
            
            // Paso 4: armar el objeto y agregarlo al array principal
            $cuenta = array(
                'nombre' => $nombre,
                'debe_no_ajuste' => $debe_no_ajuste,
                'haber_no_ajuste' => $haber_no_ajuste,
                'debe_ajuste' => $debe_ajuste,
                'haber_ajuste' => $haber_ajuste,
                'debe_todo' => $debe_todo,
                'haber_todo' => $haber_todo
            );
            array_push($cuentas, $cuenta);
        }
        
        return $cuentas;
    }
    
    public function obtener_saldo_no_ajuste()
    {
        return $this->saldo_no_ajuste;
    }
    
    public function obtener_saldo_ajuste()
    {
        return $this->saldo_ajuste;
    }
    
    public function obtener_saldo_todo()
    {
        return $this->saldo_todo;
    }
}