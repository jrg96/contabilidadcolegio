<?php
class Cuenta_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    public function obtener_cuentas($id_cuenta = NULL)
    {
        $this->db->select('*');
        $this->db->from('tbl_cuenta');
        $this->db->join('tbl_clase_cuenta', 'tbl_cuenta.id_clase_cuenta = tbl_clase_cuenta.id_clase_cuenta');
        $this->db->join('tbl_grupo_cuenta', 'tbl_cuenta.id_grupo_cuenta = tbl_grupo_cuenta.id_grupo_cuenta');
        
        if (!empty($id_cuenta))
        {
            $this->db->where('tbl_cuenta.id_cuenta_interno', $id_cuenta);
        }
        
        $this->db->order_by('tbl_cuenta.id_clase_cuenta', 'ASC');
        $this->db->order_by('tbl_cuenta.id_grupo_cuenta', 'ASC');
        $this->db->order_by('tbl_cuenta.id_cuenta_mayor', 'ASC');
        $this->db->order_by('tbl_cuenta.id_cuenta', 'ASC');
        $resultado = $this->db->get();
        
        return $resultado->result_array();
    }
    
    public function obtener_cuentas_por_tipo($tipo = 'resultado')
    {
        $this->db->select('*');
        $this->db->from('tbl_cuenta');
        $this->db->join('tbl_clase_cuenta', 'tbl_cuenta.id_clase_cuenta = tbl_clase_cuenta.id_clase_cuenta');
        $this->db->join('tbl_grupo_cuenta', 'tbl_cuenta.id_grupo_cuenta = tbl_grupo_cuenta.id_grupo_cuenta');
        
        if ($tipo == 'resultado')
        {
            $this->db->where_in('tbl_cuenta.id_clase_cuenta', array('4', '5'));
        }
        
        if ($tipo == 'capital')
        {
            $this->db->where_in('tbl_cuenta.id_clase_cuenta', array('3'));
        }
		
		if ($tipo == 'activo_pasivo')
		{
			$this->db->where_in('tbl_cuenta.id_clase_cuenta', array('1', '2'));
		}
        
        $this->db->order_by('tbl_cuenta.id_clase_cuenta', 'ASC');
        $this->db->order_by('tbl_cuenta.id_grupo_cuenta', 'ASC');
        $this->db->order_by('tbl_cuenta.id_cuenta_mayor', 'ASC');
        $this->db->order_by('tbl_cuenta.id_cuenta', 'ASC');
        $resultado = $this->db->get();
        
        return $resultado->result_array();
    }
    
    public function insertar_cuenta($id_cuenta, $id_clase_cuenta, $id_grupo_cuenta, $id_cuenta_mayor, $nombre_cuenta, $atributo_cuenta)
    {   
        if ($id_cuenta_mayor == "-1")
        {
            $id_cuenta_mayor = $id_cuenta;
            $id_cuenta = null;
        }
        
        // Creando array de datos
        $datos = array(
                    'id_cuenta' => $id_cuenta, 
                    'id_clase_cuenta' => $id_clase_cuenta, 
                    'id_grupo_cuenta' => $id_grupo_cuenta, 
                    'id_cuenta_mayor' => $id_cuenta_mayor, 
                    'nombre_cuenta' => $nombre_cuenta, 
                    'atributo_cuenta' => $atributo_cuenta);
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->insert('tbl_cuenta', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
    
    public function modificar_cuenta($id_cuenta, $id_clase_cuenta, $id_grupo_cuenta, $id_cuenta_mayor, $nombre_cuenta, $atributo_cuenta, $id_interno)
    {   
        if ($id_cuenta_mayor == "-1")
        {
            $id_cuenta_mayor = $id_cuenta;
            $id_cuenta = null;
        }
        
        // Creando array de datos
        $datos = array(
                    'id_cuenta' => $id_cuenta, 
                    'id_clase_cuenta' => $id_clase_cuenta, 
                    'id_grupo_cuenta' => $id_grupo_cuenta, 
                    'id_cuenta_mayor' => $id_cuenta_mayor, 
                    'nombre_cuenta' => $nombre_cuenta, 
                    'atributo_cuenta' => $atributo_cuenta);
        
        // Realizar insert
        $this->db->db_debug = FALSE;
        $this->db->where('id_cuenta_interno', $id_interno);
        $this->db->update('tbl_cuenta', $datos);
        $err = $this->db->error();
        $this->db->db_debug = TRUE;
        
        // Ver codigo de error
        if ($err['code'] == 0)
        {
            return true;
        }
        return false;
    }
}