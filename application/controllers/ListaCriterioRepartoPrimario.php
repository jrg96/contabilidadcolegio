<?php
class ListaCriterioRepartoPrimario extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('CriterioRepartoPrimario_model');
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
		$criterios_primarios = $this->CriterioRepartoPrimario_model->obtener_lista_criterio_reparto_primario();
		
		/////////////////////////////// Depslegar ///////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
			'criterios_primarios' => $criterios_primarios
        ));
        
        $this->smarty->view('lista_criterio_reparto_primario.php');
    }
}