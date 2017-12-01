<?php
defined('BASEPATH') OR exit('No direct script access allowed');


////////////////////////////////////TIPO: Pagina Admin ////////////////////////
class EliminarCentroCosto extends CI_Controller {
	
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
		$this->load->model('CentroCosto_model');
        $this->load->library('session');
    }
    
	public function index($id_centro_costo)
	{
		/////////////////////////// Redireccion seguridad ////////////////////////
		if (!$this->session->userdata('id_usuario'))
		{
			redirect('/login/index');
		}
		
		$this->CentroCosto_model->eliminar_centro_costo($id_centro_costo);
		
		$this->session->set_userdata('resultado_operacion','exito');
		$this->session->set_userdata('mensaje_operacion','Caso eliminado con exito');
		
		redirect('/listacentroscosto/index');
	}
}
