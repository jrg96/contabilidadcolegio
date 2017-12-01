<?php
class CrearConsumidorCosto extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('ConsumidorCosto_model');
		$this->load->model('InductorConsumido_model');
		$this->load->model('InductorCosto_model');
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
		
		///////////////////////////// Mensajes Aplicacion ///////////////////////////
        $resultado_operacion = 'ninguna';
        $mensaje_operacion = 'm';
        
        if ($this->session->userdata('resultado_operacion'))
        {
            $resultado_operacion = $this->session->userdata('resultado_operacion');
            $mensaje_operacion = $this->session->userdata('mensaje_operacion');
            
            $this->session->unset_userdata('resultado_operacion');
            $this->session->unset_userdata('mensaje_operacion');
        }
        
		//////////////////////////// Obtener Datos de la DB ////////////////////////
		$inductores_costo = $this->InductorCosto_model->obtener_lista_inductor_costo();
		
		
		//////////////////////////// Desplegar /////////////////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
            'resultado_operacion' => $resultado_operacion,
            'mensaje_operacion' => $mensaje_operacion,
			'inductores_costo' => $inductores_costo
        ));
        
        $this->smarty->view('crear_consumidor_costo.php');
    }
	
	public function procesar()
	{
		$valido = TRUE;
		
		/////////////// Captura datos criterio reparto primario ////////////////////
		$nombre_consumidor_costo = $this->input->post('nombre_consumidor_costo');
		$inductores_costo = $this->InductorCosto_model->obtener_lista_inductor_costo();
		
		if($valido)
		{
			$id_consumidor_costo = $this->ConsumidorCosto_model->insertar_consumidor_costo($nombre_consumidor_costo);
			
			foreach($inductores_costo as $inductor)
			{
				$nombre_campo = 'inductor_' . $inductor['id_inductor_costo'];
				$valor_inductor = $this->input->post($nombre_campo); ;
				
				$this->InductorConsumido_model->insertar_inductor_consumido($id_consumidor_costo, $inductor['id_inductor_costo'], $valor_inductor);
			}
			
			$this->session->set_userdata("resultado_operacion","exito");
			$this->session->set_userdata("mensaje_operacion","La creacion fue realizada con exito");
		}
		
		redirect('/crearconsumidorcosto/index');
	}
}