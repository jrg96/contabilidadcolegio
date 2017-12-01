<?php
class ModificarCentroCosto extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('parser');
        $this->load->library('session');
		$this->load->model('CentroCosto_model');
    }
    
    public function index($id_centro_costo)
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
		
		//////////////////////////// Obtener datos de laDB //////////////////////////
		$centro_costo = $this->CentroCosto_model->obtener_datos_centro_costo($id_centro_costo);
        
		echo var_dump($centro_costo);
        
        //////////////////////////// Desplegar //////////////////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
            'resultado_operacion' => $resultado_operacion,
            'mensaje_operacion' => $mensaje_operacion,
			'centro_costo' => $centro_costo
        ));
        
        $this->smarty->view('modificar_centro_costo.php');
    }
    
    public function procesar()
    {  
		////////////////////////// Variables a utilizar ///////////////////////////+
		$valido = true;
		
		////////////////////////// Captura de datos ///////////////////////////////
		$id_centro_costo = $this->input->post('id_centro_costo');
        $nombre_centro_costo = $this->input->post('nombre_centro_costo');
		$descripcion_centro_costo = $this->input->post('descripcion_centro_costo');
		
		///////////////////////// Ejecucion de logica /////////////////////////////
		if ($valido)
		{
			$this->CentroCosto_model->modificar_centro_costo($id_centro_costo, $nombre_centro_costo, $descripcion_centro_costo);
			
			$this->session->set_userdata("resultado_operacion","exito");
			$this->session->set_userdata("mensaje_operacion","La creacion fue realizada con exito");
		}
		
		redirect('/modificarcentrocosto/index/' . $id_centro_costo);
    }
}