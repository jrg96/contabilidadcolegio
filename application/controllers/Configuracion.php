<?php
class Configuracion extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
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
        
        $this->smarty->view('configuracion_general.php');
    }
    
    public function procesar()
    {
        $perc_utilidad_retenida = $this->input->post('utilidades_retenidas');
        $longitud_periodo_contable = $this->input->post('periodo_contable');
        
        $this->Configuracion_model->actualizar_configuracion($perc_utilidad_retenida, $longitud_periodo_contable);
        
        $this->session->set_userdata('resultado_operacion','exito');
        $this->session->set_userdata('mensaje_operacion','La modificacion ha sido realizada con exito');
        redirect('/configuracion');
    }
}