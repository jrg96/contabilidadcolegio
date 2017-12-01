<?php
defined('BASEPATH') OR exit('No direct script access allowed');


////////////////////////////////////TIPO: Pagina Admin ////////////////////////
class EliminarCriterioRepartoPrimario extends CI_Controller {
	
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
		$this->load->model('CriterioRepartoPrimario_model');
        $this->load->library('session');
    }
    
	public function index($id_criterio_reparto_primario)
	{
		/////////////////////////// Redireccion seguridad ////////////////////////
		if (!$this->session->userdata('id_usuario'))
		{
			redirect('/login/index');
		}
		
		$this->CriterioRepartoPrimario_model->eliminar_criterio_reparto_primario($id_criterio_reparto_primario);
		
		$this->session->set_userdata('resultado_operacion','exito');
		$this->session->set_userdata('mensaje_operacion','Caso eliminado con exito');
		
		redirect('/listacriteriorepartoprimario/index');
	}
}
