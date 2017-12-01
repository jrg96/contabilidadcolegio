<?php
class VerRepartoSecundario extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('RepartoPrimario_model');
		$this->load->model('UnidadRepartoPrimario_model');
		$this->load->model('RepartoSecundarioMaster_model');
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
		
		// Paso 1: ver la distribucion del reparto primario y crear el maestro de reparto secundario
		$reparto_primario = new RepartoPrimario_model();
		$reparto_primario->cargar_datos();
		$reparto_secundario = new RepartoSecundarioMaster_model();
		
		// Paso 2: obtener las filas y por cada una de ellas enviarla al maestro de reparto secundario
		$centros_costo_repartidos = $reparto_primario->obtener_filas();
		foreach($centros_costo_repartidos as $fila)
		{
			$reparto_secundario->agregar_fila_centro_costo($fila);
		}
		
		// Paso 3: calcular los repartos secundarios
		$reparto_secundario->calcular_reparto_secundario();
		$info_a_desplegar = $reparto_secundario->obtener_info_a_desplegar();
		
		/////////////////////////////// Depslegar ///////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
			'info_a_desplegar' => $info_a_desplegar
        ));
        
        $this->smarty->view('ver_reparto_secundario.php');
    }
}