<?php
date_default_timezone_set('America/El_Salvador');

class CrearPeriodoContable extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Configuracion_model');
        $this->load->model('PeriodoContable_model');
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
        
        if ($this->session->userdata('resultado_operacion'))
        {
            $resultado_operacion = $this->session->userdata('resultado_operacion');
            $mensaje_operacion = $this->session->userdata('mensaje_operacion');
            
            $this->session->unset_userdata('resultado_operacion');
            $this->session->unset_userdata('mensaje_operacion');
        }
        
        
        
        
        $config = $this->Configuracion_model->obtener_configuracion();
        $perc_utilidad_retenida = 0;
        $longitud_periodo_contable = 0;
        
        if (!empty($config)){
            $perc_utilidad_retenida = $config[0]['perc_utilidad_retenida'];
            $longitud_periodo_contable = $config[0]['longitud_periodo_contable'];
        }
        
        $this->smarty->assign(array(
            'base_url' => base_url(),
            'perc_utilidad_retenida' => $perc_utilidad_retenida,
            'longitud_periodo_contable' => $longitud_periodo_contable,
            'resultado_operacion' => $resultado_operacion,
            'mensaje_operacion' => $mensaje_operacion
        ));
        
        $this->smarty->view('crear_periodo_contable.php');
    }
    
    public function procesar()
    {
		
        $config = $this->Configuracion_model->obtener_configuracion();
        
        $fecha_inicio = $this->input->post('fecha_inicio');
        $longitud_periodo_contable = intval($this->input->post('longitud_periodo_contable'));
		$fecha_partes = explode('/', $fecha_inicio);
		$str_fecha_inicio = $fecha_partes[1] . '-' . $fecha_partes[0] . '-01';
		
		// Paso 1: Obtener el inicio del mes
		$fecha_inicio = new DateTime($str_fecha_inicio);
		
		// Paso 2: sumarle la cantidad de meses-1 que lleva el periodo contable
		$fecha_final = new DateTime($str_fecha_inicio);
		$fecha_final->modify('+' . ($longitud_periodo_contable-1) . ' month');
		
		// Variables a enviar
		$fecha_creacion = date('Y-m-d H:i:s');
		$fecha_inicio = $fecha_inicio->format('Y-m-d H:i:s');
		$fecha_final = $fecha_final->format('Y-m-t H:I:s');
		$meses_duracion = $longitud_periodo_contable;
        $perc_utilidad_retenida = $config[0]['perc_utilidad_retenida'];
        $estado = 'abierto';
		
		$this->PeriodoContable_model->insertar_periodocontable($fecha_creacion, $fecha_inicio, $fecha_final, $meses_duracion, $perc_utilidad_retenida, $estado);
        $this->session->set_userdata('resultado_operacion','exito');
        $this->session->set_userdata('mensaje_operacion','El periodo contable se ha creadop con exito');
        redirect('/crearperiodocontable');
    }
}