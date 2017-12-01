<?php
class ModificarConsumidorCosto extends CI_Controller {
    
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
    
    public function index($id_consumidor_costo)
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
		$consumidor_costo = $this->ConsumidorCosto_model->obtener_datos_consumidor_costo($id_consumidor_costo);
		$inductores_costo = $this->InductorConsumido_model->obtener_lista_inductor_consumido($id_consumidor_costo);
		
		
		//////////////////////////// Desplegar /////////////////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
            'resultado_operacion' => $resultado_operacion,
            'mensaje_operacion' => $mensaje_operacion,
			'consumidor_costo' => $consumidor_costo,
			'inductores_costo' => $inductores_costo
        ));
        
        $this->smarty->view('modificar_consumidor_costo.php');
    }
	
	public function procesar()
	{
		$valido = TRUE;
		
		/////////////// Captura datos criterio reparto primario ////////////////////
		$id_consumidor_costo = $this->input->post('id_consumidor_costo');
		$nombre_consumidor_costo = $this->input->post('nombre_consumidor_costo');
		$inductores_costo = $this->InductorConsumido_model->obtener_lista_inductor_consumido($id_consumidor_costo);
		
		if($valido)
		{
			$this->ConsumidorCosto_model->modificar_consumidor_costo($id_consumidor_costo, $nombre_consumidor_costo);
			
			foreach($inductores_costo as $inductor)
			{
				$nombre_campo = 'inductor_' . $inductor['id_inductor_consumido'];
				$valor_inductor = $this->input->post($nombre_campo); ;
				
				$this->InductorConsumido_model->modificar_inductor_consumido($inductor['id_inductor_consumido'], $valor_inductor);
			}
			
			$this->session->set_userdata("resultado_operacion","exito");
			$this->session->set_userdata("mensaje_operacion","La creacion fue realizada con exito");
		}
		
		redirect('/modificarconsumidorcosto/index/' . $id_consumidor_costo);
	}
}