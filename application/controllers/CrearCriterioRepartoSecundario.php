<?php
class CrearCriterioRepartoSecundario extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Actividad_model');
		$this->load->model('CentroCosto_model');
		$this->load->model('CriterioRepartoSecundario_model');
		$this->load->model('UnidadRepartoSecundario_model');
        $this->load->library('parser');
        $this->load->library('session');
    }
    
    public function index($id_centro_costo)
    {
		/////////////////////////// Redireccion seguridad ////////////////////////
		if (!$this->session->userdata('id_usuario'))
		{
			redirect('/login/index');
		}
		
		///////////////////////////// Mensajes Aplicacion ///////////////////////////
        $resultado_operacion = 'ninguna';
        $mensaje_operacion = 'm';
        
        if ($this->session->userdata('resultado_operacion'))
        {
            $resultado_operacion = $this->session->userdata('resultado_operacion');
            $mensaje_operacion = $this->session->userdata('mensaje_operacion');
            
            $this->session->unset_userdata('resultado_operacion');
            $this->session->unset_userdata('mensaje_operacion');
        }
        
		//////////////////////////// Obtener Datos de la DB ////////////////////////
		$centro_costo = $this->CentroCosto_model->obtener_datos_centro_costo($id_centro_costo);
		$criterio_reparto_secundario = $this->CriterioRepartoSecundario_model->obtener_datos_criterio_reparto_secundario_porcentrocosto($id_centro_costo);
		$actividades = $this->Actividad_model->obtener_actividad_porcentrocosto($id_centro_costo);
		$es_nuevo_registro = 'no';
		
		if (count($criterio_reparto_secundario) == 0)
		{
			$es_nuevo_registro = 'si';
		}
		else
		{
			$criterio_reparto_secundario = $criterio_reparto_secundario[0];
			// cargar actividades en base a las ligadas a este 
			$actividades = $this->UnidadRepartoSecundario_model->obtener_lista_unidad_reparto_secundario($criterio_reparto_secundario['id_criterio_reparto_secundario']);
		}
		
		
		//////////////////////////// Desplegar /////////////////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
            'resultado_operacion' => $resultado_operacion,
            'mensaje_operacion' => $mensaje_operacion,
			'centro_costo' => $centro_costo,
			'criterio_reparto_secundario' => $criterio_reparto_secundario,
			'es_nuevo_registro' => $es_nuevo_registro,
			'actividades' => $actividades
        ));
        
        $this->smarty->view('crear_criterio_reparto_secundario.php');
    }
    
    public function procesarinsertar()
    {
		$valido = TRUE;
		
		/////////////// Captura datos criterio reparto primario ////////////////////
		$id_centro_costo = $this->input->post('id_centro_costo');
		$nombre_criterio_reparto_secundario = $this->input->post('nombre_criterio_reparto_secundario');
		$desc_criterio_reparto_secundario = $this->input->post('desc_criterio_reparto_secundario');
		$unidad_reparto = $this->input->post('unidad_reparto');
		$total = 0.0;
		
		if ($valido)
		{
			$id_criterio_reparto_secundario = $this->CriterioRepartoSecundario_model->insertar_criterio_reparto_secundario($id_centro_costo, $nombre_criterio_reparto_secundario, $desc_criterio_reparto_secundario, $unidad_reparto);
			$actividades = $this->Actividad_model->obtener_actividad_porcentrocosto($id_centro_costo);
			
			foreach($actividades as $actividad)
			{
				$nombre_campo = 'actividad_' . $actividad['id_actividad'];
				
				// Capturando el dato escrito por el usuario
				$valor_unidad = $this->input->post($nombre_campo);
				$id_actividad = $actividad['id_actividad'];
				$id_criterio_reparto_secundario = $id_criterio_reparto_secundario;
				$total += floatval($valor_unidad);
				
				$this->UnidadRepartoSecundario_model->insertar_unidad_reparto_secundario($id_criterio_reparto_secundario, $id_actividad, $valor_unidad);
			}
			
			$this->CriterioRepartoSecundario_model->modificar_total_criterio_reparto_secundario($id_criterio_reparto_secundario, $total);
		}
		
		redirect('/crearcriteriorepartosecundario/index/' . $id_centro_costo);
    }
	
	public function procesarmodificar()
	{
		$valido = TRUE;
		
		/////////////// Captura datos criterio reparto primario ////////////////////
		$id_criterio_reparto_secundario = $this->input->post('id_criterio_reparto_secundario');
		$id_centro_costo = $this->input->post('id_centro_costo');
		$nombre_criterio_reparto_secundario = $this->input->post('nombre_criterio_reparto_secundario');
		$desc_criterio_reparto_secundario = $this->input->post('desc_criterio_reparto_secundario');
		$unidad_reparto = $this->input->post('unidad_reparto');
		$total = 0.0;
		
		if ($valido)
		{
			$this->CriterioRepartoSecundario_model->modificar_criterio_reparto_secundario($id_criterio_reparto_secundario, $id_centro_costo, $nombre_criterio_reparto_secundario, $desc_criterio_reparto_secundario, $unidad_reparto);
			$actividades = $this->UnidadRepartoSecundario_model->obtener_lista_unidad_reparto_secundario($id_criterio_reparto_secundario);
			
			foreach($actividades as $actividad)
			{
				$nombre_campo = 'unidad_reparto_' . $actividad['id_unidad_reparto_secundario'];
				
				// Capturando el dato escrito por el usuario
				$valor_unidad = $this->input->post($nombre_campo);
				$id_unidad_reparto_secundario = $actividad['id_unidad_reparto_secundario'];
				$id_criterio_reparto_secundario = $id_criterio_reparto_secundario;
				
				$total += floatval($valor_unidad);
				
				$this->UnidadRepartoSecundario_model->modificar_unidad_reparto_secundario($id_unidad_reparto_secundario, $valor_unidad);
			}
			
			$this->CriterioRepartoSecundario_model->modificar_total_criterio_reparto_secundario($id_criterio_reparto_secundario, $total);
		}
		
		redirect('/crearcriteriorepartosecundario/index/' . $id_centro_costo);
	}
}