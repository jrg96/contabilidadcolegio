<?php
class VerRepartoTerciario extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('RepartoPrimario_model');
		$this->load->model('UnidadRepartoPrimario_model');
		$this->load->model('RepartoSecundarioMaster_model');
		$this->load->model('RepartoTerciario_model');
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
		
		// Paso 4: obtener las actividades primarias y auxiliares, pasarlas al reparto terciario
		$actividades_primarias = $reparto_secundario->obtener_costo_actividades('Primaria');
		$actividades_auxiliares = $reparto_secundario->obtener_costo_actividades('Auxiliar');
		
		$reparto_terciario = new RepartoTerciario_model();
		$reparto_terciario->set_costos_actividades_primarias($actividades_primarias);
		$reparto_terciario->set_costos_actividades_auxiliares($actividades_auxiliares);
		$reparto_terciario->calcular_reparto_terciario();
		
		$info_a_desplegar = $reparto_terciario->obtener_info_a_desplegar();
		$encabezados = $reparto_terciario->obtener_encabezados_tabla();
		$totales_finales = $reparto_terciario->obtener_totales_finales();
		
		/////////////////////////////// Depslegar ///////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
			'info_a_desplegar' => $info_a_desplegar,
			'criterios_aplicados' => $encabezados,
			'totales_finales' => $totales_finales
        ));
        
        $this->smarty->view('ver_reparto_terciario.php');
    }
}