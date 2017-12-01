<?php
class CrearCentroCosto extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('parser');
        $this->load->library('session');
		$this->load->model('CentroCosto_model');
    }
    
    public function index()
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
        
        
        //////////////////////////// Desplegar //////////////////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
            'resultado_operacion' => $resultado_operacion,
            'mensaje_operacion' => $mensaje_operacion
        ));
        
        $this->smarty->view('crear_centro_costo.php');
    }
    
    public function procesar()
    {  
		////////////////////////// Variables a utilizar ///////////////////////////+
		$valido = true;
		
		////////////////////////// Captura de datos ///////////////////////////////
        $nombre_centro_costo = $this->input->post('nombre_centro_costo');
		$descripcion_centro_costo = $this->input->post('descripcion_centro_costo');
		
		///////////////////////// Ejecucion de logica /////////////////////////////
		if ($valido)
		{
			$this->CentroCosto_model->insertar_centro_costo($nombre_centro_costo, $descripcion_centro_costo);
			
			$this->session->set_userdata("resultado_operacion","exito");
			$this->session->set_userdata("mensaje_operacion","La creacion fue realizada con exito");
		}
		
		redirect('/crearcentrocosto/index');
    }
}