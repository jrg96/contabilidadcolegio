<?php
class CatalogoCuentas extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Cuenta_model');
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
		
        $cuentas = $this->Cuenta_model->obtener_cuentas();
        
        $this->smarty->assign(array(
            'cuentas' => $cuentas,
            'base_url' => base_url()
        ));
        
        $this->smarty->view('catalogo_cuentas.php');
    }
}