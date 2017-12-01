<?php
class ListaCriterioRepartoSecundario extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('CriterioRepartoSecundario_model');
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
		$criterios_secundarios = $this->CriterioRepartoSecundario_model->obtener_lista_criterio_reparto_secundario();
		
		/////////////////////////////// Depslegar ///////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
			'criterios_secundarios' => $criterios_secundarios
        ));
        
        $this->smarty->view('lista_criterio_reparto_secundario.php');
    }
}