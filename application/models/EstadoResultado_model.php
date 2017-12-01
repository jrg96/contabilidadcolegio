<?php
class EstadoResultado_model extends CI_Model {
    private $cuentas_a_cargar;
    private $cuentas_resultado = array();
    private $saldo_final;
    private $estado_empresa;
    
    public function __construct()
    {
        $this->load->database();
        $this->load->model('Cuenta_model');
        $this->load->model('CuentaEncapsulada_model');
    }
    
    public function cargar_informacion($id_periodo_contable = NULL)
    {
        // Paso 1: obtener ids de cuentas que solo son resultado
        $this->cuentas_a_cargar = $this->Cuenta_model->obtener_cuentas_por_tipo('resultado');
        
        // Paso 2: cargar toda la informacion respectiva a esa cuenta
        foreach ($this->cuentas_a_cargar as $cuenta)
        {
            if (!$this->es_cuenta_desinversion($cuenta))
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
            
                array_push($this->cuentas_resultado, $cuenta_encapsulada);
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
    
    public function saldar_estado_resultado()
    {
        $debe = 0.0;
        $haber = 0.0;
        foreach ($this->cuentas_resultado as $cuenta)
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
        
        // Si es cierto, estamos en un caso de perdida de utilidades
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
    
    public function obtener_saldo()
    {
        return $this->saldo_final;
    }
    
    public function obtener_estado_empresa()
    {
        return $this->estado_empresa;
    }
    
    public function obtener_info_a_desplegar()
    {
        $cuentas = array();
        
        foreach ($this->cuentas_resultado as $cuenta)
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
        
        return $cuentas;
    }
}