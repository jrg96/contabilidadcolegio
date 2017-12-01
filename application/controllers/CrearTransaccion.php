<?php
date_default_timezone_set('America/El_Salvador');

class CrearTransaccion extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Cuenta_model');
        $this->load->model('PeriodoContable_model');
        $this->load->model('Transaccion_model');
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
		
        $resultado_operacion = 'ninguna';
        $mensaje_operacion = 'm';
        
        $cuentas = $this->Cuenta_model->obtener_cuentas();
        
        $this->smarty->assign(array(
            'cuentas' => $cuentas,
            'base_url' => base_url(),
            'resultado_operacion' => $resultado_operacion,
            'mensaje_operacion' => $mensaje_operacion
        ));
        
        $this->smarty->view('crear_transaccion.php');
    }
    
    public function procesar()
    {
        $periodo_contable = $this->PeriodoContable_model->obtener_periodo_abierto()[0];
        $ajuste = $this->input->post('es_transaccion_ajuste');
        $cuenta_izquierda = explode(',', $this->input->post('cuenta_izquierda'));
        $cuenta_derecha = explode(',', $this->input->post('cuenta_derecha'));
        $opcion_lado = $this->input->post('opcion_lado');
        $monto = $this->input->post('txt_monto');
        $fecha_creacion = date('Y-m-d H:i:s');
        $esta_en_debe_izquierda = '';
        $esta_en_debe_derecha = '';
        $es_ajuste = '';
        
        // Si es debe, es porque la izquierda esta en el debe, y la derecha en el haber
        if ($opcion_lado == 'debe')
        {
            $esta_en_debe_izquierda = 'V';
            $esta_en_debe_derecha = 'F';
        } else {
            $esta_en_debe_izquierda = 'F';
            $esta_en_debe_derecha = 'V';
        }
        
        if ($ajuste == 'off')
        {
            $es_ajuste = 'F';
        } else{
            $es_ajuste = 'V';
        }
        
        // Realizar insert de las transacciones (Primero izquierda, segunda derecha)
        $id_transaccion_1 = $this->Transaccion_model->insertar_transaccion($periodo_contable['id_periodo_contable'], $cuenta_izquierda[0],
                                  $monto, $esta_en_debe_izquierda, $es_ajuste, $fecha_creacion);
                                  
        $id_transaccion_2 = $this->Transaccion_model->insertar_transaccion($periodo_contable['id_periodo_contable'], $cuenta_derecha[0],
                                  $monto, $esta_en_debe_derecha, $es_ajuste, $fecha_creacion);
								  
    }
}