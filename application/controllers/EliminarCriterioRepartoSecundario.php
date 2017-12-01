<?php
defined('BASEPATH') OR exit('No direct script access allowed');


////////////////////////////////////TIPO: Pagina Admin ////////////////////////
class EliminarCriterioRepartoSecundario extends CI_Controller {
	
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
		$this->load->model('CriterioRepartoSecundario_model');
        $this->load->library('session');
    }
    
	public function index($id_criterio_reparto_secundario)
	{
		/////////////////////////// Redireccion seguridad ////////////////////////
		if (!$this->session->userdata('id_usuario'))
		{
			redirect('/login/index');
		}
		
		$this->CriterioRepartoSecundario_model->eliminar_criterio_reparto_secundario($id_criterio_reparto_secundario);
		
		$this->session->set_userdata('resultado_operacion','exito');
		$this->session->set_userdata('mensaje_operacion','Caso eliminado con exito');
		
		redirect('/listacriteriorepartosecundario/index');
	}
}
