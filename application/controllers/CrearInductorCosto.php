<?php
class CrearInductorCosto extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('parser');
        $this->load->library('session');
		$this->load->model('InductorCosto_model');
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
		// Obtener las actividades
		$actividades = $this->InductorCosto_model->obtener_lista_inductor_costo();
		$es_nuevo_registro = 'no';
		
		if (count($actividades) == 0)
		{
			$es_nuevo_registro = 'si';
			$actividades = $this->Actividad_model->obtener_actividad_portipo('Primaria');
		}
        
        //////////////////////////// Desplegar //////////////////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
            'resultado_operacion' => $resultado_operacion,
            'mensaje_operacion' => $mensaje_operacion,
			'actividades' => $actividades,
			'es_nuevo_registro' => $es_nuevo_registro
        ));
        
        $this->smarty->view('crear_inductor_costo.php');
    }
    
    public function procesarinsertar()
    { 
		$actividades = $this->Actividad_model->obtener_actividad_portipo('Primaria');
		
		foreach($actividades as $actividad)
		{
			$nombre_campo = 'actividad_' . $actividad['id_actividad'];
				
			// Capturando el dato escrito por el usuario
			$nombre_inductor_costo = $this->input->post($nombre_campo);
			$this->InductorCosto_model->insertar_inductor_costo($actividad['id_actividad'], $nombre_inductor_costo);
		}
		
		redirect('/crearinductorcosto/index');
    }
	
	public function procesarmodificar()
	{
		$actividades = $this->InductorCosto_model->obtener_lista_inductor_costo();
		
		foreach($actividades as $actividad)
		{
			$nombre_campo = 'inductor_' . $actividad['id_inductor_costo'];
				
			// Capturando el dato escrito por el usuario
			$nombre_inductor_costo = $this->input->post($nombre_campo);
			$this->InductorCosto_model->modificar_inductor_costo($actividad['id_inductor_costo'], $nombre_inductor_costo);
		}
		
		redirect('/crearinductorcosto/index');
	}
}