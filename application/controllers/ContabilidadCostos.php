<?php
class ContabilidadCostos extends CI_Controller {    
    
	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
		$this->load->helper('url');
		$this->load->model('CentroCosto_model');
		$this->load->model('Actividad_model');
    }
	
	public function index()
	{
		/////////////////////////// Redireccion seguridad ////////////////////////
		if (!$this->session->userdata('id_usuario'))
		{
			redirect('/login/index');
		}
		
		///////////////////// Mensajes Aplicacion ////////////////////////
		$resultado_operacion = 'ninguna';
        $mensaje_operacion = 'm';
        
        if ($this->session->userdata('resultado_operacion'))
        {
            $resultado_operacion = $this->session->userdata('resultado_operacion');
            $mensaje_operacion = $this->session->userdata('mensaje_operacion');
            
            $this->session->unset_userdata('resultado_operacion');
            $this->session->unset_userdata('mensaje_operacion');
        }
		
		///////////////////// Obtener datos DB ///////////////////////////
		$centros_costo = $this->CentroCosto_model->obtener_lista_centro_costo();
		$actividades_auxiliares = $this->Actividad_model->obtener_actividad_portipo('Auxiliar');
		
		///////////////////// Desplegar //////////////////////////////////
		$this->smarty->assign(array(
            'base_url' => base_url(),
            'resultado_operacion' => $resultado_operacion,
            'mensaje_operacion' => $mensaje_operacion,
			'centros_costo' => $centros_costo,
			'actividades_auxiliares' => $actividades_auxiliares
        ));
        
        $this->smarty->view( 'contabilidad_costos.php');
	}
}