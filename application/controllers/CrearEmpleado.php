<?php
class CrearEmpleado extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('parser');
        $this->load->library('session');
		$this->load->model('Empleado_model');
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
        
        $this->smarty->view('crear_empleado.php');
    }
    
    public function procesar()
    {  
		////////////////////////// Variables a utilizar ///////////////////////////+
		$valido = true;
		
		////////////////////////// Captura de datos ///////////////////////////////
        $nombre_empleado = $this->input->post('nombre_empleado');
		$fecha_contratacion = $this->input->post('fecha_contratacion');
		$salario_base_diario = $this->input->post('salario_base_diario');
		$tipo_empleado = $this->input->post('tipo_empleado');
		
		///////////////////////// Ejecucion de logica /////////////////////////////
		if ($valido)
		{
			$this->Empleado_model->insertar_empleado($nombre_empleado, $fecha_contratacion, $salario_base_diario, $tipo_empleado);
			
			$this->session->set_userdata("resultado_operacion","exito");
			$this->session->set_userdata("mensaje_operacion","La creacion fue realizada con exito");
		}
		
		redirect('/crearempleado/index');
    }
}