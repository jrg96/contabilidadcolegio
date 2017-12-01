<?php
class VerRepartoPrimario extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('RepartoPrimario_model');
		$this->load->model('UnidadRepartoPrimario_model');
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
		
		$reparto_primario = new RepartoPrimario_model();
		$reparto_primario->cargar_datos();
		
		$criterios = $reparto_primario->obtener_criterios();
		$info_a_desplegar = $reparto_primario->obtener_info_a_desplegar();
		$totales_finales = $reparto_primario->obtener_totales_finales();
		
		/////////////////////////////// Depslegar ///////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
			'criterios_aplicados' => $criterios,
			'info_a_desplegar' => $info_a_desplegar,
			'totales_finales' => $totales_finales
        ));
        
        $this->smarty->view('ver_reparto_primario.php');
    }
}