<?php
class ListaConsumidoresCosto extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('ConsumidorCosto_model');
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
		$consumidor_costo = $this->ConsumidorCosto_model->obtener_lista_consumidor_costo();
		
		/////////////////////////////// Depslegar ///////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
			'consumidor_costo' => $consumidor_costo
        ));
        
        $this->smarty->view('lista_consumidor_costo.php');
    }
}