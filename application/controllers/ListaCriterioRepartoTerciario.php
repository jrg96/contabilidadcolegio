<?php
class ListaCriterioRepartoTerciario extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('CriterioRepartoTerciario_model');
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
		
		//////////////////////////////// Obtener datos DB ///////////////////
		$criterios_terciarios = $this->CriterioRepartoTerciario_model->obtener_lista_criterio_reparto_terciario();
		
		/////////////////////////////// Depslegar ///////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
			'criterios_terciarios' => $criterios_terciarios
        ));
        
        $this->smarty->view('lista_criterio_reparto_terciario.php');
    }
}