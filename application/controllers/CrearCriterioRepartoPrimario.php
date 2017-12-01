<?php
class CrearCriterioRepartoPrimario extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Cuenta_model');
		$this->load->model('CentroCosto_model');
		$this->load->model('CriterioRepartoPrimario_model');
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
		$cuentas = $this->Cuenta_model->obtener_cuentas();
		$centros_costo = $this->CentroCosto_model->obtener_lista_centro_costo();
		
		//////////////////////////// Desplegar /////////////////////////////////////
        $this->smarty->assign(array(
            'base_url' => base_url(),
            'resultado_operacion' => $resultado_operacion,
            'mensaje_operacion' => $mensaje_operacion,
			'cuentas' => $cuentas,
			'centros_costo' => $centros_costo
        ));
        
        $this->smarty->view('crear_criterio_reparto_primario.php');
    }
    
    public function procesar()
    {
		/////////////////////////// Variables a utilizar ///////////////////////////
		$valido = TRUE;
		
		/////////////// Captura datos criterio reparto primario ////////////////////
		$id_cuenta_interno = $this->input->post('cuenta_a_repartir');
		$nombre_criterio_reparto_primario = $this->input->post('nombre_criterio_reparto_primario');
		$desc_criterio_reparto_primario = $this->input->post('desc_criterio_reparto_primario');
		$unidad_reparto = $this->input->post('unidad_reparto');
		
        if ($valido)
		{
			$id_criterio_reparto_primario = $this->CriterioRepartoPrimario_model->insertar_criterio_reparto_primario($id_cuenta_interno, $nombre_criterio_reparto_primario, $desc_criterio_reparto_primario, $unidad_reparto);
			$centros_costo = $this->CentroCosto_model->obtener_lista_centro_costo();
			$total = 0.0;
			
			foreach ($centros_costo as $centro)
			{
				$nombre_campo = 'centro_costo_' . $centro['id_centro_costo'];
				
				// Capturando el dato escrito por el usuario
				$valor_unidad = $this->input->post($nombre_campo);
				$id_centro_costo = $centro['id_centro_costo'];
				$id_criterio_reparto_primario = $id_criterio_reparto_primario;
				
				$total += floatval($valor_unidad);
				
				// Insertando el valor para ese centro de costo
				$this->UnidadRepartoPrimario_model->insertar_unidad_reparto_primario($id_criterio_reparto_primario, $id_centro_costo, $valor_unidad);
			}
			
			// por ultimo modificamos valor del total
			$this->CriterioRepartoPrimario_model->modificar_total_criterio_reparto_primario($id_criterio_reparto_primario, $total);
		}
		
		$this->session->set_userdata("resultado_operacion","exito");
        $this->session->set_userdata("mensaje_operacion","La creacion ha sido realizada con exito");
		redirect('/crearcriteriorepartoprimario/index');
    }
}