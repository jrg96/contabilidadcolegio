<?php
class CrearCuenta extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
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
		
        $resultado_operacion = 'ninguna';
        $mensaje_operacion = 'm';
        
        if ($this->session->userdata('resultado_operacion'))
        {
            $resultado_operacion = $this->session->userdata('resultado_operacion');
            $mensaje_operacion = $this->session->userdata('mensaje_operacion');
            
            $this->session->unset_userdata('resultado_operacion');
            $this->session->unset_userdata('mensaje_operacion');
        }
        
        $cuentas = $this->Cuenta_model->obtener_cuentas();
        
        $this->smarty->assign(array(
            'cuentas' => $cuentas,
            'base_url' => base_url(),
            'resultado_operacion' => $resultado_operacion,
            'mensaje_operacion' => $mensaje_operacion
        ));
        
        $this->smarty->view('crear_cuenta.php');
    }
    
    public function procesar()
    {  
        $id_cuenta = $this->input->post('id_cuenta');
        $id_clase_cuenta = $this->input->post('clase_cuenta');
        $id_grupo_cuenta = $this->input->post('grupo_cuenta');
        $id_cuenta_mayor = $this->input->post('detalle_de');
        $nombre_cuenta = $this->input->post('nombre_cuenta');
        $es_desinversion = $this->input->post('es_desinversion');
		$es_capitalemp = $this->input->post('es_capitalemp');
		$es_utilidadret = $this->input->post('es_utilidadret');
        $atributo_cuenta = '';
        
        $partes_id = explode(",", $id_cuenta_mayor);
        echo var_dump($partes_id);
        
        if (count($partes_id) == 4)
        {
            $id_cuenta_mayor = $partes_id[2];
        }
        
        if ($es_desinversion == 'on')
        {
            $atributo_cuenta = 'DI';
        }
		
		if ($es_capitalemp == 'on')
		{
			$atributo_cuenta = 'KE';
		}
		
		if ($es_utilidadret == 'on')
		{
			$atributo_cuenta = 'UR';
		}
        
        $this->Cuenta_model->insertar_cuenta($id_cuenta, $id_clase_cuenta, $id_grupo_cuenta
                                                     ,$id_cuenta_mayor, $nombre_cuenta, $atributo_cuenta);
                                                     
        
        $this->session->set_userdata("resultado_operacion","exito");
        $this->session->set_userdata("mensaje_operacion","La creacion ha sido realizada con exito");
        redirect('/crearcuenta/index');
    }
}