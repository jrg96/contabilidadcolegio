<?php
class VerTransaccionesCuenta extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('CuentaEncapsulada_model');
		$this->load->model('PeriodoContable_model');
        $this->load->library('parser');
		$this->load->library('session');
    }
    
    public function index($id_cuenta_interno)
    {   
		/////////////////////////// Redireccion seguridad ////////////////////////
		if (!$this->session->userdata('id_usuario'))
		{
			redirect('/login/index');
		}
		
        // Cargamos la cuenta encapsulada
        $cuenta = new CuentaEncapsulada_model();
        $cuenta->cargar_cuenta($id_cuenta_interno);
        
        // Filtrando las transacciones a desplegar y saldar cuenta
        $transacciones_desplegar = $cuenta->filtrar_transacciones('todo');
        $saldo = $cuenta->saldar_cuenta('todo');
		
		// Caso especial: datos han sido enviados de periodo especifico
		$id_periodo_contable;
		
		if ($this->session->userdata('periodo_especifico'))
        {
            $id_periodo_contable = $this->session->userdata('periodo_especifico');
			$cuenta->cargar_cuenta_periodo($id_cuenta_interno, $id_periodo_contable);
			$transacciones_desplegar = $cuenta->filtrar_transacciones('todo');
			$saldo = $cuenta->saldar_cuenta('todo');
			$this->session->unset_userdata('periodo_especifico');
        }
		
		///////////////// Datos de la DB /////////////////////////
		$periodos = $this->PeriodoContable_model->obtener_lista_periodo_contable();
        
        $this->smarty->assign(array(
            'base_url' => base_url(),
            'transacciones_desplegar' => $transacciones_desplegar,
            'saldo_debe' => $saldo[0],
            'saldo_haber' => $saldo[1],
            'cuenta' => $cuenta->obtener_datos_cuenta(),
			'periodos' => $periodos
        ));
        
        $this->smarty->view('ver_transacciones_cuenta.php');
    }
	
	public function procesar()
	{
		$id_cuenta = $this->input->post('id_cuenta');
		$id_periodo_contable = $this->input->post('id_periodo_contable');
		
		// Guardar en sesion y redireccionar
		$this->session->set_userdata("periodo_especifico", $id_periodo_contable);
		
		redirect('/vertransaccionescuenta/index/' . $id_cuenta);
	}
}