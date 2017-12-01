<?php
class CrearActividad extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('parser');
        $this->load->library('session');
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
        
		//////////////////////////// Obtener datos de la DB /////////////////////////
		$centros_costo = $this->CentroCosto_model->obtener_lista_centro_costo();
        
        //////////////////////////// Desplegar //////////////////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
            'resultado_operacion' => $resultado_operacion,
            'mensaje_operacion' => $mensaje_operacion,
			'centros_costo' => $centros_costo
        ));
        
        $this->smarty->view('crear_actividad.php');
    }
    
    public function procesar()
    {  
		////////////////////////// Variables a utilizar ///////////////////////////+
		$valido = true;
		
		////////////////////////// Captura de datos ///////////////////////////////
        $id_centro_costo = $this->input->post('id_centro_costo');
		$nombre_actividad = $this->input->post('nombre_actividad');
		$descripcion_actividad = $this->input->post('descripcion_actividad');
		$tipo_actividad = $this->input->post('tipo_actividad');
		
		///////////////////////// Ejecucion de logica /////////////////////////////
		if ($valido)
		{
			$this->Actividad_model->insertar_actividad($id_centro_costo, $nombre_actividad, $descripcion_actividad, $tipo_actividad);
			
			$this->session->set_userdata("resultado_operacion","exito");
			$this->session->set_userdata("mensaje_operacion","La creacion fue realizada con exito");
		}
		
		redirect('/crearactividad/index');
    }
}