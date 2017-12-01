<?php
class CentroCostoEncapsulado_model extends CI_Model {
	private $datos_centro_costo;

    public function __construct()
    {
        $this->load->database();
		$this->load->model('CentroCosto_model');
    }
    
	public function cargar_centro_costo($id_centro_costo)
    {
        // paso 1: cargamos la informacion respectiva
		$this->datos_centro_costo = $this->CentroCosto_model->obtener_datos_centro_costo($id_centro_costo);
    }
	
	public function get_centro_costo()
	{
		return $this->datos_centro_costo;
	}
}