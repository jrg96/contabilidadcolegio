<?php
date_default_timezone_set('America/El_Salvador');
class VerEstadosFinancieros extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('BalanceComprobacion_model');
        $this->load->model('EstadoResultado_model');
        $this->load->model('EstadoCapital_model');
		$this->load->model('BalanceGeneral_model');
		$this->load->model('PeriodoContable_model');
		$this->load->model('Configuracion_model');
        $this->load->library('parser');
		$this->load->library('session');
    }
    
    public function index()
    {   
		/////////////////////////// Redireccion seguridad ////////////////////////
		if (!$this->session->userdata('id_usuario'))
		{
			redirect('/login/index');
		}
		
		$id_periodo_contable = -1;
		
		if ($this->session->userdata('periodo_especifico'))
        {
            $id_periodo_contable = $this->session->userdata('periodo_especifico');
			$this->session->unset_userdata('periodo_especifico');
        }
		
		
        // Parte 1: cargar toda la informacion del balance de comprobacion
        $balance_comprobacion = new BalanceComprobacion_model();
		if ($id_periodo_contable == -1)
		{
			$balance_comprobacion->cargar_informacion();
		}
		else
		{
			$balance_comprobacion->cargar_informacion($id_periodo_contable);
		}
        $balance_comprobacion->saldar_balance_comprobacion();
        $datos_a_desplegar = $balance_comprobacion->obtener_info_a_desplegar();
        
        $saldo_no_ajuste = $balance_comprobacion->obtener_saldo_no_ajuste();
        $saldo_ajuste = $balance_comprobacion->obtener_saldo_ajuste();
        $saldo_todo = $balance_comprobacion->obtener_saldo_todo();
        
        // Parte 2: cargar toda la informacion del estado de resultado
        $estado_resultado = new EstadoResultado_model();
		if ($id_periodo_contable == -1)
		{
			$estado_resultado->cargar_informacion();
		}
		else
		{
			$estado_resultado->cargar_informacion($id_periodo_contable);
		}
        $estado_resultado->saldar_estado_resultado();
        $datos_resultado_a_desplegar = $estado_resultado->obtener_info_a_desplegar();
        $saldo_estado_resultado = $estado_resultado->obtener_saldo();
        $estado_empresa = $estado_resultado->obtener_estado_empresa();
        $mensaje_estado = '';
        
        // Parte 3: cargar toda la informacion del estado de capital
        $estado_capital = new EstadoCapital_model();
		if ($id_periodo_contable == -1)
		{
			$estado_capital->cargar_informacion();
		}
		else
		{
			$estado_capital->cargar_informacion($id_periodo_contable);
		}
        $saldo_a_enviar = 0.0;
        if ($estado_empresa == 'ganancia')
        {
            $saldo_a_enviar = $saldo_estado_resultado[1];
        }
        else
        {
            $saldo_a_enviar = $saldo_estado_resultado[0];
        }
        $estado_capital->agregar_info_utilidades($saldo_a_enviar, $estado_empresa);
        $estado_capital->saldar_estado_capital();
        $datos_capital_a_desplegar = $estado_capital->obtener_info_a_desplegar();
        $saldo_estado_capital = $estado_capital->obtener_saldo();
        
        
        if ($estado_empresa == 'ganancia')
        {
            $mensaje_estado = 'La empresa presenta ganancias';
        }
        else
        {
            $mensaje_estado = 'La empresa presenta perdidas';
        }
		
		
		// Parte 4: cargar toda la infomacion de balance general
		$balance_general = new BalanceGeneral_model();
		if ($id_periodo_contable == -1)
		{
			$balance_general->cargar_informacion();
		}
		else
		{
			$balance_general->cargar_informacion($id_periodo_contable);
		}
		$balance_general->cargar_estado_capital($estado_capital->obtener_saldo());
		$balance_general->cargar_estado_resultado($estado_resultado->obtener_saldo());
		$balance_general->cargar_periodo_contable($estado_capital->obtener_periodo_contable());
		$balance_general->saldar_balance_general();
		$datos_balancegeneral_a_desplegar = $balance_general->obtener_info_a_desplegar();
		$saldo_balance_general = $balance_general->obtener_saldo();
		
		// guardamos en la sesion el balance general
		$this->session->set_userdata('balance_general', $balance_general);
        
		// Parte 5: obtener informacion extra del nuevo periodo contable
		$periodo_contable = $this->PeriodoContable_model->obtener_periodo_abierto();
		$fecha_nuevo_periodo = new DateTime($periodo_contable[0]['fecha_final']);
		$fecha_nuevo_periodo->modify('+1 day');
		
		
		$periodos = $this->PeriodoContable_model->obtener_lista_periodo_contable();
		
        
		
        $this->smarty->assign(array(
            'base_url' => base_url(),
            'datos_a_desplegar' => $datos_a_desplegar,
            'saldo_debe_no_ajuste' => $saldo_no_ajuste[0],
            'saldo_haber_no_ajuste' => $saldo_no_ajuste[1],
            'saldo_debe_ajuste' => $saldo_ajuste[0],
            'saldo_haber_ajuste' => $saldo_ajuste[1],
            'saldo_debe_todo' => $saldo_todo[0],
            'saldo_haber_todo' => $saldo_todo[1],
            'datos_resultado_a_desplegar' => $datos_resultado_a_desplegar,
            'saldo_debe_resultado' => $saldo_estado_resultado[0],
            'saldo_haber_resultado' => $saldo_estado_resultado[1],
            'mensaje_estado_empresa' => $mensaje_estado,
            'datos_capital_a_desplegar' => $datos_capital_a_desplegar,
            'saldo_debe_capital' => $saldo_estado_capital[0],
            'saldo_haber_capital' => $saldo_estado_capital[1],
			'datos_balancegeneral_a_desplegar' => $datos_balancegeneral_a_desplegar,
			'saldo_debe_balance_general' => $saldo_balance_general[0],
			'saldo_haber_balance_general' => $saldo_balance_general[1],
			'fecha_nuevo_periodo' => $fecha_nuevo_periodo->format('d-m-Y'),
			'periodos' => $periodos
        ));
        
        $this->smarty->view('ver_estados_financieros.php');
    }
	
	public function procesar()
	{
		// Paso 0: obtener configuracion del sistema
		$config = $this->Configuracion_model->obtener_configuracion();
		$longitud_periodo_contable = intval($config[0]['longitud_periodo_contable']);
		
		// Paso 1: crear el nuevo periodo contable
		$periodo_anterior = $this->PeriodoContable_model->obtener_periodo_abierto();
		$fecha_inicio = new DateTime($periodo_anterior[0]['fecha_final']);
		$fecha_inicio->modify('+1 day');
		
		$fecha_final = clone $fecha_inicio;
		$fecha_final->modify('+' . ($longitud_periodo_contable-1) . ' month');
		
		$fecha_creacion = date('Y-m-d H:i:s');
		$fecha_inicio = $fecha_inicio->format('Y-m-d H:i:s');
		$fecha_final = $fecha_final->format('Y-m-t H:I:s');
		$meses_duracion = $longitud_periodo_contable;
        $perc_utilidad_retenida = $config[0]['perc_utilidad_retenida'];
        $estado = 'abierto';
		
		// Paso 2: Cerrar periodo contable actual
		$this->PeriodoContable_model->cerrar_periodo_contable();
		
		// Paso 3: Insertar el nuevo periodo contable
		$this->PeriodoContable_model->insertar_periodocontable($fecha_creacion, $fecha_inicio, $fecha_final, $meses_duracion, $perc_utilidad_retenida, $estado);
		
		// Paso 4: obtener el nuevo periodo abierto
		$periodo_nuevo = $this->PeriodoContable_model->obtener_periodo_abierto();
		
		// Recuperar el balance general y enviar los resultados como nuevas transacciones
		$balance_general = $this->session->userdata('balance_general');
		$balance_general->enviar_a_db($periodo_nuevo[0]['id_periodo_contable']);
	}
	
	public function procesarconsulta()
	{
		$id_periodo_contable = $this->input->post('id_periodo_contable');
		
		// Guardar en sesion y redireccionar
		$this->session->set_userdata("periodo_especifico", $id_periodo_contable);
		
		redirect('/verestadosfinancieros/index');
	}
}