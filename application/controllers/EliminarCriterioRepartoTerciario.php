<?php
defined('BASEPATH') OR exit('No direct script access allowed');


////////////////////////////////////TIPO: Pagina Admin ////////////////////////
class EliminarCriterioRepartoTerciario extends CI_Controller {
	
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
		$this->load->model('CriterioRepartoTerciario_model');
        $this->load->library('session');
    }
    
	public function index($id_criterio_reparto_terciario)
	{
		/////////////////////////// Redireccion seguridad ////////////////////////
		if (!$this->session->userdata('id_usuario'))
		{
			redirect('/login/index');
		}
		
		$this->CriterioRepartoTerciario_model->eliminar_criterio_reparto_terciario($id_criterio_reparto_terciario);
		
		$this->session->set_userdata('resultado_operacion','exito');
		$this->session->set_userdata('mensaje_operacion','Caso eliminado con exito');
		
		redirect('/listacriteriorepartoterciario/index');
	}
}
