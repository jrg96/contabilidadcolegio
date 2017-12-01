<?php
date_default_timezone_set('America/El_Salvador');
class ModificarEmpleado extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('parser');
        $this->load->library('session');
		$this->load->model('Empleado_model');
		$this->load->model('Prestaciones_model');
		$this->load->model('Cuenta_model');
		$this->load->model('PeriodoContable_model');
		$this->load->model('PagoEmpleado_model');
		$this->load->model('Transaccion_model');
    }
    
    public function index($id_empleado)
    {
		/////////////////////////// Redireccion seguridad ////////////////////////
		if (!$this->session->userdata('id_usuario'))
		{
			redirect('/login/index');
		}
		
		//////////////////////////// Mensajes de la aplicacion ///////////////////////
        $resultado_operacion = 'ninguna';
        $mensaje_operacion = 'm';
        
        if ($this->session->userdata('resultado_operacion'))
        {
            $resultado_operacion = $this->session->userdata('resultado_operacion');
            $mensaje_operacion = $this->session->userdata('mensaje_operacion');
            
            $this->session->unset_userdata('resultado_operacion');
            $this->session->unset_userdata('mensaje_operacion');
        }
		
		//////////////////////////// Datos de la DB /////////////////////////////////
		$empleado = $this->Empleado_model->obtener_datos_empleado($id_empleado);
		$prestaciones =  new Prestaciones_model();
		$prestaciones->set_salario_base($empleado['salario_base_diario']);
		$prestaciones->set_fecha_contratacion($empleado['fecha_contratacion']);
		$prestaciones->calcular_prestaciones_ley();
		
		$dias_aguinaldo = $prestaciones->obtener_dias_aguinaldo();
		$aguinaldo_semanal = $prestaciones->obtener_aguinaldo_semanal();
		$vacaciones_semanal = $prestaciones->obtener_vacaciones_semanal();
		$seguro_afp_vacaciones = $prestaciones->obtener_seguro_afp_vacaciones();
		$insaforp_semanal = $prestaciones->obtener_insaforp_semanal();
		$seguro_afp_semanal = $prestaciones->obtener_seguro_afp_semanal();
		$salario_real_semanal = $prestaciones->obtener_salario_real_semanal();
		$salario_real_mensual = $salario_real_semanal * 4;
		
		$cuentas = $this->Cuenta_model->obtener_cuentas();
		$pagos = $this->PagoEmpleado_model->obtener_lista_pago_empleado($id_empleado);
		
        
        //////////////////////////// Desplegar //////////////////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
            'resultado_operacion' => $resultado_operacion,
            'mensaje_operacion' => $mensaje_operacion,
			'empleado' => $empleado,
			'dias_aguinaldo' => $dias_aguinaldo,
			'aguinaldo_semanal' => $aguinaldo_semanal,
			'vacaciones_semanal' => $vacaciones_semanal,
			'seguro_afp_vacaciones' => $seguro_afp_vacaciones,
			'insaforp_semanal' => $insaforp_semanal,
			'seguro_afp_semanal' => $seguro_afp_semanal,
			'salario_real_semanal' => $salario_real_semanal,
			'salario_real_mensual' => $salario_real_mensual,
			'cuentas' => $cuentas,
			'pagos' => $pagos
        ));
        
        $this->smarty->view('modificar_empleado.php');
    }
    
    public function procesar()
    {  
		////////////////////////// Variables a utilizar ///////////////////////////+
		$valido = true;
		
		////////////////////////// Captura de datos ///////////////////////////////
		$id_empleado = $this->input->post('id_empleado');
        $nombre_empleado = $this->input->post('nombre_empleado');
		$fecha_contratacion = $this->input->post('fecha_contratacion');
		$salario_base_diario = $this->input->post('salario_base_diario');
		$tipo_empleado = $this->input->post('tipo_empleado');
		
		///////////////////////// Ejecucion de logica /////////////////////////////
		if ($valido)
		{
			$this->Empleado_model->modificar_empleado($id_empleado, $nombre_empleado, $fecha_contratacion, $salario_base_diario, $tipo_empleado);
			
			$this->session->set_userdata("resultado_operacion","exito");
			$this->session->set_userdata("mensaje_operacion","La cmodificacion fue realizada con exito");
		}
		
		redirect('/modificarempleado/index/' . $id_empleado);
    }
	
	public function procesarpago()
	{
		$id_empleado = $this->input->post('id_empleado');
		
		$periodo_contable = $this->PeriodoContable_model->obtener_periodo_abierto()[0];
		$cuenta_izquierda = explode(',', $this->input->post('cuenta_izquierda'));
        $cuenta_derecha = explode(',', $this->input->post('cuenta_derecha'));
        $opcion_lado = $this->input->post('opcion_lado');
        $monto = $this->input->post('txt_monto');
        $fecha_creacion = date('Y-m-d H:i:s');
        $esta_en_debe_izquierda = '';
        $esta_en_debe_derecha = '';
        $es_ajuste = 'F';
		
		// Si es debe, es porque la izquierda esta en el debe, y la derecha en el haber
        if ($opcion_lado == 'debe')
        {
            $esta_en_debe_izquierda = 'V';
            $esta_en_debe_derecha = 'F';
        } else {
            $esta_en_debe_izquierda = 'F';
            $esta_en_debe_derecha = 'V';
        }
		
		// Realizar insert de las transacciones (Primero izquierda, segunda derecha)
        $id_transaccion_1 = $this->Transaccion_model->insertar_transaccion($periodo_contable['id_periodo_contable'], $cuenta_izquierda[0],
                                  $monto, $esta_en_debe_izquierda, $es_ajuste, $fecha_creacion);
                                  
        $id_transaccion_2 = $this->Transaccion_model->insertar_transaccion($periodo_contable['id_periodo_contable'], $cuenta_derecha[0],
                                  $monto, $esta_en_debe_derecha, $es_ajuste, $fecha_creacion);
								
		// Creamos el objeto pago
		$this->PagoEmpleado_model->insertar_pago_empleado($id_empleado, $monto, $fecha_creacion, $id_transaccion_1, $id_transaccion_2);
	}
}