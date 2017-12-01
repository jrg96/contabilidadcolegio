<?php
class CrearCriterioRepartoTerciario extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Actividad_model');
		$this->load->model('CentroCosto_model');
		$this->load->model('CriterioRepartoTerciario_model');
		$this->load->model('UnidadRepartoTerciario_model');
        $this->load->library('parser');
        $this->load->library('session');
    }
    
    public function index($id_actividad_auxiliar)
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
		$actividad = $this->Actividad_model->obtener_datos_actividad($id_actividad_auxiliar);
		$criterio_reparto_terciario = $this->CriterioRepartoTerciario_model->obtener_datos_criterio_reparto_terciario_poractividad($id_actividad_auxiliar);
		$actividades = $this->Actividad_model->obtener_actividad_portipo('Primaria');
		$es_nuevo_registro = 'no';
		
		if (count($criterio_reparto_terciario) == 0)
		{
			$es_nuevo_registro = 'si';
		}
		else
		{
			$criterio_reparto_terciario = $criterio_reparto_terciario[0];
			// cargar actividades en base a las ligadas a este 
			$actividades = $this->UnidadRepartoTerciario_model->obtener_lista_unidad_reparto_terciario($criterio_reparto_terciario['id_criterio_reparto_terciario']);
		}
		
		
		//////////////////////////// Desplegar /////////////////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
            'resultado_operacion' => $resultado_operacion,
            'mensaje_operacion' => $mensaje_operacion,
			'actividad' => $actividad,
			'criterio_reparto_terciario' => $criterio_reparto_terciario,
			'es_nuevo_registro' => $es_nuevo_registro,
			'actividades' => $actividades
        ));
        
        $this->smarty->view('crear_criterio_reparto_terciario.php');
    }
    
    public function procesarinsertar()
    {
		$valido = TRUE;
		
		/////////////// Captura datos criterio reparto primario ////////////////////
		$id_actividad_auxiliar = $this->input->post('id_actividad_auxiliar');
		$nombre_criterio_reparto_terciario = $this->input->post('nombre_criterio_reparto_terciario');
		$desc_criterio_reparto_terciario = $this->input->post('desc_criterio_reparto_terciario');
		$unidad_reparto = $this->input->post('unidad_reparto');
		$total = 0.0;
		
		if ($valido)
		{
			$id_criterio_reparto_terciario = $this->CriterioRepartoTerciario_model->insertar_criterio_reparto_terciario($id_actividad_auxiliar, $nombre_criterio_reparto_terciario, $desc_criterio_reparto_terciario, $unidad_reparto);
			$actividades = $this->Actividad_model->obtener_actividad_portipo('Primaria');
			
			foreach($actividades as $actividad)
			{
				$nombre_campo = 'actividad_' . $actividad['id_actividad'];
				
				// Capturando el dato escrito por el usuario
				$valor_unidad = $this->input->post($nombre_campo);
				$id_actividad = $actividad['id_actividad'];
				$id_criterio_reparto_terciario = $id_criterio_reparto_terciario;
				$total += floatval($valor_unidad);
				
				$this->UnidadRepartoTerciario_model->insertar_unidad_reparto_terciario($id_criterio_reparto_terciario, $id_actividad, $valor_unidad);
			}
			
			$this->CriterioRepartoTerciario_model->modificar_total_criterio_reparto_terciario($id_criterio_reparto_terciario, $total);
		}
		
		redirect('/crearcriteriorepartoterciario/index/' . $id_actividad_auxiliar);
    }
	
	public function procesarmodificar()
	{
		$valido = TRUE;
		
		/////////////// Captura datos criterio reparto primario ////////////////////
		$id_criterio_reparto_terciario = $this->input->post('id_criterio_reparto_terciario');
		$id_actividad_auxiliar = $this->input->post('id_actividad_auxiliar');
		$nombre_criterio_reparto_terciario = $this->input->post('nombre_criterio_reparto_terciario');
		$desc_criterio_reparto_terciario = $this->input->post('desc_criterio_reparto_terciario');
		$unidad_reparto = $this->input->post('unidad_reparto');
		$total = 0.0;
		
		if ($valido)
		{
			$this->CriterioRepartoTerciario_model->modificar_criterio_reparto_terciario($id_criterio_reparto_terciario, $id_actividad_auxiliar, $nombre_criterio_reparto_terciario, $desc_criterio_reparto_terciario, $unidad_reparto);
			$actividades = $this->UnidadRepartoTerciario_model->obtener_lista_unidad_reparto_terciario($id_criterio_reparto_terciario);
			
			foreach($actividades as $actividad)
			{
				$nombre_campo = 'unidad_reparto_' . $actividad['id_unidad_reparto_terciario'];
				
				// Capturando el dato escrito por el usuario
				$valor_unidad = $this->input->post($nombre_campo);
				$id_unidad_reparto_terciario = $actividad['id_unidad_reparto_terciario'];
				$id_criterio_reparto_terciario = $id_criterio_reparto_terciario;
				
				$total += floatval($valor_unidad);
				
				$this->UnidadRepartoTerciario_model->modificar_unidad_reparto_terciario($id_unidad_reparto_terciario, $valor_unidad);
			}
			
			$this->CriterioRepartoTerciario_model->modificar_total_criterio_reparto_terciario($id_criterio_reparto_terciario, $total);
		}
		
		redirect('/crearcriteriorepartoterciario/index/' . $id_actividad_auxiliar);
	}
}