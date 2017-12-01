<?php
class ListaCentrosCosto extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('CentroCosto_model');
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
		$centro_costo = $this->CentroCosto_model->obtener_lista_centro_costo();
		
		/////////////////////////////// Depslegar ///////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
			'centros_costo' => $centro_costo
        ));
        
        $this->smarty->view('lista_centro_costo.php');
    }
}